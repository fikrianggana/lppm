<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $primaryKey = 'pdn_id'; // Tetapkan primary key
    public $incrementing = false; // Set agar tidak dianggap auto-increment

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->pdn_id) {
                $latestId = static::max('pdn_id');
                $nextId = $latestId ? (int)substr($latestId, 3) + 1 : 1;
                $model->pdn_id = 'PDN' . sprintf("%03s", $nextId);
            }
        });
    }

    protected $fillable = [
        'pdn_id',
        'pkm_namakegiatan',
        'pkm_jenis',
        'pkm_waktupelaksanaan',
        'pkm_personilterlibat',
        'pkm_jumlahpenerimamanfaat',
        'pkm_buktipendukung',
        'pkm_mahasiswa',
        'pkm_nim',
        'prodi_id',
    ];

}
