<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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
        $title ='Jurnal';
        $jurnal = Jurnal::all();
        // $user = User::pluck('pgn_nama'); // Sesuaikan dengan nama kolom di tabel User

        $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

        // Tentukan view berdasarkan peran pengguna
        if ($usr_role === 'karyawan') {
            return view ('karyawan.publikasi.jurnal.index', compact('title'), ['jurnal' => $jurnal]);
        } elseif ($usr_role === 'admin') {
            return view ('admin.publikasi.jurnal.index', compact('title'), ['jurnal' => $jurnal]);
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
        $title ='Jurnal';
 
        $user = User::pluck('usr_nama', 'usr_id'); // Sesuaikan dengan nama kolom di tabel User

        $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

        // Tentukan view berdasarkan peran pengguna
        if ($usr_role === 'karyawan') {
            return view ('karyawan.publikasi.jurnal.create', compact('title'),['users' => $user]);
        } elseif ($usr_role === 'admin') {
            return view ('admin.publikasi.jurnal.create', compact('title'),['users' => $user]);
        } else {
            // Handle jika peran tidak teridentifikasi
            return abort(403, 'Unauthorized action.');
        }      

       
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
            $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

            // Tentukan view berdasarkan peran pengguna
            if ($usr_role === 'karyawan') {
                return redirect()->route('karyawan.publikasi.jurnal.index')->with(['success' => 'Data Berhasil Disimpan!']);
            } elseif ($usr_role === 'admin') {
                return redirect()->route('admin.publikasi.jurnal.index')->with(['success' => 'Data Berhasil Disimpan!']);
            } else {
                // Handle jika peran tidak teridentifikasi
                return abort(403, 'Unauthorized action.');
            }  
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
    public function edit(Jurnal $jurnal, $jrn_id)
    {
        $jurnal = Jurnal::findOrFail($jrn_id);
        $users = User::pluck('usr_nama', 'usr_id');
        
        return view('admin.publikasi.jurnal.edit', [
            'jrn'=>$jurnal,
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
    public function update(UpdateJurnalRequest $request, $jrn_id)
    {
        $request->validated();

        Jurnal::find($jrn_id)->update($request->all());

        return redirect()->route('admin.publikasi.jurnal.index')->with('success', 'Data berhasil diperbarui!');
    }    /**
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
