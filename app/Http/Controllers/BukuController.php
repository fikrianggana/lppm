<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Buku;
use App\Models\User;
use App\Http\Requests\StoreBukuRequest;
use App\Http\Requests\UpdateBukuRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BukuExport;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $title = 'Publikasi - Buku';
    $buku = Buku::all();

    $query = $request->get('search');

    $search = Buku::where(function ($query) use ($request) {
        $query->where('bku_tahun', 'like', "%{$request->search}%")
            ->orWhere('bku_judul', 'like', "%{$request->search}%")
            ->orWhere('bku_penulis', 'like', "%{$request->search}%")
            ->orWhere('bku_editor', 'like', "%{$request->search}%")
            ->orWhere('bku_isbn', 'like', "%{$request->search}%")
            ->orWhere('bku_penerbit', 'like', "%{$request->search}%");
    });

    $user = Auth::user();
    $usr_role = $user->usr_role; // Ambil peran pengguna yang sedang login
    $usr_id = $user->usr_id;

    if ($usr_role === 'karyawan') {
        $search->where('usr_id', $usr_id); // Assuming 'created_by' is the correct column
    }

    $buku = $search->get();

    if ($usr_role === 'karyawan') {
        return view('karyawan.publikasi.buku.index', compact('title', 'buku'));
    } elseif ($usr_role === 'admin') {
        return view('admin.publikasi.buku.index', compact('title', 'buku'));
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
        $title = 'Buku';

        // Ambil hanya kolom nama dari model User
        $user = User::pluck('usr_nama', 'usr_id'); // Sesuaikan dengan nama kolom

        $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

        // Tentukan view berdasarkan peran pengguna
        if ($usr_role === 'karyawan') {
            return view('karyawan.publikasi.buku.create', compact('title'),['users' => $user]);
        } elseif ($usr_role === 'admin') {
            return view('admin.publikasi.buku.create',compact('title'), ['users' => $user]);
        } else {
            // Handle jika peran tidak teridentifikasi
            return abort(403, 'Unauthorized action.');
        }

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
            $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

            // Tentukan view berdasarkan peran pengguna
            if ($usr_role === 'karyawan') {
                return redirect()->route('karyawan.publikasi.buku.index')->with(['success' => 'Data Berhasil Disimpan!']);
            } elseif ($usr_role === 'admin') {
                return redirect()->route('admin.publikasi.buku.index')->with(['success' => 'Data Berhasil Disimpan!']);
            } else {
                // Handle jika peran tidak teridentifikasi
                return abort(403, 'Unauthorized action.');
            }

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
        $title = 'Ubah Buku';
        $buku = Buku::findOrFail($bku_id);
        $users = User::pluck('usr_nama', 'usr_id');

        return view('admin.publikasi.buku.edit', compact('title'),['bk'=>$buku,'users'=>$users]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBukuRequest  $request
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBukuRequest $request, $bku_id)
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
    
    public function bukuexport(Request $request){
        $search = $request->get('search');
        return Excel::download(new BukuExport($search), 'Laporan_Buku.xlsx');
    }
    
}
