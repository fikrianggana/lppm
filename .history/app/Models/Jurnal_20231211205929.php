<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    use HasFactory;

    protected $primaryKey = 'jrn_id'; // Tetapkan primary key
    public $incrementing = false; // Set agar tidak dianggap auto-increment

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->jrn_id) {
                $latestId = static::max('hpt_id');
                $nextId = $latestId ? (int)substr($latestId, 3) + 1 : 1;
                $model->hpt_id = 'HPT' . sprintf("%03s", $nextId);
            }
        });
    }

    protected $fillable = [
        'jrn_id',
        'jrn_judulmakalah',
        'jrn_namajurnal',
        'jrn_namapersonil',
        'jrn_issn',
        'jrn_volume',
        'jrn_nomor',
        'jrn_halamanawal',
        'jrn_halamanakhir',
        'jrn_url',
        'jrn_kategori',
        'pgn_id',
        'jrn_atribut',
    ];

    public function pengguna()
    {
        return $this -> hasMany(Pengguna::class);
    }
}
