<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\SeminarExport;
use Illuminate\Support\Facades\Auth;
use App\Models\Seminar;
use App\Models\User;
use App\Http\Requests\StoreSeminarRequest;
use App\Http\Requests\UpdateSeminarRequest;
use Maatwebsite\Excel\Facades\Excel;

class SeminarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        $title= 'Seminar';

        $seminar = Seminar::all();
        // $user = User::pluck('usr_nama'); // Sesuaikan dengan nama kolom di tabel User

        $query = $request->get('search');
           
        $search = Seminar::where(function ($query) use ($request) {
            $query->where('smn_namapenulis', 'like', "%{$request->search}%")
                  ->orWhere('smn_kategori', 'like', "%{$request->search}%")
                  ->orWhere('smn_penyelenggara', 'like', "%{$request->search}%")
                  ->orWhere('smn_waktu', 'like', "%{$request->search}%")
                  ->orWhere('smn_tempatpelaksaan', 'like', "%{$request->search}%")
                  ->orWhere('smn_keterangan', 'like', "%{$request->search}%");
        })
        ->get();
        
        $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

        // Tentukan view berdasarkan peran pengguna
        if ($usr_role === 'karyawan') {
            return view ('karyawan.publikasi.seminar.index', compact('title'), ['seminar' => $seminar]);
        } elseif ($usr_role === 'admin') {
            return view ('admin.publikasi.seminar.index', compact('title'), ['seminar' => $search]);
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
        $title= 'Seminar';
        $user = User::pluck('usr_nama', 'usr_id'); // Sesuaikan dengan nama kolom di tabel User

        $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

        // Tentukan view berdasarkan peran pengguna
        if ($usr_role === 'karyawan') {
            return view('karyawan.publikasi.seminar.create', compact('title'),['users' => $user]);
        } elseif ($usr_role === 'admin') {
            return view('admin.publikasi.seminar.create',compact('title'), ['users' => $user]);
        } else {
            // Handle jika peran tidak teridentifikasi
            return abort(403, 'Unauthorized action.');
        }

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
            $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

            // Tentukan view berdasarkan peran pengguna
            if ($usr_role === 'karyawan') {
                return redirect()->route('karyawan.publikasi.seminar.index')->with(['success' => 'Data Berhasil Disimpan!']);
            } elseif ($usr_role === 'admin') {
                return redirect()->route('admin.publikasi.seminar.index')->with(['success' => 'Data Berhasil Disimpan!']);
            } else {
                // Handle jika peran tidak teridentifikasi
                return abort(403, 'Unauthorized action.');
            }
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
        return view('admin.publikasi.seminar.edit', [
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
    public function update(UpdateSeminarRequest $request, Seminar $seminar, $smn_id)
    {
        $request->validated();

        Seminar::find($smn_id)->update($request->all());

        return redirect()->route('admin.publikasi.seminar.index')->with('success', 'Data berhasil diperbarui!');
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
    public function seminarexport(){
        return Excel::download(new SeminarExport, 'Seminar.xlsx');
    }
}
