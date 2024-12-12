<?php

namespace App\Services\inventory;

use App\Models\InventoryIssue;
use Exception;
use Illuminate\Support\Facades\DB;

class InventoryIssueService
{
    public function __construct(){}

    public function createInventoryIssue(array $data)
    {
        DB::beginTransaction();

        try {
            $currentIssue = InventoryIssue::create([
                'outgoing_date' => now(),
                'commentary' => $data['comment'] ?? null,
            ]);

            for ($i = 0; $i < count($data['id']); $i++) {
                $currentIssue->details()->create([
                    'supply_id' => $data['id'][$i],
                    'price' => 0.0,
                    'quantity' => $data['quantity'][$i],
                    'total_amount' => 0.0,
                    'note' => $data['notes'][$i] ?? null,
                ]);
            };

            DB::commit();
            return $currentIssue;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateInventoryIssue(int $issueId, array $data)
    {
        DB::beginTransaction();

        try {
            $issue = InventoryIssue::findOrFail($issueId);
            
            $issue->update([
                'outgoing_date' => $data['outgoing_date'],
                'commentary' => isset($data['commentary']) ? $data['commentary'] : null,
            ]);

            $issue->details()->delete();
            for ($i = 0; $i < count($data['supply_ids']); $i++) {
                $issue->details()->create([
                    'supply_id' => $data['supply_ids'][$i],
                    'price' => floatval($data['prices'][$i]),
                    'quantity' => $data['quantities'][$i],
                    'total_amount' => floatval($data['total_prices'][$i]),
                    'note' => $data['notes'][$i] ?? null,
                ]);
            };

            DB::commit();
            return $issue;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteInventoryReceipt(int $issueId) {
        DB::beginTransaction();

        try {
            $issue = InventoryIssue::findOrFail($issueId);
            $issue->details()->delete();
            $issue->delete();

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
