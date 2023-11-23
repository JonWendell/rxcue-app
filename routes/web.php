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
Route::controller(UserManagmentController::class)->group(function(){
    Route::get('user/table','index')->name('user/table');
});
// routes/web.php

Route::get('/userTable', 'UserManagmentController@index')->name('userTable');
Route::get('/editUser/{id}', 'UserManagmentController@editUser')->name('editUser');
Route::post('/updateUser/{id}', 'UserManagmentController@updateUser')->name('updateUser');
Route::get('/archiveUser/{id}', 'UserManagmentController@archiveUser')->name('archiveUser');


//routes for inventoyry//


Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
Route::get('/inventory/create', [InventoryController::class, 'create'])->name('inventory.create');
Route::post('/inventory', [InventoryController::class, 'store'])->name('inventory.store');
Route::post('/update-inventory', [InventoryController::class, 'update'])->name('updateInventory');
//Route::get('/inventory/add', [InventoryController::class, 'showAddForm'])->name('inventory.add');
Route::get('/inventory/add/{id}', [InventoryController::class, 'getAddQuantity'])->name('inventory.add'); // Modified this line
Route::post('/inventory/add/{id}', [InventoryController::class, 'postAddQuantity'])->name('inventory.postAdd'); // Modified this li

