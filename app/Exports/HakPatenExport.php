<?php

namespace App\Exports;

use App\Models\HakPaten;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
	use Maatwebsite\Excel\Concerns\WithStyles;
	use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class HakPatenExport implements FromCollection, ShouldAutoSize, WithHeadings, WithStyles
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
        $query = HakPaten::query();

        if ($this->search) {
            $query->where(function ($query) {
                $query->where('hpt_namalengkap', 'like', "%{$this->search}%")
                ->orWhere('hpt_judul', 'like', "%{$this->search}%")
                ->orWhere('hpt_nopemohonan', 'like', "%{$this->search}%")
                ->orWhere('hpt_tglpenerimaan', 'like', "%{$this->search}%")
                ->orWhere('hpt_status', 'like', "%{$this->search}%");
            });
        }

        // Select only the columns you want to export
        $data = $query->select('hpt_namalengkap', 'hpt_judul', 'hpt_nopemohonan', 'hpt_tglpenerimaan', 'hpt_status')->get();

        // Add a 'No' column to the collection
        $dataWithNo = $data->map(function ($item, $key) {
            return [
                'No' => $key + 1,
                'Nama Lengkap' => $item->hpt_namalengkap,
                'Judul' => $item->hpt_judul,
                'No Pemohon' => $item->hpt_nopemohonan,
                'Tanggal Penerimaan' => $item->hpt_tglpenerimaan,
                'Status' => $item->hpt_status,
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
			'Nama Lengkap',
			'Judul',
			'No Pemohon',
			'Tanggal Penerimaan',
			'Status',
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
