<?php

namespace App\Providers;
use App\Providers\Folder_Path;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
class Resource_Path_Css extends ServiceProvider
{

    public function boot(): void
    {

        View::composer('*', function ($view) {

            $view->with('rutaLoginMobile', 'resources/auth/css/login_mobile.css');
            $view->with('rutaLoginDesktop', 'resources/auth/css/login_desktop.css');
        });
    }
}
