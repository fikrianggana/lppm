<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $primaryKey = 'jrn_id'; // Tetapkan primary key
    public $incrementing = false; // Set agar tidak dianggap auto-increment

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->bku_id) {
                $latestId = static::max('jrn_id');
                $nextId = $latestId ? (int)substr($latestId, 3) + 1 : 1;
                $model->jrn_id = 'JRN' . sprintf("%03s", $nextId);
            }
        });
    }

    protected $fillable = [
        'bku_id',
        'bku_judul',
        'bku_penulis',
        'bku_editor',
        'bku_isbn',
        'bku_penerbit',
        'bku_tahun',
        'pgn_id',
    ];

    public function pengguna()
    {
        return $this -> hasMany(Pengguna::class);
    }
}
