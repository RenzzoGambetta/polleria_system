<?php

namespace App\Providers;
use App\Providers\Folder_Path;

class Folder_Path_Function
{
    //Funciones de Concatenacion
    public function Resource($subfolders, $integrated_subfolders, $assets)
    {
        return Folder_Path::RESOURCE . "/" . $subfolders . "/" . $integrated_subfolders . "/" . $assets;
    }
    public function Global_Resource($integrated_subfolders, $assets)
    {
        return Folder_Path::GLOBAL_RESOURCE . "/" . $integrated_subfolders . "/" . $assets;
    }
}
