<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seminar extends Model
{
    use HasFactory;

    protected $fillable = [
        'smn_id',
        'smn_namapenulis',
        'smn_kategori',
        'smn_penyelenggara',
        'smn_waktu',
        'smn_tempatpelaksaan',
        'smn_keterangan',
        'pgn_id',
        'smn_atribut',
    ];

    public function pengguna()
    {
        return $this -> hasMany(Pengguna::class);
    }
}
