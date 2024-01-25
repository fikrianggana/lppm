<?php

namespace App\Exports;

use App\Models\HakCipta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class HakCiptaExport implements FromCollection, ShouldAutoSize, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return HakCipta::all();
    // }

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
        $query = HakCipta::query();

        if ($this->search) {
            $query->where(function ($query) {
                $query->where('hcp_namalengkap', 'like', "%{$this->search}%")
                ->orWhere('hcp_judul', 'like', "%{$this->search}%")
                ->orWhere('hcp_noapk', 'like', "%{$this->search}%")
                ->orWhere('hcp_sertifikat', 'like', "%{$this->search}%")
                ->orWhere('hcp_keterangan', 'like', "%{$this->search}%");
            });
        }

        // Select only the columns you want to export
        $data = $query->select('hcp_namalengkap', 'hcp_judul', 'hcp_noapk', 'hcp_sertifikat', 'hcp_keterangan')->get();

        // Add a 'No' column to the collection
        $dataWithNo = $data->map(function ($item, $key) {
            return [
                'No' => $key + 1,
                'Nama Lengkap' => $item->hcp_namalengkap,
                'Judul' => $item->hcp_judul,
                'No Aplikasi' => $item->hcp_noapk,
                'Sertifikat' => $item->hcp_sertifikat,
                'Keterangan' => $item->hcp_keterangan,
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
			'No Aplikasi',
			'Sertifikat',
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
