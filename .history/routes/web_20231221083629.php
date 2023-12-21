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
use App\Http\Middleware\UserAccess;
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

// Route::name('pengguna')->namespace('Pengguna')->prefix('pengguna')->group(function(){
//     Route::namespace('Auth')->middleware('guest:pengguna')->group(function(){
//         //login route
//         Route::get('/login',[LoginController::class,'login'])->name('login');
//         Route::post('/login',[LoginController::class,'processLogin']);
//     });
//     Route::namespace('Auth')->middleware('auth:pengguna')->group(function(){
//         Route::post('/logout',function(){
//             Auth::guard('doctor')->logout();
//             return redirect()->action([
//                 LoginController::class,
//                 'login'
//             ]);
//         })->name('logout');
//     });
// });






// Route::get('/home', function() {
//     return redirect('/');
// });

// Route::prefix('')->group(function () {
//     Route::get('/', [LoginController::class, 'index']);
//     Route::post('/login', [LoginController::class, 'login'])->name('login.form_login');
//     Route::get('/dashboardAdmin',[DashboardAdminController::class,'index'])->name('admin.dashboard.index')->middleware('userAccess:admin');
//     Route::get('/dashboardKaryawan',[DashboardKaryawanController::class,'index'])->name('karyawan.dashboard.index')->middleware('userAccess:karyawan');
//     Route::get('/logout', [LoginController::class,'logout']);
// });

Route::get('/', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login'])->name('login.form_login');
Route::get('/dashboardAdmin',[DashboardAdminController::class,'index'])->name('admin.dashboard.index')->middleware('userAccess:admin');
Route::get('/dashboardKaryawan',[DashboardKaryawanController::class,'index'])->name('karyawan.dashboard.index')->middleware('userAccess:karyawan');
Route::get('/logout', [LoginController::class,'logout']);

// Route::get('/', [LoginController::class, 'index']);
// Route::post('/login', [LoginController::class, 'login'])->name('login.form_login');

Route::middleware(['auth:admin'])->group(function () {
    Route::get('pengabdian',[PengabdianMasyarakatController::class,'index'])->name('admin.pengabdian.index');
    Route::get('pengabdian/create', [PengabdianMasyarakatController::class, 'create'])->name('admin.pengabdian.create');
    Route::post('pengabdian', [PengabdianMasyarakatController::class, 'store'])->name('admin.pengabdian.store');
    Route::get('pengabdian/{pkm_id}/edit', [PengabdianMasyarakatController::class, 'edit'])->name('admin.pengabdian.edit');
    Route::put('pengabdian/{pkm_id}', [PengabdianMasyarakatController::class, 'update'])->name('admin.pengabdian.update');
    Route::delete('pengabdian/{pkm_id}', [PengabdianMasyarakatController::class, 'destroy'])->name('admin.pengabdian.destroy');

    //Pengajuan
    Route::get('pengajuan',[PengajuanSuratTugasController::class,'index'])->name('admin.pengajuan.index');
    Route::get('pengajuan/create', [PengajuanSuratTugasController::class, 'create'])->name('admin.penpengajuangabdian.create');
    Route::post('pengajuan', [PengajuanSuratTugasController::class, 'store'])->name('admin.pengajuan.store');

    //Buku
    Route::get('buku',[BukuController::class,'index'])->name('admin.publikasi.buku.index');
    Route::get('buku/create', [BukuController::class, 'create'])->name('admin.publikasi.buku.create');
    Route::post('buku', [BukuController::class, 'store'])->name('admin.publikasi.buku.store');

    //Jurnal
    Route::get('jurnal',[JurnalController::class,'index'])->name('admin.publikasi.jurnal.index');
    Route::get('jurnal/create', [JurnalController::class, 'create'])->name('admin.publikasi.jurnal.create');
    Route::post('jurnal', [JurnalController::class, 'store'])->name('admin.publikasi.jurnal.store');

    //Seminars
    Route::get('seminar',[SeminarController::class,'index'])->name('admin.publikasi.seminar.index');
    Route::get('seminar/create', [SeminarController::class, 'create'])->name('admin.publikasi.seminar.create');
    Route::post('seminar', [SeminarController::class, 'store'])->name('admin.publikasi.seminar.store');

    //Hakcipta
    Route::get('hakcipta',[HakCiptaController::class,'index'])->name('admin.publikasi.hakcipta.index');
    Route::get('hakcipta/create', [HakCiptaController::class, 'create'])->name('admin.publikasi.hakcipta.create');
    Route::post('hakcipta', [HakCiptaController::class, 'store'])->name('admin.publikasi.hakcipta.store');

    //Hakpaten
    Route::get('hakpaten',[HakPatenController::class,'index'])->name('admin.publikasi.hakpaten.index');
    Route::get('hakpaten/create', [HakPatenController::class, 'create'])->name('admin.publikasi.hakpaten.create');
    Route::post('hakpaten', [HakPatenController::class, 'store'])->name('admin.publikasi.hakpaten.store');


    //Prosiding
    Route::get('prosiding',[ProsidingController::class,'index'])->name('admin.publikasi.prosiding.index');
    Route::get('prosiding/create', [ProsidingController::class, 'create'])->name('admin.publikasi.prosiding.create');
    Route::post('prosiding', [ProsidingController::class, 'store'])->name('admin.publikasi.prosiding.store');

});


Route::middleware(['auth:karyawan'])->group(function(){
    //Pengabdian
    Route::get('pengabdian',[PengabdianMasyarakatController::class,'index'])->name('karyawan.pengabdian.index');
    Route::get('pengabdian/create', [PengabdianMasyarakatController::class, 'create'])->name('karyawan.pengabdian.create');
    Route::post('pengabdian', [PengabdianMasyarakatController::class, 'store'])->name('karyawan.pengabdian.store');

    //Pengajuan
    Route::get('pengajuan',[PengajuanSuratTugasController::class,'index'])->name('karyawan.pengajuan.index');
    Route::get('pengajuan/create', [PengajuanSuratTugasController::class, 'create'])->name('karyawan.penpengajuangabdian.create');
    Route::post('pengajuan', [PengajuanSuratTugasController::class, 'store'])->name('karyawan.pengajuan.store');

    //Buku
    Route::get('buku',[BukuController::class,'index'])->name('karyawan.publikasi.buku.index');
    Route::get('buku/create', [BukuController::class, 'create'])->name('karyawan.publikasi.buku.create');
    Route::post('buku', [BukuController::class, 'store'])->name('karyawan.publikasi.buku.store');

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
    Route::post('hakcipta', [HakCiptaController::class, 'store'])->name('karyawan.publikasi.hakcipta.store');

    //Hakpaten
    Route::get('hakpaten',[HakPatenController::class,'index'])->name('karyawan.publikasi.hakpaten.index');
    Route::get('hakpaten/create', [HakPatenController::class, 'create'])->name('karyawan.publikasi.hakpaten.create');
    Route::post('hakpaten', [HakPatenController::class, 'store'])->name('karyawan.publikasi.hakpaten.store');


    //Prosiding
    Route::get('prosiding',[ProsidingController::class,'index'])->name('karyawan.publikasi.prosiding.index');
    Route::get('prosiding/create', [ProsidingController::class, 'create'])->name('karyawan.publikasi.prosiding.create');
    Route::post('prosiding', [ProsidingController::class, 'store'])->name('karyawan.publikasi.prosiding.store');
});



