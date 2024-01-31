<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Dashboard';
        return view ('admin.dashboard.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function totalPengajuan()
    {
        $results = DB::connection()->select("
            SELECT MONTH(pst_masapelaksanaan) as bulan, COUNT(*) as total_pengajuan
            FROM pengajuan_surat_tugas
            GROUP BY bulan
        ");

        return $results;
    }
    public function totalPengaduan()
    {
        $results = DB::connection()->select("
            SELECT MONTH(pst_masapelaksanaan) as bulan, COUNT(*) as total_pengajuan
            FROM pengajuan_surat_tugas
            GROUP BY bulan
        ");

        return $results;
    }
}
