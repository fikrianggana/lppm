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
                $query->where('prd_nama', 'like', "%{$this->search}%");
            });
        }

        // Select only the columns you want to export
        $data = $query->select('prd_nama')->get();

        // Add a 'No' column to the collection
        $dataWithNo = $data->map(function ($item, $key) {
            return [
                'No' => $key + 1,
                'Nama Prodi' => $item->prd_nama,
                'Nama Jurnal' => $item->jrn_namajurnal,
                'Nama Personil' => $item->jrn_namapersonil,
                'ISSN' => $item->jrn_issn,
                'Volume' => $item->jrn_volume,
                'Nomor' => $item->jrn_nomor,
                'Halaman Awal' => $item->jrn_halamanawal,
                'Halaman Akhir' => $item->jrn_halamanakhir,
                'URL' => $item->jrn_url,
                'Kategori' => $item->jrn_kategori,
                'Nama User' => $item->user->usr_nama,
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
            'No',
			'Judul Makalah',
            'Nama Jurnal',
            'Nama Personil',
            'ISSN',
            'Volume',
            'Nomor',
            'Halaman Awal',
            'Halaman Akhir',
            'URL',
            'Kategori',
            'Nama User',
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
