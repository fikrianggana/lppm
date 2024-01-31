<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Pengaduan';
        $pengaduan = User::all();

        $query = $request->get('search');

        $search = Pengaduan::where(function ($query) use ($request) {
            $query->where('pdn_tipe', 'like', "%{$request->search}%")
                ->orWhere('pdn_jenis', 'like', "%{$request->search}%")
                ->orWhere('usr_id', 'like', "%{$request->search}%")
                ->orWhere('keterangan', 'like', "%{$request->search}%");
        });

        $user = Auth::user();
        $usr_role = $user->usr_role; // Ambil peran pengguna yang sedang login
        $usr_id = $user->usr_id;

        if ($usr_role === 'karyawan') {
            $search->where('usr_id', $usr_id); // Assuming 'created_by' is the correct column
        }

        $pengaduan = $search->get();

        // Berdasarkan peran, tentukan view yang akan digunakan
        if ($usr_role === 'karyawan') {
            return view('karyawan.pengaduan.index', compact('title'), ['pengaduan' => $pengaduan]);
        } elseif ($usr_role === 'admin') {
            return view('admin.pengaduan.index', compact('title'), ['pengaduan' => $pengaduan]);
        } else {
            // Handle jika peran tidak teridentifikasi
            return abort(403, 'Unauthorized action.');
        }
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
}
