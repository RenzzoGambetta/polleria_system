<?php

namespace App\Http\Controllers\user_management;

use App\Http\Controllers\Controller;
use App\Http\Requests\user_management\CreateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Services\user_management\UserService;
use Exception;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    protected $Navigation = [
        'seccion' => 2,
        'sub_seccion' => 2.0,
        'color' => 20

    ];
    public function show_user_list()
    {

        $Users = User::paginate(6);
        $Navigation = $this->Navigation;
        return view('user_management.user', compact('Navigation', 'Users'));
    }

    public function showUserNewRegister(Request $Data)
    {
        $Role = Role::all();
        $Employee = Employee::all();

        $Navigation = $this->Navigation;

        if ($Data->action == 'edit') {
            $Info = User::with(['employee', 'employee.person'])->find($Data->id);
            $Info['title'] = 'Editar Usuario';
            $Info['text_password'] = 'Escriva la nueva contraseña';
            $Info['text_repeat_password'] = 'Repita la nueva Contraseña';
            $Info['text_info_password'] = 'Solo rellene este campo si desea modificar la contraseña';
        } else {
            $Info['title'] = 'Nuevo usuario';
            $Info['text_password'] = '*Contraseña';
            $Info['text_repeat_password'] = '*Repita la Contraseña';
        }
        return view('user_management.user_register', compact('Navigation', 'Role', 'Employee','Info'));
    }
    public function store(CreateUserRequest $request)
    {
        /*
        *   Modifica la logica como tu sabes, esta implementacion es temporal
        */

        $userService = new UserService();
        $user = $userService->createUser($request->validated());

        if (!$user) throw new Exception('No se pudo crear el usuario');

        return redirect()->route('user');
    }
    public function show_home_list()
    {

        $Navigation = [
            'seccion' => 1,
            'sub_seccion' => 1.0,
            'color' => 10
        ];
        $List = Employee::paginate(6);
        return view('user_management.employee', compact('Navigation', 'List'));
    }
}
