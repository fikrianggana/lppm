<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengabdianMasyarakat extends Model
{
    use HasFactory;

    protected $fillable = [
        'pkm_id',
        'pkm_namakegiatan',
        'pkm_jenis',
        'pkm_waktupelaksanaan',
        'pkm_personilterlibat',
        'pkm_jumlahpenerimamanfaat',
        'pkm_buktipendukung',
    ];

    public function pengguna()
    {
        return $this -> hasMany(Pengguna::class);
    }
}
