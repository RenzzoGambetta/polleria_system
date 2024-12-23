<?php

namespace App\Services\order;

use App\Models\order\CashierSession;
use Exception;

class CashierSessionService
{
    public function __construct(){}

    public function openCashRegister(array $data)
    {
        try {
            $cashierSession = CashierSession::create([
                'user_id' => $data['user_id'],
                'employee_id' => $data['employee_id'],
                'opening_balance' => $data['opening_balance'],
                'note' => $data['note'],
                'cash_open_at' => now(),
            ]);

            return $cashierSession;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function closeCashRegister(int $idCashierSession, string $noteEdit)
    {
        $cashierSession = CashierSession::find($idCashierSession);

        if (!$cashierSession) throw new Exception('No se encontró ninguna sesion con ese id');

        try {
            $cashierSession->update([
                'cash_close_at' => now(),
                'note' => isset($noteEdit) ?? $noteEdit,
            ]);

            return true;
        }
        catch (Exception $e) {
            throw $e;
        }
    }
}
