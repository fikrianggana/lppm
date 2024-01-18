<?php

namespace App\Exports;

use App\Models\PengabdianMasyarakat;
use Maatwebsite\Excel\Concerns\FromCollection;

class PengabdianExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PengabdianMasyarakat::all();
    }
    
}
