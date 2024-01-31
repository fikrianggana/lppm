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
        return $this -> hasMany(User::class);
    }

    public function pengabdianMasyarakat(){
        return $this-> hasMany(PengabdianMasyarakat::class);
    }
}
