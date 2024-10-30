<?php

namespace App\Services\menu;

use App\Models\menu\Lounge;
use App\Models\menu\Table;

class LoungeService
{
    public function __construct(){}

    public function createLounge(array $data) 
    {
        return $this->createLoungeWithTables($data, 10);
    }

    public function createLoungeAndSetTables(array $data, int $tableQuantity) 
    {
        return $this->createLoungeWithTables($data, $tableQuantity);
    }

    private function createLoungeWithTables(array $data, int $tableQuantity) 
    {
        $lounge = Lounge::create([
           'code' => $data['code'],
           'name' => $data['name'],
           'floor' => (isset($data['floor'])) ? $data['floor'] : 1,
           'address' => $data['address']
        ]);
        
        $tables = [];
        for ($i=1; $i < $tableQuantity + 1; $i++) { 
            $tables[] = [ 'code' => $i ];
        }

        $lounge->tables()->createMany($tables);

        return $lounge;
    }
}
