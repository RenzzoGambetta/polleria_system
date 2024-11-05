<?php

namespace App\Services\order;

use App\Models\menu\Table;
use App\Models\menu\MenuItem;
use App\Models\order\OrderDetail;
use Exception;

class OrderService
{
    public function __construct() {}

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
