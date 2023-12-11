<?php

namespace App\Http\Controllers;

use App\Models\PengabdianMasyarakat;
use App\Http\Requests\StorePengabdianMasyarakatRequest;
use App\Http\Requests\UpdatePengabdianMasyarakatRequest;

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
    use Carbon\Carbon;

    public function store(StorePengabdianMasyarakatRequest $request)
    {
        $validatedData = $request->validated();

        PengabdianMasyarakat::create([
            'pkm_id' => $request->pkm_id,
            'pkm_namakegiatan' => $request->pkm_namakegiatan,
            'pkm_jenis' => $request->pkm_jenis,
            'pkm_waktupelaksanaan' => Carbon::parse($request->pkm_waktupelaksanaan)->toDateString(),
            'pkm_personilterlibat' => $request->pkm_personilterlibat,
            'pkm_jumlahpenerimamanfaat' => $request->pkm_jumlahpenerimamanfaat,
            'pkm_buktipendukung' => $request->pkm_buktipendukung
        ]);

        return redirect()->route('karyawan.pengabdian.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
    public function destroy(PengabdianMasyarakat $pengabdianMasyarakat)
    {
        // $pkm = PengabdianMasyarakat::findOrFail($pengabdianMasyarakat);

        // if($pkm->delete())
        // {
        //     return redirect(route('karyawan.pengabdian.index'))->with('success', 'Pengabdian berhasil dihapus!');
        // }
    }
}
