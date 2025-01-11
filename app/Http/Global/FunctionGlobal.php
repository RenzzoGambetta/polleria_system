<?php

namespace  App\Http\Global;

class FunctionGlobal
{
    public static function NavigationSpecific($seccion, $sub_seccion, $color)
    {
        $Navigation = [
            'seccion' => $seccion,
            'sub_seccion' => $sub_seccion,
            'color' => $color
        ];
        return $Navigation;
    }
    public static function NavigationFast($primary_number, $sub_number)
    {
        $Navigation = [
            'seccion' => $primary_number,
            'sub_seccion' => round($primary_number + ($sub_number * 0.1), 1),
            'color' => ($primary_number * 10) + $sub_number
        ];
        return $Navigation;
    }
    public static function routerGallery($nameFile)
    {
        return 'warehouse/' . $nameFile;
    }
    public static function MessageError($Message, $Time = 10, $ConsoleTest = '', $PlusData = [])
    {
        // Inicializar el arreglo base
        $Data = [
            'Message' => $Message,
            'Type' => 'error',
            'Time' => $Time
        ];

        // Si se proporciona un mensaje de consola, lo agregamos
        if (!empty($ConsoleTest)) {
            $Data['Console'] = $ConsoleTest;
        }

        // Si hay datos adicionales, los fusionamos con el arreglo base
        if (!empty($PlusData)) {
            $Data = array_merge($Data, $PlusData);
        }
        return $Data;
    }
    public static function MessageSuccess($Message, $Time = 10, $ConsoleTest = '', $PlusData = [])
    {
        // Inicializar el arreglo base
        $Data = [
            'Message' => $Message,
            'Type' => 'success',
            'Time' => $Time
        ];

        // Si se proporciona un mensaje de consola, lo agregamos
        if (!empty($ConsoleTest)) {
            $Data['Console'] = $ConsoleTest;
        }

        // Si hay datos adicionales, los fusionamos con el arreglo base
        if (!empty($PlusData)) {
            $Data = array_merge($Data, $PlusData);
        }

        return $Data;
    }
}
