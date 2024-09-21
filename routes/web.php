<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\user_management\UserController;
use App\Http\Controllers\user_management\EmployeeController;
use App\Http\Controllers\user_management\RoleController;
use App\Http\Controllers\inventory_management\InventoryController;
use App\Http\Controllers\inventory_management\ProductStockController;
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
    Route::get('/show_panel_register_entry', [ProductStockController::class,'showPanelRegisterEntry'])->name('show_panel_register_entry');
    Route::get('/supplier_product_list', [ProductStockController::class,'supplierProductList'])->name('supplier_product_list');
    Route::get('/list_of_products', [ProductStockController::class,'listOfProducts'])->name('list_of_products');
    Route::get('/anchor_product_provider', [ProductStockController::class,'anchorProductProvider'])->name('anchor_product_provider');
    Route::post('/register_product_entry', [ProductStockController::class,'registerProductEntry'])->name('register_product_entry');
    Route::get('/suppliers', [SuppliersController::class,'showSuppliersList'])->name('suppliers');
    Route::get('/suppliers_register_and_edit', [SuppliersController::class,'showSuppliersRegisterAndEdit'])->name('suppliers_register_and_edit');

//--> Home

    Route::get('/home', [UserController::class,'show_home_list'])->name('home');

//-- Sesion y efectos nesesarios

    Route::get('/switch_theme_', [EfectController::class, 'switch_theme']);
    Route::get('/update_menu_state', [EfectController::class, 'updateMenuState']);
