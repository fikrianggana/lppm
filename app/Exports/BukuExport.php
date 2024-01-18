<?php

namespace App\Exports;

use App\Models\Buku;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BukuExport implements FromCollection, ShouldAutoSize
{
    protected $search;

    public function __construct($search)
    {
        $this->search = $search;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = Buku::query();

        if ($this->search) {
            $query->where(function ($query) {
                $query->where('bku_tahun', 'like', "%{$this->search}%")
                    ->orWhere('bku_judul', 'like', "%{$this->search}%")
                    ->orWhere('bku_penulis', 'like', "%{$this->search}%")
                    ->orWhere('bku_editor', 'like', "%{$this->search}%")
                    ->orWhere('bku_isbn', 'like', "%{$this->search}%")
                    ->orWhere('bku_penerbit', 'like', "%{$this->search}%");
            });
        }

        return $query->get();
    }
}
