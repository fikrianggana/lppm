<?php

namespace App\Http\Controllers;

use App\Models\HakCipta;
use App\Http\Requests\StoreHakCiptaRequest;
use App\Http\Requests\UpdateHakCiptaRequest;

class HakCiptaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hakPaten = HakPaten::all();
        $pengguna = Pengguna::pluck('pgn_nama'); // Sesuaikan dengan nama kolom di tabel Pengguna
        return view ('karyawan.publikasi.hakpaten.index',  ['hakpaten' => $hakPaten, 'penggunas' => $pengguna]);
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
     * @param  \App\Http\Requests\StoreHakCiptaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHakCiptaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HakCipta  $hakCipta
     * @return \Illuminate\Http\Response
     */
    public function show(HakCipta $hakCipta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HakCipta  $hakCipta
     * @return \Illuminate\Http\Response
     */
    public function edit(HakCipta $hakCipta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHakCiptaRequest  $request
     * @param  \App\Models\HakCipta  $hakCipta
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHakCiptaRequest $request, HakCipta $hakCipta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HakCipta  $hakCipta
     * @return \Illuminate\Http\Response
     */
    public function destroy(HakCipta $hakCipta)
    {
        //
    }
}
