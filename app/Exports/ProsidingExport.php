<?php

namespace App\Exports;

use App\Models\Prosiding;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProsidingExport implements FromCollection, ShouldAutoSize, WithHeadings, WithStyles
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
        $query = Prosiding::query();

        if ($this->search) {
            $query->where(function ($query) {
                $query->where('pro_namapenulis', 'like', "%{$this->search}%")
                  ->orWhere('pro_judulprogram', 'like', "%{$this->search}%")
                  ->orWhere('pro_judulpaper', 'like', "%{$this->search}%")
                  ->orWhere('pro_kategori', 'like', "%{$this->search}%")
                  ->orWhere('pro_penyelenggara', 'like', "%{$this->search}%")
                  ->orWhere('pro_waktuterbit', 'like', "%{$this->search}%")
                  ->orWhere('pro_tempatpelaksanaan', 'like', "%{$this->search}%")
                  ->orWhere('pro_keterangan', 'like', "%{$this->search}%");
            });
        }

        // Select only the columns you want to export
        $data = $query->select('pro_namapenulis', 'pro_judulprogram', 'pro_judulpaper', 'pro_kategori', 'pro_penyelenggara',
                            'pro_waktuterbit', 'pro_tempatpelaksanaan', 'pro_keterangan')->get();

        // Add a 'No' column to the collection
        $dataWithNo = $data->map(function ($item, $key) {
            return [
                $key + 1,
                $item->pro_namapenulis,
                $item->pro_judulprogram,
                $item->pro_judulpaper,
                $item->pro_kategori,
                $item->pro_penyelenggara,
                $item->pro_waktuterbit,
                $item->pro_tempatpelaksanaan,
                $item->pro_keterangan,
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
			'Judul Program',
			'Judul Paper',
			'Kategori',
			'Penelengara',
            'Waktu Terbit',
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
