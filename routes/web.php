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
use App\Http\Controllers\temp\EfectController;



//--> Modulo de autentificacion

    //Registro y login de acceso
    Route::get('/', [LoginController::class,'show'])->name('login');
    Route::get('/login', [LoginController::class,'show'])->name('login');
    Route::post('/login', [LoginController::class,'login']);
    Route::get('/register', [RegisterController::class,'show'])->name('register');
    Route::post('/register', [RegisterController::class,'register']);

//--> Modulo de Empleados

    //Usuarios
    Route::get('/user', [UserController::class,'show_user_list'])->name('user');
    Route::get('/user_register', [UserController::class,'showUserNewRegister'])->name('user_register');
    Route::post('/user_register_store', [UserController::class,'store'])->name('user_register_store');
    //Empleados
    Route::get('/employeer', [EmployeeController::class,'show_employeer_list'])->name('employeer');
    Route::get('/employeer_register', [EmployeeController::class,'show_employeer_register'])->name('employeer_register');
    Route::get('/fetch_person_data', [EmployeeController::class,'fetch_person_data'])->name('fetch_person_data');
    Route::post('/create_employee_record', [EmployeeController::class,'create_employee_record'])->name('create_employee_record');
    //Roles
    Route::get('/position', [RoleController::class,'show_position_list'])->name('position');
    Route::get('/role_register', [RoleController::class,'show_role_register'])->name('role_register');
    Route::post('/role_register_store', [RoleController::class,'store'])->name('role_register_store');

//--> Modulo de gestion de inventario

    //Inventario
    Route::get('/inventory', [InventoryController::class,'showInventoryList'])->name('inventory');
    Route::get('/show_panel_register_entry', [SupplyStockController::class,'showPanelRegisterEntry'])->name('show_panel_register_entry');
    Route::get('/register_new_supply', [SupplyStockController::class,'registerNewsupply'])->name('register_new_supply');
    Route::get('/show_panel_register_output', [SupplyStockController::class,'showPanelRegisterOutput'])->name('show_panel_register_output');
    Route::get('/supplier_supply_list', [SupplyStockController::class,'suppliersupplyList'])->name('supplier_supply_list');
    Route::get('/list_of_supplys', [SupplyStockController::class,'listOfsupplys'])->name('list_of_supplys');
    Route::get('/anchor_supply_provider', [SupplyStockController::class,'anchorsupplyProvider'])->name('anchor_supply_provider');
    Route::post('/register_supply_entry', [SupplyStockController::class,'registersupplyEntry'])->name('register_supply_entry');
    Route::get('/query_supply_data', [SupplyStockController::class,'querySupplyData'])->name('query_supply_data');
    Route::get('/suppliers', [SuppliersController::class,'showSuppliersList'])->name('suppliers');
    Route::get('/new_supplier_registration_fast', [SuppliersController::class,'newSupplierRegistrationFast'])->name('new_supplier_registration_fast');
    Route::get('/suppliers_register_and_edit', [SuppliersController::class,'showSuppliersRegisterAndEdit'])->name('suppliers_register_and_edit');
    Route::get('/show_list_inventory_movements', [InventoryController::class,'showListInventoryMovements'])->name('show_list_inventory_movements');
    Route::get('/new_supply_inventory', [InventoryController::class,'newsupplyInventory'])->name('new_supply_inventory');
    Route::get('/list_of_suppliers', [SuppliersController::class,'listOfSuppliers'])->name('list_of_suppliers');

//--> Home

    Route::get('/home', [UserController::class,'show_home_list'])->name('home');

//-- Sesion y efectos nesesarios

    Route::get('/switch_theme_', [EfectController::class, 'switch_theme']);
    Route::get('/update_menu_state', [EfectController::class, 'updateMenuState']);
