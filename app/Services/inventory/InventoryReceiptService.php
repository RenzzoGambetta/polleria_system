<?php

namespace App\Services\inventory;

use App\Models\finance\Voucher;
use App\Models\InventoryReceipt;
use App\Models\Supplier;
use App\Models\VoucherType;
use Error;
use Exception;
use Illuminate\Support\Facades\DB;

class InventoryReceiptService
{
    public function __construct(){}

    public function createInventoryReceipt(array $data) {
        DB::beginTransaction();

        try {
            $voucher = Voucher::create([
                'voucher_serie_id' => $data['voucher_type_id'] == 1 ? 1 : 2,
                'correlative_number' => (int) $data['correlative_number'],
                'issuance_date' => $data['issuance_date'],
                'expiration_date' => $data['expiration_date'],
                'payment_type' => $data['payment_type'],
            ]);

            $currentReceipt = new InventoryReceipt([
                'supplier_id' => $data['supplier_id'],
                'incoming_date' => $data['issuance_date'],
                'commentary' => isset($data['commentary']) ? $data['commentary'] : null,
            ]);

            $voucher->inventoryReceipt()->save($currentReceipt);

            $receiptTotalAmount = 0.0;
            for ($i = 0; $i < count($data['supply_ids']); $i++) {
                $currentReceipt->details()->create([
                    'supply_id' => $data['supply_ids'][$i],
                    'price' => floatval($data['prices'][$i]),
                    'quantity' => $data['quantities'][$i],
                    'total_amount' => floatval($data['total_prices'][$i]),
                    'note' => $data['notes'][$i] ?? null,
                ]);

                $receiptTotalAmount += $data['total_prices'][$i];
            }

            $currentReceipt->update(['total_amount' => $receiptTotalAmount]);
            $voucher->update(['total_amount' => $receiptTotalAmount]);

            $inventoryReceipt = $voucher->inventoryReceipt;
            $inventoryReceipt->update(['total_amount' => $receiptTotalAmount]);

            DB::commit();
            return $inventoryReceipt;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateInventoryReceipt(int $receiptId, array $data) 
    {
        DB::beginTransaction();

        try {
            $receipt = InventoryReceipt::findOrFail($receiptId);

            $receipt->update([
                'voucher_id' => $data['voucher_type_id'],
                'voucher_serie' => $data['voucher_serie'],
                'correlative_number' => $data['correlative_number'],
                'supplier_ruc' => $data['supplier_ruc'],
                'issuance_date' => $data['issuance_date'],
                'expiration_date' => $data['expiration_date'],
                'total_amount' => $data['total_amount'],
                'payment_type' => $data['payment_type'],
                'commentary' => isset($data['commentary']) ? $data['commentary'] : null,
            ]);

            $receipt->details()->delete();
            for ($i = 0; $i < count($data['supply_ids']); $i++) {
                $receipt->details()->create([
                    'supply_id' => $data['supply_ids'][$i],
                    'price' => $data['prices'][$i],
                    'quantity' => $data['quantities'][$i],
                    'total_amount' => $data['total_prices'][$i],
                    'note' => $data['notes'][$i],
                ]);
            }

            DB::commit();
            return $receipt;
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    public function deleteInventoryReceipt(int $receiptId) {
        DB::beginTransaction();

        try {
            $receipt = InventoryReceipt::findOrFail($receiptId);
            $receipt->details()->delete();
            $receipt->delete();

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
    }
}
