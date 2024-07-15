<?php

namespace App\Providers;
use App\Providers\Folder_Path;
use App\Providers\Folder_Path_Function;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class Resource_Path_Image extends ServiceProvider
{
    public function boot(): void
    {
        $fpFunc = new Folder_Path_Function();

        View::composer('*', function ($view) use ($fpFunc) {
            //Global Resources

            //$Fonts = $fpFunc->Global_Resource(Folder_Path::CSS, 'fonts.css');
            //$view->with('Fonts', $Fonts);

            //Resources

            // = $fpFunc->Resource(Folder_Path::AUTH, Folder_Path::CSS, 'login_mobile.css');
            //$view->with('LoginMobile', $LoginMobile);

        });
    }
}
