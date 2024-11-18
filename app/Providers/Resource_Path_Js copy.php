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

            $FunctionGlobal = $fpFunc->Global_Resource(Folder_Path::JS, 'function_global.js');
            $view->with('FunctionGlobal', $FunctionGlobal);

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

            $FueryFetch = $fpFunc->Resource(Folder_Path::USER_MANAGEMENT, Folder_Path::JS, 'query_fetch.js');
            $view->with('FueryFetch', $FueryFetch);

            $RoleRegistrationButtonActions = $fpFunc->Resource(Folder_Path::USER_MANAGEMENT, Folder_Path::JS, 'role_registration_button_actions.js');
            $view->with('RoleRegistrationButtonActions', $RoleRegistrationButtonActions);

            $OptionSelector = $fpFunc->Resource(Folder_Path::INVENTORY_MANAGEMENT, Folder_Path::JS, 'option_selector.js');
            $view->with('OptionSelector', $OptionSelector);

            $FunctionButtonOnclick = $fpFunc->Resource(Folder_Path::INVENTORY_MANAGEMENT, Folder_Path::JS, 'function_button_onclick.js');
            $view->with('FunctionButtonOnclick', $FunctionButtonOnclick);

            $SearchBoxTemplate = $fpFunc->Resource(Folder_Path::INVENTORY_MANAGEMENT, Folder_Path::JS, 'search_box_template.js');
            $view->with('SearchBoxTemplate', $SearchBoxTemplate);

            $NewsupplyAction = $fpFunc->Resource(Folder_Path::INVENTORY_MANAGEMENT, Folder_Path::JS, 'new_supply_action.js');
            $view->with('NewsupplyAction', $NewsupplyAction);

            $FuctionButtonOutput = $fpFunc->Resource(Folder_Path::INVENTORY_MANAGEMENT, Folder_Path::JS, 'fuction_button_output.js');
            $view->with('FuctionButtonOutput', $FuctionButtonOutput);

            $OrderTable = $fpFunc->Resource(Folder_Path::MENU_MANAGEMENT, Folder_Path::JS, 'order_table.js');
            $view->with('OrderTable', $OrderTable);

            $newLabelData = $fpFunc->Resource(Folder_Path::MENU_MANAGEMENT, Folder_Path::JS, 'new_label_data.js');
            $view->with('newLabelData', $newLabelData);

            $newMenuAndEdit = $fpFunc->Resource(Folder_Path::MENU_MANAGEMENT, Folder_Path::JS, 'new_menu_and_edit.js');
            $view->with('newMenuAndEdit', $newMenuAndEdit);

            $tableEditAndRegister = $fpFunc->Resource(Folder_Path::MENU_MANAGEMENT, Folder_Path::JS, 'table_edit_and_register.js');
            $view->with('tableEditAndRegister', $tableEditAndRegister);

            $pointOfSale = $fpFunc->Resource(Folder_Path::ORDER, Folder_Path::JS, 'point_of_sale.js');
            $view->with('pointOfSale', $pointOfSale);

            $openingClosingDesignFunction = $fpFunc->Resource(Folder_Path::ORDER, Folder_Path::JS, 'opening_closing_design.js');
            $view->with('openingClosingDesignFunction', $openingClosingDesignFunction);

            $searchBoxDataCliene = $fpFunc->Resource(Folder_Path::ORDER, Folder_Path::JS, 'search_box_data_cliene.js');
            $view->with('searchBoxDataCliene', $searchBoxDataCliene);
            
            $orderFunction = $fpFunc->Resource(Folder_Path::ORDER, Folder_Path::JS, 'order_function.js');
            $view->with('orderFunction', $orderFunction);
        });
    }
}
