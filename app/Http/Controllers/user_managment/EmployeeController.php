<?php

namespace App\Http\Controllers\user_managment;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Exception;
use App\Utils\LogHelper;
use App\Services\IdentificationDocumentService;
use App\Services\user_managment\EmployeeService;

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
        $List = Employee::all();

        $Navigation = $this->Navigation;
        return view('user_managment.employee', compact('Navigation', 'List'));
    }
    public function show_employeer_register()
    {

        $Navigation = $this->Navigation;
        return view('user_managment.employee_register', compact('Navigation'));
    }


    public function fetch_person_data(Request $request)
    {

        $personData = $request->validate([
        'dato' => 'required|size:8',

        ]);

        $dni = $personData['dato'];

        $response = $this->identificationDocumentService->fetchDataByDni($dni);

        if (is_array($response))
        {
            return redirect()->route('employeer_register')->with('data', $response);
        }
        else if (is_string($response))
        {
            return redirect()->route('employeer_register')->with('Ms', $response);
        }
    }
    public function create_employee_record(Request $request)
    {
        $Datos = $request->validate([
            'nombre' => 'required',
            'documento_dni' => 'required',
            'paterno' => 'required',
            'materno' => 'required',
            'genero' => '',
            'fecha_n' => '',
            'nacionalidad' => '',
            'telefono' => '',
            'correo' => 'required',
            'direccion' => '',

        ]);
        $data = [
            'dni' => $Datos['documento_dni'],
            'name' =>  $Datos['nombre'],
            'paternal_surname' =>  $Datos['paterno'],
            'maternal_surname' =>  $Datos['materno'],
            'birthdate' =>  $Datos['fecha_n'],
            'gender' =>  $Datos['genero'],
            'phone' =>  $Datos['telefono'],
            'email' =>  $Datos['correo'],
            'address' => $Datos['direccion'],
            'nationality' => $Datos['nacionalidad'],
        ];
        $response = $this->employeeService->create($data);

        return redirect()->route('fetch_person_data');
    }

}

