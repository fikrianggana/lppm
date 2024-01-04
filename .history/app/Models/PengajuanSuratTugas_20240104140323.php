<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSuratTugas extends Model
{

   use HasFactory;

    protected $primaryKey = 'pst_id'; // Tetapkan primary key
    public $incrementing = false; // Set agar tidak dianggap auto-increment

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->pst_id) {
                $latestId = static::max('pkm_id');
                $nextId = $latestId ? (int)substr($latestId, 3) + 1 : 1;
                $model->pkm_id = 'PKM' . sprintf("%03s", $nextId);
            }
        });
    }

    protected $fillable = [
        'pst_id',
        'pst_namapengaju',
        'pst_namasurattugas',
        'pst_masapelaksanaan',
        'pst_buktipendukung',
    ];

    public function pengguna()
    {
        return $this -> hasMany(Pengguna::class);
    }
}
