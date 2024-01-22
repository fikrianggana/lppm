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
        $validatedData = $request->validated();

        // Set status 0 saat pertama kali data disimpan
        $validatedData['status'] = 0;
        $validatedData['inputby'] = Auth::user()->usr_id;


        if ($pengaduan = Pengaduan::create($validatedData)){

            $pengaduan->save();

            $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

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
    public function edit(Pengaduan $pengaduan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengaduan $pengaduan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengaduan $pengaduan)
    {
        //
    }

    public function pengaduanexport(){
        return Excel::download(new Pengaduan, 'Laporan_Pengaduan.xlsx');
    }


    public function getData(Request $request) {
        $id = $request->input('id');
        $pengaduan = $request->input('pengaduan');
        $data = [];

        if ($pengaduan == "Buku") {
            $bukuData = Buku::where('usr_id', $id)->get();

            foreach ($bukuData as $buku) {
                $pengaduanEntry = new DataModel([
                    'Id' => $buku->bku_id,
                    'Nama' => $buku->Judulbuku
                ]);

                $data[] = $pengaduanEntry;
            }
        } elseif ($pengaduan == "jurnal") {
            $bukuData = Buku::where('Inputby', $id)->get();

            foreach ($bukuData as $buku) {
                $pengaduanEntry = new DataModel([
                    'Id' => $buku->Id,
                    'Nama' => $buku->Judulbuku
                ]);

                $data[] = $pengaduanEntry;
            }
        }

        return response()->json($data);
    }

}

