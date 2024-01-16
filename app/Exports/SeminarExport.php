<?php

namespace App\Exports;

use App\Models\Seminar;
use Maatwebsite\Excel\Concerns\FromCollection;

class SeminarExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Seminar::all();
    }
}
