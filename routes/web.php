<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DaftarAlamatController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\DataBarangController;
use App\Http\Controllers\DataKategoriController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OngkirController;
use App\Http\Controllers\PaymentCallbackController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\RegisterController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


// ==== Login and Register Routes ====
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');
// ==== End Login and Register Routes ====


// ==== Admin Routes ====

// Manual Route
Route::get('/dashboard-admin', [DashboardAdminController::class, 'index'])->middleware('admin');
Route::get('/master/data-kategori/list/{kategori:id}', [DataKategoriController::class, 'list'])->middleware('admin');

// Resource Route
Route::resource('/master/data-kategori', DataKategoriController::class)->middleware('admin');
Route::resource('/master/data-barang', DataBarangController::class)->middleware('admin');

// ==== End Admin Routes ====


// ==== User Routes ====

// Manual Route
Route::get('/', [DashboardUserController::class, 'index']);
Route::get('/produk', [DashboardUserController::class, 'getProduk']);
Route::get('/single-produk/{barang:uuid}', [DashboardUserController::class, 'singleProduk']);
Route::get('/produk/kategori/{kategori:id}', [DashboardUserController::class, 'getProdukByKategori']);
Route::get('/keranjang', [KeranjangController::class, 'index'])->middleware('auth');
Route::post('/keranjang/{barang:id}', [KeranjangController::class, 'addToCart'])->middleware('auth');
Route::post('/keranjang/{keranjang:id}/update', [KeranjangController::class, 'updateCart'])->middleware('auth');
Route::delete('/keranjang/hapus/{keranjang:id}', [KeranjangController::class, 'hapus'])->middleware('auth');
Route::get('/checkout', [CheckoutController::class, 'index'])->middleware('auth');
Route::post('/pembayaran', [CheckoutController::class, 'pembayaran'])->middleware('auth');
Route::get('/checkout/get_data', [OngkirController::class, 'provinces'])->name('checkout.get_data')->middleware('auth');
Route::post('/checkout/cek_ongkir', [OngkirController::class, 'cost'])->middleware('auth');
Route::post('/checkout/charger', [CheckoutController::class, 'charger'])->name('checkout.charger')->middleware('auth');
Route::get('/pesanan', [PesananController::class, 'index'])->middleware('auth');
Route::get('/pesanan/{checkout:uuid}', [PesananController::class, 'detailPesanan'])->middleware('auth');
Route::post('payments/midtrans-notification', [PaymentCallbackController::class, 'receive']);

// Resource Route
Route::resource('/daftar-alamat', DaftarAlamatController::class)->middleware('auth');

// ==== End User Routes ====