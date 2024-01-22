<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\HakPatenExport;
use Illuminate\Support\Facades\Auth;
use App\Models\HakPaten;
use App\Http\Requests\StoreHakPatenRequest;
use App\Http\Requests\UpdateHakPatenRequest;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;


class HakPatenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title= 'Hak Paten';

        $hakPaten = HakPaten::all();
        // $user = User::pluck('pgn_nama'); // Sesuaikan dengan nama kolom di tabel User

        $query = $request->get('search');
           
        $search = HakPaten::where(function ($query) use ($request) {
            $query->where('hpt_namalengkap', 'like', "%{$request->search}%")
                  ->orWhere('hpt_judul', 'like', "%{$request->search}%")
                  ->orWhere('hpt_nopemohonan', 'like', "%{$request->search}%")
                  ->orWhere('hpt_tglpenerimaan', 'like', "%{$request->search}%")
                  ->orWhere('hpt_status', 'like', "%{$request->search}%");
        });

        $user = Auth::user();
        $usr_role = $user->usr_role; // Ambil peran pengguna yang sedang login
        $usr_id = $user->usr_id;

        if ($usr_role === 'karyawan') {
            $search->where('usr_id', $usr_id); // Assuming 'created_by' is the correct column
        }

        $hakPaten = $search->get();

    //     ->get();

    //    $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

        // Tentukan view berdasarkan peran pengguna
        if ($usr_role === 'karyawan') {
            return view ('karyawan.publikasi.hakpaten.index', compact('title'), ['hakpaten' => $hakPaten]);
        } elseif ($usr_role === 'admin') {
            return view ('admin.publikasi.hakpaten.index', compact('title'), ['hakpaten' => $hakPaten]);
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
        $title='Hak Paten';
        // Ambil hanya kolom nama dari model User
        $user = User::pluck('usr_nama', 'usr_id'); // Sesuaikan dengan nama kolom di tabel User

        $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

        // Tentukan view berdasarkan peran pengguna
        if ($usr_role === 'karyawan') {
            return view('karyawan.publikasi.hakpaten.create', compact('title'),['users' => $user]);
        } elseif ($usr_role === 'admin') {
            return view('admin.publikasi.hakpaten.create', compact('title'),['users' => $user]);
        } else {
            // Handle jika peran tidak teridentifikasi
            return abort(403, 'Unauthorized action.');
        }
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
            $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

            // Tentukan view berdasarkan peran pengguna
            if ($usr_role === 'karyawan') {
                return redirect()->route('karyawan.publikasi.hakpaten.index')->with(['success' => 'Data Berhasil Disimpan!']);
            } elseif ($usr_role === 'admin') {
                return redirect()->route('admin.publikasi.hakpaten.index')->with(['success' => 'Data Berhasil Disimpan!']);
            } else {
                // Handle jika peran tidak teridentifikasi
                return abort(403, 'Unauthorized action.');
            }
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
    public function edit(HakPaten $hakPaten, $hpt_id)
    {
        $hakPaten = HakPaten::findOrFail($hpt_id);
        $users = User::pluck('usr_nama', 'usr_id');
        return view('admin.publikasi.hakpaten.edit', [
            'hpt'=>$hakPaten,
            'users'=>$users,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHakPatenRequest  $request
     * @param  \App\Models\HakPaten  $hakPaten
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHakPatenRequest $request, HakPaten $hakPaten, $hpt_id)
    {
        $request->validated();

        HakPaten::find($hpt_id)->update($request->all());

        return redirect()->route('admin.publikasi.hakpaten.index')->with('success', 'Data berhasil diperbarui!');
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
    public function hakpatenexport(){
        return Excel::download(new HakPatenExport, 'HakPaten.xlsx');
    }
}
