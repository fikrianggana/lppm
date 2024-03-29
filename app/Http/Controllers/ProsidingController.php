<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ProsidingExport;
use Illuminate\Support\Facades\Auth;
use App\Models\Prosiding;
use App\Models\User;
use App\Http\Requests\StoreProsidingRequest;
use App\Http\Requests\UpdateProsidingRequest;
use Maatwebsite\Excel\Facades\Excel;

class ProsidingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Publikasi - Prosiding';
        $prosiding = Prosiding::all();

        $query = $request->get('search');
           
        $search = Prosiding::where(function ($query) use ($request) {
            $query->where('pro_namapenulis', 'like', "%{$request->search}%")
                  ->orWhere('pro_judulprogram', 'like', "%{$request->search}%")
                  ->orWhere('pro_judulpaper', 'like', "%{$request->search}%")
                  ->orWhere('pro_kategori', 'like', "%{$request->search}%")
                  ->orWhere('pro_penyelenggara', 'like', "%{$request->search}%")
                  ->orWhere('pro_waktuterbit', 'like', "%{$request->search}%")
                  ->orWhere('pro_tempatpelaksanaan', 'like', "%{$request->search}%")
                  ->orWhere('pro_keterangan', 'like', "%{$request->search}%");
        });

        $user = Auth::user();
        $usr_role = $user->usr_role; // Ambil peran pengguna yang sedang login
        $usr_id = $user->usr_id;

        if ($usr_role === 'karyawan') {
            $search->where('usr_id', $usr_id); // Assuming 'created_by' is the correct column
        }

        $prosiding = $search->get();
        // ->get();

        // $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

        // Tentukan view berdasarkan peran pengguna
        if ($usr_role === 'karyawan') {
            return view ('karyawan.publikasi.prosiding.index', compact('title'), ['prosiding' => $prosiding]);
        } elseif ($usr_role === 'admin') {
            return view ('admin.publikasi.prosiding.index', compact('title'), ['prosiding' => $prosiding]);
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
        $title = 'Prosiding';

        // Ambil hanya kolom nama dari model User
        $user = User::pluck('usr_nama', 'usr_id'); // Sesuaikan dengan nama kolom

        $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

        // Tentukan view berdasarkan peran pengguna
        if ($usr_role === 'karyawan') {
            return view('karyawan.publikasi.prosiding.create', compact('title'),['users' => $user]);
        } elseif ($usr_role === 'admin') {
            return view('admin.publikasi.prosiding.create', compact('title'),['users' => $user]);
        } else {
            // Handle jika peran tidak teridentifikasi
            return abort(403, 'Unauthorized action.');
        }
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

            $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

            // Tentukan view berdasarkan peran pengguna
            if ($usr_role === 'karyawan') {
                return redirect()->route('karyawan.publikasi.prosiding.index')->with(['success' => 'Data Berhasil Disimpan!']);
            } elseif ($usr_role === 'admin') {
                return redirect()->route('admin.publikasi.prosiding.index')->with(['success' => 'Data Berhasil Disimpan!']);
            } else {
                // Handle jika peran tidak teridentifikasi
                return abort(403, 'Unauthorized action.');
            }

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
    public function edit(Prosiding $prosiding, $pro_id)
    {
        $title = 'Ubah Prosiding';
        $prosiding = Prosiding::findOrFail($pro_id);
        $users = User::pluck('usr_nama', 'usr_id');
        return view('admin.publikasi.prosiding.edit',compact('title'), [
            'pro'=>$prosiding,
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
    public function update(UpdateProsidingRequest $request, Prosiding $prosiding, $pro_id)
    {
        $request->validated();

        Prosiding::find($pro_id)->update($request->all());

        return redirect()->route('admin.publikasi.prosiding.index')->with('success', 'Data berhasil diperbarui!');
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
    public function prosidingexport(Request $request){
        $search = $request->get('search');
        return Excel::download(new ProsidingExport($search), 'Laporan_Prosiding.xlsx');
    }
}
