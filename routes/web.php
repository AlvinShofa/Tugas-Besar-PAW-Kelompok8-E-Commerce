<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\UserController;

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
    return Redirect::route('index_product');
});

Auth::routes();

Route::get('/product', [ProductController::class, 'index_product'])->name('index_product');

Route::middleware(['admin'])->prefix('admin')->group(function() {
    Route::get('/product/create', [ProductController::class, 'create_product'])->name('admin.create_product');
    Route::post('/product/create', [ProductController::class, 'store_product'])->name('admin.store_product');
    Route::get('/product/{product}/edit', [ProductController::class, 'edit_product'])->name('admin.edit_product');
    Route::patch('/product/{product}/update', [ProductController::class, 'update_product'])->name('admin.update_product');
    Route::delete('/product/{product}', [ProductController::class, 'delete_product'])->name('admin.delete_product');
    Route::post('/order/{order}/confirm', [OrderController::class, 'confirm_payment'])->name('admin.confirm_payment');
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.index_user');
    Route::post('/admin/users/toggle/{user}', [UserController::class, 'toggleStatus'])->name('admin.users.toggleStatus');
    // Hapus satu akun
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    // Hapus banyak akun
    Route::delete('/admin/users/delete-multiple', [UserController::class, 'deleteMultiple'])->name('admin.users.deleteMultiple');

});

Route::middleware(['auth'])->group(function() {
    Route::get('/product/{product}', [ProductController::class, 'show_product'])->name('show_product');
    Route::post('/cart/{product}', [CartController::class, 'add_to_cart'])->name('add_to_cart');
    Route::get('/cart', [CartController::class, 'show_cart'])->name('show_cart');
    Route::patch('/cart/{cart}', [CartController::Class, 'update_cart'])->name('update_cart');
    Route::delete('/cart/{cart}', [CartController::class, 'delete_cart'])->name('delete_cart');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/order', [OrderController::class, 'index_order'])->name('admin.index_order');
    Route::get('/order/{order}', [OrderController::class, 'show_order'])->name('show_order');
    Route::post('/order/{order}/pay', [OrderController::class, 'submit_payment_receipt'])->name('submit_payment_receipt');
    Route::get('/profile', [ProfileController::class, 'show_profile'])->name('show_profile');
    Route::post('/profile', [ProfileController::class, 'edit_profile'])->name('edit_profile');
    Route::get('/category/{id}', [ProductController::class, 'showByCategory'])->name('show_category');
});

