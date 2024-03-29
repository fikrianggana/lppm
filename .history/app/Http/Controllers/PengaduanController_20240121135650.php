<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
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
            $query->where('usr_id', 'like', "%{$request->search}%")
                ->orwhere('usr_id', 'like', "%{$request->search}%")
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
            // return view('karyawan.pengaduan.index', compact('title'), ['pengaduan' => $search]);
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function surattugasexport(){
        return Excel::download(new Pengaduan, 'Laporan_Pengaduan.xlsx');
    }
}
