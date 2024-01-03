<?php

namespace App\Http\Controllers;

use App\Models\Seminar;
use App\Models\User;
use App\Http\Requests\StoreSeminarRequest;
use App\Http\Requests\UpdateSeminarRequest;

class SeminarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seminar = Seminar::all();
        // $user = User::pluck('usr_nama'); // Sesuaikan dengan nama kolom di tabel User

        return view ('admin.publikasi.seminar.index',  ['seminar' => $seminar]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::pluck('usr_nama', 'usr_id'); // Sesuaikan dengan nama kolom di tabel User
        return view('admin.publikasi.seminar.create', ['users' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSeminarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSeminarRequest $request)
    {
        $validatedData = $request->validated();

        if ($seminar = Seminar::create($validatedData)){
            return redirect()->route('admin.publikasi.seminar.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seminar  $seminar
     * @return \Illuminate\Http\Response
     */
    public function show(Seminar $seminar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seminar  $seminar
     * @return \Illuminate\Http\Response
     */
    public function edit(Seminar $seminar, $smn_id)
    {
        $seminar = Seminar::findOrFail($smn_id);
        $users = User::pluck('usr_nama', 'usr_id');
        return view('admin.publikasi.buku.edit', [
            'smn'=>$seminar,
            'users'=>$users,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSeminarRequest  $request
     * @param  \App\Models\Seminar  $seminar
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSeminarRequest $request, Seminar $seminar)
    {
        $request->validated();

        Buku::find($bku_id)->update($request->all());

        return redirect()->route('admin.publikasi.buku.index')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seminar  $seminar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seminar $seminar, $smn_id)
    {
        try {
            // Find the book by ID
            $seminar = $seminar->findOrFail($smn_id);

            // Delete the book
            $seminar->delete();

            // Redirect with success message
            return redirect()->route('admin.publikasi.seminar.index')->with('success', 'Seminar deleted successfully');
        } catch (\Exception $e) {
            // Redirect with error message if deletion fails
            return redirect()->back()->with('error', 'Error deleting book: ' . $e->getMessage());
        }
    }
}
