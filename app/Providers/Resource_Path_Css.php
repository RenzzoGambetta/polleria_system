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

            $PaginationStyle = $fpFunc->Global_Resource(Folder_Path::CSS, 'pagination_style.css');
            $view->with('PaginationStyle', $PaginationStyle);

            $ColorNightAndDay = $fpFunc->Global_Resource(Folder_Path::CSS, 'color_night_and_day.css');
            $view->with('ColorNightAndDay', $ColorNightAndDay);


            $InputResources = $fpFunc->Global_Resource(Folder_Path::CSS, 'input_resources.css');
            $view->with('InputResources', $InputResources);
            //Resources

            $LoginMobile = $fpFunc->Resource(Folder_Path::AUTH, Folder_Path::CSS, 'login_mobile.css');
            $view->with('LoginMobile', $LoginMobile);

            $LoginDesktop = $fpFunc->Resource(Folder_Path::AUTH, Folder_Path::CSS, 'login_desktop.css');
            $view->with('LoginDesktop', $LoginDesktop);

            $TemplateMobile = $fpFunc->Resource(Folder_Path::TEMPLATE, Folder_Path::CSS, 'template_mobile.css');
            $view->with('TemplateMobile', $TemplateMobile);

            $TemplateDesktop = $fpFunc->Resource(Folder_Path::TEMPLATE, Folder_Path::CSS, 'template_desktop.css');
            $view->with('TemplateDesktop', $TemplateDesktop);

            //$EmployeeRecordMobile = $fpFunc->Resource(Folder_Path::USER_MANAGEMENT, Folder_Path::CSS, 'employee_record_mobile.css');
            //$view->with('EmployeeRecordMobile', $EmployeeRecordMobile);loading_style

            $EmployeeRecordDesktop = $fpFunc->Resource(Folder_Path::USER_MANAGEMENT, Folder_Path::CSS, 'employee_record_desktop.css');
            $view->with('EmployeeRecordDesktop', $EmployeeRecordDesktop);

            $LoadFragment = $fpFunc->Resource(Folder_Path::INVENTORY_MANAGEMENT, Folder_Path::CSS, 'load_fragment.css');
            $view->with('LoadFragment', $LoadFragment);

            $RoleRegisterDesktop = $fpFunc->Resource(Folder_Path::USER_MANAGEMENT, Folder_Path::CSS, 'style_role_register_desktop.css');
            $view->with('RoleRegisterDesktop', $RoleRegisterDesktop);

            $IconReferen = $fpFunc->Resource(Folder_Path::TEMPLATE, Folder_Path::CSS, 'icon_referen.css');
            $view->with('IconReferen', $IconReferen);

            $InventoryRegisterDesktop = $fpFunc->Resource(Folder_Path::INVENTORY_MANAGEMENT, Folder_Path::CSS, 'inventory_register_desktop.css');
            $view->with('InventoryRegisterDesktop', $InventoryRegisterDesktop);

            $InventoryRegisterMobile = $fpFunc->Resource(Folder_Path::INVENTORY_MANAGEMENT, Folder_Path::CSS, 'inventory_register_mobile.css');
            $view->with('InventoryRegisterMobile', $InventoryRegisterMobile);

            $ItemSelectionAlert = $fpFunc->Resource(Folder_Path::INVENTORY_MANAGEMENT, Folder_Path::CSS, 'item_selection_alert.css');
            $view->with('ItemSelectionAlert', $ItemSelectionAlert);

            $CheckboxAnimation = $fpFunc->Resource(Folder_Path::INVENTORY_MANAGEMENT, Folder_Path::CSS, 'checkbox_animation.css');
            $view->with('CheckboxAnimation', $CheckboxAnimation);

            $LoadingStyle = $fpFunc->Resource(Folder_Path::TEMPLATE, Folder_Path::CSS, 'loading_style.css');
            $view->with('LoadingStyle', $LoadingStyle);

            $SearchBox = $fpFunc->Resource(Folder_Path::INVENTORY_MANAGEMENT, Folder_Path::CSS, 'search_box.css');
            $view->with('SearchBox', $SearchBox);

            $RegisterNewsupply = $fpFunc->Resource(Folder_Path::INVENTORY_MANAGEMENT, Folder_Path::CSS, 'register_new_supply.css');
            $view->with('RegisterNewsupply', $RegisterNewsupply);

            $StockMovement = $fpFunc->Resource(Folder_Path::INVENTORY_MANAGEMENT, Folder_Path::CSS, 'stock_movement.css');
            $view->with('StockMovement', $StockMovement);

            $OuputSupply = $fpFunc->Resource(Folder_Path::INVENTORY_MANAGEMENT, Folder_Path::CSS, 'ouput_supply.css');
            $view->with('OuputSupply', $OuputSupply);
        });
    }
}

