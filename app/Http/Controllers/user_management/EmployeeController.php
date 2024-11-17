<?php

namespace App\Http\Controllers\user_management;

use App\Http\Controllers\Controller;
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
    protected $identificationDocumentService;
    protected $employeeService;

    protected $Navigation = [
        'seccion' => 2,
        'sub_seccion' => 2.1,
        'color' => 21
    ];

    public function __construct(IdentificationDocumentService $identificationDocumentService, EmployeeService $employeeService)
    {
        $this->identificationDocumentService = $identificationDocumentService;
        $this->employeeService = $employeeService;
    }

    public function show_employeer_list()
    {
        $List = Employee::with(['person', 'user'])->paginate(6);

        $Navigation = $this->Navigation;

        return view('user_management.employee', compact('Navigation', 'List'));
    }
    public function show_employeer_register(Request $Data)
    {
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
        $Navigation = $this->Navigation;
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

        $response = $this->identificationDocumentService->fetchDataByDni($dni);

        if (is_array($response)) {
            return response()->json(['data' => $response], 200);
        }
        return response()->json(['error' => $response], 400);
    }
    public function create_employee_record(EmployeeRequest $request)
    {
        try {
            $response = $this->employeeService->createEmployee($request->validated());

            if ($response) {
                return redirect()->route('employeer')->with([
                    'Message' => 'Se registro exitosomente el empleado/a.',
                    'Type' => 'success'
                ]);
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
            $response = $this->employeeService->updateEmployee($request->validated(), $employee);

            if ($response) {
                return redirect()->route('employeer')->with([
                    'Message' => 'Se edito exitosomente el empleado/a.',
                    'Type' => 'success'
                ]);
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
            $response = $this->employeeService->deleteEmployee($employee);

            if ($response) {
                return redirect()->route('employeer')->with([
                    'Message' => 'Se elimino exitosomente el empleado/a.',
                    'Type' => 'success'
                ]);
            }
            return redirect()->route('employeer')->with([
                'Message' => 'No se pudo elimino el empleado/a.',
                'Type' => 'error'
            ]);
        } catch (Exception $e) {
            return redirect()->route('employeer')->with([
                'Message' => 'No se pudo elimino el empleado/a.',
                'Type' => 'error'
            ]);
        }
    }
    public function showDataemployerBlock(Request $Data)
    {

        $Info = Employee::find($Data->id);
        $Info['title']='Empleado';
        $Info['sub_title']='Datos de empleado';
        $Info['data']=$Data->id;

        $Navigation = $this->Navigation;

        return view('user_management.data_employer', compact('Navigation', 'Info'));
    }
}
