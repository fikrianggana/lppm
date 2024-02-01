<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPengajuanSuratTugas extends Model
{
    use HasFactory;

    protected $table = 'detail_surat_tugas';
    protected $primaryKey = 'id'; // Tetapkan primary key
    
    protected $fillable = [
        'pengaju_id',
        'usr_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'usr_id');
    }
    public function pengajuanSurat()
    {
        return $this->belongsTo(PengajuanSuratTugas::class, 'pst_id');
    }
}
