<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataModel extends Model
{
    protected $fillable = [
        'id',
        'nama',
    ];

    // ... Anda dapat menambahkan metode atau atribut tambahan sesuai kebutuhan
}
