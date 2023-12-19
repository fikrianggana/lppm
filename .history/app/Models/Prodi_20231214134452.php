<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $fillable = [
        'prd_nama',
    ];

    public function pengguna()
    {
        return $this -> hasMany(Pengguna::class);
    }

    public function pengabdianMasyarakat(){
        return $this-> belongsTaaaoMany(PengabdianMasyarakat::class);
    }
}
