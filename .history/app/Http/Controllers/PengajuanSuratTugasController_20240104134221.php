<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSuratTugas;
use App\Http\Requests\StorePengajuanSuratTugasRequest;
use App\Http\Requests\UpdatePengajuanSuratTugasRequest;

class PengajuanSuratTugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengajuanSuratTugas = PengajuanSuratTugas::all();

        $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

        // Berdasarkan peran, tentukan view yang akan digunakan
        if ($usr_role === 'karyawan') {
            return view('karyawan.pengajuan.index', ['pengajuan' => $pengabdianMasyarakat, 'prodis' => $prodis, 'users' => $user]);
        } elseif ($usr_role === 'admin') {
            return view('admin.pengajuan.index', ['pengajuan' => $pengabdianMasyarakat, 'prodis' => $prodis, 'users' => $user]);
        } else {
            // Handle jika peran tidak teridentifikasi
            return abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePengajuanSuratTugasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePengajuanSuratTugasRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PengajuanSuratTugas  $pengajuanSuratTugas
     * @return \Illuminate\Http\Response
     */
    public function show(PengajuanSuratTugas $pengajuanSuratTugas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PengajuanSuratTugas  $pengajuanSuratTugas
     * @return \Illuminate\Http\Response
     */
    public function edit(PengajuanSuratTugas $pengajuanSuratTugas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePengajuanSuratTugasRequest  $request
     * @param  \App\Models\PengajuanSuratTugas  $pengajuanSuratTugas
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePengajuanSuratTugasRequest $request, PengajuanSuratTugas $pengajuanSuratTugas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PengajuanSuratTugas  $pengajuanSuratTugas
     * @return \Illuminate\Http\Response
     */
    public function destroy(PengajuanSuratTugas $pengajuanSuratTugas)
    {
        //
    }
}
