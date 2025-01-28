<?php

namespace App\Http\Controllers\user_management;

use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Http\Global\ConstGlobal;
use App\Http\Global\FunctionGlobal;
use App\Http\Requests\user_management\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Services\user_management\UserService;
use Exception;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    protected $Navigation;

    public function __construct()
    {
        $this->Navigation = FunctionGlobal::NavigationFast(2, 0);
    }
    public function show_user_list()
    {
        $Users = User::orderBy('created_at', 'desc')->paginate(ConstGlobal::PAGINATION);
        $Navigation = $this->Navigation;
        return view('user_management.user', compact('Navigation', 'Users'));
    }

    public function showUserNewRegister(Request $Data)
    {
        $Navigation = $this->Navigation;

        if ($Data->action == 'edit') {
            $Info = User::with(['employee', 'employee.person'])->find($Data->id);
            $Info['title'] = 'Editar Usuario';
            $Info['text_password'] = 'Escriba la nueva contraseña';
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
        return view('user_management.user_register', compact('Navigation', 'Info'));
    }
    public function store(UserRequest $request)
    {
        //return response()->json('entro');
        try {
            $user = (new UserService)->createUser($request->validated());
            if (!$user) {
                return redirect()->back()->with('Ms', 'Ocurrió un error, puede ser que el DNI ya se encuentre registrado');
            }
            return redirect()->route('user')->with(FunctionGlobal::MessageSuccess('Se registro exitosomente el Usuario.'));
        } catch (Exception $e) {
            return redirect()->route('user_register')
                ->withInput()
                ->with('Ms', 'Ocurrió un error, puede ser que el usuario ya se encuentre registrado');
        }
    }
    public function show_home_list()
    {
        $Navigation =  FunctionGlobal::NavigationFast(1, 0);
        $List = Employee::paginate(ConstGlobal::PAGINATION);
        return view('user_management.employee', compact('Navigation', 'List'));
    }
    public function editUser(Request $request)
    {
        try {
            $response = (new UserService)->updateUser($request->id, $request->all());
            if ($response) {
                return redirect()->route('user')->with(FunctionGlobal::MessageSuccess('Se edito exitosomente el empleado/a.'));
            }
            return redirect()->route('user_register')
                ->withInput()
                ->with('Ms', 'Ocurrió un error al editar el usuario');
        } catch (Exception $e) {
            //return response()->json($e->getMessage());
            return redirect()->route('user_register')
                ->withInput()
                ->with('Ms', 'Ocurrió un error, puede ser que usuario ya se encuentre registrado');
        }
    }
    public function deleteUser(Request $request)
    {
        try {
            $response = (new UserService)->deleteUser($request->id);
            if ($response) {
                return redirect()->route('user')->with(FunctionGlobal::MessageSuccess('Se elimino exitosamente el usuario.'));
            }
            return redirect()->route('user')->with(FunctionGlobal::MessageError('No se pudo elimino el usuario.'));
        } catch (CustomException $ce) {
            return redirect()->route('user')->with(FunctionGlobal::MessageError('Error' . $ce->getMessage()));
        } catch (Exception $e) {
            return redirect()->route('user')->with(FunctionGlobal::MessageError('No se pudo elimino el usuario.'));
        }
    }
    public function showDataUserBlock(Request $Data)
    {
        $Navigation = $this->Navigation;
        $Info = User::with(['employee.person'])->find($Data->id);
        $Info['title'] = 'Usuario';
        $Info['sub_title'] = 'Datos de Usuario';
        $Info['data'] = $Data->id;
        $Info['type'] = 'user';
        $Info['url'] = 'data_user_block';
        return view('user_management.data_employer', compact('Navigation', 'Info'));
    }

    public function queryTokenDatabase(Request $Data)
    {
        $Info = User::select('remember_token as token')->where('id', $Data->id)->first();
        return response()->json($Info);
    }
}
