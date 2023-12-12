<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HakPaten extends Model
{
    use HasFactory;

    protected $primaryKey = 'hpt_id'; // Tetapkan primary key
    public $incrementing = false; // Set agar tidak dianggap auto-increment

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->hpt_id) {
                $latestId = static::max('hpt_id');
                $nextId = $latestId ? (int)substr($latestId, 3) + 1 : 1;
                $model->hpt_id = 'HPT' . sprintf("%03s", $nextId);
            }
        });
    }

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
        return $this->belongsTo(Pengguna::class, 'pgn_id', 'id');
    }
}
