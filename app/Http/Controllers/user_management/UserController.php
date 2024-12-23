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
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function show_user_list()
    {

        $Users = User::orderBy('created_at', 'desc')->paginate(10);
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
            $Info['id'] = $Data->id;
            $Info['form_url'] = 'user_edit';

        } else {
            $Info['title'] = 'Nuevo usuario';
            $Info['text_password'] = '*Contraseña';
            $Info['text_repeat_password'] = '*Repita la Contraseña';
            $Info['form_url'] = 'user_register_store';
        }
        return view('user_management.user_register', compact('Navigation', 'Role', 'Employee', 'Info'));
    }
    public function store(CreateUserRequest $request)
    {
        try {

            $user = $this->userService->createUser($request->validated());

            if (!$user) {
                return redirect()->back()->with('Ms', 'Ocurrió un error, puede ser que el DNI ya se encuentre registrado');
            }
            return redirect()->route('user')->with([
                'Message' => 'Se registro exitosomente el Usuario.',
                'Type' => 'success'
            ]);
        } catch (Exception $e) {
            return redirect()->route('user_register')
                ->withInput()
                ->with('Ms', 'Ocurrió un error, puede ser que el usuario ya se encuentre registrado');
        }
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
    public function editUser(CreateUserRequest $request)
    {
        try {

            $user = User::find($request->id);

            //*quitar el omentario cuando se complete el servisio para editar
            $response = true;
            //$response = $this->userService->updateUser($request->validated(), $user);

            if ($response) {
                return redirect()->route('user')->with([
                    'Message' => 'Se edito exitosomente el empleado/a.',
                    'Type' => 'success'
                ]);
            }
            return redirect()->route('user_register')
                ->withInput()
                ->with('Ms', 'Ocurrió un error al editar el usuario');
        } catch (Exception $e) {
            return redirect()->route('user_register')
                ->withInput()
                ->with('Ms', 'Ocurrió un error, puede ser que usuario ya se encuentre registrado');
        }
    }
    public function deleteUser(Request $request)
    {
        try {

            $user = User::find($request->id);
            //*quitar el omentario cuando se complete el servisio para eliminar
            $response = true;
            //$response = $this->userService->deleteUser($user);

            if ($response) {
                return redirect()->route('user')->with([
                    'Message' => 'Se elimino exitosomente el usuario.',
                    'Type' => 'success'
                ]);
            }
            return redirect()->route('user')->with([
                'Message' => 'No se pudo elimino el usuario.',
                'Type' => 'error'
            ]);
        } catch (Exception $e) {
            return redirect()->route('user')->with([
                'Message' => 'No se pudo elimino el usuario.',
                'Type' => 'error'
            ]);
        }
    }
}
