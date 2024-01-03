<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use App\Http\Requests\StoreBukuRequest;
use App\Http\Requests\UpdateBukuRequest;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buku = Buku::all();

        return view ('admin.publikasi.buku.index',  ['buku' => $buku]);
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

        // Kemudian, kirim data User ke view
        return view('admin.publikasi.buku.create', ['users' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBukuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBukuRequest $request)
    {
        $validatedData = $request->validated();

        if (Buku::create($validatedData)){
            return redirect()->route('admin.publikasi.buku.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function show(Buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function edit(Buku $buku, $bku_id)
    {
        $buku = Buku::findOrFail($bku_id);
        $users = User::pluck('usr_nama', 'usr_id');
        return view('admin.publikasi.buku.edit', [
            'bk'=>$buku,
            'users'=>$users,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBukuRequest  $request
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBukuRequest $request, Buku $buku, $bku_id)
    {
        $request->validated();

        Buku::find($bku_id)->update($request->all());

        return redirect()->route('admin.publikasi.buku.index')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buku $buku, $bku_id)
    {
        try {
            // Find the book by ID
            $buku = $buku->findOrFail($bku_id);

            // Delete the book
            $buku->delete();

            // Redirect with success message
            return redirect()->route('admin.publikasi.buku.index')->with('success', 'Buku deleted successfully');
        } catch (\Exception $e) {
            // Redirect with error message if deletion fails
            return redirect()->back()->with('error', 'Error deleting book: ' . $e->getMessage());
        }
    }
}
