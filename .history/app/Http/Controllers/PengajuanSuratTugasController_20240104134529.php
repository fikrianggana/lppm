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
            return view('karyawan.pengajuan.index', ['pengajuan' => $pengajuanSuratTugas]);
        } elseif ($usr_role === 'admin') {
            return view('admin.pengajuan.index', ['pengajuan' => $pengajuanSuratTugas]);
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
        $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

        // Tentukan view berdasarkan peran pengguna
        if ($usr_role === 'karyawan') {
            return view('karyawan.pengajuan.create');
        } elseif ($usr_role === 'admin') {
            return view('admin.pengajuan.create');
        } else {
            // Handle jika peran tidak teridentifikasi
            return abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePengajuanSuratTugasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePengajuanSuratTugasRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('pst_buktipendukung')) {
            $pst_buktipendukung = $request->file('pst_buktipendukung');
            $nama_buktipendukung = $pst_buktipendukung->getClientOriginalName(); // Gunakan nama asli file

            $pst_buktipendukung->move('files/', $nama_buktipendukung);
            $validatedData['pst_buktipendukung'] = 'files/' . $nama_buktipendukung; // Simpan path file dalam database
        }

        if ($pengabdian = PengajuanSuratTugas::create($validatedData)){

            // Dapatkan ID prodi dari input form


            // Simpan relasi dengan satu program studi
        
            $pengabdian->save();

            $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

            // Tentukan view berdasarkan peran pengguna
            if ($usr_role === 'karyawan') {
                return redirect(route('karyawan.pengabdian.index'))->with('success', 'Data Berhasil Disimpan!');
            } elseif ($usr_role === 'admin') {
                return redirect(route('admin.pengabdian.index'))->with('success', 'Data Berhasil Disimpan!');
            } else {
                // Handle jika peran tidak teridentifikasi
                return abort(403, 'Unauthorized action.');
            }

        }
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
