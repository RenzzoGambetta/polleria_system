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
        $List = Employee::paginate(6);

        $Navigation = $this->Navigation;
        return view('user_management.employee', compact('Navigation', 'List'));
    }
    public function show_employeer_register()
    {

        $Navigation = $this->Navigation;
        return view('user_management.employee_register', compact('Navigation'));
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
                return redirect()->route('employeer')->with('Ms', 'Empleado creado exitosamente');
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
}
