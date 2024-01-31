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
			'Nama Prodi',
		];
	}

	public function styles(Work $sheet)
	{
		return [
			// Style the first row as bold text.
			1    => ['font' => ['bold' => true]],
		];
	}
}
