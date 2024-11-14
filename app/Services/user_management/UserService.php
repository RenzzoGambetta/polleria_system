<?php

namespace App\Services\user_management;

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
                'password_confirmation' => $data['password_confirmation'],
                'role_id' => $data['role_id'],
                'employee_id' => $data['employee_id'] ?? null,
            ]);

            return $user;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
