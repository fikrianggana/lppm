<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seminar extends Model
{
    use HasFactory;

    protected $primaryKey = 'smn_id'; // Tetapkan primary key
    public $incrementing = false; // Set agar tidak dianggap auto-increment

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->smn_id) {
                $latestId = static::max('smn_id');
                $nextId = $latestId ? (int)substr($latestId, 3) + 1 : 1;
                $model->smn_id = 'SMN' . sprintf("%03s", $nextId);
            }
        });
    }

    protected $fillable = [
        'smn_id',
        'smn_namapenulis',
        'smn_kategori',
        'smn_penyelenggara',
        'smn_waktu',
        'smn_tempatpelaksaan',
        'smn_keterangan',
        'pgn_id',
    ];

    public function pengguna()
    {
        return $this -> hasMany(Pengguna::class);
    }
}
