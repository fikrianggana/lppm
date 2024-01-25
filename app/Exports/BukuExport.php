<?php

	namespace App\Exports;

	use App\Models\Buku;
	use Illuminate\Support\Collection;
	use Maatwebsite\Excel\Concerns\FromCollection;
	use Maatwebsite\Excel\Concerns\ShouldAutoSize;
	use Maatwebsite\Excel\Concerns\WithHeadings;
	use Maatwebsite\Excel\Concerns\WithStyles;
	use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BukuExport implements FromCollection, ShouldAutoSize, WithHeadings, WithStyles
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

        // Select only the columns you want to export
        $data = $query->select('bku_judul', 'bku_penulis', 'bku_editor', 'bku_isbn', 'bku_penerbit', 'bku_tahun')->get();

        // Add a 'No' column to the collection
        $dataWithNo = $data->map(function ($item, $key) {
            return [
                'No' => $key + 1,
                'Judul Buku' => $item->bku_judul,
                'Penulis' => $item->bku_penulis,
                'Editor' => $item->bku_editor,
                'ISBN' => $item->bku_isbn,
                'Penerbit' => $item->bku_penerbit,
                'Tahun' => $item->bku_tahun,
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
			'Judul Buku',
			'Penulis',
			'Editor',
			'ISBN',
			'Penerbit',
			'Tahun',
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