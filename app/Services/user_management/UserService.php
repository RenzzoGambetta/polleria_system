<?php

namespace App\Services\user_management;

use App\Exceptions\CustomException;
use App\Models\User;
use Exception;

class UserService
{
    public function __construct() {}

    public function createUser(array $data) 
    {
        try {
            $user = User::create([
                'username' => $data['username'],
                'password' => $data['password'],
                'role_id' => $data['role_id'],
                'employee_id' => $data['employee_id'] ?? null,
            ]);

            return $user;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function updateUser(int $userId, array $data) 
    {
        $user = User::findOrFail($userId);

        try {
            $user->update([
                'username' => $data['username'],
                'role_id' => $data['role_id'],
                'employee_id' => $data['employee_id'] ?? null,
            ]);

            if (isset($data['password'])) {
                $user->update([
                    'password' => $data['password'],
                ]);
            };
            
            return $user;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteUser(int $userId) 
    {
        $user = User::findOrFail($userId);

        if ($user->cashierSessions->isNotEmpty()) throw new CustomException('El usuario tiene un historial de una o más sesiones de caja');

        if ($user->orders->isNotEmpty()) throw new CustomException('El usuario ha comandado uno o más pedidos');

        if ($user->voucher_series->isNotEmpty()) throw new CustomException('El usuario ha realizado uno o más pagos de cuentas de clientes');

        try {
            $user->delete();
            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
