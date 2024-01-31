<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\HakPaten;
use App\Models\Jurnal;
use App\Models\PengabdianMasyarakat;
use App\Models\PengajuanSuratTugas;
use App\Models\Prosiding;
use App\Models\Seminar;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Dashboard';
        return view ('admin.dashboard.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getChartByMenu($menuName, $forOneYear = false)
    {
        $data = [];

        switch (strtolower($menuName)) {
            case "pengabdian":
                // Implementasikan metode ini untuk mendapatkan data pengabdian
                $data = $this->getPKM();
                break;
            case "surattugas":
                $data = $this->getMonthlyData();
                break;
            case "buku":
                // Implementasikan metode ini untuk mendapatkan data buku
                $data = $this->getBuku();
                break;
            case "seminar":
                // Implementasikan metode ini untuk mendapatkan data seminar
                $data = $this->getSeminar();
                break;
            case "jurnal":
                // Implementasikan metode ini untuk mendapatkan data jurnal
                $data = $this->getJurnal();
                break;
            case "prosiding":
                // Implementasikan metode ini untuk mendapatkan data prosiding
                $data = $this->getProsiding();
                break;
            case "hakcipta":
                // Implementasikan metode ini untuk mendapatkan data hak cipta
                $data = $this->getHakCipta();
                break;
            case "hakpaten":
                // Implementasikan metode ini untuk mendapatkan data hak paten
                $data = $this->getHakPaten();
                break;
            default:
                // Jika nama menu tidak dikenali, kembalikan data default
                $data = $this->getMonthlyData();
                break;
        }

        // Ambil data dari sumber data Anda, sesuaikan dengan kebutuhan
        $labels = $forOneYear
        ? array_map(function ($month) {
            return Carbon::create()->month($month)->monthName;
        }, range(1, 12))
        : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        return response()->json(['labels' => $labels, 'values' => $data]);

    }

    public function getMonthlyData()
    {
        // Ambil data bulanan dari database
        $monthlyData = [];

        // Mendapatkan tahun saat ini
        $currentYear = Carbon::now()->year;

        $list = PengajuanSuratTugas::all(); // Mengambil semua data surat tugas

        for ($month = 1; $month <= 12; $month++) {
            // Menghitung jumlah surat tugas per bulan dari database
            $startDate = Carbon::create($currentYear, $month, 1)->startOfMonth();
            $endDate = Carbon::create($currentYear, $month, 1)->endOfMonth();

            $monthlyTotal = $list
                ->where('pst_masapelaksanaan', '>=', $startDate)
                ->where('pst_masapelaksanaan', '<=', $endDate)
                ->count();

            // Menyimpan jumlah surat tugas ke dalam array
            $monthlyData[$month - 1] = $monthlyTotal;
        }

        return $monthlyData;
    }

    public function getSeminar()
    {
        // Ambil data bulanan dari database
        $monthlyData = [];

        // Mendapatkan tahun saat ini
        $currentYear = Carbon::now()->year;

        $list = Seminar::all(); // Mengambil semua data surat tugas

        for ($month = 1; $month <= 12; $month++) {
            // Menghitung jumlah surat tugas per bulan dari database
            $startDate = Carbon::create($currentYear, $month, 1)->startOfMonth();
            $endDate = Carbon::create($currentYear, $month, 1)->endOfMonth();

            $monthlyTotal = $list
                ->where('smn_waktu', '>=', $startDate)
                ->where('smn_waktu', '<=', $endDate)
                ->count();

            // Menyimpan jumlah surat tugas ke dalam array
            $monthlyData[$month - 1] = $monthlyTotal;
        }

        return $monthlyData;
    }

    public function getHakPaten()
    {
        // Ambil data bulanan dari database
        $monthlyData = [];

        // Mendapatkan tahun saat ini
        $currentYear = Carbon::now()->year;

        $list = HakPaten::all(); // Mengambil semua data surat tugas

        for ($month = 1; $month <= 12; $month++) {
            // Menghitung jumlah surat tugas per bulan dari database
            $startDate = Carbon::create($currentYear, $month, 1)->startOfMonth();
            $endDate = Carbon::create($currentYear, $month, 1)->endOfMonth();

            $monthlyTotal = $list
                ->where('hpt_tglpenerimaan', '>=', $startDate)
                ->where('hpt_tglpenerimaan', '<=', $endDate)
                ->count();

            // Menyimpan jumlah surat tugas ke dalam array
            $monthlyData[$month - 1] = $monthlyTotal;
        }

        return $monthlyData;
    }

    public function getProsiding()
    {
        // Ambil data bulanan dari database
        $monthlyData = [];

        // Mendapatkan tahun saat ini
        $currentYear = Carbon::now()->year;

        $list = Prosiding::all(); // Mengambil semua data surat tugas

        for ($month = 1; $month <= 12; $month++) {
            // Menghitung jumlah surat tugas per bulan dari database
            $startDate = Carbon::create($currentYear, $month, 1)->startOfMonth();
            $endDate = Carbon::create($currentYear, $month, 1)->endOfMonth();

            $monthlyTotal = $list
                ->where('pro_waktuterbit', '>=', $startDate)
                ->where('pro_waktuterbit', '<=', $endDate)
                ->count();

            // Menyimpan jumlah surat tugas ke dalam array
            $monthlyData[$month - 1] = $monthlyTotal;
        }

        return $monthlyData;
    }

    public function getPKM()
    {
        // Ambil data bulanan dari database
        $monthlyData = [];

        // Mendapatkan tahun saat ini
        $currentYear = Carbon::now()->year;

        $list = PengabdianMasyarakat::all(); // Mengambil semua data surat tugas

        for ($month = 1; $month <= 12; $month++) {
            // Menghitung jumlah surat tugas per bulan dari database
            $startDate = Carbon::create($currentYear, $month, 1)->startOfMonth();
            $endDate = Carbon::create($currentYear, $month, 1)->endOfMonth();

            $monthlyTotal = $list
                ->where('created_at', '>=', $startDate)
                ->where('created_at', '<=', $endDate)
                ->count();

            // Menyimpan jumlah surat tugas ke dalam array
            $monthlyData[$month - 1] = $monthlyTotal;
        }

        return $monthlyData;
    }

    public function getBuku()
    {
        // Ambil data bulanan dari database
        $monthlyData = [];

        // Mendapatkan tahun saat ini
        $currentYear = Carbon::now()->year;

        $list = Buku::all(); // Mengambil semua data surat tugas

        for ($month = 1; $month <= 12; $month++) {
            // Menghitung jumlah surat tugas per bulan dari database
            $startDate = Carbon::create($currentYear, $month, 1)->startOfMonth();
            $endDate = Carbon::create($currentYear, $month, 1)->endOfMonth();

            $monthlyTotal = $list
                ->where('created_at', '>=', $startDate)
                ->where('created_at', '<=', $endDate)
                ->count();

            // Menyimpan jumlah surat tugas ke dalam array
            $monthlyData[$month - 1] = $monthlyTotal;
        }

        return $monthlyData;
    }

    public function getJurnal()
    {
        // Ambil data bulanan dari database
        $monthlyData = [];

        // Mendapatkan tahun saat ini
        $currentYear = Carbon::now()->year;

        $list = Jurnal::all(); // Mengambil semua data surat tugas

        for ($month = 1; $month <= 12; $month++) {
            // Menghitung jumlah surat tugas per bulan dari database
            $startDate = Carbon::create($currentYear, $month, 1)->startOfMonth();
            $endDate = Carbon::create($currentYear, $month, 1)->endOfMonth();

            $monthlyTotal = $list
                ->where('created_at', '>=', $startDate)
                ->where('created_at', '<=', $endDate)
                ->count();

            // Menyimpan jumlah surat tugas ke dalam array
            $monthlyData[$month - 1] = $monthlyTotal;
        }

        return $monthlyData;
    }

    public function getHakCipta()
    {
        // Ambil data bulanan dari database
        $monthlyData = [];

        // Mendapatkan tahun saat ini
        $currentYear = Carbon::now()->year;

        $list = Jurnal::all(); // Mengambil semua data surat tugas

        for ($month = 1; $month <= 12; $month++) {
            // Menghitung jumlah surat tugas per bulan dari database
            $startDate = Carbon::create($currentYear, $month, 1)->startOfMonth();
            $endDate = Carbon::create($currentYear, $month, 1)->endOfMonth();

            $monthlyTotal = $list
                ->where('created_at', '>=', $startDate)
                ->where('created_at', '<=', $endDate)
                ->count();

            // Menyimpan jumlah surat tugas ke dalam array
            $monthlyData[$month - 1] = $monthlyTotal;
        }

        return $monthlyData;
    }

}
