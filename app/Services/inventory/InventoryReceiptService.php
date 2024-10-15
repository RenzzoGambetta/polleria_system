<?php

namespace App\Services\inventory;

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
        $supplyIds = $data['supply_ids'];
        $supplyPrices = $data['prices'];
        $supplyQuantities = $data['quantities'];
        $supplyTotalPrices = $data['total_prices'];
        $supplyNotes = $data['notes'];

        DB::beginTransaction();

        try {
            $currentReceipt = InventoryReceipt::create([
                'voucher_id' => $data['voucher_type_id'],
                'voucher_serie' => $data['voucher_serie'],
                'correlative_number' => $data['correlative_number'],
                'supplier_ruc' => $data['supplier_ruc'],
                'issuance_date' => $data['issuance_date'],
                'expiration_date' => $data['expiration_date'],
                'total_amount' => $data['total_amount'],
                'payment_type' => $data['payment_type'],
                'commentary' => $data['commentary'],
            ]);

            for ($i = 0; $i < count($supplyIds); $i++) {
                $currentReceipt->details()->create([
                    'supply_id' => $supplyIds[$i],
                    'price' => $supplyPrices[$i],
                    'quantity' => $supplyQuantities[$i],
                    'total_amount' => $supplyTotalPrices[$i],
                    'note' => $supplyNotes[$i],
                ]);
            }

            DB::commit();
            return $currentReceipt;
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    public function updateInventoryReceipt(int $receiptId, array $data) {
        $supplyIds = $data['supply_ids'];
        $supplyPrices = $data['prices'];
        $supplyQuantities = $data['quantities'];
        $supplyTotalPrices = $data['total_prices'];
        $supplyNotes = $data['notes'];

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
                'commentary' => $data['commentary'],
            ]);

            $receipt->details()->delete();
            for ($i = 0; $i < count($supplyIds); $i++) {
                $receipt->details()->create([
                    'supply_id' => $supplyIds[$i],
                    'price' => $supplyPrices[$i],
                    'quantity' => $supplyQuantities[$i],
                    'total_amount' => $supplyTotalPrices[$i],
                    'note' => $supplyNotes[$i],
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

    public function fetchSupplierByRuc(string $ruc) {
        $supplier = Supplier::first($ruc);
        return $supplier;
    }

    public function fetchVoucherById(int $id) {
        $voucher_type = VoucherType::first($id);
        return $voucher_type;
    }
}
