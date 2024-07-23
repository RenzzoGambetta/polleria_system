<?php

namespace App\Providers;

use App\Providers\Folder_Path;
use App\Providers\Folder_Path_Function;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class Resource_Path_Css extends ServiceProvider
{
    //Designacion de Fracmentos faltantes
    public function boot(): void
    {
        $fpFunc = new Folder_Path_Function();

        View::composer('*', function ($view) use ($fpFunc) {
            //Global Resources

            $Fonts = $fpFunc->Global_Resource(Folder_Path::CSS, 'fonts.css');
            $view->with('Fonts', $Fonts);

            $Form = $fpFunc->Global_Resource(Folder_Path::CSS, 'form.css');
            $view->with('Form', $Form);

            //Resources

            $LoginMobile = $fpFunc->Resource(Folder_Path::AUTH, Folder_Path::CSS, 'login_mobile.css');
            $view->with('LoginMobile', $LoginMobile);

            $LoginDesktop = $fpFunc->Resource(Folder_Path::AUTH, Folder_Path::CSS, 'login_desktop.css');
            $view->with('LoginDesktop', $LoginDesktop);

            //$TemplateMobile = $fpFunc->Resource(Folder_Path::TEMPLATE, Folder_Path::CSS, 'template_mobile.css');
            //$view->with('TemplateMobile', $TemplateMobile);

            $TemplateDesktop = $fpFunc->Resource(Folder_Path::TEMPLATE, Folder_Path::CSS, 'template_desktop.css');
            $view->with('TemplateDesktop', $TemplateDesktop);

            //$EmployeeRecordMobile = $fpFunc->Resource(Folder_Path::USER_MANAGMENT, Folder_Path::CSS, 'employee_record_mobile.css');
            //$view->with('EmployeeRecordMobile', $EmployeeRecordMobile);

            $EmployeeRecordDesktop = $fpFunc->Resource(Folder_Path::USER_MANAGMENT, Folder_Path::CSS, 'employee_record_desktop.css');
            $view->with('EmployeeRecordDesktop', $EmployeeRecordDesktop);

            $RoleRegisterDesktop = $fpFunc->Resource(Folder_Path::USER_MANAGMENT, Folder_Path::CSS, 'style_role_register_desktop.css');
            $view->with('RoleRegisterDesktop', $RoleRegisterDesktop);
        });
    }
}

