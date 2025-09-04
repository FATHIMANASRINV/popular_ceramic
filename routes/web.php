<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Auth; 

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

Route::middleware(['auth', 'checkUserType:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard.index');
    })->name('admin.dashboard');

    Route::get('/admin/inventory/addproduct', function () {
        return view('admin.inventory.addproduct');
    })->name('admin.inventory.addproduct');

    Route::get('signup/index', function () {
        return view('signup.index');
    })->name('admin.signup.index');

    Route::post('signup/SignupForm', [SignupController::class, 'SignupForm'])->name('signup.SignupForm');


    Route::get('/admin/inventory/addcategory', function () {
        return view('admin.inventory.addcategory');
    })->name('admin.inventory.addcategory');

    Route::post('admin/inventory/store', [InventoryController::class, 'store'])->name('inventory.store');
    Route::get('admin/inventory/editcategorydetails', [InventoryController::class, 'editcategorydetails'])->name('inventory.editcategorydetails');

    Route::get('admin/inventory/addcategory', [InventoryController::class, 'getcategories'])->name('admin.inventory.addcategory');
    Route::get('admin/inventory/getcategoriesDatatable', [InventoryController::class, 'getcategoriesDatatable'])->name('inventory.getcategoriesDatatable');

    Route::match(['get', 'post'], 'admin/inventory/categoryselect2', [InventoryController::class, 'categoryselect2'])->name('admin.inventory.categorysearch');

    Route::post('admin/inventory/Insertproduct', [InventoryController::class, 'Insertproduct'])->name('inventory.Insertproduct');

    Route::match(['get','post'], 'admin/inventory/addproduct', [InventoryController::class, 'getProducts'])->name('admin.inventory.addproduct');


    Route::get('admin/inventory/editProductdetails', [InventoryController::class, 'editProductdetails'])->name('inventory.editProductdetails');




    Route::post('admin/inventory/approve_quantity', [InventoryController::class, 'approve_quantity'])->name('inventory.approve_quantity');

    Route::post('admin/inventory/approve_sales', [InventoryController::class, 'approve_sales'])->name('admin.inventory.approve_sales');

    Route::match(['get','post'], 'admin/inventory/pending_quantity', [InventoryController::class, 'getRequestedQuantityProducts'])->name('admin.inventory.pending_quantity');

    Route::match(['get','post'], 'admin/report/staff_details', [ReportController::class, 'getstaff_details'])->name('admin.report.staff_details');

    Route::match(['get', 'post'], 'admin/report/usersEmailselect2', [ReportController::class, 'usersEmailselect2'])->name('admin.report.usersselect2');


    Route::get('/admin/inventory/sales', function () {
        return view('admin.inventory.sales');
    })->name('admin.inventory.sales'); 


    Route::match(['get','post'], 'admin/inventory/pending_sales', [InventoryController::class, 'getpending_salesProducts'])->name('admin.inventory.pending_sales');


    Route::match(['get','post'], 'admin/inventory/sales_details', [InventoryController::class, 'getSalesDetailsReport'])->name('admin.inventory.sales_details');


    Route::match(['get', 'post'], 'admin/inventory/productselect2', [InventoryController::class, 'productselect2'])->name('admin.inventory.productsearch');

    Route::post('admin/inventory/MoveToHold', [InventoryController::class, 'MoveToHold'])->name('admin.inventory.MoveToHold');
});

Route::middleware(['auth', 'checkUserType:staff'])->group(function () {
    Route::get('/staff/dashboard', function () {
        return view('staff.dashboard.index');
    })->name('staff.dashboard');

    Route::match(['get', 'post'], 'staff/inventory/categoryselect2', [InventoryController::class, 'categoryselect2'])->name('staff.inventory.categorysearch');

    Route::match(['get', 'post'], 'staff/inventory/productselect2', [InventoryController::class, 'productselect2'])->name('staff.inventory.productsearch');

    Route::get('/staff/inventory/request_quantity', function () {
        return view('staff.inventory.request_quantity');
    })->name('staff.inventory.request_quantity');
    Route::get('/staff/inventory/request_quantity_report', function () {
        return view('staff.inventory.request_quantity_report');
    })->name('staff.inventory.request_quantity_report');

    Route::post('staff/inventory/InsertRequestproduct', [InventoryController::class, 'InsertRequestproduct'])->name('inventory.InsertRequestproduct');

    Route::match(['get','post'], 'staff/inventory/request_quantity_report', [InventoryController::class, 'getRequestedQuantityProducts'])->name('staff.inventory.request_quantity_report');

    Route::post('staff/inventory/MoveToHold', [InventoryController::class, 'MoveToHold'])->name('staff.inventory.MoveToHold');


});

Route::get('/', [App\Http\Controllers\WebsiteController::class, 'getWebsiteIndexDetails'])
->name('website.index');

