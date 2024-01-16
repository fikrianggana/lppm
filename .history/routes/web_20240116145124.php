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
use App\Models\PengajuanSuratTugas;

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

Route::get('/', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout',[LoginController::class, 'logout'])->name('logout');

    Route::middleware(['auth', 'userAccess:admin'])->group(function () {
        // Rute khusus untuk admin
        Route::get('/dashboardAdmin',[DashboardAdminController::class,'index'])->name('admin.dashboard.index');

        //Pengabdian
        Route::get('pengabdian', [PengabdianMasyarakatController::class, 'index'])->name('admin.pengabdian.index');
        Route::get('pengabdian/create', [PengabdianMasyarakatController::class, 'create'])->name('admin.pengabdian.create');
        Route::post('pengabdian', [PengabdianMasyarakatController::class, 'store'])->name('admin.pengabdian.store');
        Route::get('pengabdian/{pkm_id}/edit', [PengabdianMasyarakatController::class, 'edit'])->name('admin.pengabdian.edit');
        Route::get('pengabdian/{pkm_id}', [PengabdianMasyarakatController::class, 'update'])->name('admin.pengabdian.update');
        Route::delete('pengabdian/{pkm_id}', [PengabdianMasyarakatController::class, 'destroy'])->name('admin.pengabdian.destroy');

        //Pengajuan
        Route::get('pengajuan',[PengajuanSuratTugasController::class,'index'])->name('admin.pengajuan.index');
        Route::get('pengajuan/create', [PengajuanSuratTugasController::class, 'create'])->name('admin.pengajuan.create');
        Route::post('pengajuan', [PengajuanSuratTugasController::class, 'store'])->name('admin.pengajuan.store');
        Route::get('pengajuan/{pst_id}/edit', [PengajuanSuratTugasController::class, 'edit'])->name('admin.pengajuan.edit');
        Route::put('pengajuan/{pst_id}', [PengajuanSuratTugasController::class, 'update'])->name('admin.pengajuan.update');
        Route::delete('pengajuan/{pst_id}', [PengajuanSuratTugasController::class, 'destroy'])->name('admin.pengajuan.destroy');
        Route::get('pengajuan/{pst_id}/confirm', [PengajuanSuratTugasController::class, 'confirm'])->name('admin.pengajuan.confirm');
        Route::post('pengajuan/{pst_id}/reject', [PengajuanSuratTugasController::class, 'reject'])->name('admin.pengajuan.reject');
        Route::post('pengajuan/{pst_id}/kirimSurat', [PengajuanSuratTugasController::class, 'kirimSuratTugas'])->name('admin.pengajuan.kirim');

        //Buku
        Route::get('buku',[BukuController::class,'index'])->name('admin.publikasi.buku.index');
        Route::get('buku/create', [BukuController::class, 'create'])->name('admin.publikasi.buku.create');
        Route::post('buku', [BukuController::class, 'store'])->name('admin.publikasi.buku.store');
        Route::get('buku/{bku_id}/edit', [BukuController::class, 'edit'])->name('admin.publikasi.buku.edit');
        Route::put('buku/{bku_id}', [BukuController::class, 'update'])->name('admin.publikasi.buku.update');
        Route::delete('buku/{bku_id}', [BukuController::class, 'destroy'])->name('admin.publikasi.buku.destroy');

        //Jurnal
        Route::get('jurnal',[JurnalController::class,'index'])->name('admin.publikasi.jurnal.index');
        Route::get('jurnal/create', [JurnalController::class, 'create'])->name('admin.publikasi.jurnal.create');
        Route::post('jurnal', [JurnalController::class, 'store'])->name('admin.publikasi.jurnal.store');
        Route::get('jurnal/{jrn_id}/edit', [JurnalController::class, 'edit'])->name('admin.publikasi.jurnal.edit');
        Route::put('jurnal/{jrn_id}', [JurnalController::class, 'update'])->name('admin.publikasi.jurnal.update');
        Route::delete('jurnal/{jrn_id}', [JurnalController::class, 'destroy'])->name('admin.publikasi.jurnal.destroy');

        //Seminars
        Route::get('seminar',[SeminarController::class,'index'])->name('admin.publikasi.seminar.index');
        Route::get('seminar/create', [SeminarController::class, 'create'])->name('admin.publikasi.seminar.create');
        Route::post('seminar', [SeminarController::class, 'store'])->name('admin.publikasi.seminar.store');
        Route::get('seminar/{smn_id}/edit', [SeminarController::class, 'edit'])->name('admin.publikasi.seminar.edit');
        Route::put('seminar/{smn_id}', [SeminarController::class, 'update'])->name('admin.publikasi.seminar.update');
        Route::delete('seminar/{smn_id}', [SeminarController::class, 'destroy'])->name('admin.publikasi.seminar.destroy');

        //Hakcipta
        Route::get('hakcipta',[HakCiptaController::class,'index'])->name('admin.publikasi.hakcipta.index');
        Route::get('hakcipta/create', [HakCiptaController::class, 'create'])->name('admin.publikasi.hakcipta.create');
        Route::post('hakcipta', [HakCiptaController::class, 'store'])->name('admin.publikasi.hakcipta.store');
        Route::get('hakcipta/{hcp_id}/edit', [HakCiptaController::class, 'edit'])->name('admin.publikasi.hakcipta.edit');
        Route::put('hakcipta/{hcp_id}', [HakCiptaController::class, 'update'])->name('admin.publikasi.hakcipta.update');
        Route::delete('hakcipta/{hcp_id}', [HakCiptaController::class, 'destroy'])->name('admin.publikasi.hakcipta.destroy');

        //Hakpaten
        Route::get('hakpaten',[HakPatenController::class,'index'])->name('admin.publikasi.hakpaten.index');
        Route::get('hakpaten/create', [HakPatenController::class, 'create'])->name('admin.publikasi.hakpaten.create');
        Route::post('hakpaten', [HakPatenController::class, 'store'])->name('admin.publikasi.hakpaten.store');
        Route::get('hakpaten/{hpt_id}/edit', [HakPatenController::class, 'edit'])->name('admin.publikasi.hakpaten.edit');
        Route::put('hakpaten/{hpt_id}', [HakPatenController::class, 'update'])->name('admin.publikasi.hakpaten.update');
        Route::delete('hakpaten/{hpt_id}', [HakPatenController::class, 'destroy'])->name('admin.publikasi.hakpaten.destroy');

        //Prosiding
        Route::get('prosiding',[ProsidingController::class,'index'])->name('admin.publikasi.prosiding.index');
        Route::get('prosiding/create', [ProsidingController::class, 'create'])->name('admin.publikasi.prosiding.create');
        Route::post('prosiding', [ProsidingController::class, 'store'])->name('admin.publikasi.prosiding.store');
        Route::get('prosiding/{pro_id}/edit', [ProsidingController::class, 'edit'])->name('admin.publikasi.prosiding.edit');
        Route::put('prosiding/{pro_id}', [ProsidingController::class, 'update'])->name('admin.publikasi.prosiding.update');
        Route::delete('prosiding/{pro_id}', [ProsidingController::class, 'destroy'])->name('admin.publikasi.prosiding.destroy');

    });

    Route::middleware(['auth', 'userAccess:karyawan'])->group(function () {
        // Rute khusus untuk karyawan
        Route::get('/dashboardKaryawan',[DashboardKaryawanController::class,'index'])->name('karyawan.dashboard.index');

        //Pengabdian
        Route::get('pengabdianKaryawan', [PengabdianMasyarakatController::class, 'index'])->name('karyawan.pengabdian.index');
        Route::get('pengabdianKaryawan/create', [PengabdianMasyarakatController::class, 'create'])->name('karyawan.pengabdian.create');
        Route::post('pengabdianKaryawan', [PengabdianMasyarakatController::class, 'store'])->name('karyawan.pengabdian.store');

        //Pengajuan
        Route::get('pengajuanKaryawan',[PengajuanSuratTugasController::class,'index'])->name('karyawan.pengajuan.index');
        Route::get('pengajuanKaryawan/create', [PengajuanSuratTugasController::class, 'create'])->name('karyawan.pengajuan.create');
        Route::post('pengajuanKaryawan', [PengajuanSuratTugasController::class, 'store'])->name('karyawan.pengajuan.store');
        Route::get('pengajuanKaryawan/{pst_id}/edit', [PengajuanSuratTugasController::class, 'edit'])->name('karyawan.pengajuan.edit');
        Route::put('pengajuanKaryawan/{pst_id}', [PengajuanSuratTugasController::class, 'update'])->name('karyawan.pengajuan.update');
        Route::delete('pengajuanKaryawan/{pst_id}', [PengajuanSuratTugasController::class, 'destroy'])->name('karyawan.pengajuan.destroy');
        Route::get('pengajuanKaryawan/{pst_id}', [PengajuanSuratTugasController::class, 'kirim'])->name('karyawan.pengajuan.kirim');

        //Buku
        Route::get('bukuKaryawan',[BukuController::class,'index'])->name('karyawan.publikasi.buku.index');
        Route::get('bukuKaryawan/create', [BukuController::class, 'create'])->name('karyawan.publikasi.buku.create');
        Route::post('bukuKaryawan', [BukuController::class, 'store'])->name('karyawan.publikasi.buku.store');
        Ro

        //Jurnal
        Route::get('jurnalKaryawan',[JurnalController::class,'index'])->name('karyawan.publikasi.jurnal.index');
        Route::get('jurnalKaryawan/create', [JurnalController::class, 'create'])->name('karyawan.publikasi.jurnal.create');
        Route::post('jurnalKaryawan', [JurnalController::class, 'store'])->name('karyawan.publikasi.jurnal.store');

        //Seminars
        Route::get('seminarKaryawan',[SeminarController::class,'index'])->name('karyawan.publikasi.seminar.index');
        Route::get('seminarKaryawan/create', [SeminarController::class, 'create'])->name('karyawan.publikasi.seminar.create');
        Route::post('seminarKaryawan', [SeminarController::class, 'store'])->name('karyawan.publikasi.seminar.store');

        //Hakcipta
        Route::get('hakciptaKaryawan',[HakCiptaController::class,'index'])->name('karyawan.publikasi.hakcipta.index');
        Route::get('hakciptaKaryawan/create', [HakCiptaController::class, 'create'])->name('karyawan.publikasi.hakcipta.create');
        Route::post('hakciptaKaryawan', [HakCiptaController::class, 'store'])->name('karyawan.publikasi.hakcipta.store');

        //Hakpaten
        Route::get('hakpatenKaryawan',[HakPatenController::class,'index'])->name('karyawan.publikasi.hakpaten.index');
        Route::get('hakpatenKaryawan/create', [HakPatenController::class, 'create'])->name('karyawan.publikasi.hakpaten.create');
        Route::post('hakpaten', [HakPatenController::class, 'store'])->name('karyawan.publikasi.hakpaten.store');

        //Prosiding
        Route::get('prosidingKaryawan',[ProsidingController::class,'index'])->name('karyawan.publikasi.prosiding.index');
        Route::get('prosidingKaryawan/create', [ProsidingController::class, 'create'])->name('karyawan.publikasi.prosiding.create');
        Route::post('prosidingKaryawan', [ProsidingController::class, 'store'])->name('karyawan.publikasi.prosiding.store');

    });
