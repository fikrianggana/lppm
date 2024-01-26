<?php

namespace App\Exports;

use App\Models\PengajuanSuratTugas;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SuratTugasExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
	protected $searchQuery;

	public function __construct($searchQuery)
	{
		$this->searchQuery = $searchQuery;
	}

	/**
	 * @return \Illuminate\Support\Collection
	 */
	public function collection()
	{
		// Filter data based on the search query
		$data = PengajuanSuratTugas::where('status', 4)
			->where(function ($query) {
			$query->where('pst_namasurattugas', 'like', "%{$this->searchQuery}%")
				->orWhere('pst_masapelaksanaan', 'like', "%{$this->searchQuery}%")
				->orWhere('pst_buktipendukung', 'like', "%{$this->searchQuery}%")
				->orWhere('status', 'like', "%{$this->searchQuery}%")
				->orWhere('surattugas', 'like', "%{$this->searchQuery}%");
		})
		->get();

		return $data;
	}

			/**
			 * @var PengajuanSuratTugas $item
			 */
	public function map($item): array
	{
		return [
			$item->user->usr_nama,
			$item->pst_namasurattugas,
			$item->pst_masapelaksanaan,
			URL::to($item->pst_buktipendukung),
			URL::to($item->surattugas),
		];
	}

	/**
	 * @return array
	 */
	public function headings(): array
	{
		return [
		    'Nama User',
			'Nama Surat Tugas',
			'Masa Pelaksanaan',
			'Bukti Pendukung',
			'Surat Tugas',
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