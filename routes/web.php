<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\GolonganController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SimpananController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\AngsuranController;
use App\Http\Controllers\PembayaranController;
 
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

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('belumlogin');
Route::post('/login', [LoginController::class, 'login'])->name('proses.login');
Route::get('/login-siswa', [LoginController::class, 'indexsiswa'])->middleware('belumlogin');
Route::post('/login-siswa-proses', [LoginController::class, 'login_siswa']);

Route::group(['middleware' => 'sudahlogin'], function () {
	Route::get('dashboard', [LoginController::class, 'dashboard']);
	Route::get('dashboard-siswa', [LoginController::class, 'dashboard_siswa']);

	//USER
	Route::get('user-data', [UserController::class, 'index']);
	Route::post('user-store', [UserController::class, 'store']);
	Route::get('user-hapus/{id}', [UserController::class, 'destroy']);
	Route::put('user-update/{id}', [UserController::class, 'update']);
	Route::get('user-detail/{id}', [UserController::class, 'detail']);

	//JENIS
	Route::get('jenis-data', [JenisController::class, 'index']);
	Route::post('jenis-store', [JenisController::class, 'store']);
	Route::get('jenis-hapus/{id}', [JenisController::class, 'destroy']);
	Route::put('jenis-update/{id}', [JenisController::class, 'update']);
	// Route::get('jenis-detail/{id}', [JenisController::class, 'detail']);

	//GOLONGAN
	Route::get('golongan-data', [GolonganController::class, 'index']);
	Route::post('golongan-store', [GolonganController::class, 'store']);
	Route::get('golongan-hapus/{id}', [GolonganController::class, 'destroy']);
	Route::put('golongan-update/{id}', [GolonganController::class, 'update']);
	// Route::get('golongan-detail/{id}', [GolonganController::class, 'detail']);

	//SISWA
	Route::get('siswa-data', [SiswaController::class, 'index']);
	Route::post('siswa-store', [SiswaController::class, 'store']);
	Route::get('siswa-hapus/{id}', [SiswaController::class, 'destroy']);
	Route::put('siswa-update/{id}', [SiswaController::class, 'update']);
	Route::get('siswa-detail/{id}', [SiswaController::class, 'detail']);

	//PINJAMAN
	Route::get('pinjaman-data', [PinjamanController::class, 'index']);
	Route::post('pinjaman-store', [PinjamanController::class, 'store']);
	Route::get('laporan-pinjaman-detailPdf/{bulan}', [PinjamanController::class, 'detailPdf']);
	Route::get('laporan-pinjaman', [PinjamanController::class, 'laporan']);
	Route::get('laporan-pinjaman-search', [PinjamanController::class, 'laporanSearch']);
	Route::get('pinjaman-hapus/{id}', [PinjamanController::class, 'destroy']);
	Route::put('pinjaman-update/{id}', [PinjamanController::class, 'update']);
	Route::get('pinjaman-detail/{id}', [PinjamanController::class, 'detail']);

	//ANGSURAN
	Route::get('angsuran-data', [AngsuranController::class, 'index']);
	Route::post('angsuran-store', [AngsuranController::class, 'store']);
	Route::get('laporan-angsuran', [AngsuranController::class, 'laporan']);
	Route::get('angsuran-hapus/{id}', [AngsuranController::class, 'destroy']);
	Route::put('angsuran-update/{id}', [AngsuranController::class, 'update']);
	Route::get('angsuran-detail/{id}', [AngsuranController::class, 'detail']);
	Route::get('laporan-detailind/{id}', [AngsuranController::class, 'detailind']);
	Route::get('laporan-detailPdf/{id}', [AngsuranController::class, 'detailPdf']);

	//SIMPANAN
	Route::get('simpanan-data', [SimpananController::class, 'index']);
	Route::post('simpanan-store', [SimpananController::class, 'store']);
	Route::get('laporan-simpanan', [SimpananController::class, 'laporan']);
	Route::get('laporan-simpanan-detailPdf/{bulan}', [SimpananController::class, 'detailPdf']);
	Route::get('laporan-simpanan-search', [SimpananController::Class, 'laporanSearch']);
	Route::get('simpanan-hapus/{id}', [SimpananController::class, 'destroy']);
	Route::put('simpanan-update/{id}', [SimpananController::class, 'update']);
	Route::get('simpanan-detail/{id}', [SimpananController::class, 'detail']);

	//PEMBAYARAN
	Route::get('pembayaran-data', [PembayaranController::class, 'index']);
	Route::get('laporan-pembayaran-detailPdf/{bulan}', [PembayaranController::class, 'detailPdf']);
	Route::get('laporan-pembayaran', [PembayaranController::class, 'laporan']);
	Route::get('laporan-pembayaran-search', [PembayaranController::class, 'laporanSearch']);
	Route::post('pembayaran-store', [PembayaranController::class, 'store']);
	Route::get('pembayaran-hapus/{id}', [PembayaranController::class, 'destroy']);
	Route::put('pembayaran-update/{id}', [PembayaranController::class, 'update']);
	Route::get('pembayaran-detail/{id}', [PembayaranController::class, 'detail']);
	Route::get('pembayaran-verifikasi/{id}', [PembayaranController::class, 'verifikasi']);

	Route::get('/logout', [LoginController::class, 'logout']);
});
