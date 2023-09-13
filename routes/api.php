<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
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


Route::apiResource('employe', EmployeController::class);
Route::apiResource('position', PositionController::class);
Route::apiResource('organization', OrganizationController::class);
Route::apiResource('product', ProductController::class);
Route::apiResource('product_type', ProductTypeController::class);

Route::post('position/set_activate/{id}', [PositionController::class, 'setActivate']);
Route::post('organization/set_activate/{id}', [OrganizationController::class, 'setActivate']);
Route::post('product/set_activate/{id}', [ProductController::class, 'setActivate']);


Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/user', [UserController::class, 'getUser']);

});

