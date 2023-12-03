<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HakPaten extends Model
{
    use HasFactory;

    protected $fillable = [
        'hpt_id',
        'hpt_namalengkap',
        'hpt_judul',
        'hpt_nopemohonan',
        'hpt_tglpelaksanaan',
        'hpt_tglpenerimaan',
        'hpt_status',
        'pgn_id'
    ];

    public function pengguna()
    {
        return $this -> hasMany(Pengguna::class);
    }
}
