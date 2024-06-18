<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SellerDashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;

Route::get('/', [ProductController::class, 'catalog'])->name('home');
Route::get('/catalog', [ProductController::class, 'catalog'])->name('catalog');
Route::post('/order/submit/{order_id}', [OrderController::class, 'submit'])->name('order.submit');
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
Route::patch('/admin/products/{id}', [AdminController::class, 'updateProduct'])->name('admin.product.update');




Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::get('/seller/dashboard', [SellerDashboardController::class, 'index'])->name('seller.dashboard');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminController::class, 'loginForm'])->name('login');
    Route::post('login', [AdminController::class, 'login']);
    Route::get('product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::patch('product/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('admin.product.edit');
    Route::get('products', [ProductController::class, 'adminProductList'])->name('admin.product.list');

    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('products', [ProductController::class, 'index'])->name('products.index');
        Route::post('products/{id}/change-status', [ProductController::class, 'changeStatus'])->name('product.changeStatus');
    });
});

Route::post('/product/add', [ProductController::class, 'addProduct'])->name('product.add');
Route::delete('/product/{id}', [ProductController::class, 'delete'])->name('product.delete');
Route::post('/admin/products/{id}/changeStatus', [ProductController::class, 'changeStatus'])->name('admin.product.changeStatus');

Route::middleware('auth')->group(function () {
    Route::get('/admin/products', [ProductController::class, 'adminProductList'])->name('admin.products');
    Route::post('/admin/products/{id}/approve', [ProductController::class, 'approveProduct'])->name('admin.product.approve');
});

Route::post('/admin/products/{id}/change-status', [ProductController::class, 'changeStatus'])->name('admin.products.changeStatus');
Route::post('/admin/products/{id}/approve', [ProductController::class, 'approveProduct'])->name('admin.product.approve');

Route::middleware('auth')->group(function () {
    Route::get('/admin/products', [AdminController::class, 'index'])->name('admin.products');
    Route::post('/admin/products/{id}/approve', [AdminController::class, 'approveProduct'])->name('admin.product.approve');
});

Route::get('/seller/products', [SellerDashboardController::class, 'index'])->name('seller.products');
Route::get('/admin/users', 'AdminController@showUsers')->name('admin.users');
Route::post('/order/create', [OrderController::class, 'store'])->name('order.create');
Route::get('/my-orders', function () {
    return view('my_orders');
})->name('my.orders');
Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('my.orders');
Route::post('/admin/product/reject/{id}', [ProductController::class, 'rejectProduct'])->name('admin.product.reject');
Route::post('/order/create', [OrderController::class, 'store'])->name('order.create')->middleware('auth');
Route::post('/reject/{id}', 'ProductController@rejectProduct')->name('product.reject');
Route::post('/product/approve/{id}', 'ProductController@changeStatus')->name('product.approve');
Route::get('admin/product/{id}/edit', [ProductController::class, 'edit'])->name('admin.product.edit');
