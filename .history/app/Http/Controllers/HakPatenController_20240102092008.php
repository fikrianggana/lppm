<?php

namespace App\Http\Controllers;

use App\Models\HakPaten;
use App\Http\Requests\StoreHakPatenRequest;
use App\Http\Requests\UpdateHakPatenRequest;
use App\Models\User;


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
        // $user = User::pluck('pgn_nama'); // Sesuaikan dengan nama kolom di tabel User

        return view ('admin.publikasi.hakpaten.index',  ['hakpaten' => $hakPaten]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Ambil hanya kolom nama dari model User
        $user = User::pluck('usr_nama', 'usr_id'); // Sesuaikan dengan nama kolom di tabel User

        // Kemudian, kirim data User ke view
        return view('admin.publikasi.hakpaten.create', ['users' => $user]);
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
            return redirect()->route('admin.publikasi.hakpaten.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $request->validated();

        Buku::find($bku_id)->update($request->all());

        return redirect()->route('admin.publikasi.buku.index')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HakPaten  $hakPaten
     * @return \Illuminate\Http\Response
     */
    public function destroy(HakPaten $hakPaten, $hpt_id)
    {
        try {
            // Find the book by ID
            $hakPaten = $hakPaten->findOrFail($hpt_id);

            // Delete the book
            $hakPaten->delete();

            // Redirect with success message
            return redirect()->route('admin.publikasi.hakpaten.index')->with('success', 'Hak Paten deleted successfully');
        } catch (\Exception $e) {
            // Redirect with error message if deletion fails
            return redirect()->back()->with('error', 'Error deleting book: ' . $e->getMessage());
        }
    }
}
