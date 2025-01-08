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
            'color' => ($primary_number*10)+$sub_number
        ];
        return $Navigation;
    }
}
