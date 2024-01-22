<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\HakCipta;
use App\Models\HakPaten;
use App\Models\Jurnal;
use App\Models\PengabdianMasyarakat;
use App\Models\Pengaduan;
use App\Models\Prosiding;
use App\Models\Seminar;
use App\Models\User;
use App\Models\DataModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PengaduanExport;
// use App\Http\Requests\

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Pengaduan';
        $pengaduan = Pengaduan::all();

        $query = $request->get('search');

        $search = Pengaduan::where(function ($query) use ($request) {
            $query->where('pdn_tipe', 'like', "%{$request->search}%")
                ->orwhere('pdn_jenis', 'like', "%{$request->search}%")
                ->orwhere('usr_id', 'like', "%{$request->search}%")
                ->orWhere('hpt_id', 'like', "%{$request->search}%")
                ->orWhere('pro_id', 'like', "%{$request->search}%")
                ->orWhere('smn_id', 'like', "%{$request->search}%")
                ->orWhere('hcp_id', 'like', "%{$request->search}%")
                ->orWhere('jrn_id', 'like', "%{$request->search}%")
                ->orWhere('bku_id', 'like', "%{$request->search}%")
                ->orWhere('pkm_id', 'like', "%{$request->search}%")
                ->orWhere('status', 'like', "%{$request->search}%")
                ->orWhere('keterangan', 'like', "%{$request->search}%");
        })
        ->get();

        $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

        // Berdasarkan peran, tentukan view yang akan digunakan
        if ($usr_role === 'karyawan') {
            // Filter out records with status 3 for karyawan view
            // $pengajuanSuratTugas = PengajuanSuratTugas::all();
            return view('karyawan.pengaduan.index', compact('title'), ['pengaduan' => $search]);
        } elseif ($usr_role === 'admin') {
            return view('admin.pengaduan.index', compact('title'), ['pengaduan' => $search]);
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
        $title = 'Pengaduan';
        $buku = Buku::all();
        $jurnal = Jurnal::all();
        $pengabdian = PengabdianMasyarakat::all();
        $seminar = Seminar::all();
        $hakcipta = HakCipta::all();
        $hakpaten = HakPaten::all();
        $prosiding = Prosiding::all();

        $user = User::pluck('usr_nama', 'usr_id'); // Sesuaikan dengan nama kolom
        $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

        // Tentukan view berdasarkan peran pengguna
        if ($usr_role === 'karyawan') {
            return view('karyawan.pengaduan.create',compact('title', 'buku', 'jurnal','seminar','hakcipta','hakpaten','prosiding','pengabdian'),['users' => $user]);
        } elseif ($usr_role === 'admin') {
            return view('admin.pengaduan.create', compact('title'),['users' => $user]);
        } else {
            // Handle jika peran tidak teridentifikasi
            return abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input pengaduan
        $request->validate([
            'usr_id' => 'required',
            'pdn_tipe' => 'required',
            'pdn_jenis' => 'required',
            'keterangan' => 'required',
        ]);

        // Set status 0 saat pertama kali data disimpan
        $validatedData = $request->all();
        $validatedData['status'] = 0;
        $validatedData['inputby'] = Auth::user()->usr_id;

        if ($pengaduan = Pengaduan::create($validatedData)) {
            $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

            $pengaduan->save();

            // Tentukan view berdasarkan peran pengguna
            if ($usr_role === 'karyawan') {
                return redirect(route('karyawan.pengaduan.index'))->with('success', 'Data Berhasil Disimpan!');
            } elseif ($usr_role === 'admin') {
                return redirect(route('admin.pengaduan.index'))->with('success', 'Data Berhasil Disimpan!');
            } else {
                // Handle jika peran tidak teridentifikasi
                return abort(403, 'Unauthorized action.');
            }
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function show(Pengaduan $pengaduan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengaduan $pengaduan, $pdn_id)
    {
        $pdn = Pengaduan::findOrFail($pdn_id);
        $title = 'Edit Pengaduan';

        $buku = Buku::all();
        $jurnal = Jurnal::all();
        $pengabdian = PengabdianMasyarakat::all();
        $seminar = Seminar::all();
        $hakcipta = HakCipta::all();
        $hakpaten = HakPaten::all();
        $prosiding = Prosiding::all();

        $user = User::pluck('usr_nama', 'usr_id'); // Sesuaikan dengan nama kolom
        $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

        // Tentukan view berdasarkan peran pengguna dan kirim data pengajuan yang akan diedit
        if ($usr_role === 'karyawan') {
            return view('karyawan.pengaduan.edit', compact('title', 'pengaduan'), ['users' => $user, 'pdn' => $pdn]);
        } elseif ($usr_role === 'admin') {
            return view('admin.pengaduan.edit', compact('title', 'pengaduan'), ['users' => $user, 'pdn' => $pdn]);
        } else {
            // Handle jika peran tidak teridentifikasi
            return abort(403, 'Unauthorized action.');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengaduan $pengaduan, $pdn_id)
    {
        // Validasi input pengaduan
        $request->validate([
            'usr_id' => 'required',
            'pdn_tipe' => 'required',
            'pdn_jenis' => 'required',
            'keterangan' => 'required',
        ]);

        // Set status 0 saat pertama kali data disimpan
        $validatedData = $request->all();
        $validatedData['status'] = 0;
        $validatedData['inputby'] = Auth::user()->usr_id;

        Pengaduan::find($pdn_id)->update($validatedData);

        $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

        // Tentukan view berdasarkan peran pengguna
        if ($usr_role === 'karyawan') {
            return redirect(route('karyawan.pengaduan.index'))->with('success', 'Data Berhasil Diupdate!');
        } elseif ($usr_role === 'admin') {
            return redirect(route('admin.pengaduan.index'))->with('success', 'Data Berhasil Diupdate!');
        } else {
            // Handle jika peran tidak teridentifikasi
            return abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function destroy($pdn_id)
    {

        $pengaduan = Pengaduan::find($pdn_id);
        // Hapus pengaduan
        $pengaduan->delete();

        $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

        // Tentukan view berdasarkan peran pengguna
        if ($usr_role === 'karyawan') {
            return redirect(route('karyawan.pengaduan.index'))->with('success', 'Data Berhasil Dihapus!');
        } elseif ($usr_role === 'admin') {
            return redirect(route('admin.pengaduan.index'))->with('success', 'Data Berhasil Dihapus!');
        } else {
            // Handle jika peran tidak teridentifikasi
            return abort(403, 'Unauthorized action.');
        }
    }

    public function pengaduanexport(){
        return Excel::download(new Pengaduan, 'Laporan_Pengaduan.xlsx');
    }


    public function getData(Request $request) {
        $id = $request->input('id');
        $pengaduan = $request->input('pengaduan');
        $data = [];

        if (empty($id) || empty($pengaduan)) {
            return response()->json(['error' => 'ID and Pengaduan are required.'], 400);
        }

        if ($pengaduan == "Buku") {

            $bukuData = Buku::where('usr_id', $id)->get();

            foreach ($bukuData as $buku) {
                $pengaduanEntry = new DataModel([
                    'id' => $buku->bku_id,
                    'nama' => $buku->bku_judul
                ]);

                $data[] = $pengaduanEntry;
            }

        } else if ($pengaduan == "Jurnal") {

            $jurnalData = Jurnal::where('usr_id', $id)->get();

            foreach ($jurnalData as $jurnal) {
                $pengaduanEntry = new DataModel([
                    'id' => $jurnal->jrn_id,
                    'nama' => $jurnal->jrn_namajurnal
                ]);

                $data[] = $pengaduanEntry;
            }

        } elseif ($pengaduan == "Seminar") {
            $seminarData = Seminar::where('usr_id', $id)->get();

            foreach($seminarData as $seminar){
                $pengaduanEntry = new DataModel([
                    'id' => $seminar->smn_id,
                    'nama' => $seminar->smn_namapenulis
                ]);

                $data[] = $pengaduanEntry;
            }
        } elseif ($pengaduan == "HakCipta"){
            $hakciptaData = HakCipta::where('usr_id', $id)->get();

            foreach ($hakciptaData as $hcp){
                $pengaduanEntry = new DataModel([
                    'id' => $hcp->hcp_id,
                    'nama' => $hcp->hcp_namalengkap
                ]);

                $data[] = $pengaduanEntry;
            }
        }


        return response()->json($data);
    }

    public function kirim($pdn_id)
    {
        $pengaduan = Pengaduan::find($pdn_id);
        $pengaduan->status = 1; // Mengubah status menjadi 1 (Dikirim)
        $pengaduan->save();

        return redirect()->back()->with('success', 'Status pengaduan berhasil diubah menjadi terkirim.');
    }

    public function confirm($pdn_id)
    {
        try {
            // Find the record by pst_id
            $pengaduan = Pengaduan::findOrFail($pdn_id);

            // Update the status only if it is not already confirmed or rejected
            if ($pengaduan->status == 1) {
                $pengaduan->update(['status' => 2]); // Change the status to "Acc"

                return redirect()->route('admin.pengaduan.index')->with('success', 'Pengaduan confirmed successfully');
            } else {
                return redirect()->route('admin.pengaduan.index')->with('error', 'Pengaduan has already been confirmed or rejected');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.pengaduan.index')->with('error', 'Error confirming pengajuan: ' . $e->getMessage());
        }
    }


    public function reject($pdn_id)
    {
        try {
            // Find the record by pst_id
            $pengaduan = Pengaduan::findOrFail($pdn_id);

            // Delete the rejected record only if it is not already confirmed or rejected
            if ($pengaduan->status == 1) {
                // Change the status to "Rejected"
                $pengaduan->update(['status' => 3, 'keterangan' => request('keterangan')]);

                // // Delete the record
                // $pengajuan->delete();

                return redirect()->route('admin.pengaduan.index')->with('success', 'Pengaduan rejected successfully');
            } else {
                return redirect()->route('admin.pengaduan.index')->with('error', 'Pengaduan has already been confirmed or rejected');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.pengaduan.index')->with('error', 'Error rejecting pengajuan: ' . $e->getMessage());
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

}

