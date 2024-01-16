<?php

namespace App\Http\Controllers;

use App\Exports\HakCiptaExport;
use Illuminate\Support\Facades\Auth;
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
        $title= 'Hak Cipta';

        $hakCipta = HakCipta::all();

        $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

        // Tentukan view berdasarkan peran pengguna
        if ($usr_role === 'karyawan') {
            return view ('karyawan.publikasi.hakcipta.index', compact('title'), ['hakcipta' => $hakCipta]);
        } elseif ($usr_role === 'admin') {
            return view ('admin.publikasi.hakcipta.index', compact('title'), ['hakcipta' => $hakCipta]);
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
        $title= 'Hak Cipta';

        // Ambil hanya kolom nama dari model User
        $user = User::pluck('usr_nama', 'usr_id'); // Sesuaikan dengan nama kolom

        $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

        // Tentukan view berdasarkan peran pengguna
        if ($usr_role === 'karyawan') {
            return view('karyawan.publikasi.hakcipta.create',compact('title'), ['users' => $user]);
        } elseif ($usr_role === 'admin') {
            return view('admin.publikasi.hakcipta.create', compact('title'),['users' => $user]);
        } else {
            // Handle jika peran tidak teridentifikasi
            return abort(403, 'Unauthorized action.');
        }
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
            $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

            // Tentukan view berdasarkan peran pengguna
            if ($usr_role === 'karyawan') {
                return redirect()->route('karyawan.publikasi.hakcipta.index')->with(['success' => 'Data Berhasil Disimpan!']);
            } elseif ($usr_role === 'admin') {
                return redirect()->route('admin.publikasi.hakcipta.index')->with(['success' => 'Data Berhasil Disimpan!']);
            } else {
                // Handle jika peran tidak teridentifikasi
                return abort(403, 'Unauthorized action.');
            }

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
    public function edit(HakCipta $hakCipta, $hcp_id)
    {
        $hakCipta = HakCipta::findOrFail($hcp_id);
        $users = User::pluck('usr_nama', 'usr_id');
        return view('admin.publikasi.hakcipta.edit', [
            'hcp'=>$hakCipta,
            'users'=>$users,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHakCiptaRequest  $request
     * @param  \App\Models\HakCipta  $hakCipta
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHakCiptaRequest $request, HakCipta $hakCipta,$hcp_id)
    {
        $request->validated();

        HakCipta::find($hcp_id)->update($request->all());

        return redirect()->route('admin.publikasi.hakcipta.index')->with('success', 'Data berhasil diperbarui!');
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
            return redirect()->route('admin.publikasi.hakcipta.index')->with('success', 'Hak Cipta deleted successfully');
        } catch (\Exception $e) {
            // Redirect with error message if deletion fails
            return redirect()->back()->with('error', 'Error deleting book: ' . $e->getMessage());
        }
    }
    public function hakciptaexport(){
        return Excel::download(new HakCiptaExport, 'HakCipta.xlsx');
    }
}
