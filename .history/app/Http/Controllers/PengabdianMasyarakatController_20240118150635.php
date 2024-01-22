<?php

namespace App\Http\Controllers;

use App\Exports\PengabdianExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PengabdianMasyarakat;
use App\Models\Prodi;
use App\Models\User;
use App\Http\Requests\StorePengabdianMasyarakatRequest;
use App\Http\Requests\UpdatePengabdianMasyarakatRequest;
use Carbon;
use Maatwebsite\Excel\Facades\Excel;

class PengabdianMasyarakatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Pengabdian Masyarakat';
        $pengabdianMasyarakat = PengabdianMasyarakat::all();
        $prodis = Prodi::pluck('prd_nama');
        $user = User::pluck('usr_nama');

        $query = $request->get('search');
        $search = PengabdianMasyarakat::where(function ($query) use ($request) {
            $query->where('pkm_namakegiatan', 'like', "%{$request->search}%")
                ->orWhere('pkm_jenis', 'like', "%{$request->search}%")
                ->orWhere('pkm_waktupelaksanaan', 'like', "%{$request->search}%")
                ->orWhere('pkm_personilterlibat', 'like', "%{$request->search}%")
                ->orWhere('pkm_jumlahpenerimamanfaat', 'like', "%{$request->search}%")
                ->orWhere('pkm_buktipendukung', 'like', "%{$request->search}%")
                ->orWhere('pkm_mahasiswa', 'like', "%{$request->search}%");
        })
        ->get();

        $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

        // Berdasarkan peran, tentukan view yang akan digunakan
        if ($usr_role === 'karyawan') {
            return view('karyawan.pengabdian.index', compact('title'),['pengabdian' => $search, 'prodis' => $prodis, 'users' => $user]);
        } elseif ($usr_role === 'admin') {
            return view('admin.pengabdian.index', compact('title'),['pengabdian' => $search, 'prodis' => $prodis, 'users' => $user]);
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
        $title = 'Pengabdian Masyarakat';
        $prodis = Prodi::pluck('prd_nama');
        $user = User::pluck('usr_nama');

        $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

        // Tentukan view berdasarkan peran pengguna
        if ($usr_role === 'karyawan') {
            return view('karyawan.pengabdian.create', compact('title'),['prodis' => $prodis, 'users' => $user]);
        } elseif ($usr_role === 'admin') {
            return view('admin.pengabdian.create', compact('title'),['prodis' => $prodis, 'users' => $user]);
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
    public function edit(PengabdianMasyarakat $pengabdianMasyarakat, $pkm_id)
    {
        $pkm = PengabdianMasyarakat::findOrFail($pkm_id);
        $title = 'Edit Pengabdian Masyarakat';
        $prodis = Prodi::pluck('prd_nama');
        $user = User::pluck('usr_nama', 'usr_id'); // Sesuaikan dengan nama kolom
        $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

        // Tentukan view berdasarkan peran pengguna dan kirim data pengajuan yang akan diedit
        if ($usr_role === 'karyawan') {
            return view('karyawan.pengabdian.edit', compact('title', 'pengabdianMasyarakat'), ['users' => $user, 'pkm' => $pkm]);
        } elseif ($usr_role === 'admin') {
            return view('admin.pengabdian.edit', compact('title', 'pengabdianMasyarakat'), ['users' => $user, 'pkm' => $pkm]);
        } else {
            // Handle jika peran tidak teridentifikasi
            return abort(403, 'Unauthorized action.');
        }
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

    public function pengabdianexport(){
        return Excel::download(new PengabdianExport, 'Laporan_Pengabdian_Masyarakat.xlsx');
    }

}
