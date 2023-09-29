<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EmployeProductController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/








Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'getUser']);
    Route::get('/logout', [AuthController::class, 'logoutUser']);




    Route::apiResource('employe', EmployeController::class);
    Route::apiResource('position', PositionController::class);
    Route::apiResource('organization', OrganizationController::class);
    Route::apiResource('product', ProductController::class);
    Route::apiResource('product_type', ProductTypeController::class);
    Route::apiResource('role', RoleController::class);
    Route::apiResource('employe_product', EmployeProductController::class);
    Route::apiResource('users', UserController::class);

    Route::get('accessOrganizations', [OrganizationController::class, 'accessOrganizations']);



    Route::get('employe_product/products/{employe_id}', [EmployeProductController::class, 'getEmployeProducts']);
    Route::get('employe_product/mainproducts/{employe_id}', [EmployeProductController::class, 'getMainEmployeProducts']);
    Route::get('employe_product/price/{nomenclature}', [EmployeProductController::class, 'getProductPrices']);
    Route::post('employe_product/confirm', [EmployeProductController::class, 'confirmProduct']);
    Route::get('employe/getdata/{tableNumber}', [EmployeController::class, 'getEmployeData']);

    Route::get('products/main', [ProductController::class, 'getMainProducts']);

    Route::post('product/set_activate/{id}', [ProductController::class, 'setActivate']);

    Route::post('position/set_activate/{id}', [PositionController::class, 'setActivate']);
    Route::post('organization/set_activate/{id}', [OrganizationController::class, 'setActivate']);
    Route::post('product/set_activate/{id}', [ProductController::class, 'setActivate']);





});


Route::middleware(['auth:sanctum', 'ability:admin,omborchi'])->group(function () {


});


Route::middleware(['auth:sanctum', 'ability:admin'])->group(function () {


});
