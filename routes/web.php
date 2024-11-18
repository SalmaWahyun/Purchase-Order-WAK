<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MarketListController;
use App\Http\Controllers\SuratJalanController;
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

// Route::get('/', function () {
//     return view('login');
// });
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/marketlist', [MarketListController::class, 'index'])->name('marketlist');

Route::post('/marketlist', [MarketListController::class, 'TambahProduk'])->name('TambahProduk');

Route::get('/marketlist/EditProduk/{id}', [MarketListController::class, 'EditProduk'])->name('EditProduk');

Route::put('/marketlist/UpdateProduk/{id}', [MarketListController::class, 'UpdateProduk'])->name('UpdateProduk');

Route::get('/suratjalan', [SuratJalanController::class, 'index'])->name('suratjalan');

Route::get('/invoice', [InvoiceController::class, 'index'])->name('invoice');

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
