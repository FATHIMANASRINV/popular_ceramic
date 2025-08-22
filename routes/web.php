<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;

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

Route::post('/logout', function () {
    Auth::logout(); 
    request()->session()->invalidate(); 
    request()->session()->regenerateToken(); 
    return redirect('/'); 
})->name('logout');

Route::get('/login-page', function () {
    return view('login.login');  
})->name('custom.login');


Route::get('/', function () {
    return view('website.index');
});

// Route::middleware('guest')->group(function () {
//     Route::get('/register', Register::class)->name('register');
//     Route::get('/login', Login::class)->name('login');

//     Route::get('/login/forgot-password', ForgotPassword::class)->name('forgot-password');
//     Route::get('/reset-password/{id}', ResetPassword::class)->name('reset-password')->middleware('signed');
// });
Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard.index');
    })->name('admin.dashboard');

    Route::get('/user/dashboard', function () {
        return view('user.dashboard.index');
    })->name('user.dashboard');

    Route::get('/admin/inventory/addproduct', function () {
        return view('admin.inventory.addproduct');
    })->name('admin.inventory.addproduct');

    Route::get('/admin/inventory/addcategory', function () {
        return view('admin.inventory.addcategory');
    })->name('admin.inventory.addcategory');

    Route::post('admin/inventory/store', [InventoryController::class, 'store'])->name('inventory.store');





    Route::get('admin/inventory/editcategorydetails', [InventoryController::class, 'editcategorydetails'])->name('inventory.editcategorydetails');



    Route::get('admin/inventory/addcategory', [InventoryController::class, 'getcategories'])->name('admin.inventory.addcategory');


    Route::get(
        'admin/inventory/getcategoriesDatatable',
        [InventoryController::class, 'getcategoriesDatatable']
    )->name('inventory.getcategoriesDatatable');

    Route::match(['get', 'post'], 'admin/inventory/categoryselect2', [InventoryController::class, 'categoryselect2'])->name('inventory.categorysearch');


    Route::POST('admin/inventory/Insertproduct', [InventoryController::class, 'Insertproduct'])->name('inventory.Insertproduct');

    Route::match(['get','post'], 'admin/inventory/addproduct', [InventoryController::class, 'getProducts'])->name('admin.inventory.addproduct');
    Route::get('admin/inventory/editProductdetails', [InventoryController::class, 'editProductdetails'])->name('inventory.editProductdetails');

Route::get('/', [App\Http\Controllers\WebsiteController::class, 'getWebsiteIndexDetails'])
     ->name('website.index');


});