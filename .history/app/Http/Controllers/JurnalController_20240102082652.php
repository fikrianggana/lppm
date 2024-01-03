<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\User;
use App\Http\Requests\StoreJurnalRequest;
use App\Http\Requests\UpdateJurnalRequest;

class JurnalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jurnal = Jurnal::all();
        // $user = User::pluck('pgn_nama'); // Sesuaikan dengan nama kolom di tabel User

        return view ('admin.publikasi.jurnal.index',  ['jurnal' => $jurnal]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::pluck('usr_nama', 'usr_id'); // Sesuaikan dengan nama kolom di tabel User

        return view ('admin.publikasi.jurnal.create', ['users' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreJurnalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJurnalRequest $request)
    {
        $validatedData = $request->validated();

        if (Jurnal::create($validatedData)){
            return redirect()->route('admin.publikasi.jurnal.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jurnal  $jurnal
     * @return \Illuminate\Http\Response
     */
    public function show(Jurnal $jurnal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jurnal  $jurnal
     * @return \Illuminate\Http\Response
     */
    public function edit(Jurnal $jurnal)
    {
        $jurnal = Buku::findOrFail($bku_id);
        $users = User::pluck('usr_nama', 'usr_id');
        return view('admin.publikasi.buku.edit', [
            'bk'=>$buku,
            'users'=>$users,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJurnalRequest  $request
     * @param  \App\Models\Jurnal  $jurnal
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJurnalRequest $request, Jurnal $jurnal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jurnal  $jurnal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jurnal $jurnal, $jrn_id)
    {
        try {
            // Find the book by ID
            $jurnal = $jurnal->findOrFail($jrn_id);

            // Delete the book
            $jurnal->delete();

            // Redirect with success message
            return redirect()->route('admin.publikasi.jurnal.index')->with('success', 'Jurnal deleted successfully');
        } catch (\Exception $e) {
            // Redirect with error message if deletion fails
            return redirect()->back()->with('error', 'Error deleting book: ' . $e->getMessage());
        }
    }
}
