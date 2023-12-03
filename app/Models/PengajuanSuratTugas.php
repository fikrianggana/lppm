<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSuratTugas extends Model
{
    use HasFactory;

    protected $fillable = [
        'pst_id',
        'pst_namapengaju',
        'pst_namasurattugas',
        'pst_masapelaksanaan',
        'pst_buktipendukung',
    ];

    public function pengguna()
    {
        return $this -> hasMany(Pengguna::class);
    }
}
