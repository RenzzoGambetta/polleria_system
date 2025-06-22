<?php

namespace App\Http\Controllers\config;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Global\ConstGlobal;
use App\Http\Global\FunctionGlobal;
use App\Models\menu\MenuCategory;
use App\Http\Global\FuctionTest;

class CookingPlaceController extends Controller
{
    protected $Navigation;

    public function __construct()
    {
        $this->Navigation = FunctionGlobal::NavigationFast(7,2);
    }

    public function showCookingPlace()
    {
        $Navigation = $this->Navigation;
        $Command = FuctionTest::convertArrayObject([
            ['id' => 1,'name' => 'Caja Principal',     'ip' => '192.168.1.10', 'port' => '9100', 'state' => 'Activo'],
            ['id' => 2,'name' => 'Cocina 1',           'ip' => '192.168.1.11', 'port' => '9100', 'state' => 'Activo'],
            ['id' => 3,'name' => 'Barra',              'ip' => '192.168.1.12', 'port' => '9100', 'state' => 'Inactivo'],
            ['id' => 4,'name' => 'Despacho',           'ip' => '192.168.1.13', 'port' => '9101', 'state' => 'Activo'],
            ['id' => 5,'name' => 'Caja Secundaria',    'ip' => '192.168.1.14', 'port' => '9100', 'state' => 'Activo'],
            ['id' => 6,'name' => 'Recepción',          'ip' => '192.168.1.15', 'port' => '9102', 'state' => 'Inactivo'],
            ['id' => 7,'name' => 'Delivery',           'ip' => '192.168.1.16', 'port' => '9100', 'state' => 'Activo'],
            ['id' => 8,'name' => 'Buffet',             'ip' => '192.168.1.17', 'port' => '9100', 'state' => 'Inactivo'],
            ['id' => 9,'name' => 'Cocina 2',           'ip' => '192.168.1.18', 'port' => '9103', 'state' => 'Activo'],
            ['id' => 10,'name' => 'Bar 2',              'ip' => '192.168.1.19', 'port' => '9100', 'state' => 'Activo'],
        ]);
        return view('config.cooking_place', compact('Navigation', 'Command'));
    }
}
