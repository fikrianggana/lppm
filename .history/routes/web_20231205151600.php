<?php

use App\Http\Controllers\JurnalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardKaryawanController;
use App\Http\Controllers\PengabdianMasyarakatController;
use App\Http\Controllers\PengajuanSuratTugasController;
use App\Http\Controllers\BukuController;
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

// Route::get('/login', function () {
//     return view('login/template_login');
// });

// Route::get('/', 'App\Http\Controllers\LoginController@showLoginForm');
// Route::post('/', 'App\Http\Controllers\LoginController@login');


Route::get('/', [LoginController::class, 'showLoginForm']);
Route::get('/dashboard', [DashboardAdminController::class, 'index']);
Route::post('/', [LoginController::class, 'login']);

Route::get('dashboardAdmin',[DashboardAdminController::class,'index'])->name('admin.dashboard.index');

Route::get('dashboardKaryawan',[DashboardKaryawanController::class,'index'])->name('karyawan.dashboard.index');

Route::get('pengabdian',[PengabdianMasyarakatController::class,'index'])->name('karyawan.pengabdian.index');
Route::get('pengajuan',[PengajuanSuratTugasController::class,'index'])->name('karyawan.pengajuan.index');
Route::get('buku',[BukuController::class,'index'])->name('karyawan.publikasi.buku.index');
Route::get('jurnal',[JurnalController::class,'index'])->name('karyawan.publikasi.buku.index');
Route::get('buku',[BukuController::class,'index'])->name('karyawan.publikasi.buku.index');
Route::get('buku',[BukuController::class,'index'])->name('karyawan.publikasi.buku.index');
Route::get('buku',[BukuController::class,'index'])->name('karyawan.publikasi.buku.index');
Route::get('buku',[BukuController::class,'index'])->name('karyawan.publikasi.buku.index');


// Route::get('/login', LoginController::class );

//cara yang lebih singkat
// Route::resource('product', ProductController::class);


