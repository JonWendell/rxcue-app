<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserManagmentController;
use App\Http\Controllers\InventoryController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::view('/login-auth','login-auth');
Route::view('/example-page','example-page');
Route::view('/customer','customer');
Route::view('/ordered','ordered');
Route::view('/checkout','checkout');
Route::get('/create-branch', [BranchController::class, 'createForm'])->name('branch.create.form');
Route::post('/create-branch', [BranchController::class, 'create'])->name('branch.create');
Route::get('/view-branches', [BranchController::class, 'view'])->name('branch.view');
Route::get('/edit-branch/{id}', [BranchController::class, 'editForm'])->name('branch.edit.form');
Route::delete('/archive-branch/{id}', [BranchController::class, 'archive'])->name('branch.archive');
Route::put('/update-branch/{id}', [BranchController::class, 'update'])->name('branch.update');
//User Management rout//

Route::group(['prefix' => 'user'], function () {
    Route::get('table', [UserManagmentController::class, 'index'])->name('userTable');
    Route::get('edit/{id}', [UserManagmentController::class, 'editUser'])->name('editUser');
    Route::post('update/{id}', [UserManagmentController::class, 'updateUser'])->name('updateUser');
    Route::get('archive/{id}', [UserManagmentController::class, 'archiveUser'])->name('archiveUser');
    Route::get('add-user-form', [UserManagmentController::class, 'showAddUserForm'])->name('addUserForm');
    Route::post('store-user', [UserManagmentController::class, 'storeUser'])->name('storeUser');
});


//routes for inventoyry//

Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
Route::get('/inventory/create', [InventoryController::class, 'create'])->name('inventory.create');
Route::post('/inventory', [InventoryController::class, 'store'])->name('inventory.store');
Route::post('/update-inventory', [InventoryController::class, 'update'])->name('updateInventory');
Route::get('/inventory/add/{id}', [InventoryController::class, 'getAddQuantity'])->name('inventory.add');
Route::post('/inventory/add/{id}', [InventoryController::class, 'postAddQuantity'])->name('inventory.postAdd');
