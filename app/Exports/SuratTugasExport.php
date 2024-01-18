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

class SuratTugasExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Filter data berdasarkan status 4
        $data = PengajuanSuratTugas::where('status', 4)->get();

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

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            'A' => ['width' => 20],
            'B' => ['width' => 30],
            'C' => ['width' => 20],
            'D' => ['width' => 100],
            'E' => ['width' => 100],
        ];
    }
}
