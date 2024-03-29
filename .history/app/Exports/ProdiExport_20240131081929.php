namespace App\Exports;

use App\Models\Prodi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProdiExport implements FromCollection, WithHeadings, WithStyles
{
    protected $search;

    public function __construct($search)
    {
        $this->search = $search;
    }

    public function collection()
    {
        $query = Prodi::query();

        if ($this->search) {
            $query->where('prd_nama', 'like', "%{$this->search}%");
        }

        // Select only the columns you want to export
        $data = $query->get(['prd_nama']);

        // Add a 'No' column to the collection
        $dataWithNo = $data->map(function ($item, $key) {
            return [
                'No' => $key + 1,
                'Nama Prodi' => $item->prd_nama,
            ];
        });

        return $dataWithNo;
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Prodi',
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
