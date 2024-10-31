<?php

namespace App\Http\Controllers\order;

use App\Http\Controllers\Controller;
use App\Models\menu\Lounge;
use Illuminate\Http\Request;

class PointOfSaleController extends Controller
{
    protected $NavigationPonit = [
        'seccion' => 6,
        'sub_seccion' => 6.0,
        'color' => 60
    ];
    protected $NavigationSessions = [
        'seccion' => 6,
        'sub_seccion' => 6.1,
        'color' => 61
    ];
    public function showPointOfSale(Request $request)
    {
        $Lounge = Lounge::all();
        $Navigation = $this->NavigationPonit;
        return view('order.point_of_sale', compact('Navigation','Lounge'));
    }
    public function showCashierSessions(Request $request)
    {
        $Lounge = Lounge::all();
        $option=true ;

        if($option){
            $Data =[
                'Title'=> 'Cierre',
                'SubTitle'=>'Serra la caja',
                'Option'=> true
            ];
        }else{
            $Data =[
                'Title'=> 'Apertura',
                'SubTitle'=>'Abrir la caja',
                'Option'=> false
            ];
        }
        $Navigation = $this->NavigationSessions;
        return view('order.cashier_sessions', compact('Navigation','Lounge','Data'));
    }
}

