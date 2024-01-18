<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SuratTugasExport;
use Illuminate\Http\Request;
use App\Models\PengajuanSuratTugas;
use App\Http\Requests\StorePengajuanSuratTugasRequest;
use App\Http\Requests\UpdatePengajuanSuratTugasRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class PengajuanSuratTugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Pengajuan Surat Tugas';
        $pengajuanSuratTugas = PengajuanSuratTugas::all();

        $query = $request->get('search');
           
        $search = PengajuanSuratTugas::where(function ($query) use ($request) {
            $query->where('pst_namasurattugas', 'like', "%{$request->search}%")
                  ->orWhere('pst_masapelaksanaan', 'like', "%{$request->search}%")
                  ->orWhere('pst_buktipendukung', 'like', "%{$request->search}%")
                  ->orWhere('status', 'like', "%{$request->search}%")
                  ->orWhere('surattugas', 'like', "%{$request->search}%");
        })
        ->get();
        
        $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

        // Berdasarkan peran, tentukan view yang akan digunakan
        if ($usr_role === 'karyawan') {
            // Filter out records with status 3 for karyawan view
            // $pengajuanSuratTugas = PengajuanSuratTugas::all();
            return view('karyawan.pengajuan.index', compact('title'), ['pengajuan' => $search]);
        } elseif ($usr_role === 'admin') {
            // Filter out records with status 3 for admin view
            // $pengajuanSuratTugas = PengajuanSuratTugas::where('status', '!=', 3)->get();
            return view('admin.pengajuan.index', compact('title'), ['pengajuan' => $search]);
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
    public function update(UpdatePengajuanSuratTugasRequest $request, PengajuanSuratTugas $pengajuanSuratTugas, $pst_id)
    {
        $validatedData = $request->validated();
    
        // Jika ada file yang diunggah, proses file
        if ($request->hasFile('pst_buktipendukung')) {
            $pst_buktipendukung = $request->file('pst_buktipendukung');
            $nama_buktipendukung = $pst_buktipendukung->getClientOriginalName(); // Gunakan nama asli file

            $pst_buktipendukung->move('files/', $nama_buktipendukung);
            $validatedData['pst_buktipendukung'] = 'files/' . $nama_buktipendukung; // Simpan path file dalam database

            // Hapus file lama jika ada
            if ($pengajuanSuratTugas->pst_buktipendukung && file_exists($pengajuanSuratTugas->pst_buktipendukung)) {
                unlink($pengajuanSuratTugas->pst_buktipendukung);
            }
        }
    
        // Ubah status menjadi 1 saat data dikirimkan kembali
        $validatedData['status'] = 0;
    
        PengajuanSuratTugas::find($pst_id)->update($validatedData);
    
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

    public function confirm($pst_id)
    {
        try {
            // Find the record by pst_id
            $pengajuan = PengajuanSuratTugas::findOrFail($pst_id);

            // Update the status only if it is not already confirmed or rejected
            if ($pengajuan->status == 1) {
                $pengajuan->update(['status' => 2]); // Change the status to "Acc"

                return redirect()->route('admin.pengajuan.index')->with('success', 'Pengajuan confirmed successfully');
            } else {
                return redirect()->route('admin.pengajuan.index')->with('error', 'Pengajuan has already been confirmed or rejected');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.pengajuan.index')->with('error', 'Error confirming pengajuan: ' . $e->getMessage());
        }
    }


    public function reject($pst_id)
    {
        try {
            // Find the record by pst_id
            $pengajuan = PengajuanSuratTugas::findOrFail($pst_id);

            // Delete the rejected record only if it is not already confirmed or rejected
            if ($pengajuan->status == 1) {
                // Change the status to "Rejected"
                $pengajuan->update(['status' => 3, 'keterangan' => request('keterangan')]);

                // // Delete the record
                // $pengajuan->delete();

                return redirect()->route('admin.pengajuan.index')->with('success', 'Pengajuan rejected successfully');
            } else {
                return redirect()->route('admin.pengajuan.index')->with('error', 'Pengajuan has already been confirmed or rejected');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.pengajuan.index')->with('error', 'Error rejecting pengajuan: ' . $e->getMessage());
        }
    }

    public function kirimSuratTugas($pst_id)
    {
        try {
            $pengajuan = PengajuanSuratTugas::findOrFail($pst_id);

            // Assuming 'surattugas' is the name of the file input in your form
            if (request()->hasFile('surattugas')) {
                $suratTugasFile = request()->file('surattugas');
                $suratTugasFileName = 'surat_tugas_' . time() . '.' . $suratTugasFile->getClientOriginalExtension();

                // Move the file to the desired location
                $suratTugasFile->move('files/', $suratTugasFileName);

                // Update the pengajuan record with the surat tugas file path
                $pengajuan->update(['status' => 4, 'surattugas' => 'files/' . $suratTugasFileName]);

                return response()->json(['success' => 'Surat Tugas berhasil dikirim.']);
            } else {
                return response()->json(['error' => 'File Surat Tugas tidak ditemukan.'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error mengirim Surat Tugas: ' . $e->getMessage()], 500);
        }
    }

    public function surattugasexport(Request $request)
    {
        // Get the search query from the request
        $searchQuery = $request->get('search');

        // Create an instance of SuratTugasExport with the search query
        $export = new SuratTugasExport($searchQuery);

        // Download the Excel file
        return Excel::download($export, 'Laporan_Surat_Tugas.xlsx');
    }

}
