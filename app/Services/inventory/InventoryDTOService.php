<?php

namespace App\Services\inventory;

use App\Models\InventoryIssue;
use App\Models\InventoryReceipt;
use Exception;

class InventoryDTOService
{
    public function __construct(){}

    //Solo envia los 300 últimos
    public function getLatestInventoryMovementsDto() {
        $inventoryReceipts = InventoryReceipt::latest('incoming_date')->take(200)->get() ?? collect([]);
        $inventoryIssues = InventoryIssue::latest('outgoing_date')->take(200)->get() ?? collect([]);

        $receiptsMovementDto = $this->mapReceiptsToMovementDto($inventoryReceipts);
        $issuesMovementDto = $this->mapIssuesToMovementDto($inventoryIssues);

        $movementsDto = $receiptsMovementDto->merge($issuesMovementDto);

        return $movementsDto->sortByDesc('date')->take(300)->values();
    }

    private function mapReceiptsToMovementDto($receipts) {
        $receiptsMovementDto = $receipts->map(function ($r) {
            return [
                'id' => $r->id,
                'date' => $r->incoming_date,
                'type' => 'Entrada',
                'proveedor' => $r->supplier->person->name,
                'total_amount' => $r->total_amount,
            ];
        });

        // foreach ($receipts as $r) {
        //     $movementDto = [
        //         'id' => $r->id,
        //         'date' => $r->incoming_date,
        //         'type' => 'Entrada',
        //         'proveedor' => $r->supply->name,
        //         'total_amount' => $r->total_amount,
        //     ];

        //     $receiptsMovementDto[] = $movementDto;
        // }

        return $receiptsMovementDto;
    }

    private function mapIssuesToMovementDto($issues) {
        $issuesMovementDto = $issues->map(function ($i) {
            return [
                'id' => $i->id,
                'date' => $i->outgoing_date,
                'type' => 'Salida',
                'proveedor' => null,
                'total_amount' => 0.0,
            ];
        });

        // foreach ($issues as $i) {
        //     $movementDto = [
        //         'id' => $i->id,
        //         'date' => $i->outgoing_date,
        //         'type' => 'Salida',
        //         'proveedor' => null,
        //         'total_amount' => 0.0,
        //     ];

        //     $issuesMovementDto[] = $movementDto;
        // }

        return $issuesMovementDto;
    }
}
