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

            $EffectsAndActions = $fpFunc->Resource(Folder_Path::USER_MANAGEMENT, Folder_Path::JS, 'effects_and_actions.js');
            $view->with('EffectsAndActions', $EffectsAndActions);

            $EffectsAndActionsUserRegister = $fpFunc->Resource(Folder_Path::USER_MANAGEMENT, Folder_Path::JS, 'effects_and_actions_user_register.js');
            $view->with('EffectsAndActionsUserRegister', $EffectsAndActionsUserRegister);

            $SwitchTheme = $fpFunc->Resource(Folder_Path::TEMPLATE, Folder_Path::JS, 'switch_theme.js');
            $view->with('SwitchTheme', $SwitchTheme);

            $QueryAndResponseAjaxData = $fpFunc->Resource(Folder_Path::USER_MANAGEMENT, Folder_Path::JS, 'query_and_response_ajax_data.js');
            $view->with('QueryAndResponseAjaxData', $QueryAndResponseAjaxData);

            $RoleRegistrationButtonActions = $fpFunc->Resource(Folder_Path::USER_MANAGEMENT, Folder_Path::JS, 'role_registration_button_actions.js');
            $view->with('RoleRegistrationButtonActions', $RoleRegistrationButtonActions);

            $OptionSelector = $fpFunc->Resource(Folder_Path::INVENTORY_MANAGEMENT, Folder_Path::JS, 'option_selector.js');
            $view->with('OptionSelector', $OptionSelector);

            $FunctionButtonOnclick = $fpFunc->Resource(Folder_Path::INVENTORY_MANAGEMENT, Folder_Path::JS, 'function_button_onclick.js');
            $view->with('FunctionButtonOnclick', $FunctionButtonOnclick);

        });
    }
}
