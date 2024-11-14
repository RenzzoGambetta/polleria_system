<?php

namespace App\Services\user_management;

use App\Models\Role;
use Exception;
use Illuminate\Support\Facades\DB;

class RoleService
{
    public function __construct(){}

    public function createRoleAndAssignPermissions(array $data) 
    {
        DB::beginTransaction();
        try {
            $role = Role::create(['name' => $data['name']]);

            if (!$role) throw new Exception('No se pudo crear el rol');

            $role->updatePermissions($data['permissions']);

            DB::commit();
            return $role;
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function updatesRoleAndAssignPermissions(int $roleId, array $data) 
    {
        $role = Role::findOrFail($roleId);

        DB::beginTransaction();
        try {
            $role->update(['name' => $data['name']]);
            $role->updatePermissions($data['permissions']);

            DB::commit();
            return $role;
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function deleteRoleAndRelatedPermissions(int $roleId) 
    {
        $role = Role::findOrFail($roleId);
        try {
            $role->delete();
            return true;
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
