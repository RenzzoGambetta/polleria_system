<?php

namespace Database\Seeders;

use App\Models\menu\MenuItem;
use App\Models\order\Order;
use App\Services\order\OrderService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderCounterSeeder extends Seeder
{
    public function run(): void
    {
        $orderService = new OrderService();

        for ($i=0; $i < 5; $i++) { 
            $data = [
                'client_id' => random_int(1, 5),
                'waiter_id' => 6,
                'is_delibery' => true, 
            ];

            $numberProducts = random_int(1, 3);
            for ($j=0; $j < $numberProducts; $j++) { 
                $itemMenu = MenuItem::find(random_int(1, 5));
                $qty = random_int(1, 2);

                $data['menu_item_ids'][$j] = $itemMenu->id;
                $data['prices'][$j] = $itemMenu->price;
                $data['quantities'][$j] = $qty;
                $data['total_prices'][$j] = $qty * $itemMenu->price;
                $data['is_delibery_details'][$j] = true;
            }

            $orderService->createOrderWithDetails($data);
        }
    }
}
