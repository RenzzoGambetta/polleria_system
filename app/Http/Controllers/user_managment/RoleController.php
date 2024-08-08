<?php

namespace App\Http\Controllers\user_managment;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\Permission;

class RoleController extends Controller
{
    protected $Navigation = [
        'seccion' => 2,
        'sub_seccion' => 2.2,
        'color' => 22
    ];
    public function show_position_list()
    {
        $Navigation = $this->Navigation;

        $Roles = Role::paginate(6);
        return view('user_managment.role', compact('Navigation', 'Roles'));
    }
    public function show_role_register()
    {
        $Categories = Permission::all()->groupBy('category');
        $Permissions = Permission::all();

        $Navigation = $this->Navigation;
        return view('user_managment.role_register', compact('Navigation','Permissions','Categories'));
    }
    public function store(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'array', // Asegura que 'permissions' sea un array
            'permissions.*' => 'integer|exists:permissions,id', // Valida que cada elemento sea un entero existente en la tabla 'permissions'
        ]);

        // Obtener el nombre del rol
        $name = $request->input('name');

        // Obtener los IDs de los permisos seleccionados
        $permissionIds = $request->input('permissions', []);

        // Retornar la respuesta en formato JSON
        return response()->json([
            'name' => $name,
            'selected_permissions' => $permissionIds,
        ]);
    }
}

