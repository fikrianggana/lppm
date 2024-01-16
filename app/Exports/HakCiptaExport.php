<?php

namespace App\Exports;

use App\Models\HakCipta;
use Maatwebsite\Excel\Concerns\FromCollection;

class HakCiptaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return HakCipta::all();
    }
}
