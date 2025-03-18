<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterAdminController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\TopUpController;
use App\Models\DaftarTagihan;
use App\Models\LaporanPembayaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

Route::get('/', function () {
    return view('auth.login');  // Halaman login akan tampil di root URL
})->name('login');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

   

// Route::middleware(['auth:admin'])->group(function () {
//     Route::get('/admin', [RegisterAdminController::class, 'index'])->name('admin.dashboard');
// });
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/opsi-pembayaran', function () {
    return view('OpsiPembayaran');
})->name('konfirmasi.pembayaran');

Route::get('/pascabayar', function () {
    return view('FormPascabayar');
})->name('pascabayar');

Route::get('/prabayar', function () {
    return view('FormPrabayar');
})->name('prabayar');

Route::get('/riwayat-pembayaran', function () {
    return view('RiwayatPembayaran');
})->name('riwayat-pembayaran');

Route::get('/topup', [TopUpController::class, 'show'])->name('topup.form');
Route::post('/topup', [TopUpController::class, 'processTopUp'])->name('topup.process');

Route::match(['GET', 'POST'], '/cek-pembayaran', [PembayaranController::class, 'cekPembayaran'])->name('cek-pembayaran');Route::match(['GET', 'POST'], '/cek-pembayaran', [PembayaranController::class, 'cekPembayaran'])->name('cek.pembayaran');


Route::post('/bayar', [PembayaranController::class, 'bayar'])->name('bayar.listrik');
Route::get('/struk/{no_ref}', [PembayaranController::class, 'showStruk'])->name('struk.show');


Route::middleware(['auth'])->get('/struk/{id}', [PembayaranController::class, 'showStruk']);
Route::get('/riwayat-pembayaran', [PembayaranController::class, 'riwayatPembayaran'])
    ->name('riwayat.pembayaran');

    Route::delete('/pembayaran/{no_ref}/hapus', [PembayaranController::class, 'hapusRiwayat'])
    ->name('pembayaran.hapus');

    Route::get('/riwayat-pembayaran', [PembayaranController::class, 'index'])->name('user.riwayat');
   
    Route::get('/riwayat-pembayaran', [PembayaranController::class, 'index'])->name('riwayat.pembayaran')->middleware('auth');

    // Route::get('/struk/{id}', [PembayaranController::class, 'showStruk'])->name('struk.pembayaran');

    Route::get('/statistik-pembayaran', [PembayaranController::class, 'statistikPembayaran'])->name('statistik.pembayaran');

Route::post('/cek-pembayaran-prabayar', [PembayaranController::class, 'cekPembayaranPrabayar'])->name('cek.pembayaran.prabayar');

Route::get('/form-konsultasi', [KonsultasiController::class, 'index'])->name('konsultasi.form');
Route::post('/form-konsultasi/kirim', [KonsultasiController::class, 'kirim'])->name('konsultasi.kirim');
    


    














require __DIR__.'/auth.php';
