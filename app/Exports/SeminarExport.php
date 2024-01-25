<?php

namespace App\Exports;

use App\Models\Seminar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class SeminarExport implements FromCollection, ShouldAutoSize, WithHeadings, WithStyles
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
        $query = Seminar::query();

        if ($this->search) {
            $query->where(function ($query) {
                $query->where('smn_namapenulis', 'like', "%{$this->search}%")
                ->orWhere('smn_kategori', 'like', "%{$this->search}%")
                ->orWhere('smn_penyelenggara', 'like', "%{$this->search}%")
                ->orWhere('smn_waktu', 'like', "%{$this->search}%")
                ->orWhere('smn_tempatpelaksaan', 'like', "%{$this->search}%")
                ->orWhere('smn_keterangan', 'like', "%{$this->search}%");
            });
        }

        // Select only the columns you want to export
        $data = $query->select('smn_namapenulis', 'smn_kategori', 'smn_penyelenggara', 'smn_waktu', 'smn_tempatpelaksaan', 'smn_keterangan')->get();

        // Add a 'No' column to the collection
        $dataWithNo = $data->map(function ($item, $key) {
            return [
                $key + 1,
                $item->smn_namapenulis,
                $item->smn_kategori,
                $item->smn_penyelenggara,
                $item->smn_waktu,
                $item->smn_tempatpelaksaan,
                $item->smn_keterangan,
            ];
        });

        return $dataWithNo;
    }

	/**
	 * @return array
	 */
	public function headings(): array
	{
		return [
			// 'Id Buku',
            'No',
			'Nama Penulis',
			'Kategori',
			'Penyelenggara',
			'Waktu',
			'Tempat Pelaksanaan',
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
