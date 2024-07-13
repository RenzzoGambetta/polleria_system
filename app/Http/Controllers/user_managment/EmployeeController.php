<?php

namespace App\Http\Controllers\user_managment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Utils\LogHelper;

class EmployeeController extends Controller
{
    protected $Navigation = [
        'seccion' => 2,
        'sub_seccion' => 2.1,
        'color' => 21
    ];
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

        $person_data = $request->validate([
            'td' => 'required',
            'dato' => 'required',

        ]);
        $customer_document_type = $person_data['td'];
        $data_document = $person_data['dato'];
        $curl = curl_init();
        $token = 'apis-token-6589.NnIufFSz2PuR-lFExEz0OOuf9NVcnLcm';
        $urldni = 'https://api.apis.net.pe/v2/reniec/dni?numero=';
        $urlruc = 'https://api.apis.net.pe/v2/sunat/ruc?numero=';

        try {
            if ($customer_document_type == 'ruc') {
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $urlruc . $data_document,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_SSL_VERIFYPEER => 0,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_HTTPHEADER => array(
                        'Referer: http://apis.net.pe/api-ruc',
                        'Authorization: Bearer ' . $token
                    ),
                )
                );
                $response = curl_exec($curl);

                curl_close($curl);
                $attachments = json_decode($response);
                if (property_exists($attachments, 'nombre') && $attachments->nombres !== null) {
                    $data = [
                        'nombre' => $attachments->nombres,
                    ];
                    return redirect()->route('employeer_register')->with('data', $data);
                } else {
                    $Ms = "No se pudo encontrar ruc en el sistema";
                    return redirect()->route('employeer_register')->with('Ms', $Ms);
                }

            } else if ($customer_document_type == 'dni') {
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $urldni . $data_document,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_SSL_VERIFYPEER => 0,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 2,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_HTTPHEADER => array(
                        'Referer: https://apis.net.pe/consulta-dni-api',
                        'Authorization: Bearer ' . $token
                    ),
                )
                );
                $response = curl_exec($curl);
                curl_close($curl);
                $attachments = json_decode($response);

                if (property_exists($attachments, 'nombres') && $attachments->nombres !== null) {
                    $data = [
                        'nombre' => $attachments->nombres,
                        'apellido_paterno' => $attachments->apellidoPaterno,
                        'apellido_materno' => $attachments->apellidoMaterno,
                        'documento' => $attachments->numeroDocumento,
                    ];
                    return redirect()->route('employeer_register')->with('data', $data);
                } else {

                    $Ms = "No se pudo encontrar el dni en el sistema";
                    return redirect()->route('employeer_register')->with('Ms', $Ms);
                }
            }
        } catch (Exception $e) {
            LogHelper::logError($this, $e);
            $fechaHoraActual = date("Y-m-d H:i:s");
            $Ms = $fechaHoraActual . ' No se puede crear el registro';

            return redirect()->route('employeer_register')->with('Ms', $Ms);
        }
    }
}

