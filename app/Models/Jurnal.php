<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    use HasFactory;

    protected $fillable = [
        'jrn_id',
        'jrn_judulmakalah',
        'jrn_namajurnal',
        'jrn_namapersonil',
        'jrn_issn',
        'jrn_volume',
        'jrn_nomor',
        'jrn_halamanawal',
        'jrn_halamanakhir',
        'jrn_url',
        'jrn_kategori',
        'pgn_id',
        'jrn_atribut',
    ];

    public function pengguna()
    {
        return $this -> hasMany(Pengguna::class);
    }
}
