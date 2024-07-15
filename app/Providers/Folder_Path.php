<?php

namespace App\Providers;

class Folder_Path
{

    // Carpetas Padres
    public const RESOURCE = "resources";
    public const GLOBAL_RESOURCE = "global_resource";

    // Carpetas Hijos
    public const AUTH = "auth";
    public const TEMPLATE = "template";
    public const USER_MANAGEMENT = "user_managment";

    // Carpetas integradas en Hijos
    public const CSS = "css";
    public const JS = "js";
    public const IMAGE = "image";

}
class Folder_Path_Function
{
    //Funciones de Concatenacion
    public function Resource($subfolders, $integrated_subfolders, $assets)
    {
        return Folder_Path::RESOURCE + "/" + $subfolders + "/" + $integrated_subfolders + "/" + $assets;
    }
    public function Global_Resource($integrated_subfolders, $assets)
    {
        return Folder_Path::RESOURCE + "/" + $integrated_subfolders + "/" + $assets;
    }
}
