<?php

namespace App\Services\order;

use App\Models\menu\Table;
use App\Models\menu\MenuItem;
use App\Models\order\Order;
use App\Models\order\OrderDetail;
use Exception;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function __construct() {}

    public function createOrderWithDetails(array $data) 
    {
        $table = Table::find($data['table_id']);

        $tableIsOccupied = $table->status;
        if ($tableIsOccupied) throw new Exception("La mesa ya tiene un pedido activo");

        DB::beginTransaction();

        try {
            $order = Order::create([
                'table_id' => $table,
                'cashier_session_id' => 1,
                'waiter_id' => $data['waiter_id'],
                'is_delibery' => $data['is_delibery'],
                'commentary' => isset($data['commentary']) ? $data['commentary'] : null,
            ]);
    
            for ($i = 0; $i < count($data['menu_item_ids']); $i++) {
                $order->details()->create([
                    'supply_id' => $data['menu_item_ids'][$i],
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
        } catch  (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateOrderWithDetails($orderId, array $data)
    {
        $order = Order::findOrFail($orderId);

        DB::beginTransaction();

        try {
            $order->update([
                'waiter_id' => $data['waiter_id'],
                'is_delibery' => $data['is_delibery'],
                'commentary' => isset($data['commentary']) ? $data['commentary'] : null,
            ]);

            $order->details()->delete();

            for ($i = 0; $i < count($data['menu_item_ids']); $i++) {
                $order->details()->create([
                    'supply_id' => $data['menu_item_ids'][$i],
                    'price' => $data['prices'][$i],
                    'quantity' => $data['quantities'][$i],
                    'total_amount' => $data['total_prices'][$i],
                    'is_delibery' => $data['is_delibery_details'][$i],
                    'note' => $data['notes'][$i],
                ]);
            }

            DB::commit();
            return $order;
        } catch (Exception $e) {
            DB::rollBack();
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

        $orderDetails = $table->orders()->last()->details;
        $orderDetailsDTO = [];

        foreach ($orderDetails as $od) {
            $orderDetailDTO[] = $this->mapOrderDetailToDTO($od);
        }

        return $orderDetailDTO;
    }

    private function mapOrderDetailToDTO(OrderDetail $od) 
    {
        $orderDetailDTO = [
            'id' => $od->id,
            'name' => $od->item->name,
            'price' => $od->item->price,
            'quantity' => $od->quantity,
            'total_price' => $od->total_amount
        ];

        return $orderDetailDTO;
    }
}