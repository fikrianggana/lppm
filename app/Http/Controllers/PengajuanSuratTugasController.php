<?php

namespace App\Http\Controllers;

use App\Models\DetailPengajuanSuratTugas;
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

        $involvedUsers = [];
        foreach ($pengajuanSuratTugas as $pengajuan) {
            $involvedUsers[$pengajuan->pst_id] = $pengajuan->involvedUsers();
        }        

        $query = $request->get('search');

        $search = PengajuanSuratTugas::where(function ($query) use ($request) {
            $query->where('pst_namasurattugas', 'like', "%{$request->search}%")
                ->orWhere('pst_masapelaksanaan', 'like', "%{$request->search}%")
                ->orWhere('pst_buktipendukung', 'like', "%{$request->search}%")
                ->orWhere('status', 'like', "%{$request->search}%")
                ->orWhere('surattugas', 'like', "%{$request->search}%");
        });

        $user = Auth::user();
        $usr_role = $user->usr_role; // Ambil peran pengguna yang sedang login
        $usr_id = $user->usr_id;

        if ($usr_role === 'karyawan') {
            $search->where('usr_id', $usr_id); // Assuming 'created_by' is the correct column
        }

        $pengajuanSuratTugas = $search->get();

        // Berdasarkan peran, tentukan view yang akan digunakan
        if ($usr_role === 'karyawan') {
            // Filter out records with status 3 for karyawan view

            return view('karyawan.pengajuan.index', compact('title'), ['pengajuan' => $pengajuanSuratTugas, 'involvedUsers' => $involvedUsers]);
        } elseif ($usr_role === 'admin') {
            // Filter out records with status 3 for admin view

            return view('admin.pengajuan.index', compact('title'), ['pengajuan' => $pengajuanSuratTugas, 'involvedUsers' => $involvedUsers]);
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

        $users = User::pluck('usr_nama', 'usr_id'); // Pluck user names with user IDs
        $usr_role = Auth::user()->usr_role; // Get the role of the logged-in user

        // Determine the view based on the user's role
        if ($usr_role === 'karyawan') {
            return view('karyawan.pengajuan.create', compact('title', 'users'));
        } elseif ($usr_role === 'admin') {
            return view('admin.pengajuan.create', compact('title', 'users'));
        } else {
            // Handle if the role is not identified
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
        $detailTemp = $request->input('detailTemp');

        $selectedUserIds = explode(',', $detailTemp);
        

        if ($request->hasFile('pst_buktipendukung')) {
            $pst_buktipendukung = $request->file('pst_buktipendukung');
            $nama_buktipendukung = $pst_buktipendukung->getClientOriginalName(); // Gunakan nama asli file

            $pst_buktipendukung->move('files/', $nama_buktipendukung);
            $validatedData['pst_buktipendukung'] = 'files/' . $nama_buktipendukung; // Simpan path file dalam database
        }

        if ($pengajuan = PengajuanSuratTugas::create($validatedData)) {

            $pengajuan->save();

            $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login
            foreach ($selectedUserIds as $userId) {
                DetailPengajuanSuratTugas::create([
                    'pengaju_id' =>$pengajuan->pst_id,
                    'usr_id' => $userId,
                ]);
            }
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
            // Get the currently logged-in user
            $currentUser = Auth::user();

            // Find the pengajuan record by pst_id
            $pengajuan = PengajuanSuratTugas::findOrFail($pst_id);

            // Check if the current user is authorized to perform the action
            if ($currentUser->usr_role === 'admin') {
                // Assuming 'surattugas' is the name of the file input in your form
                if (request()->hasFile('surattugas')) {
                    $suratTugasFile = request()->file('surattugas');
                    $suratTugasFileName = 'surat_tugas_' . time() . '.' . $suratTugasFile->getClientOriginalExtension();

                    // Move the file to the desired location
                    $suratTugasFile->move('files/', $suratTugasFileName);

                    // Update the pengajuan record with the surat tugas file path
                    $pengajuan->update(['status' => 4, 'surattugas' => 'files/' . $suratTugasFileName]);

                    // Retrieve the involved users data
                    $involvedUsers = $pengajuan->involvedUsers();

                    // Check if the current user is involved in the pengajuan
                    if (in_array($currentUser->usr_id, array_keys($involvedUsers))) {
                        return response()->json(['success' => 'Surat Tugas berhasil dikirim.']);
                    } else {
                        return response()->json(['error' => 'Unauthorized action.'], 403);
                    }
                } else {
                    return response()->json(['error' => 'File Surat Tugas tidak ditemukan.'], 400);
                }
            } else {
                return response()->json(['error' => 'Unauthorized action.'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error mengirim Surat Tugas: ' . $e->getMessage()], 500);
        }
    }



    public function surattugasexport(Request $request)
    {
        // search query dari request
        $searchQuery = $request->get('search');

        // buat instansiasi dari search query
        $export = new SuratTugasExport($searchQuery);

        // Download the Excel file
        return Excel::download($export, 'Laporan_Surat_Tugas.xlsx');
    }
    public function detail(Request $request)
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
        });

        $user = Auth::user();
        $usr_role = $user->usr_role; // Ambil peran pengguna yang sedang login
        $usr_id = $user->usr_id;

        if ($usr_role === 'karyawan') {
            $search->where('usr_id', $usr_id); // Assuming 'created_by' is the correct column
        }

        $pengajuanSuratTugas = $search->get();

        // Berdasarkan peran, tentukan view yang akan digunakan
        if ($usr_role === 'karyawan') {
            // Filter out records with status 3 for karyawan view

            return view('karyawan.pengajuan.detail', compact('title'), ['pengajuan' => $pengajuanSuratTugas]);
        } elseif ($usr_role === 'admin') {
            // Filter out records with status 3 for admin view

            return view('admin.pengajuan.detail', compact('title'), ['pengajuan' => $pengajuanSuratTugas]);
        } else {
            // Handle jika peran tidak teridentifikasi
            return abort(403, 'Unauthorized action.');
        }
    }    
    public function indexDetail(Request $request)
    {
        $title = 'Detail Pengajuan Surat Tugas';

        // Get the currently logged-in user
        $user = Auth::user();

        // Retrieve the detail surat tugas for the logged-in user
        $detailPengajuanSuratTugas = DetailPengajuanSuratTugas::where('usr_id', $user->usr_id)->get();

        // Extract the unique pengaju_id values from the detail records
        $pengajuIds = $detailPengajuanSuratTugas->pluck('pengaju_id')->unique();

        // Retrieve the pengajuan surat tugas based on the extracted ids
        $pengajuanSuratTugas = PengajuanSuratTugas::whereIn('pst_id', $pengajuIds)->get();

        // Retrieve the involved users data based on the $involvedUsers array
        $involvedUsers = [];
        foreach ($pengajuanSuratTugas as $pengajuan) {
            $involvedUsers[$pengajuan->pst_id] = $pengajuan->involvedUsers();
        }

        return view('karyawan.pengajuan.detail', compact('title', 'pengajuanSuratTugas', 'involvedUsers', 'detailPengajuanSuratTugas'));
    }
}
