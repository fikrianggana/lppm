<?php

use App\Http\Controllers\HakCiptaController;
use App\Http\Controllers\HakPatenController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\ProsidingController;
use App\Http\Controllers\SeminarController;
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

//Pengabdian
Route::get('pengabdian',[PengabdianMasyarakatController::class,'index'])->name('karyawan.pengabdian.index');
Route::get('pengabdian/create', [PengabdianMasyarakatController::class, 'create'])->name('karyawan.pengabdian.create');
Route::post('pengabdian', [PengabdianMasyarakatController::class, 'store'])->name('karyawan.pengabdian.store');
Route::get('pengabdian/{pkm_id}/edit', [PengabdianMasyarakatController::class, 'edit'])->name('karyawan.pengabdian.edit');
Route::put('pengabdian/{pkm_id}', [PengabdianMasyarakatController::class, 'update'])->name('karyawan.pengabdian.update');
Route::delete('pengabdian/{pkm_id}', [PengabdianMasyarakatController::class, 'destroy'])->name('karyawan.pengabdian.destroy');

//Pengajuan
Route::get('pengajuan',[PengajuanSuratTugasController::class,'index'])->name('karyawan.pengajuan.index');
Route::get('publikasi',[PublikasiController::class,'index'])->name('karyawan.publikasi.index');
//Buku
Route::get('buku',[BukuController::class,'index'])->name('karyawan.publikasi.buku.index');


//Jurnal
Route::get('jurnal',[JurnalController::class,'index'])->name('karyawan.publikasi.jurnal.index');
Route::get('jurnal/create', [JurnalController::class, 'create'])->name('karyawan.publikasi.jurnal.create');
Route::post('jurnal', [JurnalController::class, 'store'])->name('karyawan.publikasi.jurnal.store');

//Seminars
Route::get('seminar',[SeminarController::class,'index'])->name('karyawan.publikasi.seminar.index');
Route::get('seminar/create', [SeminarController::class, 'create'])->name('karyawan.publikasi.seminar.create');
Route::post('seminar', [SeminarController::class, 'store'])->name('karyawan.publikasi.seminar.store');
//Hakcipta
Route::get('hakcipta',[HakCiptaController::class,'index'])->name('karyawan.publikasi.hakcipta.index');
Route::get('hakcipta/create', [HakCiptaController::class, 'create'])->name('karyawan.publikasi.hakcipta.create');

//Hakpaten
Route::get('hakpaten',[HakPatenController::class,'index'])->name('karyawan.publikasi.hakpaten.index');
Route::get('hakpaten/create', [HakPatenController::class, 'create'])->name('karyawan.publikasi.hakpaten.create');
Route::post('hakpaten', [HakPatenController::class, 'store'])->name('karyawan.publikasi.hakpaten.store');


//Prosiding
Route::get('prosiding',[ProsidingController::class,'index'])->name('karyawan.publikasi.prosiding.index');


// Route::get('/login', LoginController::class );

//cara yang lebih singkat
// Route::resource('product', ProductController::class);


