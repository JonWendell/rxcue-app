<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\UserController;


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
Route::get('/manage-user', [UserController::class, 'index'])->name('user.index');