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

            $view->with('JquerySrc', 'global_resources/js/jquery-3.7.1.js');

            //Language

            $view->with('Language', 'es');

            //Boxicons

            $view->with('Boxicons', 'https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css');

            //Includes

            $view->with('HeaderPanel', 'template.header');
            $view->with('FooterPanel', 'template.footer');

            //Alert

            $view->with('AlertSrc', 'https://cdn.jsdelivr.net/npm/sweetalert2@11');

            //Drag and drop

            $view->with('DragAndDrop', 'https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js');

        });
    }
}
