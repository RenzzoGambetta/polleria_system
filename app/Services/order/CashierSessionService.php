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
                'note' => $data['note'], //se agrego las notas
                'cash_open_at' => now(),
            ]);

            return $cashierSession;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function closeCashRegister(int $idCashierSession, string $noteEdit)
    {
        $cashierSession = CashierSession::find($idCashierSession)->first();
        //$cashierSession = CashierSession::where('id', $idCashierSession)->latest()->first(); // se modifico para que se edite el ultimo del id

        if (!$cashierSession) throw new Exception('No se encontró ninguna sesion con ese id');

        try {
            $cashierSession['cash_close_at'] = now(); //se corrigio  de cash_open_at a cash_close_at
            $cashierSession['note'] = $noteEdit; //se añadio la opcion para editar la nota
            $cashierSession->save(); // se añadio para el guardado en la base de datos
            return true;
        }
        catch (Exception $e) {
            throw $e;
        }
    }
}
