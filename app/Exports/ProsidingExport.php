<?php

namespace App\Exports;

use App\Models\Prosiding;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProsidingExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Prosiding::all();
    }
}
