<?php

namespace App\Http\Controllers\user_management;

use App\Http\Controllers\Controller;
use App\Http\Requests\user_management\RoleRequest;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    protected $Navigation = [
        'seccion' => 2,
        'sub_seccion' => 2.2,
        'color' => 22
    ];
    /*
    protected $roleService;
    public function __construct( roleService $roleService)
    {
        $this->roleService = $roleService;
    }
    */
    public function show_position_list()
    {
        $Navigation = $this->Navigation;

        $Roles = Role::paginate(6);
        return view('user_management.role', compact('Navigation', 'Roles'));
    }
    public function show_role_register()
    {
        $Categories = Permission::all()->groupBy('category');
        $Permissions = Permission::all();

        $Navigation = $this->Navigation;
        return view('user_management.role_register', compact('Navigation', 'Permissions', 'Categories'));
    }
    public function store(RoleRequest $request)
    {

        DB::beginTransaction();

        try {

            $role = Role::create(['name' => $request->input('name')]);

            if ($role) {

                foreach ($request->input('permissions') as $permissionId) {
                    DB::table('role_permission')->insert([
                        'role_id' => $role->id,
                        'permission_id' => $permissionId,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('position')->withInput()->with([
                'Message' => 'Rol y permisos asignados correctamente.',
                'Type' => 'success'
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('role_register')->withInput()->with([
                'Message' => 'Error al asignar el rol y permisos.',
                'Type' => 'error'
            ]);
        }
    }
}
