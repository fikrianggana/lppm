<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
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
        'bku_id',
        'bku_judul',
        'bku_penulis',
        'bku_editor',
        'bku_isbn',
        'bku_penerbit',
        'bku_tahun',
        'usr_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'usr_id');
    }
}
