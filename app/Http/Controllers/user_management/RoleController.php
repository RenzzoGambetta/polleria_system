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
    public function show_role_register(Request $Data)
    {
        $Navigation = $this->Navigation;

        $Categories = Permission::all()->groupBy('category');

        if ($Data->action == 'edit' || $Data->action == 'modify') {

            $rolePermissions = DB::table('role_permission')
                ->where('role_id', $Data->id)
                ->pluck('permission_id')
                ->toArray();
            $Categories = $Categories->map(function ($permissions, $category) use ($rolePermissions) {
                $hasChecked = false;
                $permissions = $permissions->map(function ($permission) use ($rolePermissions, &$hasChecked) {
                    $permission->checked = in_array($permission->id, $rolePermissions);
                    if ($permission->checked) {
                        $hasChecked = true;
                    }
                    return $permission;
                });
                return (object)[
                    'permissions' => $permissions,
                    'checked' => $hasChecked
                ];
            });
            if ($Data->action == 'edit') {
                $Info = [
                    'title' => 'Modificar Rol',
                    'id' => $Data->id,
                    'form_url' => 'role_edit',
                    'button_text' => 'Editar',
                    'name' => Role::select('name')->where('id', $Data->id)->first() ?? ''
                ];
            } else if ($Data->action == 'modify') {
                $Info = [
                    'title' => 'Nuevo sub Rol de '.Role::select('name')->where('id', $Data->id)->first()->name ?? '',
                    'id' => $Data->id,
                    'form_url' => 'new_extension_role',
                    'button_text' => 'Mejorar',
                    'input_text' => 'Sub nombre',
                    'id_user' => $Data->id_user
                ];
            }
        } else {

            $Categories = $Categories->map(function ($permissions) {
                return (object)[
                    'permissions' => $permissions->map(function ($permission) {
                        $permission->checked = false;
                        return $permission;
                    }),
                    'checked' => false
                ];
            });

            $Info = [
                'title' => 'Registro de nuevo Rol',
                'button_text' => 'Registrar',
                'form_url' => 'role_register_store'
            ];
        }

        //return response()->json($Categories);
        return view('user_management.role_register', compact('Navigation',  'Categories', 'Info'));
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
            //return $e;
            return redirect()->route('role_register')->withInput()->with([
                'Message' => 'Error al asignar el rol y permisos.',
                'Type' => 'error'
            ]);
        }
    }
    public function editRole(CreateRoleRequest $request)
    {
        try {

            $role = Role::find($request->id);

            //*quitar el omentario cuando se complete el servisio para editar
            $response = true;
            //$response = $this->roleService->updateRole($request->validated(), $role);

            if ($response) {
                return redirect()->route('position')->with([
                    'Message' => 'Se edito exitosomente el rol.',
                    'Type' => 'success'
                ]);
            }
            return redirect()->route('role_register', ['id' => $request->id, 'action' => 'edit'])
                ->withInput()
                ->with([
                    'Message' => 'Error al asignar el rol.',
                    'Type' => 'error'
                ]);
        } catch (Exception $e) {
            return redirect()->route('position')
                ->withInput()
                ->with([
                    'Message' => 'Error al asignar el rol.',
                    'Type' => 'error'
                ]);
        }
    }
    public function deleteRole(Request $request)
    {
        try {

            $role = Role::find($request->id);
            //*quitar el omentario cuando se complete el servisio para eliminar
            $response = true;
            //$response = $this->roleService->deleteRole($role);

            if ($response) {
                return redirect()->route('position')->with([
                    'Message' => 'Se elimino exitosomente el rol.',
                    'Type' => 'success'
                ]);
            }
            return redirect()->route('position')->with([
                'Message' => 'No se pudo elimino el rol.',
                'Type' => 'error'
            ]);
        } catch (Exception $e) {
            return redirect()->route('position')->with([
                'Message' => 'No se pudo elimino el rol.',
                'Type' => 'error'
            ]);
        }
    }
    public function newExtensionRole(CreateRoleRequest $request)
    {
        try {

            $role = Role::find($request->id);

            //*quitar el omentario cuando se complete el servisio para editar
            $response = true;
            //$response = $this->roleService->newExtensionRole($request->validated(), $role);

            if ($response) {
                return redirect()->route('user_register', ['id' => $request->id_user, 'action' => 'edit'])->with([
                    'Message' => 'Se creo una modificocion exitosomente del rol.',
                    'Type' => 'success'
                ]);
            }
            return redirect()->route('role_register', ['id' => $request->id, 'action' => 'modify'])
                ->withInput()
                ->with([
                    'Message' => 'Error al modificar un rol.',
                    'Type' => 'error'
                ]);
        } catch (Exception $e) {
            return redirect()->route('role_register')
                ->withInput()
                ->with([
                    'Message' => 'Error al asignar el rol.',
                    'Type' => 'error'
                ]);
        }
    }
}
