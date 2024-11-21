<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\WorkforceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SellingController;
use App\Http\Controllers\SellingTransactionController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseTransactionController;
// @AR, start
use App\Http\Controllers\SellingReportViewController;
use App\Http\Controllers\PurchaseReportViewController;
use App\Http\Controllers\AllTimeSellingReportViewController;
use App\Http\Controllers\ProfitReportViewController;
use App\Http\Controllers\ExpenditureReportViewController;
use App\Http\Controllers\ExpenditurePerMaterialReportViewController;
// @AR, end



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("user/{id}",[UserController::class,"index"]);

Route::put('products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::get('products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::post('products', [ProductController::class, 'store'])->name('products.store');
Route::get('products', [ProductController::class, 'index'])->name('products.index');

Route::put('products/{id}/updateMaterials', [ProductController::class, 'updateProductMaterials']);
Route::post('products/createProductMaterials', [ProductController::class, 'createProductMaterials']);

 
Route::post('materials/', [MaterialController::class, 'store']);
Route::get('materials/', [MaterialController::class, 'index']);
Route::get('materials/{id}', [MaterialController::class, 'show']);
Route::delete('materials/{id}', [MaterialController::class, 'destroy']);
Route::put('materials/{id}', [MaterialController::class, 'update']);

Route::post('machine/', [MachineController::class, 'store']);
Route::get('machine/', [MachineController::class, 'index']);
Route::get('machine/{id}', [MachineController::class, 'show']);
Route::delete('machine/{id}', [MachineController::class, 'destroy']);
Route::put('machine/{id}', [MachineController::class, 'update']);

Route::post('workforce/', [WorkforceController::class, 'store']);
Route::get('workforce/', [WorkforceController::class, 'index']);
Route::get('workforce/{id}', [WorkforceController::class, 'show']);
Route::delete('workforce/{id}', [WorkforceController::class, 'destroy']);
Route::put('workforce/{id}', [WorkforceController::class, 'update']);

Route::post('project/', [ProjectController::class, 'store']);
Route::get('project/', [ProjectController::class, 'index']);
Route::get('project/{id}', [ProjectController::class, 'show']);
Route::delete('project/{id}', [ProjectController::class, 'destroy']);
Route::put('project/{id}', [ProjectController::class, 'update']);
// @AR2, start
Route::get('project/workforce_machine/{id}', [ProjectController::class, 'showWorkforces_Machines']);
// @AR2, end

Route::put('project/{id}/updateProducts', [ProjectController::class, 'updateProjectProducts']);
Route::post('project/createProjectProducts', [ProjectController::class, 'createProjectProducts']);
// @AR2, start
Route::put('project/{id}/updateProjectMachines', [ProjectController::class, 'updateProjectMachines']);
Route::put('project/{id}/updateProjectWorkforces', [ProjectController::class, 'updateProjectWorkforces']);
// @AR2, end

// Route::post('schedule/', [ScheduleController::class, 'store']);
// Route::get('schedule/', [ScheduleController::class, 'index']);
// Route::get('schedule/{id}', [ScheduleController::class, 'show']);
// Route::delete('schedule/{id}', [ScheduleController::class, 'destroy']);
// Route::put('schedule/{id}', [ScheduleController::class, 'update']);

Route::get('customer/', [CustomerController::class, 'index']);
Route::post('customer/', [CustomerController::class, 'store']);
Route::get('customer/{id}', [CustomerController::class, 'show']);
Route::put('customer/{id}', [CustomerController::class, 'update']);
Route::delete('customer/{id}', [CustomerController::class, 'destroy']);

//SELLING
Route::get('selling/', [SellingController::class, 'index']);
Route::post('selling/transaction/', [SellingController::class, 'storeTransaction']);
Route::post('selling/item/', [SellingController::class, 'storeItem']);

Route::get('/archive/selling/transaction', [SellingTransactionController::class, 'index']);
Route::post('/archive/selling/transaction/', [SellingTransactionController::class, 'store']);
Route::get('/archive/selling/transaction/{id}', [SellingTransactionController::class, 'show']);
Route::put('/archive/selling/transaction/{id}', [SellingTransactionController::class, 'update']);
Route::delete('/archive/selling/transaction/{id}', [SellingTransactionController::class, 'destroy']);
Route::put('/archive/selling/{id}/updateItem', [SellingTransactionController::class, 'updateItem']);


//PURCHASING
Route::get('purchase/', [PurchaseController::class, 'index']);
Route::post('purchase/transaction/', [PurchaseController::class, 'storeTransaction']);
Route::post('purchase/item/', [PurchaseController::class, 'storeItem']);

Route::get('/archive/purchase/transaction', [PurchaseTransactionController::class, 'index']);
Route::post('/archive/purchase/transaction/', [PurchaseTransactionController::class, 'store']);
Route::get('/archive/purchase/transaction/{id}', [PurchaseTransactionController::class, 'show']);
Route::put('/archive/purchase/transaction/{id}', [PurchaseTransactionController::class, 'update']);
Route::delete('/archive/purchase/transaction/{id}', [PurchaseTransactionController::class, 'destroy']);
Route::put('/archive/purchase/{id}/updateItem', [PurchaseTransactionController::class, 'updateItem']);

Route::get('/archive/purchase/item', [PurchaseItemController::class, 'index']);


// @AR, start
//VIEWS
Route::get('sellingReportView', [SellingReportViewController::class, 'index']);
Route::get('purchaseReportView', [PurchaseReportViewController::class, 'index']);
Route::get('allTimeSellingReportView', [AllTimeSellingReportViewController::class, 'index']);
Route::get('profitReportView', [ProfitReportViewController::class, 'index']);
Route::get('expenditureReportView', [ExpenditureReportViewController::class, 'index']);
Route::get('expenditurePerMaterialReportView', [ExpenditurePerMaterialReportViewController::class, 'index']);
// @AR, end
