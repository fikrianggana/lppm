<?php

namespace App\Http\Controllers;

use App\Models\Prosiding;
use App\Models\User;
use App\Http\Requests\StoreProsidingRequest;
use App\Http\Requests\UpdateProsidingRequest;

class ProsidingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prosiding = Prosiding::all();
        return view ('admin.publikasi.prosiding.index',  ['prosiding' => $prosiding]);
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
        return view('admin.publikasi.prosiding.create', ['users' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProsidingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProsidingRequest $request)
    {
        $validatedData = $request->validated();
        if (Prosiding::create($validatedData)){
            return redirect()->route('admin.publikasi.prosiding.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prosiding  $prosiding
     * @return \Illuminate\Http\Response
     */
    public function show(Prosiding $prosiding)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prosiding  $prosiding
     * @return \Illuminate\Http\Response
     */
    public function edit(Prosiding $prosiding, $bku_id)
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
     * @param  \App\Http\Requests\UpdateProsidingRequest  $request
     * @param  \App\Models\Prosiding  $prosiding
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProsidingRequest $request, Prosiding $prosiding)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prosiding  $prosiding
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prosiding $prosiding, $pro_id)
    {
        try {
            // Find the book by ID
            $prosiding = $prosiding->findOrFail($pro_id);

            // Delete the book
            $prosiding->delete();

            // Redirect with success message
            return redirect()->route('admin.publikasi.prosiding.index')->with('success', 'Prosiding deleted successfully');
        } catch (\Exception $e) {
            // Redirect with error message if deletion fails
            return redirect()->back()->with('error', 'Error deleting book: ' . $e->getMessage());
        }
    }
}
