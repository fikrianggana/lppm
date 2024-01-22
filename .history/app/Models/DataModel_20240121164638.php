// app/Models/DataModel.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataModel extends Model
{a
    protected $fillable = [
        'Id',
        'Nama',
    ];

    // ... Anda dapat menambahkan metode atau atribut tambahan sesuai kebutuhan
}
