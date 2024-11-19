<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\user_management\UserController;
use App\Http\Controllers\user_management\EmployeeController;
use App\Http\Controllers\user_management\RoleController;
use App\Http\Controllers\inventory_management\InventoryController;
use App\Http\Controllers\inventory_management\SupplyStockController;
use App\Http\Controllers\inventory_management\SuppliersController;
use App\Http\Controllers\menu_management\MenuController;
use App\Http\Controllers\menu_management\TableController;
use App\Http\Controllers\order\PointOfSaleController;
use App\Http\Controllers\temp\EfectController;
use App\Http\Controllers\test\testController;

//--> Modulo de autentificacion

    //Registro y login de acceso
    Route::get('/', [LoginController::class,'show'])->name('login');
    Route::get('/login', [LoginController::class,'show'])->name('login');
    Route::post('/login', [LoginController::class,'login']);
    Route::get('/register', [RegisterController::class,'show'])->name('register');
    Route::post('/register', [RegisterController::class,'register']);
    Route::middleware('auth')->group(function () {
    //--> Modulo de Empleados

        //Usuarios
        Route::get('/user', [UserController::class,'show_user_list'])->name('user');
        Route::get('/user_register', [UserController::class,'showUserNewRegister'])->name('user_register');
        Route::post('/user_register_store', [UserController::class,'store'])->name('user_register_store');
        Route::post('/user_edit', [UserController::class,'editUser'])->name('user_edit');
        Route::post('/user_delete', [UserController::class,'deleteUser'])->name('user_delete');
        //Empleados
        Route::get('/employeer', [EmployeeController::class,'show_employeer_list'])->name('employeer');
        Route::get('/employeer_register', [EmployeeController::class,'show_employeer_register'])->name('employeer_register');
        Route::get('/fetch_person_data', [EmployeeController::class,'fetch_person_data'])->name('fetch_person_data');
        Route::get('/data_employer_block', [EmployeeController::class,'showDataemployerBlock'])->name('data_employer_block');
        Route::post('/create_employee_record', [EmployeeController::class,'create_employee_record'])->name('create_employee_record');
        Route::post('/edit_employee_record', [EmployeeController::class,'editEmployeeRecord'])->name('edit_employee_record');
        Route::post('/employeer_delete', [EmployeeController::class,'deleteEmployeeRecord'])->name('employeer_delete');
        //Roles
        Route::get('/position', [RoleController::class,'show_position_list'])->name('position');
        Route::get('/role_register', [RoleController::class,'show_role_register'])->name('role_register');
        Route::post('/role_register_store', [RoleController::class,'store'])->name('role_register_store');
        Route::post('/role_edit', [RoleController::class,'editRole'])->name('role_edit');
        Route::post('/role_delete', [RoleController::class,'deleteRole'])->name('role_delete');
        Route::post('/new_extension_role', [RoleController::class,'newExtensionRole'])->name('new_extension_role');

    //--> Modulo de gestion de inventario

        //Inventario
        Route::get('/inventory', [InventoryController::class,'showInventoryList'])->name('inventory');
        Route::get('/show_list_inventory_movements', [InventoryController::class,'showListInventoryMovements'])->name('show_list_inventory_movements');
        Route::get('/new_supply_inventory', [InventoryController::class,'newsupplyInventory'])->name('new_supply_inventory');
        Route::get('/delete_new_supply_complete', [InventoryController::class,'deleteNewSupplyComplete'])->name('delete_new_supply_complete');
        //Suministros
        Route::get('/show_panel_register_entry', [SupplyStockController::class,'showPanelRegisterEntry'])->name('show_panel_register_entry');
        Route::get('/register_new_supply', [SupplyStockController::class,'registerNewsupply'])->name('register_new_supply');
        Route::post('/register_new_supply_complete', [SupplyStockController::class,'registerNewSupplyComplete'])->name('register_new_supply_complete');
        Route::get('/show_panel_register_output', [SupplyStockController::class,'showPanelRegisterOutput'])->name('show_panel_register_output');
        Route::get('/supplier_supply_list', [SupplyStockController::class,'supplierSupplyList'])->name('supplier_supply_list');
        Route::get('/list_of_supplys', [SupplyStockController::class,'listOfsupplys'])->name('list_of_supplys');
        Route::get('/anchor_supply_provider', [SupplyStockController::class,'anchorSupplyProvider'])->name('anchor_supply_provider');
        Route::post('/register_supply_entry', [SupplyStockController::class,'registerSupplyEntry'])->name('register_supply_entry');
        Route::get('/query_supply_data', [SupplyStockController::class,'querySupplyData'])->name('query_supply_data');
        //Provedores
        Route::get('/suppliers', [SuppliersController::class,'showSuppliersList'])->name('suppliers');
        Route::get('/new_supplier_registration_fast', [SuppliersController::class,'newSupplierRegistrationFast'])->name('new_supplier_registration_fast');
        Route::get('/suppliers_register_and_edit', [SuppliersController::class,'showSuppliersRegisterAndEdit'])->name('suppliers_register_and_edit');
        Route::get('/list_of_suppliers', [SuppliersController::class,'listOfSuppliers'])->name('list_of_suppliers');
        Route::post('/new_supplier_registration', [SuppliersController::class,'newSupplierRegistration'])->name('new_supplier_registration');
    //--> Modulo de gestion de Menu
        //Menu
        Route::get('/menu', [MenuController::class,'showMenuList'])->name('menu');
        Route::get('/registro_menu', [MenuController::class,'newMenuAndEdit'])->name('registro_menu');
        Route::get('/category_carte', [MenuController::class,'categoryCarte'])->name('category_carte');
        Route::get('/new_menu_categories', [MenuController::class,'newMenuCategories'])->name('new_menu_categories');
        Route::post('/edit_to_order_categori', [MenuController::class,'editToOrderCategori'])->name('edit_to_order_categori');
        Route::post('/edit_to_order_item', [MenuController::class,'editToOrderItem'])->name('edit_to_order_item');
        Route::get('/list_of_item', [MenuController::class,'listOfItem'])->name('list_of_item');
        Route::get('/list_of_category', [MenuController::class,'listOfCategory'])->name('list_of_category');
        Route::get('/filt_item_data', [MenuController::class,'filtItemData'])->name('filt_item_data');
        Route::get('/edit_new_menu', [MenuController::class,'editNewMenu'])->name('edit_new_menu');
        Route::get('/register_new_menu', [MenuController::class,'registerNewMenu'])->name('register_new_menu');
        Route::get('/show_order_item', [MenuController::class,'showOrderItem'])->name('show_order_item');
        Route::get('/list_of_cooking_place', [MenuController::class,'listOfCookingPlace'])->name('list_of_cooking_place');
        //Mesas
        Route::get('/show_drawing_table', [TableController::class,'showDrawingTable'])->name('show_drawing_table');
        Route::get('/tables-list-data', [TableController::class,'tablesListData'])->name('tables-list-data');
        Route::get('/lounge_data_edit', [TableController::class,'loungeDataEdit'])->name('lounge_data_edit');
        Route::post('/edit_lounge', [TableController::class,'editLounge'])->name('edit_lounge');
        Route::post('/new_lounge', [TableController::class,'newLounge'])->name('new_lounge');
        Route::post('/delate_lounge', [TableController::class,'delateLounge'])->name('delate_lounge');
        Route::post('/delate_table', [TableController::class,'delateTable'])->name('delate_table');
        Route::post('/edit_table', [TableController::class,'editTable'])->name('edit_table');
        Route::post('/new_table', [TableController::class,'newTable'])->name('new_table');

    //--> Order
        //PointOfSale
        Route::get('/list_employeer', [PointOfSaleController::class,'listEmployeer'])->name('list_employeer');
        Route::get('/point_of_sale', [PointOfSaleController::class,'showPointOfSale'])->name('point_of_sale');
        Route::get('/cashier_sessions', [PointOfSaleController::class,'showCashierSessions'])->name('cashier_sessions');
        Route::get('/assigned_waiter', [PointOfSaleController::class,'assignedWaiter'])->name('assigned_waiter');
        Route::post('/register_session_cash_box', [PointOfSaleController::class,'registerSessionCashBox'])->name('register_session_cash_box');
        Route::get('/client_data_filt', [PointOfSaleController::class,'clientDataFilt'])->name('client_data_filt');
        Route::get('/new_order_client', [PointOfSaleController::class,'newOrderClient'])->name('new_order_client');
        Route::get('/list_item_filt_category', [PointOfSaleController::class,'listItemFiltCategory'])->name('list_item_filt_category');

    //--> Home

        Route::get('/home', [UserController::class,'show_home_list'])->name('home');

    //-- Sesion y efectos nesesarios

        Route::get('/switch_theme_', [EfectController::class, 'switch_theme']);
        Route::get('/update_menu_state', [EfectController::class, 'updateMenuState']);

    //-- testing view
        Route::get('/view-test', [testController::class, 'viewTest']);

    });
