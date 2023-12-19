<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prosiding extends Model
{
    use HasFactory;


    
    protected $fillable = [
        'pro_id',
        'pro_namapenulis',
        'pro_judulprogram',
        'pro_judulpaper',
        'pro_kategori',
        'pro_penyelenggara',
        'pro_waktuterbit',
        'pro_tempatpelaksanaan',
        'pro_keterangan',
        'pgn_id',
    ];

    public function pengguna()
    {
        return $this -> hasMany(Pengguna::class);
    }
}
