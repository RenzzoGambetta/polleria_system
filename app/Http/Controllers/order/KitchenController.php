<?php

namespace App\Http\Controllers\order;

use App\Http\Controllers\Controller;
use App\Http\Global\FunctionGlobal;
use App\Models\order\Order;
use App\Models\order\OrderDetail;
use Illuminate\Http\Request;

class KitchenController extends Controller
{
    protected $NavigationPonit;
    
    public function __construct()
    {
        $this->NavigationPonit = FunctionGlobal::NavigationFast(7, 0);
    }
    public function showKitchenList(Request $request)
    {
        $OrderDetail = OrderDetail::where('status', '!=', 'cancelado')->where('status', '!=', 'terminado')->get();

        $Navigation = $this->NavigationPonit;
        return view('order.kitchen_order_list', compact('Navigation', 'OrderDetail'));
    }
}
