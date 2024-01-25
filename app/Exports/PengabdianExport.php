<?php

namespace App\Exports;

use App\Models\PengabdianMasyarakat;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PengabdianExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
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
        $query = PengabdianMasyarakat::query();

        if ($this->search) {
            $query->where(function ($query) {
                $query->where('pkm_namakegiatan', 'like', "%{$this->search}%")
                ->orWhere('pkm_jenis', 'like', "%{$this->search}%")
                ->orWhere('pkm_waktupelaksanaan', 'like', "%{$this->search}%")
                ->orWhere('pkm_personilterlibat', 'like', "%{$this->search}%")
                ->orWhere('pkm_jumlahpenerimamanfaat', 'like', "%{$this->search}%")
                ->orWhere('pkm_buktipendukung', 'like', "%{$this->search}%")
                ->orWhere('pkm_mahasiswa', 'like', "%{$this->search}%");
            });
        }

        // Select only the columns you want to export
        $data = $query->select('pkm_namakegiatan', 'pkm_jenis', 'pkm_waktupelaksanaan', 'pkm_personilterlibat', 'pkm_jumlahpenerimamanfaat', 
                            'pkm_buktipendukung', 'pkm_mahasiswa')->get();

        // Add a 'No' column to the collection
        $dataWithNo = $data->map(function ($item, $key) {
            return [
                'No' => $key + 1,
                'Nama Kegiatan' => $item->pkm_namakegiatan,
                'Jenis' => $item->pkm_jenis,
                'Waktu Pelaksanaan' => $item->pkm_waktupelaksanaan,
                'Personil Terlibat' => $item->pkm_personilterlibat,
                'Jumlah Penerima Manfaat' => $item->pkm_jumlahpenerimamanfaat,
                URL::to($item->pkm_buktipendukung),
                'Mahasiswa' => $item->pkm_mahasiswa,
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
			'Nama Kegiatan',
			'Jenis',
			'Waktu Pelaksanaan',
			'Personil Terlibat',
			'Jumlah Penerima Manfaat',
			'Bukti Pendukung',
            'Mahasiswa',
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
