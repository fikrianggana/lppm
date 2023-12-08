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

//Pengabdian CRUD

Route::controller(App\Http\Controllers\PengabdianMasyarakatController::class)->group(function() {
    Route::get('pengabdian','index')->name('karyawan.pengabdian.index');
    Route::get('pengabdian/create','create')->name('karyawan.pengabdian.create');
    Route::post('pengabdian', 'store')->name('karyawan.pengabdian.store');
    Route::get('pengabdian/{pkm_id}/edit', 'edit')->name('karyawan.pengabdian.edit');
    Route::put('pengabdian/{pkm_id}', 'update')->name('karyawan.pengabdian.update');
    Route::delete('pengabdian/{pkm_id}', 'destroy')->name('karyawan.pengabdian.destroy');
    
});

Route::controller(App\Http\Controllers\PengajuanSuratTugasController::class)->group(function() {
    Route::get('pengajuan','index')->name('karyawan.pengajuan.index');

});


Route::get('publikasi',[PublikasiController::class,'index'])->name('karyawan.publikasi.index');
Route::get('buku',[BukuController::class,'index'])->name('karyawan.publikasi.buku.index');
Route::get('jurnal',[JurnalController::class,'index'])->name('karyawan.publikasi.jurnal.index');
Route::get('seminar',[SeminarController::class,'index'])->name('karyawan.publikasi.seminar.index');
Route::get('hakcipta',[HakCiptaController::class,'index'])->name('karyawan.publikasi.hakcipta.index');
Route::get('hakpaten',[HakPatenController::class,'index'])->name('karyawan.publikasi.hakpaten.index');
Route::get('prosiding',[ProsidingController::class,'index'])->name('karyawan.publikasi.prosiding.index');


// Route::get('/login', LoginController::class );

//cara yang lebih singkat
// Route::resource('product', ProductController::class);


