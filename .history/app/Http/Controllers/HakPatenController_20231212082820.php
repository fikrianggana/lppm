<?php

namespace App\Http\Controllers;

use App\Models\HakPaten;
use App\Http\Requests\StoreHakPatenRequest;
use App\Http\Requests\UpdateHakPatenRequest;
use App\Models\Pengguna;


class HakPatenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hakPaten = HakPaten::all();

        return view ('karyawan.publikasi.hakpaten.index',  ['hakpaten' => $hakPaten]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pengguna = Pengguna::created();

        return view('karyawan.publikasi.hakpaten.create', ['penggunas' => $pengguna ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHakPatenRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHakPatenRequest $request)
    {
        $validatedData = $request->validated();

        if ($hakPaten = HakPaten::create($validatedData)){
            return redirect()->route('karyawan.publikasi.hakpaten.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HakPaten  $hakPaten
     * @return \Illuminate\Http\Response
     */
    public function show(HakPaten $hakPaten)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HakPaten  $hakPaten
     * @return \Illuminate\Http\Response
     */
    public function edit(HakPaten $hakPaten)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHakPatenRequest  $request
     * @param  \App\Models\HakPaten  $hakPaten
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHakPatenRequest $request, HakPaten $hakPaten)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HakPaten  $hakPaten
     * @return \Illuminate\Http\Response
     */
    public function destroy(HakPaten $hakPaten)
    {
        //
    }
}
