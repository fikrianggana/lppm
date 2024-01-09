<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PengabdianMasyarakat;
use App\Models\Prodi;
use App\Models\User;
use App\Http\Requests\StorePengabdianMasyarakatRequest;
use App\Http\Requests\UpdatePengabdianMasyarakatRequest;
use Carbon;

class PengabdianMasyarakatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pengabdianMasyarakat = PengabdianMasyarakat::all();
        $prodis = Prodi::pluck('prd_nama');
        $user = User::pluck('usr_nama');

        $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

        // Berdasarkan peran, tentukan view yang akan digunakan
        if ($usr_role === 'karyawan') {
            return view('karyawan.pengabdian.index', ['pengabdian' => $pengabdianMasyarakat, 'prodis' => $prodis, 'users' => $user]);
        } elseif ($usr_role === 'admin') {
            return view('admin.pengabdian.index', ['pengabdian' => $pengabdianMasyarakat, 'prodis' => $prodis, 'users' => $user]);
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
        $prodis = Prodi::pluck('prd_nama');
        $user = User::pluck('usr_nama');

        $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

        // Tentukan view berdasarkan peran pengguna
        if ($usr_role === 'karyawan') {
            return view('karyawan.pengabdian.create', ['prodis' => $prodis, 'users' => $user]);
        } elseif ($usr_role === 'admin') {
            return view('admin.pengabdian.create', ['prodis' => $prodis, 'users' => $user]);
        } else {
            // Handle jika peran tidak teridentifikasi
            return abort(403, 'Unauthorized action.');
        }  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePengabdianMasyarakatRequest  $request
     * @return \Illuminate\Http\Response
     */

    public function store(StorePengabdianMasyarakatRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('pkm_buktipendukung')) {
            $pkm_buktipendukung = $request->file('pkm_buktipendukung');
            $nama_buktipendukung = $pkm_buktipendukung->getClientOriginalName(); // Gunakan nama asli file

            $pkm_buktipendukung->move('files/', $nama_buktipendukung);
            $validatedData['pkm_buktipendukung'] = 'files/' . $nama_buktipendukung; // Simpan path file dalam database
        }

        if ($pengabdian = PengabdianMasyarakat::create($validatedData)){

            // Dapatkan ID prodi dari input form
            $prodiId = $request->input('prodi_id');

            // Simpan relasi dengan satu program studi
            $pengabdian->prodi()->associate($prodiId);
            $pengabdian->save();

            $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

            // Tentukan view berdasarkan peran pengguna
            if ($usr_role === 'karyawan') {
                return redirect(route('karyawan.pengabdian.index'))->with('success', 'Data Berhasil Disimpan!');
            } elseif ($usr_role === 'admin') {
                return redirect(route('admin.pengabdian.index'))->with('success', 'Data Berhasil Disimpan!');
            } else {
                // Handle jika peran tidak teridentifikasi
                return abort(403, 'Unauthorized action.');
            }  
           
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PengabdianMasyarakat  $pengabdianMasyarakat
     * @return \Illuminate\Http\Response
     */
    public function show(PengabdianMasyarakat $pengabdianMasyarakat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PengabdianMasyarakat  $pengabdianMasyarakat
     * @return \Illuminate\Http\Response
     */
    public function edit(PengabdianMasyarakat $pengabdianMasyarakat)
    {
        return view('admin.pengabdian.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePengabdianMasyarakatRequest  $request
     * @param  \App\Models\PengabdianMasyarakat  $pengabdianMasyarakat
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePengabdianMasyarakatRequest $request, PengabdianMasyarakat $pengabdianMasyarakat)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PengabdianMasyarakat  $pengabdianMasyarakat
     * @return \Illuminate\Http\Response
     */
    public function destroy($pkm_id)
    {
        try {
            $pkm = PengabdianMasyarakat::findOrFail($pkm_id);

            if ($pkm) {
                $pkm->delete();
                return redirect(route('admin.pengabdian.index'))->with('success', 'Pengabdian berhasil dihapus!');
            } else {
                return redirect(route('admin.pengabdian.index'))->with('error', 'Pengabdian tidak ditemukan.');
            }
        } catch (\Exception $e) {
            return redirect(route('admin.pengabdian.index'))->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // public function search(Request $request)
    // {
    //     $usr_role = Auth::user()->usr_role;

    //     // Check if the user has admin role
    //     if ($usr_role === 'admin') {
    //         if ($request->has('search')) {

    //             $searchTerm = $request->search;
    //             // Perform the search based on the provided term
    //             $pengabdianMasyarakat = PengabdianMasyarakat::where('pkm_namakegiatan', 'LIKE', '%' . $searchTerm . '%')->get();
    //         }
    
    //         $prodis = Prodi::pluck('prd_nama');
    //         $user = User::pluck('usr_nama');
    
    //         // Return the view with the search results
    //         return view('admin.pengabdian.index', ['pengabdian' => $pengabdianMasyarakat ?? [], 'prodis' => $prodis, 'users' => $user]);
    //     } else {
    //         // Handle unauthorized access for non-admin users
    //         return abort(403, 'Unauthorized action.');
    //     }
    // }

}
