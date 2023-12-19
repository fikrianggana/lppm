<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HakCipta extends Model
{
    use HasFactory;

    $validatedData = $request->validated();
if ($hakPaten = HakPaten::create($validatedData)){
    return redirect()->route('karyawan.publikasi.hakpaten.index')->with(['success' => 'Data Berhasil Disimpan!']);
}

    protected $fillable = [
        'hcp_id',
        'hcp_namalengkap',
        'hcp_judul',
        'hcp_noapk',
        'hcp_sertifikat',
        'hcp_keterangan',
        'pgn_id',
    ];

    public function pengguna()
    {
        return $this -> hasMany(Pengguna::class);
    }
}
