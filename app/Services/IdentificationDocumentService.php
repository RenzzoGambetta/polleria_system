<?php

namespace App\Services;

use App\Models\Person;
use App\Utils\LogHelper;
use Exception;

use function PHPUnit\Framework\returnSelf;

class IdentificationDocumentService
{

    public function __construct() {}

    //*Ingresa a la pagina de https://apis.net.pe/ y prueva usar la forma natiba de laravel

    public function fetchDataByDni(string $dni)
    {
        $dataFromDatabase = $this->fetchDataByDniFromDatabase($dni);

        if ($dataFromDatabase) return $dataFromDatabase;

        $curl = curl_init();
        $token = 'apis-token-6589.NnIufFSz2PuR-lFExEz0OOuf9NVcnLcm';
        $urldni = 'https://api.apis.net.pe/v2/reniec/dni?numero=';

        try {
            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_URL => $urldni . $dni,
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
                    'name' => $attachments->nombres,
                    'paternal_surname' => $attachments->apellidoPaterno,
                    'maternal_surname' => $attachments->apellidoMaterno,
                    'dni' => $attachments->numeroDocumento,
                    'response' => true
                ];
                return $data;
            } else {
                return [
                    'message' => "No se pudo encontrar el dni en el sistema de la Reniec",
                    'response' => false,
                    'date_time' =>  date("Y-m-d H:i:s"),
                    'data' =>  $attachments->message
                ];
            }
        } catch (Exception $e) {
            LogHelper::logError($this, $e);
            $currentDatatime = date("Y-m-d H:i:s");
            $errorMessage = $currentDatatime . ' No se puede encontrar' . $e->getMessage();
            return $errorMessage;
        }
    }

    public function fetchDataByRuc(string $ruc)
    {
        $curl = curl_init();
        $token = 'apis-token-6589.NnIufFSz2PuR-lFExEz0OOuf9NVcnLcm';
        $urlruc = 'https://api.apis.net.pe/v2/sunat/ruc?numero=';

        try {
            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_URL => $urlruc . $ruc,
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
            if (property_exists($attachments, 'numeroDocumento') && $attachments->numeroDocumento !== null) {
                $attachments['response'] = true;
                return $attachments;
            } else {
                return [
                    'message' => "No se pudo encontrar el ruc en el sistema de la Reniec",
                    'response' => false,
                    'date_time' =>  date("Y-m-d H:i:s"),
                    'data' =>  $attachments->toArray()
                ];
            }
        } catch (Exception $e) {
            LogHelper::logError($this, $e);
            $currentDatatime = date("Y-m-d H:i:s");
            $errorMessage = $currentDatatime . ' No se puede encontrar' . $e->getMessage();
            return $errorMessage;
        }
    }

    private function fetchDataByDniFromDatabase(string $dni)
    {
        $person = Person::where('document_number', $dni)->first();

        if (!$person) return false;

        $data = [
            'name' => $person->name,
            'paternal_surname' => strstr($person->lastname, ' ', true),
            'maternal_surname' => strstr($person->lastname, ' '),
            'dni' => $dni,
            'response' => true
        ];

        return $data;
    }
}
