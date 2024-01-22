<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    static::creating(function ($model) {
        if (!$model->pkm_id) {
            $latestId = static::max('pkm_id');
            $nextId = $latestId ? (int)substr($latestId, 3) + 1 : 1;
            $model->pkm_id = 'PKM' . sprintf("%03s", $nextId);
        }
    });
}
