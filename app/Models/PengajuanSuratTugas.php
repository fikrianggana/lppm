<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Collection;

class PengajuanSuratTugas extends Model
{

   use HasFactory;

    protected $primaryKey = 'pst_id'; // Tetapkan primary key
    public $incrementing = false; // Set agar tidak dianggap auto-increment

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->pst_id) {
                $latestId = static::max('pst_id');
                $nextId = $latestId ? (int)substr($latestId, 3) + 1 : 1;
                $model->pst_id = 'PST' . sprintf("%03s", $nextId);
            }
        });
    }

    protected $fillable = [
        'pst_id',
        'usr_id',
        'pst_namasurattugas',
        'pst_masapelaksanaan',
        'pst_buktipendukung',
        'status',
        'inputby',
        'editby',
        'surattugas',
        'namafile',
        'namafilesurat',
        'keterangan',
        'tanggalselesai',
        'surattugas',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'usr_id');
    }
    public function detialSurat(){
        return $this->hasMany(DetailPengajuanSuratTugas::class);
    }

    // Model PengajuanSuratTugas
    public function involvedUsers()
    {
        return $this->hasMany(DetailPengajuanSuratTugas::class, 'pengaju_id', 'pst_id')
            ->join('users', 'detail_surat_tugas.usr_id', '=', 'users.usr_id')
            ->pluck('users.usr_nama', 'users.usr_id');
    }

}
