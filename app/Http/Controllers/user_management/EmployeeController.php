<?php

namespace App\Http\Controllers\user_management;

use App\Http\Controllers\Controller;
use App\Http\Global\ConstGlobal;
use App\Http\Global\FunctionGlobal;
use App\Models\Employee;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Lang;
use App\Services\IdentificationDocumentService;
use App\Services\user_management\EmployeeService;
use App\Http\Requests\user_management\EmployeeRequest;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    protected $Navigation;

    public function __construct()
    {
        $this->Navigation = FunctionGlobal::NavigationFast(2,1);
    }

    public function show_employeer_list()
    {
        $Navigation = $this->Navigation;
        $List = Employee::orderBy('created_at', 'desc')->with(['person', 'user'])->paginate(ConstGlobal::PAGINATION);
        return view('user_management.employee', compact('Navigation', 'List'));
    }
    public function show_employeer_register(Request $Data)
    {
        $Navigation = $this->Navigation;
        if ($Data->action == "new") {
            $Info = [
                'title' => 'Registro',
                'form_url' => 'create_employee_record'
            ];
        } else if ($Data->action == "edit") {
            $Info = Employee::find($Data->id);

            $Info['title'] = 'Editar';
            $Info['id'] = $Data->id;
            $Info['form_url'] = 'edit_employee_record';
            $Info['data'] = 'id=' . $Data->id . '&action=' . $Data->action;

            $lastname = explode(' ', $Info->person->lastname, 2);
            $Info->lastname = (object) [
                'paternal_surname' => $lastname[0],
                'maternal_surname' => $lastname[1] ?? "",
            ];
        } else {
            $Info = [
                'title' => 'Registro',
                'form_url' => 'create_employee_record'
            ];
        }
        return view('user_management.employee_register', compact('Navigation', 'Info'));
    }


    public function fetch_person_data(Request $request)
    {

        $personData = validator::make(
            $request->all(),
            [
                'dni' => 'required|size:8',
            ]
        );

        $dni = $request->input('dni');
        $sms = "El Dni solo resivido contiene " . strlen((string) abs($dni)) .  " digitos en ves de 8";

        if ($personData->fails()) {
            return response()->json(['error' => $sms], 400);
        }

        $response = (new IdentificationDocumentService)->fetchDataByDni($dni);

        if (is_array($response)) {
            return response()->json(['data' => $response], 200);
        }
        return response()->json(['error' => $response['message']], 400);
    }
    public function create_employee_record(EmployeeRequest $request)
    {
        try {
            $response = (new EmployeeService)->createEmployee($request->validated());

            if ($response) {
                return redirect()->route('employeer')->with(FunctionGlobal::MessageSuccess('Se registro exitosomente el empleado/a.'));
            }
            return redirect()->route('employeer_register')
                ->withInput()
                ->with('Ms', 'Ocurrió un error al crear el empleado');
        } catch (Exception $e) {
            return redirect()->route('employeer_register')
                ->withInput()
                ->with('Ms', 'Ocurrió un error, puede ser que el Dni ya se encuentre registrado');
        }
    }
    public function editEmployeeRecord(EmployeeRequest $request)
    {
        try {
            $employee = Employee::find($request->id);
            $response = (new EmployeeService)->updateEmployee($request->validated(), $employee);

            if ($response) {
                return redirect()->route('employeer')->with(FunctionGlobal::MessageSuccess('Se edito exitosomente el empleado/a.'));
            }
            return redirect()->route('employeer_register')
                ->withInput()
                ->with('Ms', 'Ocurrió un error al editar el empleado');
        } catch (Exception $e) {
            return redirect()->route('employeer_register')
                ->withInput()
                ->with('Ms', 'Ocurrió un error, puede ser que el Dni ya se encuentre registrado');
        }
    }
    public function deleteEmployeeRecord(Request $request)
    {
        try {
            $employee = Employee::find($request->id);
            $response = (new EmployeeService)->deleteEmployee($employee);

            if ($response) {
                return redirect()->route('employeer')->with(FunctionGlobal::MessageSuccess('Se elimino exitosomente el empleado/a.'));
            }
            return redirect()->route('employeer')->with(FunctionGlobal::MessageError('No se pudo elimino el empleado/a.'));
        } catch (Exception $e) {
            return redirect()->route('employeer')->with(FunctionGlobal::MessageError('No se pudo elimino el empleado/a.' . $e));
        }
    }
    public function showDataemployerBlock(Request $Data)
    {
        $Navigation = $this->Navigation;
        $Info = Employee::find($Data->id);
        $Info['title']='Empleado';
        $Info['sub_title']='Datos de empleado';
        $Info['data']=$Data->id;
        $Info['type']='employer';
        $Info['url']='data_employer_block';

        return view('user_management.data_employer', compact('Navigation', 'Info'));
    }
}
