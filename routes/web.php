<?php

use App\Http\Controllers\DaftarProdukController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MarketListController;
use App\Http\Controllers\SuratJalanController;
use App\Http\Controllers\KonsumenController;
use App\Http\Controllers\SuplierController;
use App\Http\Controllers\TambahPesananController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BasicElementController;
use App\Http\Controllers\BasicTableController;
use App\Http\Controllers\ButtonsController;
use App\Http\Controllers\ChartJsController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\DropdownsController;
use App\Http\Controllers\Error404Controller;
use App\Http\Controllers\Error500Controller;
use App\Http\Controllers\MDIController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TypographyController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\RiwayatPesananController;

// Route::get('/', function () {
//     return view('login');
// });
Route::get('/', function () {
    return redirect('/login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);  
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/marketlist', [MarketListController::class, 'index'])->name('marketlist');

Route::post('/marketlist', [MarketListController::class, 'TambahPesanan'])->name('TambahPesanan');

Route::get('/marketlist/EditProduk/{id}', [MarketListController::class, 'EditProduk'])->name('EditProduk');

Route::put('/marketlist/UpdateProduk/{id}', [MarketListController::class, 'UpdateProduk'])->name('UpdateProduk');

Route::get('/daftarproduk', [DaftarProdukController::class, 'index'])->name('daftarproduk');

Route::post('/daftarproduk', [DaftarProdukController::class, 'TambahProduk'])->name('TambahProduk');

Route::get('/tambahpesanan', [TambahPesananController::class, 'index'])->name('tambahpesanan');


Route::get('/konsumen', [KonsumenController::class, 'index'])->name('konsumen');

Route::post('/konsumen', [KonsumenController::class, 'TambahKonsumen'])->name('TambahKonsumen');

Route::get('/suplier', [SuplierController::class, 'index'])->name('suplier');

Route::post('/suplier', [SuplierController::class, 'TambahSuplier'])->name('TambahSuplier');

Route::get('/basic_elements', [BasicElementController::class, 'index'])->name('basic_elements');

Route::get('/basic-table', [BasicTableController::class, 'index'])->name('basic-table');

Route::get('/buttons', [ButtonsController::class, 'index'])->name('buttons');

Route::get('/chartjs', [ChartJsController::class, 'index'])->name('chartjs');

Route::get('/documentation', [DocumentationController::class, 'index'])->name('documentation');

Route::get('/dropdowns', [DropdownsController::class, 'index'])->name('dropdowns');

Route::get('/error-404', [Error404Controller::class, 'index'])->name('error-404');

Route::get('/error-500', [Error500Controller::class, 'index'])->name('error-500');

Route::get('/mdi', [MDIController::class, 'index'])->name('mdi');

// Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::get('/register', [RegisterController::class, 'index'])->name('register');

Route::get('/typography', [TypographyController::class, 'index'])->name('typography');

Route::get('/tambah-pesanan', [MarketListController::class, 'createPesanan'])->name('create.pesanan');
Route::post('/store-pesanan', [MarketListController::class, 'storePesanan'])->name('store.pesanan');

Route::get('/pesanan/{id}/detail', [MarketListController::class, 'detailPesanan'])->name('pesanan.detail');
Route::get('/pesanan/{id}/edit', [MarketListController::class, 'editPesanan'])->name('pesanan.edit');
Route::put('/pesanan/{id}', [MarketListController::class, 'updatePesanan'])->name('pesanan.update');

Route::delete('/transaksi-pesanan/{id}', [MarketListController::class, 'deleteTransaksi'])
    ->name('transaksi.delete');

Route::post('/pesanan/{id}/transaksi', [MarketListController::class, 'storeTransaksi'])
    ->name('transaksi.store');

Route::delete('/transaksi-pesanan/{id}/delete-with-pesanan', [MarketListController::class, 'deleteTransaksiAndPesanan'])
    ->name('transaksi.delete-with-pesanan');

Route::delete('/pesanan/{id}', [MarketListController::class, 'deletePesanan'])->name('pesanan.delete');

Route::put('/daftarproduk/{id}', [DaftarProdukController::class, 'UpdateProduk'])->name('UpdateProduk');

Route::delete('/daftarproduk/{id}', [DaftarProdukController::class, 'deleteProduk'])->name('DeleteProduk');

Route::put('/suplier/{id}', [SuplierController::class, 'UpdateSuplier'])->name('UpdateSuplier');
Route::delete('/suplier/{id}', [SuplierController::class, 'deleteSuplier'])->name('DeleteSuplier');

Route::put('/konsumen/{id}', [KonsumenController::class, 'UpdateKonsumen'])->name('UpdateKonsumen');
Route::delete('/konsumen/{id}', [KonsumenController::class, 'deleteKonsumen'])->name('DeleteKonsumen');

Route::get('/check-produk/{pesananId}/{produkId}', [MarketListController::class, 'checkProduk']);

// Route::get('/cetak-invoice/{id}', [InvoiceController::class, 'cetakInvoice'])->name('cetak.invoice');

Route::get('/preview-invoice/{id}', [InvoiceController::class, 'Invoice'])->name('preview.invoice');

Route::get('/riwayat-pesanan', [RiwayatPesananController::class, 'index'])->name('riwayat.index');
Route::get('/riwayat-pesanan/{id}', [RiwayatPesananController::class, 'detail'])->name('riwayat.detail');
Route::put('/pesanan/{id}/selesai', [MarketListController::class, 'selesaikanPesanan'])->name('pesanan.selesai');