<?php

namespace App\Http\Controllers\user_managment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Utils\LogHelper;
use App\Services\IdentificationDocumentService;

class EmployeeController extends Controller
{
    protected $identificationDocumentService;

    protected $Navigation = [
        'seccion' => 2,
        'sub_seccion' => 2.1,
        'color' => 21
    ];

    public function __construct(IdentificationDocumentService $identificationDocumentService)
    {
        $this->identificationDocumentService = $identificationDocumentService;
    }

    public function show_employeer_list()
    {

        $Navigation = $this->Navigation;
        return view('user_managment.employee', compact('Navigation'));
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

        return redirect()->route('fetch_person_data');
    }
}

