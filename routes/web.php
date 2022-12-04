<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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
Route::middleware(['auth'])->group(function(){
    Route::get('/info', [InformasiController::class, 'index'])->name('informasi.index');
    Route::get('/info/search', [InformasiController::class, 'search'])->name('informasi.search');

    // Route untuk DATA BARANG
    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    Route::get('/barang/search', [BarangController::class, 'search'])->name('barang.search');
    Route::get('/barang/add', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/barang/store', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/barang/edit/{id}', [BarangController::class, 'edit'])->name('barang.edit');
    Route::post('/barang/update/{id}', [BarangController::class, 'update'])->name('barang.update');
    // Route untuk delete DATA BARANG
    Route::get('/barang/trash', [BarangController::class, 'trash'])->name('barang.trash');
    Route::post('/barang/softDeleted/{id}', [BarangController::class, 'softDeleted'])->name('barang.softDeleted');
    Route::post('/barang/delete/{id}', [BarangController::class, 'delete'])->name('barang.delete');
    Route::get('/barang/restore/{id}', [BarangController::class, 'restore'])->name('barang.restore');

    
    // Route untuk DATA PEMBELI
    Route::get('/pembeli', [PembeliController::class, 'index'])->name('pembeli.index');
    Route::get('/pembeli/search', [PembeliController::class, 'search'])->name('pembeli.search');
    Route::get('/pembeli/add', [PembeliController::class, 'create'])->name('pembeli.create');
    Route::post('/pembeli/store', [PembeliController::class, 'store'])->name('pembeli.store');
    Route::get('/pembeli/edit/{id}', [PembeliController::class, 'edit'])->name('pembeli.edit');
    Route::post('/pembeli/update/{id}', [PembeliController::class, 'update'])->name('pembeli.update');
    Route::post('/pembeli/delete/{id}', [PembeliController::class, 'delete'])->name('pembeli.delete');
    // Route untuk delete DATA PEMBELI
    Route::get('/pembeli/trash', [PembeliController::class, 'trash'])->name('pembeli.trash');
    Route::post('/pembeli/softDeleted/{id}', [PembeliController::class, 'softDeleted'])->name('pembeli.softDeleted');
    Route::post('/pembeli/delete/{id}', [PembeliController::class, 'delete'])->name('pembeli.delete');
    Route::get('/pembeli/restore/{id}', [PembeliController::class, 'restore'])->name('pembeli.restore');
    

    // Route untuk DATA TRANSAKSI
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/search', [TransaksiController::class, 'search'])->name('transaksi.search');
    Route::get('/transaksi/add', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/transaksi/edit/{id}', [TransaksiController::class, 'edit'])->name('transaksi.edit');
    Route::post('/transaksi/update/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
    Route::post('/transaksi/delete/{id}', [TransaksiController::class, 'delete'])->name('transaksi.delete');
    // Route untuk delete DATA TRANSAKSI
    Route::get('/transaksi/trash', [TransaksiController::class, 'trash'])->name('transaksi.trash');
    Route::post('/transaksi/softDeleted/{id}', [TransaksiController::class, 'softDeleted'])->name('transaksi.softDeleted');
    Route::post('/transaksi/delete/{id}', [TransaksiController::class, 'delete'])->name('transaksi.delete');
    Route::get('/transaksi/restore/{id}', [TransaksiController::class, 'restore'])->name('transaksi.restore');
});

Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/logout', function() {
    \Auth::logout();
    return redirect('/');
});
