<?php
namespace  App\Http\Global;

class ConstGlobal
{
    /*
        *Cantidad de items por pagina
    */
    public const PAGINATION = 10;

    /*
        *Unidad de medidas
    */

    public const UNIT_OPTIONS = [
        ['kg', 'kilogramo'],
        ['l', 'litro'],
        ['und', 'unidad'],
        ['pack', 'paquete'],
        ['caj', 'caja'],
        ['bls', 'bolsa'],
        ['m', 'metro'],
    ];

    /*
    *   Ruta de guardado de imagenes 
    */
    public const ROUTE_SUPPLY ='warehouse/supply'; 
}
