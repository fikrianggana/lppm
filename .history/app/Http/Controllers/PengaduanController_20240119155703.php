<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

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
                  ->orWhere('hpt_id', 'like', "%{$request->search}%")
                  ->orWhere('pro_id', 'like', "%{$request->search}%")
                  ->orWhere('smn_id', 'like', "%{$request->search}%")
                  ->orWhere('hcp_id', 'like', "%{$request->search}%")
                  ->orWhere('hcp_id', 'like', "%{$request->search}%");
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
}
