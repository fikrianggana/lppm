<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $primaryKey = 'bk_id'; // Tetapkan primary key
    public $incrementing = false; // Set agar tidak dianggap auto-increment

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->bk_id) {
                $latestId = static::max('bk_id');
                $nextId = $latestId ? (int)substr($latestId, 3) + 1 : 1;
                $model->bk_id = '' . sprintf("%03s", $nextId);
            }
        });
    }

    protected $fillable = [
        'bk_id',
        'bk_judul',
        'bk_penulis',
        'bk_editor',
        'bk_isbn',
        'bk_penerbit',
        'bk_tahun',
        'pgn_id',
    ];

    public function pengguna()
    {
        return $this -> hasMany(Pengguna::class);
    }
}
