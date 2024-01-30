<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardKaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Dashboard';
        return view ('karyawan.dashboard.index',compact('title'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function totalPengajuan()
    {
        $usr_id = Auth::user()->usr_id;

        $results = DB::connection()->select("SELECT 
            MONTH(pst_masapelaksanaan) as bulan, 
            pengajuan_surat_tugas.usr_id,
            users.usr_nama, 
            COUNT(*) as total_pengajuan 
            FROM pengajuan_surat_tugas 
            JOIN users ON pengajuan_surat_tugas.usr_id = users.usr_id
            WHERE pengajuan_surat_tugas.usr_id = :user_id
            GROUP BY bulan, pengajuan_surat_tugas.usr_id, users.usr_nama", ['user_id' => $usr_id]);

        return response()->json($results);
    }

    public function totalSeminar()
    {
        $usr_id = Auth::user()->usr_id;
    
        $results = DB::connection()->select("SELECT 
            MONTH(smn_waktu) as bulan, 
            seminars.usr_id,
            users.usr_nama, 
            COUNT(*) as total_seminar
            FROM seminars 
            JOIN users ON seminars.usr_id = users.usr_id
            WHERE seminars.usr_id = :user_id
            GROUP BY bulan, seminars.usr_id, users.usr_nama", ['user_id' => $usr_id]);
    
        return response()->json($results);
    }

    public function totalHakPaten()
    {
        $usr_id = Auth::user()->usr_id;
    
        $results = DB::connection()->select("SELECT 
            MONTH(hpt_tglpenerimaan) as bulan, 
            hak_patens.usr_id,
            users.usr_nama, 
            COUNT(*) as total_hakpaten
            FROM hak_patens 
            JOIN users ON hak_patens.usr_id = users.usr_id
            WHERE hak_patens.usr_id = :user_id
            GROUP BY bulan, hak_patens.usr_id, users.usr_nama", ['user_id' => $usr_id]);
    
        return response()->json($results);
    }
    
    public function totalProsiding()
    {
        $usr_id = Auth::user()->usr_id;
    
        $results = DB::connection()->select("SELECT 
            MONTH(pro_waktuterbit) as bulan, 
            prosidings.usr_id,
            users.usr_nama, 
            COUNT(*) as total_prosiding
            FROM prosidings 
            JOIN users ON prosidings.usr_id = users.usr_id
            WHERE prosidings.usr_id = :user_id
            GROUP BY bulan, prosidings.usr_id, users.usr_nama", ['user_id' => $usr_id]);
    
        return response()->json($results);
    }
    
}
