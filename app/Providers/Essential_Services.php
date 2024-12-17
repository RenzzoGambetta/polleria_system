<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Providers\Folder_Path;
use App\Providers\Folder_Path_Function;
use Illuminate\Support\Facades\View;

class Essential_Services extends ServiceProvider
{
    public function boot(): void
    {
        $fpFunc = new Folder_Path_Function();

        View::composer('*', function ($view) use ($fpFunc) {
            //Jquery

            $view->with('JquerySrc', 'plugin/js/jquery-3.7.1.js');

            //Language

            $view->with('Language', 'es');

            //Boxicons

            //$view->with('Boxicons', 'https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css');
            $view->with('Boxicons', 'plugin/css/boxicons.css');//descargar

            //Includes

            $view->with('HeaderPanel', 'template.header');
            $view->with('FooterPanel', 'template.footer');
            $view->with('HeaderMozo', 'template.header_mozo');

            //Alert

            //$view->with('AlertSrc', 'https://cdn.jsdelivr.net/npm/sweetalert2@11');
            //$view->with('AlertSrc', 'global_resources/js/sweetalert2.all.min.js');
            $view->with('AlertSrc', 'plugin/js/sweetalert2.all.js');

            //Drag and drop

            //$view->with('DragAndDrop', 'https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js');
            $view->with('DragAndDrop', 'plugin/js/sortable.min.js');


            //JsonApp
            $view->with('JsonApp', 'resources/auth/json/manifest.json');
            $view->with('JsApp', 'resources/auth/js/sw.js');

            //jsPdf
            $view->with('JsPdf', 'plugin\js\jspdf.umd.js');

            //Html2Canvas
            $view->with('Html2Canvas', 'plugin\js\html2canvas.js');

        });
    }
}
