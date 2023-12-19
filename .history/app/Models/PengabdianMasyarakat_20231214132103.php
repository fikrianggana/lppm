<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengabdianMasyarakat extends Model
{
    use HasFactory;

    protected $primaryKey = 'pkm_id'; // Tetapkan primary key
    public $incrementing = false; // Set agar tidak dianggap auto-increment

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->pkm_id) {
                $latestId = static::max('pkm_id');
                $nextId = $latestId ? (int)substr($latestId, 3) + 1 : 1;
                $model->pkm_id = 'PKM' . sprintf("%03s", $nextId);
            }
        });
    }

    protected $fillable = [
        'pkm_id',
        'pkm_namakegiatan',
        'pkm_jenis',
        'pkm_waktupelaksanaan',
        'pkm_personilterlibat',
        'pkm_jumlahpenerimamanfaat',
        'pkm_buktipendukung',
        'pkm_mahasiswa',
        'pkm_nim',
        'prd_id',
    ];

    public function pengguna()
    {
        return $this -> hasMany(Pengguna::class);
    }

    public function prodi()
}
