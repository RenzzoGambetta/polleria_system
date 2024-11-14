<?php

namespace App\Http\Controllers\user_management;

use App\Http\Controllers\Controller;
use App\Http\Requests\user_management\CreateRoleRequest;
use App\Models\Role;
use App\Models\Permission;
use App\Services\user_management\RoleService;
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
    
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }
    
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
    public function store(CreateRoleRequest $request)
    {
        /*
        *   Implementacion temporal de la creación de roles, modifica la logica.
        */
        try {
            $role = $this->roleService->createRoleAndAssignPermissions($request->validated()); 

            return redirect()->route('position')->withInput()->with([
                'Message' => 'Rol y permisos asignados correctamente.',
                'Type' => 'success'
            ]);
        } catch (Exception $e) {
            return $e;

            return redirect()->route('role_register')->withInput()->with([
                'Message' => 'Error al asignar el rol y permisos.',
                'Type' => 'error'
            ]);
        }
    }
}
