<?php
namespace App\Http\Controllers;

use App\Models\Data; 
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class RecapController extends Controller
{
    public function recap(Request $request)
    {
        // Ambil bulan dan tahun dari input
        $month = $request->input('month', Carbon::now()->format('m'));
        $year = $request->input('year', Carbon::now()->year);

        // Ambil data dari database berdasarkan bulan dan tahun
        $data = Data::whereMonth('tgl', $month)
                    ->whereYear('tgl', $year)
                    ->where('user_id', auth()->id())
                    ->orderBy('tgl', 'asc')
                    ->paginate(10);

        // Cek apakah data ada
        if ($data->isEmpty()) {
            return view('recap', [
                'selectedMonth' => Carbon::createFromDate($year, $month)->translatedFormat('F'),
                'labels' => [],
                'data' => $data,
                'suhuData' => [],
                'o2Data' => [],
                'phData' => [],
                'salinityData' => [],
                'hasilData' => [], // Tambahkan ini
                'combinedLabels' => [],
                'combinedSuhuData' => [],
                'combinedO2Data' => [],
                'combinedPhData' => [],
                'combinedSalinityData' => [],
                'combinedHasilData' => [], // Tambahkan ini
                'message' => 'Tidak ada data untuk bulan ini.',
            ]);
        }

        // Ambil label dan nilai dari tabel data
        $labels = $data->pluck('tgl')->map(function ($date) {
            return Carbon::parse($date)->format('d-m-Y');
        });
        
        // Ambil data untuk grafik
        $suhuData = $data->pluck('suhu');
        $o2Data = $data->pluck('o2');
        $phData = $data->pluck('ph');
        $salinityData = $data->pluck('salinitas');
        $hasilData = $data->pluck('hasil'); // Ambil data dari kolom hasil

        // Log data untuk debugging
        Log::info('Labels:', ['labels' => $labels]);
        Log::info('Suhu Data:', $suhuData->toArray());
        Log::info('O2 Data:', $o2Data->toArray());
        Log::info('pH Data:', $phData->toArray());
        Log::info('Salinitas Data:', $salinityData->toArray());
        Log::info('Hasil Data:', $hasilData->toArray()); // Log data hasil

        // Ambil data untuk grafik gabungan (seluruh bulan dalam tahun yang sama)
        $combinedData = Data::whereYear('tgl', $year)
                            ->selectRaw('MONTH(tgl) as month, AVG(suhu) as avg_suhu, AVG(o2) as avg_o2, AVG(ph) as avg_ph, AVG(salinitas) as avg_salinitas, AVG(hasil) as avg_hasil') // Menambahkan hasil
                            ->groupBy('month')
                            ->get();

        // Ambil label dan nilai untuk grafik gabungan
        $combinedLabels = $combinedData->pluck('month')->map(function ($monthNumber) {
            return Carbon::create()->month($monthNumber)->translatedFormat('F');
        });

        $combinedSuhuData = $combinedData->pluck('avg_suhu');
        $combinedO2Data = $combinedData->pluck('avg_o2');
        $combinedPhData = $combinedData->pluck('avg_ph');
        $combinedSalinityData = $combinedData->pluck('avg_salinitas');
        $combinedHasilData = $combinedData->pluck('avg_hasil'); // Menambahkan hasil

        return view('recap', [
            'selectedMonth' => Carbon::createFromDate($year, $month)->translatedFormat('F'),
            'labels' => $labels,
            'data' => $data,
            'suhuData' => $suhuData,
            'o2Data' => $o2Data,
            'phData' => $phData,
            'salinityData' => $salinityData,
            'hasilData' => $hasilData, // Mengirim data hasil ke view
            'combinedLabels' => $combinedLabels,
            'combinedSuhuData' => $combinedSuhuData,
            'combinedO2Data' => $combinedO2Data,
            'combinedPhData' => $combinedPhData,
            'combinedSalinityData' => $combinedSalinityData,
            'combinedHasilData' => $combinedHasilData, // Mengirim data gabungan hasil
            'message' => null,
        ]);
    }
}