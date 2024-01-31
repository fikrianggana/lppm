<?php

namespace App\Exports;

use App\Models\Prodi;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProdiExport implements FromCollection
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
        $query = Prodi::query();

        if ($this->search) {
            $query->where(function ($query) {
                $query->where('prd_nama', 'like', "%{$this->search}%")
                    ->orWhere('pdn_jenis', 'like', "%{$this->search}%")
                    ->orWhere('keterangan', 'like', "%{$this->search}%")
                    ->orWhere('usr_id', 'like', "%{$this->search}%");
            });
        }

        // Add a condition for the status (assuming 'status' is the column name)
        $query->where('status', 2);

        // Select only the columns you want to export
        $data = $query->with('user')->select('pdn_tipe', 'pdn_jenis', 'keterangan', 'usr_id')->get();

        // Add a 'No' column to the collection
        $dataWithNo = $data->map(function ($item, $key) {
            return [
                $key + 1,
                $item->user->usr_nama,
                $item->pdn_tipe,
                $item->pdn_jenis,
                $item->keterangan,

            ];
        });

        return $dataWithNo;
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Pengadu',
            'Tipe Pengaduan',
            'Jenis Pengaduan',
            'Keterangan',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}
