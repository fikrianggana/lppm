<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'bk_id',
        'bk_judul',
        'bk_penulis',
        'bk_editor',
        'bk_isbn',
        'bk_penerbit',
        'bk_tahun',
        'pgn_id',
    ];

    public function pengguna()
    {
        return $this -> hasMany(Pengguna::class);
    }
}
