<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prosiding extends Model
{
    use HasFactory;

    protected $primaryKey = 'pro_id'; // Tetapkan primary key
    public $incrementing = false; // Set agar tidak dianggap auto-increment
    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->pro_id) {
                $latestId = static::max('pro_id');
                $nextId = $latestId ? (int)substr($latestId, 3) + 1 : 1;
                $model->pro_id = 'PRO' . sprintf("%03s", $nextId);
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
        'usr_id',
    ];

    public function pengguna()
    {
        return $this -> hasMany(Pengguna::class);
    }
}
