<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productController;
use App\Http\Controllers\ProfileController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/products/create', [productController::class, 'create'])->name('product.create');
    Route::post('/products/create', [productController::class, 'store'])->name('product.store');
    Route::get('/products', [productController::class, 'index'])->name('product.index');
    Route::get('/products/{product}', [productController::class, 'show'])->name('product.detail');
    Route::get('/products/edit/{product}', [productController::class, 'edit'])->name('product.edit');
    Route::patch('/products/{product}/update', [productController::class, 'update'])->name('product.update');
    Route::delete('/products/delete/{product}', [productController::class, 'destroy'])->name('product.delete');
});

require __DIR__.'/auth.php';