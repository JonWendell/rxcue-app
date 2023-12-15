<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserManagmentController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\EcomController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SalesController;  

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

Route::middleware(['auth.manual'])->group(function () {
    Route::get('/back-home', function () {
        return view('back.home');
    })->name('admin.home');
    
});


Route::middleware(['auth.manual'])->group(function () {
    Route::get('/customer', [EcomController::class, 'index'])->name('customer');
});

//User Management rout//

Route::group(['prefix' => 'user'], function () {
    Route::get('table', [UserManagmentController::class, 'index'])->name('userTable');
    Route::get('edit/{id}', [UserManagmentController::class, 'showEditUserForm'])->name('editUser');
    Route::post('update/{id}', [UserManagmentController::class, 'updateUser'])->name('updateUser');
    Route::get('archive/{id}', [UserManagmentController::class, 'archiveUser'])->name('archiveUser');
    Route::get('add-user-form', [UserManagmentController::class, 'showAddUserForm'])->name('addUserForm'); // Add this line
    Route::post('store-user', [UserManagmentController::class, 'storeUser'])->name('storeUser');
    Route::get('/user/details/{id}', [UserManagmentController::class, 'getUserDetails'])->name('getUserDetails');
});


//routes for inventoyry//

Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
Route::get('/inventory/create', [InventoryController::class, 'create'])->name('inventory.create');
Route::post('/inventory', [InventoryController::class, 'store'])->name('inventory.store');
Route::post('/update-inventory', [InventoryController::class, 'update'])->name('updateInventory');
Route::get('/inventory/add/{id}', [InventoryController::class, 'getAddQuantity'])->name('inventory.add');
Route::post('/inventory/add/{id}', [InventoryController::class, 'postAddQuantity'])->name('inventory.postAdd');
Route::get('/inventory/audit/{id}', [InventoryController::class, 'auditHistory'])->name('inventory.audit');

//branch routes nakakalito na to //
Route::get('/create-branch', [BranchController::class, 'createForm'])->name('branch.create.form');
Route::post('/create-branch', [BranchController::class, 'create'])->name('branch.create');
Route::get('/view-branches', [BranchController::class, 'view'])->name('branch.view');
Route::get('/edit-branch/{id}', [BranchController::class, 'editForm'])->name('branch.edit.form');
Route::delete('/archive-branch/{id}', [BranchController::class, 'archive'])->name('branch.archive');
Route::put('/update-branch/{id}', [BranchController::class, 'update'])->name('branch.update');
//ecom side//



Route::get('/order-layout/{productId}', [EcomController::class, 'showOrderLayout']);
Route::view('/checkout','checkout');
Route::get('/cart', [EcomController::class, 'showCart']);
Route::post('/add-to-cart/{productId}', [EcomController::class, 'addToCart'])->name('addToCart');
Route::post('/purchase', [EcomController::class, 'purchase'])->name('purchase');
Route::delete('/remove-from-cart/{productId}', [EcomController::class, 'removeFromCart'])->name('remove-from-cart');
Route::get('/home1', [EcomController::class, 'home1'])->name('home1');
Route::get('/about2', [EcomController::class, 'about2'])->name('about2');
Route::get('/product1', [EcomController::class, 'product1'])->name('product1');


// routes/web.php



Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');


//cashier

Route::get('/cashier', [CashierController::class, 'show'])->name('cashier.show');
Route::get('/cashier/inventory', [CashierController::class, 'showInventory'])->name('cashier.inventory');



Route::get('/logout', [AuthController::class, 'logout'])->name('manual.logout');

//landingpage
Route::get('/home', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/products', [PageController::class, 'products'])->name('products');


// routes/web.php

Route::post('/purchase', [SalesController::class, 'purchase'])->name('purchase');



Route::get('/cashier/purchases', [SalesController::class, 'showPurchases'])->name('cashier.purchases');
Route::get('/purchases/show', [SalesController::class, 'showPurchases'])->name('purchases.show');
Route::get('/purchases/{id}/void', [SalesController::class, 'voidPurchase'])
    ->name('purchases.void');
    
Route::get('/purchase-history', [EcomController::class, 'showPurchaseHistory'])->name('ecom.purchase.history');
Route::delete('/cancel-order/{sale}', [EcomController::class, 'cancelOrder'])->name('cancel.order');


Route::get('cashier/manageSales', [CashierController::class, 'manageSales'])->name('cashier.manageSales');
Route::post('/purchases/complete', [SalesController::class, 'completePurchase'])->name('purchases.complete');
Route::get('/purchases/sales', [SalesController::class, 'viewSales'])->name('purchases.sales');
Route::get('/sales-management', [SalesController::class, 'viewSales'])->name('sales.management');


