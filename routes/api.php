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
use App\Http\Controllers\MainDocumentController;
use App\Http\Controllers\PositionTypeController;
use App\Http\Controllers\WorkingConditionController;



Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    // available organizations
    Route::get('accessOrganizations', [OrganizationController::class, 'accessOrganizations']);

    Route::get('/user', [AuthController::class, 'getUser']);
    Route::get('/logout', [AuthController::class, 'logoutUser']);

    Route::apiResource('employe', EmployeController::class)->only(['index', 'show']);
    Route::apiResource('position', PositionController::class)->only(['index', 'show']);

    Route::apiResource('employe_product', EmployeProductController::class)->only(['index', 'show']);
    Route::get('employe_product/products/{employe_id}', [EmployeProductController::class, 'getEmployeProducts']);
    Route::get('employe_product/mainproducts/{employe_id}', [EmployeProductController::class, 'getMainEmployeProducts']);
    
    Route::apiResource('product', ProductController::class);
    Route::apiResource('product_type', ProductTypeController::class);
    Route::apiResource('role', RoleController::class);



    //   
    Route::apiResource('position_type', PositionTypeController::class);
    Route::apiResource('working_condition', WorkingConditionController::class);



    


    Route::get('employe/getdata/{tableNumber}', [EmployeController::class, 'getEmployeData']);

    Route::get('products/main', [ProductController::class, 'getMainProducts']);

    Route::post('product/set_activate/{id}', [ProductController::class, 'setActivate']);

    Route::post('position/set_activate/{id}', [PositionController::class, 'setActivate']);

    Route::get('allpositions', [PositionController::class, 'allPositions']);

    
    Route::post('product/set_activate/{id}', [ProductController::class, 'setActivate']);



});


Route::middleware(['auth:sanctum', 'ability:admin,buxgalter'])->group(function () {


});

Route::middleware(['auth:sanctum', 'ability:admin,tb'])->group(function () {
    Route::apiResource('employe', EmployeController::class)->only(['update', 'store']);
    Route::apiResource('position', PositionController::class)->only(['update', 'store']);
    Route::apiResource('document', MainDocumentController::class)->only(['index', 'store', 'show', 'destroy']);

    Route::post('document/{id}', [MainDocumentController::class, 'update']);
});

Route::middleware(['auth:sanctum', 'ability:admin,omborchi'])->group(function () {

    Route::post('employe_product/confirm', [EmployeProductController::class, 'confirmProduct']);
    Route::get('employe_product/price/{nomenclature}', [EmployeProductController::class, 'getProductPrices']);
    Route::apiResource('employe_product', EmployeProductController::class)->only(['update', 'store']);

});


Route::middleware(['auth:sanctum', 'ability:admin'])->group(function () {
    Route::apiResource('organization', OrganizationController::class);
    Route::apiResource('users', UserController::class);

    Route::post('organization/set_activate/{id}', [OrganizationController::class, 'setActivate']);

});
