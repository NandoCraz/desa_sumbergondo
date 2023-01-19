<?php

use App\Http\Controllers\BookingAdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DaftarAlamatController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\DataBarangController;
use App\Http\Controllers\DataKategoriController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MontirController;
use App\Http\Controllers\OngkirController;
use App\Http\Controllers\PaymentCallbackController;
use App\Http\Controllers\PelayananController;
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
Route::get('/pesanan/belum-dibayar', [PesananController::class, 'belumDibayar'])->middleware('admin');
Route::get('/pesanan/menunggu-konfirmasi', [PesananController::class, 'menungguKonfirmasi'])->middleware('admin');
Route::get('/pesanan/diproses', [PesananController::class, 'diproses'])->middleware('admin');
Route::get('/pesanan/dikirim', [PesananController::class, 'dikirim'])->middleware('admin');
Route::get('/pesanan/selesai', [PesananController::class, 'selesai'])->middleware('admin');
Route::get('/pesanan/dibatalkan', [PesananController::class, 'dibatalkan'])->middleware('admin');
Route::get('/pesanan/admin/{checkout:id}', [PesananController::class, 'detailPesananAdmin'])->middleware('admin');
Route::get('/layanan-admin', [BookingAdminController::class, 'index'])->middleware('admin');
Route::get('/layanan-admin/{booking:id}', [BookingAdminController::class, 'detailLayananAdmin'])->middleware('admin');
Route::post('/hargaAkhir/{booking:id}', [BookingController::class, 'updateHarga'])->middleware('admin');
Route::post('/keputusan/{booking:id}', [BookingAdminController::class, 'keputusanAdmin'])->middleware('admin');
Route::get('/seluruh-user', [DashboardAdminController::class, 'seluruhUser'])->middleware('admin');
Route::delete('/hapusUser/{user:id}', [DashboardAdminController::class, 'hapusUser'])->middleware('admin');
Route::get('/getUserDetail/{user:id}', [DashboardAdminController::class, 'getUserDetail'])->name('getUserDetail')->middleware('admin');


// Resource Route
Route::resource('/master/data-kategori', DataKategoriController::class)->middleware('admin');
Route::resource('/master/data-barang', DataBarangController::class)->middleware('admin');
Route::resource('/master/data-montir', MontirController::class)->middleware('admin');
Route::resource('/master/data-pelayanan', PelayananController::class)->middleware('admin');

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
Route::post('/changeStatus/{checkout:uuid}', [PesananController::class, 'changeStatus'])->middleware('auth');
Route::get('/checkout/get_data', [OngkirController::class, 'provinces'])->name('checkout.get_data')->middleware('auth');
Route::post('/checkout/cek_ongkir', [OngkirController::class, 'cost'])->middleware('auth');
Route::post('/checkout/charger', [CheckoutController::class, 'charger'])->name('checkout.charger')->middleware('auth');
Route::get('/pesanan', [PesananController::class, 'index'])->middleware('auth');
Route::get('/pesanan/{checkout:uuid}', [PesananController::class, 'detailPesanan'])->middleware('auth');
Route::post('payments/midtrans-notification', [PaymentCallbackController::class, 'receive']);
Route::get('/booking', [BookingController::class, 'index'])->middleware('auth');
Route::post('/booking', [BookingController::class, 'booking'])->middleware('auth');
Route::get('/layanans', [BookingController::class, 'layananPerbaikan'])->middleware('auth');
Route::get('/layanan/{booking:uuid}', [BookingController::class, 'detailLayanan'])->middleware('auth');
Route::post('/layananBarang/{barang_booking:id}', [BookingController::class, 'updateBarangLayanan'])->middleware('auth');
Route::delete('/layananBarang/hapus/{barang_booking:id}', [BookingController::class, 'hapusBarangLayanan'])->middleware('auth');
Route::delete('/pelayanan/hapus/{booking_pelayanan:id}', [BookingController::class, 'hapusPelayanan'])->middleware('auth');
Route::post('/changeLayanan/{booking:id}', [BookingController::class, 'changeStatusBooking'])->middleware('auth');
Route::delete('/hapusLayanan/{booking:id}', [BookingController::class, 'hapusLayanan'])->middleware('auth');
Route::post('/penawaran/{booking:id}', [BookingController::class, 'penawaranBiaya'])->middleware('auth');
Route::post('/booking/charger', [BookingController::class, 'charger'])->name('booking.charger')->middleware('auth');
// Resource Route
Route::resource('/daftar-alamat', DaftarAlamatController::class)->middleware('auth');

// ==== End User Routes ====