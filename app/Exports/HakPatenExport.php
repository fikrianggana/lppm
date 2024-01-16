<?php

namespace App\Exports;

use App\Models\HakPaten;
use Maatwebsite\Excel\Concerns\FromCollection;

class HakPatenExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return HakPaten::all();
    }
}
