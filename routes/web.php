<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\SatkerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::get('dashboard', [AuthController::class, 'dashboard']); 
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('custom-login', [AuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [AuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');


Route::group(['middleware' => 'auth'], function () {

    // =============
    // Admin Master
    // =============
    Route::group(['middleware' => ['role:admin-master','status:aktif'], 'prefix' => 'admin-master', 'as' => 'admin-master.'], function () {

        Route::get('dashboard', [AdminController::class, 'index']);
        Route::get('chart_total_order', [AdminController::class,'getChartTotalOrder']);

        Route::get('show_user', [AdminController::class, 'showUser']);
        Route::get('show_warehouse', [AdminController::class, 'showWarehouse']);
        Route::get('show_entry_item', [AdminController::class, 'showEntryItem']);
        Route::get('show_history', [AdminController::class, 'showHistory']);
        Route::get('category_item', [AdminController::class, 'showCategoryItem']);
        Route::get('show_exit_item', [AdminController::class, 'showExitItem']);
        Route::get('create_user', [AdminController::class, 'createUser']);
        Route::get('create_warehouse', [AdminController::class, 'createWarehouse']);
        Route::get('create_slot/{id}', [AdminController::class, 'createSlot']);
        Route::get('edit_warehouse/{id}', [AdminController::class, 'editWarehouse']);
        Route::get('detail_exit_order/{id}', [AdminController::class, 'detailExitOrder']);
        Route::get('detail_warehouse/{id}', [AdminController::class, 'detailWarehouse']);
        Route::get('detail_slot/{id}', [AdminController::class, 'detailSlot']);
        Route::get('show_profile/{id}', [AdminController::class, 'showProfile']);

        Route::post('edit_profile/{id}', [AdminController::class, 'editProfile']);
        Route::post('edit_password/{id}', [AdminController::class, 'editPassword']);
        Route::post('add_category_item', [AdminController::class, 'addCategoryItem']);
        Route::post('edit_category_item/{id}', [AdminController::class, 'editCategoryItem']);
        Route::post('add_user', [AdminController::class, 'addUser']);
        Route::post('add_warehouse', [AdminController::class, 'addWarehouse']);
        Route::post('add_slot', [AdminController::class, 'addSlot']);
        Route::post('update_warehouse/{id}', [AdminController::class, 'updateWarehouse']);
        Route::post('rack_pallet/{id}', [AdminController::class, 'detailWarehouse']);
        Route::post('delete_category/{id}', [AdminController::class, 'deleteCategory']);

    });

    // =============
    // Admin User
    // =============
    Route::group(['middleware' => ['role:admin-user','status:aktif'], 'prefix' => 'admin-user', 'as' => 'admin-user.'], 
        function () {
            
        Route::get('dashboard', [PetugasController::class, 'index']);
        Route::get('show_warehouse', [PetugasController::class, 'showWarehouse']);
        Route::get('show_history', [PetugasController::class, 'showHistory']);
        Route::get('category_item', [PetugasController::class, 'showCategoryItem']);
        Route::get('create_all_order', [PetugasController::class, 'createAllOrder']);
        Route::get('create_exit_order', [PetugasController::class, 'createExitOrder']);
        Route::get('edit_warehouse/{id}', [PetugasController::class, 'editWarehouse']);
        Route::get('detail_warehouse/{id}', [PetugasController::class, 'detailWarehouse']);
        Route::get('detail_slot/{id}', [PetugasController::class, 'detailSlot']);
        Route::get('detail_order/{id}', [PetugasController::class, 'detailOrder']);
        Route::get('detail_exit_order/{id}', [PetugasController::class, 'detailExitOrder']);
        Route::get('confirm_exit_order/{id}', [PetugasController::class, 'confirmExitOrder']);
        Route::get('confirm_entry_order/{id}', [PetugasController::class, 'confirmEntryOrder']);
        Route::get('show_profile/{id}', [PetugasController::class, 'showProfile']);

        Route::post('edit_profile/{id}', [PetugasController::class, 'editProfile']);
        Route::post('edit_password/{id}', [PetugasController::class, 'editPassword']);
        Route::post('add_order_all', [PetugasController::class, 'addOrderAll']);
        Route::post('add_exit_order', [PetugasController::class, 'addExitOrder']);
        Route::post('add_category_item', [PetugasController::class, 'addCategoryItem']);
        Route::post('edit_category_item/{id}', [PetugasController::class, 'editCategoryItem']);

        Route::get('/get_slot_id', [PetugasController::class, 'getSlotId']);
        Route::get('/get_slot_id_not_in', [PetugasController::class, 'getSlotIdNotIn']);
        Route::get('/get_item', [PetugasController::class, 'getItem']);
        Route::get('/get_warehouse', [PetugasController::class, 'getWarehouse']);
        Route::get('/get_item_category', [PetugasController::class, 'getItemCategory']);
        Route::get('/get_item_code_09', [PetugasController::class, 'getItemCode09']);

        // BARANG KELUAR
        Route::get('/get_warehouse_id', [PetugasController::class, 'getWarehouseId']);
        Route::get('/get_pallet_id', [PetugasController::class, 'getPalletId']);
        Route::get('/get_pallet_id_not_in', [PetugasController::class, 'getPalletIdNotIn']);
        Route::get('/get_item_id', [PetugasController::class, 'getItemId']);
        Route::get('/get_item_id_not_in', [PetugasController::class, 'getItemIdNotIn']);
        Route::get('/get_orderdata_id', [PetugasController::class, 'getOrderDataId']);

    });

    // =============
    // Satuan Kerja (SATKER)
    // =============
    Route::group(['middleware' => ['role:satker','status:aktif'], 'prefix' => 'satker', 'as' => 'satker.'], function () {

        Route::get('dashboard', [SatkerController::class, 'index']);
        Route::get('detail_slot/{id}', [SatkerController::class, 'detailSlot']);
        Route::get('show_profile/{id}', [SatkerController::class, 'showProfile']);

        Route::post('edit_profile/{id}', [SatkerController::class, 'editProfile']);
        Route::post('edit_password/{id}', [SatkerController::class, 'editPassword']);

    });

});
