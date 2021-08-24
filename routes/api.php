<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\StorageController;
use \App\Http\Middleware\EnsureTokenIsValid;
use \App\Http\Controllers\Api\Report\ReportController;
use \App\Http\Controllers\Api\FillingController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::get('/product',[ProductController::class, 'index'])->middleware([EnsureTokenIsValid::class]);

//Route::get("/report/new-product", [ReportController::class, "newProductReport"])->middleware(['auth.basic', 'admin']);
//
//Route::get("/report/moved-product", [ReportController::class, "movedProductReport"])->middleware(['auth.basic', 'admin']);
//
//Route::get("/report/customer-product", [ReportController::class, "customerProductReport"])->middleware(['auth.basic', 'customer']);
//
//Route::post("/create-product", [FillingController::class, "createProduct"])->middleware(['auth.basic', 'customer']);
//
//Route::post("/add-storage/{product}", [FillingController::class, "addStorage"])->middleware(['auth.basic', 'admin']);

Route::middleware(['auth.basic', 'admin'])->group(function(){
    Route::get("/report/new-product", [ReportController::class, "newProductReport"]);
    Route::get("/report/moved-product", [ReportController::class, "movedProductReport"]);
    Route::post("/add-storage/{product}", [FillingController::class, "addStorage"]);
});

Route::middleware(['auth.basic', 'customer'])->group(function(){
    Route::get("/report/customer-product", [ReportController::class, "customerProductReport"])->middleware(['auth.basic', 'customer']);
    Route::post("/create-product", [FillingController::class, "createProduct"])->middleware(['auth.basic', 'customer']);
});
