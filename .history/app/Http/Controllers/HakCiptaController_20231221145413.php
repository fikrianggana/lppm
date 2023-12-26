<?php

namespace App\Http\Controllers;

use App\Models\HakCipta;
use App\Models\User;
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
        $hakCipta = HakCipta::all();
        return view ('admin.publikasi.hakcipta.index',  ['hakcipta' => $hakCipta]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Ambil hanya kolom nama dari model User
        $user = User::pluck('usr_nama', 'usr_id'); // Sesuaikan dengan nama kolom


        return view('admin.publikasi.hakcipta.create', ['users' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHakCiptaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHakCiptaRequest $request)
    {
        $validatedData = $request->validated();

        if (HakCipta::create($validatedData)){
            return redirect()->route('admin.publikasi.hakcipta.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }
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
    public function destroy(HakCipta $hakCipta, $hcp_id)
    {
        try {
            // Find the book by ID
            $hakCipta = $hakCipta->findOrFail($hcp_id);

            // Delete the book
            $hakCipta->delete();

            // Redirect with success message
            return redirect()->route('admin.publikasi.hakcipta.index')->with('success', 'Buku deleted successfully');
        } catch (\Exception $e) {
            // Redirect with error message if deletion fails
            return redirect()->back()->with('error', 'Error deleting book: ' . $e->getMessage());
        }
    }
}
