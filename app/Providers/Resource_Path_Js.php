<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Providers\Folder_Path;
use App\Providers\Folder_Path_Function;
use Illuminate\Support\Facades\View;

class Resource_Path_Js extends ServiceProvider
{
    public function boot(): void
    {
        $fpFunc = new Folder_Path_Function();

        View::composer('*', function ($view) use ($fpFunc) {
            //Global Resources

            //$N1 = $fpFunc->Global_Resource(Folder_Path::JS, 'n1.js');
            //$view->with('N1', $N1);

            //Resources

            $Efect = $fpFunc->Resource(Folder_Path::TEMPLATE, Folder_Path::JS, 'efect.js');
            $view->with('Efect', $Efect);

            $ThemeToggle = $fpFunc->Resource(Folder_Path::TEMPLATE, Folder_Path::JS, 'theme_toggle.js');
            $view->with('ThemeToggle', $ThemeToggle);

            $EffectsAndActions = $fpFunc->Resource(Folder_Path::USER_MANAGMENT, Folder_Path::JS, 'effects_and_actions.js');
            $view->with('EffectsAndActions', $EffectsAndActions);
        });
    }
}
