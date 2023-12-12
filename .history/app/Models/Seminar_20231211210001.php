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
            if (!$model->jrn_id) {
                $latestId = static::max('jrn_id');
                $nextId = $latestId ? (int)substr($latestId, 3) + 1 : 1;
                $model->jrn_id = 'JRN' . sprintf("%03s", $nextId);
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
        'smn_atribut',
    ];

    public function pengguna()
    {
        return $this -> hasMany(Pengguna::class);
    }
}
