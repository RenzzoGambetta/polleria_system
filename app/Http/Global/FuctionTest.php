<?php
namespace  App\Http\Global;

class FuctionTest
{
    /**
     * Convert an array to JSON.
     *
     * @param array $data
     */
    public static function convertArrayObject(array $data)
    {
        return  json_decode(json_encode($data));
    }
}
