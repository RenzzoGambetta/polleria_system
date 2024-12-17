<?php

namespace App\Services\order;

use App\Models\menu\Table;
use App\Models\menu\MenuItem;
use App\Models\order\Order;
use App\Models\order\OrderDetail;
use App\Models\order\OrderSerie;
use Exception;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function __construct() {}

    public function createOrderWithDetails(array $data)
    {
        $table = Table::find($data['table_id'] ?? 0);

        if ($table) {
            $tableIsOccupied = $table->status;
            if ($tableIsOccupied) throw new Exception("La mesa ya tiene un pedido activo");
        }
        
        DB::beginTransaction();

        try {
            $orderSerie = OrderSerie::findOrFail(1);
            $orderTotalAmount = array_sum($data['total_amount']);
            $currentCorrelativeNumber = $orderSerie->last_correlative_number + 1;

            $order = Order::create([
                'order_serie_id' => 1,
                'correlative_number' => $currentCorrelativeNumber,
                'table_id' => $data['table_id'] ?? null,
                'cashier_session_id' => 1,
                'waiter_id' => $data['waiter_id'],
                'is_delibery' => $data['is_delibery'],
                'commentary' => $data['commentary'] ?? null,
                'total_amount' => $orderTotalAmount,
            ]);

            $acumulativeTotalAmount = 0;
            for ($i = 0; $i < count($data['menu_item_ids']); $i++) {
                $order->details()->create([
                    'menu_item_id' => $data['menu_item_ids'][$i],
                    'price' => $data['prices'][$i],
                    'quantity' => $data['quantities'][$i],
                    'total_amount' => $data['total_prices'][$i],
                    'is_delibery' => $data['is_delibery_details'][$i],
                    'note' => $data['notes'][$i] ?? null,
                ]);

                $acumulativeTotalAmount += $data['total_prices'][$i];
            }

            $order->update([
                'total_amount' => $acumulativeTotalAmount,
            ]);

            $orderSerie->update([
                'last_correlative_number' => $currentCorrelativeNumber,
            ]);

            if ($table) {
                $table->update([
                    'status' => true,
                ]);
            }
            
            DB::commit();
            return $order;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    // public function splitOrder() 
    // {
    //     return [$order1, $order2];
    // }

    public function addDetailsToOrder($orderId, array $data)
    {
        $order = Order::findOrFail($orderId);
        $orderTotalAmount = array_sum($data['total_amount']);

        DB::beginTransaction();

        $order->update([
            'total_amount' => $orderTotalAmount,
        ]);

        try {
            $this->addEveryDetailToOrder($order, $data);

            DB::commit();
            return $order;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateOnlyOrderDetails($orderId, array $data)
    {
        $order = Order::findOrFail($orderId);
        $orderTotalAmount = array_sum($data['total_amount']);

        DB::beginTransaction();

        try {
            $order->update([
                'total_amount' => $orderTotalAmount,
            ]);

            $order->details()->delete();

            $this->addEveryDetailToOrder($order, $data);

            DB::commit();
            return $order;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateOrderWithDetails(int $orderId, array $data)
    {
        $order = Order::findOrFail($orderId);
        $orderTotalAmount = array_sum($data['total_amount']);

        DB::beginTransaction();

        try {
            $order->update([
                'is_delibery' => $data['is_delibery'],
                'commentary' => isset($data['commentary']) ? $data['commentary'] : null,
                'total_amount' => $orderTotalAmount,
            ]);

            $order->details()->delete();

            $this->addEveryDetailToOrder($order, $data);

            DB::commit();
            return $order;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function cancelOrder(int $orderId, string $commentary) 
    {
        $order = Order::findOrFail($orderId);

        if (!isset($commentary)) throw new Exception('Es obligatorio el motivo de cancelacion del pedido');
        try {
            $order->update([
                'status' => 'cancelado',
                'commentary' => $commentary,
            ]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteOrderWithDetails($orderId)
    {
        $order = Order::findOrFail($orderId);
        $table = Table::find($order->table_id);

        DB::beginTransaction();

        try {
            $order->details()->delete();

            $order->delete();

            $table->update(['status' => false]);

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getAllOrderDetailsOfTable(int $tableId)
    {
        $table = Table::find($tableId);

        if (!$table) throw new Exception("No se encontro ninguna mesa con el ID");

        $order = $table->orders()
            ->whereNotIn('status', ['completado', 'cancelado', 'reembolsado'])
            ->latest()
            ->first();

        if (!$order) throw new Exception("No existe una orden pendiente para esta mesa");

        $orderDetails = $order->details;
        $orderDetailsDTO = [];

        foreach ($orderDetails as $od) {
            $orderDetailDTO[] = $this->mapOrderDetailToDTO($od);
        }

        return $orderDetailDTO;
    }

    private function addEveryDetailToOrder(Order $order, array $data)
    {
        for ($i = 0; $i < count($data['menu_item_ids']); $i++) {
            $order->details()->create([
                'menu_item_id' => $data['menu_item_ids'][$i],
                'price' => $data['prices'][$i],
                'quantity' => $data['quantities'][$i],
                'total_amount' => $data['total_prices'][$i],
                'is_delibery' => $data['is_delibery_details'][$i],
                'note' => $data['notes'][$i],
            ]);
        }
    }

    private function mapOrderDetailToDTO(OrderDetail $od)
    {
        $orderDetailDTO = [
            'id' => $od->id,
            'name' => $od->item->name,
            'price' => $od->item->price,
            'quantity' => $od->quantity,
            'total_price' => $od->total_amount,
            'is_delibery' => $od->is_delibery,
            'note' => $od->note
        ];

        return $orderDetailDTO;
    }
}
