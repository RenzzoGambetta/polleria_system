<?php

namespace App\Http\Controllers\user_management;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Exception;
use App\Utils\LogHelper;
use App\Services\IdentificationDocumentService;
use App\Services\user_management\EmployeeService;
use App\Http\Requests\user_management\EmployeeRequest;
use Illuminate\Validation\ValidationException;
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
        $request->all(), [
        'dni' => 'required|size:8',
        ]);

        $dni = $request->input('dni');
        $sms = "El Dni solo resivido contiene ". strlen((string) abs($dni)) .  " digitos en ves de 8";

        if ($personData->fails()){
          return response()->json(['error' => $sms], 400);
        }

        $response = $this->identificationDocumentService->fetchDataByDni($dni);
        if (is_array($response))
        {
            return response()->json(['data' => $response], 200);
        }
        return response()->json(['error' => $response], 400);
    }
    public function create_employee_record(EmployeeRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $response = $this->employeeService->create($validatedData);

            if ($response === true) {
                return redirect()->route('employeer')->with('success', 'Empleado creado exitosamente');
            } else {
                $fechaHoraActual = date("Y-m-d H:i:s");
                $Ms = $fechaHoraActual . ' No se puede crear el registro. El error es -> ' . $response;
                return response()->json(['error' => $Ms], 400);
            }
        } catch (Exception $e) {
            $response = "Completa los campos";
            return redirect()->route('employeer_register')->with('Ms', $response);
        }
    }

}

