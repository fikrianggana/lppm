<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HakCipta extends Model
{
    use HasFactory;

    protected $primaryKey = 'hcp_id'; // Tetapkan primary key
    public $incrementing = false; // Set agar tidak dianggap auto-increment

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->hcp_id) {
                $latestId = static::max('hcp_id');
                $nextId = $latestId ? (int)substr($latestId, 3) + 1 : 1;
                $model->bku_id = 'BKU' . sprintf("%03s", $nextId);
            }
        });
    }

    protected $fillable = [
        'hcp_id',
        'hcp_namalengkap',
        'hcp_judul',
        'hcp_noapk',
        'hcp_sertifikat',
        'hcp_keterangan',
        'pgn_id',
    ];

    public function pengguna()
    {
        return $this -> hasMany(Pengguna::class);
    }
}
