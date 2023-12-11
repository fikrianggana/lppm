<?php

namespace App\Http\Controllers;

use App\Models\PengabdianMasyarakat;
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
    public function index()
    {
        $pengabdianMasyarakat = PengabdianMasyarakat::all();

        return view ('karyawan.pengabdian.index',  ['pengabdian' => $pengabdianMasyarakat]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('karyawan.pengabdian.create');
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
            return redirect()->route('karyawan.pengabdian.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        //return view('karyawan.pengabdian.create');
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
        //
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
            $pengabdian = PengabdianMasyarakat::findOrFail($pkm_id);

            if ($pengabdian->delete()) {
                return redirect(route('karyawan.pengabdian.index'))->with('success', 'Pengabdian berhasil dihapus!');
            } else {
                return redirect(route('karyawan.pengabdian.index'))->with('error', 'Gagal menghapus pengabdian.');
            }
        } catch (ModelNotFoundException $e) {
            return redirect(route('karyawan.pengabdian.index'))->with('error', 'Pengabdian tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect(route('karyawan.pengabdian.index'))->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
