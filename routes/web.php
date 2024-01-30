<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoriController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransaksiController;

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
Route::get('/', [TransaksiController::class, 'index'])->name('landingpage');


// Route::get('/', function () {
//     return view('landingpage.cardproduct');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('product', [ProductController ::class, 'index'])->name('product.index');
Route::get('produk', [ProductController ::class, 'create'])->name('product.tambah');
Route::post('saved', [ProductController ::class, 'store'])->name('product.store');
Route::get('ganti/{id}', [ProductController ::class, 'edit'])->name('product.edit');
Route::post('perbarui/{id}', [ProductController ::class, 'update'])->name('product.update');
Route::delete('delete/{id}', [ProductController ::class, 'destroy'])->name('product.destroy');

Route::get('categori', [CategoriController ::class, 'index'])->name('categori.index');
    Route::get('add', [CategoriController ::class, 'create'])->name('categori.tambah');
    Route::get('ubah/{id}', [CategoriController ::class, 'edit'])->name('categori.edit');
    Route::post('save', [CategoriController ::class, 'store'])->name('categori.store');
    Route::post('update/{id}', [CategoriController ::class, 'update'])->name('categori.update');
    Route::get('hapus/{id}', [CategoriController ::class, 'destroy'])->name('categori.destroy');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/order/{id}', [TransaksiController::class, 'orderID'])->name('order');
    Route::post('/order/store', [TransaksiController::class, 'store'])->name('order.store');
    Route::get('/transaksi', [TransaksiController::class, 'listTransaksi'])->name('transaksi');

});


