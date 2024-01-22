<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $primaryKey = 'pdn_id'; // Tetapkan primary key
    public $incrementing = false; // Set agar tidak dianggap auto-increment

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->pdn_)) {
                $latestId = static::max('pkm_id');
                $nextId = $latestId ? (int)substr($latestId, 3) + 1 : 1;
                $model->pkm_id = 'PKM' . sprintf("%03s", $nextId);
            }
        });
    }

}
