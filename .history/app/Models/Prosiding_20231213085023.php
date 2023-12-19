<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prosiding extends Model
{
    use HasFactory;

    protected $primaryKey = 'bku_id'; // Tetapkan primary key
    public $incrementing = false; // Set agar tidak dianggap auto-increment
    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->bku_id) {
                $latestId = static::max('bku_id');
                $nextId = $latestId ? (int)substr($latestId, 3) + 1 : 1;
                $model->bku_id = 'BKU' . sprintf("%03s", $nextId);
            }
        });
    }

    protected $fillable = [
        'pro_id',
        'pro_namapenulis',
        'pro_judulprogram',
        'pro_judulpaper',
        'pro_kategori',
        'pro_penyelenggara',
        'pro_waktuterbit',
        'pro_tempatpelaksanaan',
        'pro_keterangan',
        'pgn_id',
    ];

    public function pengguna()
    {
        return $this -> hasMany(Pengguna::class);
    }
}