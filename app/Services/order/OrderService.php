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
        $table = Table::find($data['table_id']);

        if ($table) {
            $tableIsOccupied = $table->status;
            if ($tableIsOccupied) throw new Exception("La mesa ya tiene un pedido activo");
        }
        
        DB::beginTransaction();

        try {
            $orderSerie = OrderSerie::findOrFail(1);
            $currentCorrelativeNumber = $orderSerie->last_correlative_number + 1;

            $order = Order::create([
                'order_serie_id' => 1,
                'correlative_number' => $currentCorrelativeNumber,
                'table_id' => isset($data['table_id']) ? $data['table_id'] : null,
                'cashier_session_id' => 1,
                'waiter_id' => $data['waiter_id'],
                'is_delibery' => $data['is_delibery'],
                'commentary' => isset($data['commentary']) ? $data['commentary'] : null,
            ]);

            for ($i = 0; $i < count($data['menu_item_ids']); $i++) {
                $order->details()->create([
                    'menu_item_id' => $data['menu_item_ids'][$i], // se cambio el supply_id a menu_item_id
                    'price' => $data['prices'][$i],
                    'quantity' => $data['quantities'][$i],
                    'total_amount' => $data['total_prices'][$i],
                    'is_delibery' => $data['is_delibery_details'][$i],
                    'note' => $data['notes'][$i],
                ]);
            }

            $table->update([
                'status' => true,
            ]);

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

        DB::beginTransaction();

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

        DB::beginTransaction();

        try {
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

        DB::beginTransaction();

        try {
            $order->update([
                'is_delibery' => $data['is_delibery'],
                'commentary' => isset($data['commentary']) ? $data['commentary'] : null,
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
        //Por tema de tiempo tome la desision de comentar el original y poner uno generico ;v el de avajo esta mas simplificado pero complejo, arregla el original
        /*
        $table = Table::find($tableId);

        if (!$table) throw new Exception("No se encontro ninguna mesa con el ID");

        $orderDetails = $table->orders()->last()->details;
        $orderDetailsDTO = [];

        foreach ($orderDetails as $od) {
            $orderDetailDTO[] = $this->mapOrderDetailToDTO($od);
        }

        return $orderDetailDTO;
        */
        $table = Table::find($tableId);
        if (!$table) return false;

        $order = $table->orders()->latest()->first();
        if (!$order) return false;

        return $order->details->map(fn($od) => $this->mapOrderDetailToDTO($od))->toArray();
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
