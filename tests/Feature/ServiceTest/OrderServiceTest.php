<?php

namespace Tests\Feature\ServiceTest;

use App\Models\menu\Lounge;
use App\Models\menu\MenuItem;
use App\Models\menu\Table;
use App\Models\order\Order;
use App\Models\order\OrderDetail;
use App\Services\order\OrderService;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;

class OrderServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_throws_an_exception_if_table_not_found()
    {
        $orderService = new OrderService();

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("No se encontro ninguna mesa con el ID");

        $orderService->getAllOrderDetailsOfTable(999);
    }

    public function test_it_returns_multiple_order_details_for_existing_table()
    {
        // Creamos instancias reales en la base de datos de prueba
        $lounge = Lounge::factory()->create(['name' => 'salon1']);
        $table = Table::factory()->create(['lounge_id' => $lounge->id, 'code' => 'a1']);
        $order = Order::factory()->create(['table_id' => $table->id]);

        $menuItem1 = MenuItem::factory()->create(['name' => '1/4 de pollo a la brasa', 'price' => 25.00]);
        $menuItem2 = MenuItem::factory()->create(['name' => 'Gaseosa Coca Cola 600ml', 'price' => 5.00]);

        $orderDetail1 = OrderDetail::factory()->create([
            'order_id' => $order->id,
            'menu_item_id' => $menuItem1->id,
            'quantity' => 1,
            'total_amount' => 25.00,
        ]);

        $orderDetail2 = OrderDetail::factory()->create([
            'order_id' => $order->id,
            'menu_item_id' => $menuItem2->id,
            'quantity' => 2,
            'total_amount' => 10.00,
        ]);

        // Instanciamos el servicio y llamamos al método que estamos probando
        $orderService = new OrderService();
        $result = $orderService->getAllOrderDetailsOfTable($table->id);

        // Verificamos que el resultado contiene los dos detalles de pedido
        $this->assertCount(2, $result);
        
        // Comprobamos el primer detalle de pedido (1/4 de pollo a la brasa)
        $this->assertEquals([
            'id' => $orderDetail1->id,
            'name' => '1/4 de pollo a la brasa',
            'price' => 25.00,
            'quantity' => 1,
            'total_price' => 25.00,
        ], $result[0]);

        // Comprobamos el segundo detalle de pedido (Gaseosa Coca Cola 600ml)
        $this->assertEquals([
            'id' => $orderDetail2->id,
            'name' => 'Gaseosa Coca Cola 600ml',
            'price' => 5.00,
            'quantity' => 2,
            'total_price' => 10.00,
        ], $result[1]);
    }
}
