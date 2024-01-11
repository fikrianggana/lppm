<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\PengajuanSuratTugas;
use App\Http\Requests\StorePengajuanSuratTugasRequest;
use App\Http\Requests\UpdatePengajuanSuratTugasRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PengajuanSuratTugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Pengajuan Surat Tugas';

        $pengajuanSuratTugas = PengajuanSuratTugas::all();

        $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

        // Berdasarkan peran, tentukan view yang akan digunakan
        if ($usr_role === 'karyawan') {
            return view('karyawan.pengajuan.index', compact('title'),['pengajuan' => $pengajuanSuratTugas]);
        } elseif ($usr_role === 'admin') {
            return view('admin.pengajuan.index', compact('title'),['pengajuan' => $pengajuanSuratTugas]);
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
        $title = 'Pengajuan Surat Tugas';

        $user = User::pluck('usr_nama', 'usr_id'); // Sesuaikan dengan nama kolom
        $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

        // Tentukan view berdasarkan peran pengguna
        if ($usr_role === 'karyawan') {
            return view('karyawan.pengajuan.create',compact('title'),['users' => $user]);
        } elseif ($usr_role === 'admin') {
            return view('admin.pengajuan.create', compact('title'),['users' => $user]);
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
        
        // Set status 0 saat pertama kali data disimpan
        $validatedData['status'] = 0;
        $validatedData['inputby'] = Auth::user()->usr_id;


        if ($request->hasFile('pst_buktipendukung')) {
            $pst_buktipendukung = $request->file('pst_buktipendukung');
            $nama_buktipendukung = $pst_buktipendukung->getClientOriginalName(); // Gunakan nama asli file

            $pst_buktipendukung->move('files/', $nama_buktipendukung);
            $validatedData['pst_buktipendukung'] = 'files/' . $nama_buktipendukung; // Simpan path file dalam database
        }

        if ($pengajuan = PengajuanSuratTugas::create($validatedData)){

            $pengajuan->save();

            $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

            // Tentukan view berdasarkan peran pengguna
            if ($usr_role === 'karyawan') {
                return redirect(route('karyawan.pengajuan.index'))->with('success', 'Data Berhasil Disimpan!');
            } elseif ($usr_role === 'admin') {
                return redirect(route('admin.pengajuan.index'))->with('success', 'Data Berhasil Disimpan!');
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
    public function edit(PengajuanSuratTugas $pengajuanSuratTugas, $pst_id)
    {
        $pst = PengajuanSuratTugas::findOrFail($pst_id);
        $title = 'Edit Pengajuan Surat Tugas';

        $user = User::pluck('usr_nama', 'usr_id'); // Sesuaikan dengan nama kolom
        $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

        // Tentukan view berdasarkan peran pengguna dan kirim data pengajuan yang akan diedit
        if ($usr_role === 'karyawan') {
            return view('karyawan.pengajuan.edit', compact('title', 'pengajuanSuratTugas'), ['users' => $user, 'pst' => $pst]);
        } elseif ($usr_role === 'admin') {
            return view('admin.pengajuan.edit', compact('title', 'pengajuanSuratTugas'), ['users' => $user, 'pst' => $pst]);
        } else {
            // Handle jika peran tidak teridentifikasi
            return abort(403, 'Unauthorized action.');
        }
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
        $validatedData = $request->validated();

        // Tambahkan log untuk mengecek nilai validatedData
        Log::info('Validated Data:', $validatedData);
    
        // Jika ada file yang diunggah, proses file
        if ($request->hasFile('pst_buktipendukung')) {
            $pst_buktipendukung = $request->file('pst_buktipendukung');
            $nama_buktipendukung = $pst_buktipendukung->getClientOriginalName(); // Gunakan nama asli file
    
            $pst_buktipendukung->move('files/', $nama_buktipendukung);
            $validatedData['pst_buktipendukung'] = 'files/' . $nama_buktipendukung; // Simpan path file dalam databas
            
            if ($pengajuanSuratTugas->pst_buktipendukung && file_exists($pengajuanSuratTugas->pst_buktipendukung)) {
                // Hapus file lama jika ada
                unlink($pengajuanSuratTugas->pst_buktipendukung);
            }
        }
    
        // Ubah status menjadi 1 saat data dikirimkan kembali
        $validatedData['status'] = 0;
    
        $pengajuanSuratTugas->update($validatedData);
    
        $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login
        
        // Redirect ke halaman yang tepat berdasarkan peran pengguna
        if ($usr_role === 'karyawan') {
            return redirect()->route('karyawan.pengajuan.index')->with('success', 'Data Berhasil Diperbarui!');
        } elseif ($usr_role === 'admin') {
            return redirect()->route('admin.pengajuan.index')->with('success', 'Data Berhasil Diperbarui!');
        } else {
            // Handle jika peran tidak teridentifikasi
            return abort(403, 'Unauthorized action.');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PengajuanSuratTugas  $pengajuanSuratTugas
     * @return \Illuminate\Http\Response
     */
    public function destroy($pst_id)
    {
        $pengajuan = PengajuanSuratTugas::find($pst_id);
        $pengajuan->delete();
        
        $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

        // Tentukan view berdasarkan peran pengguna
        if ($usr_role === 'karyawan') {
            return redirect(route('karyawan.pengajuan.index'))->with('success', 'Data Berhasil Dihapus!');
        } elseif ($usr_role === 'admin') {
            return redirect(route('admin.pengajuan.index'))->with('success', 'Data Berhasil Dihapus!');
        } else {
            // Handle jika peran tidak teridentifikasi
            return abort(403, 'Unauthorized action.');
        }
    }

    public function kirim($pst_id)
    {
        $pengajuan = PengajuanSuratTugas::find($pst_id);
        $pengajuan->status = 1; // Mengubah status menjadi 1 (Dikirim)
        $pengajuan->save();

        return redirect()->back()->with('success', 'Status pengajuan berhasil diubah menjadi terkirim.');
    }
}
