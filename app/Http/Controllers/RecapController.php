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
        // Ambil bulan dan tahun dari input, gunakan bulan dan tahun saat ini sebagai default
        $month = $request->input('month', Carbon::now()->format('m'));
        $year = $request->input('year', Carbon::now()->year);

        // Ambil data dari database berdasarkan bulan, tahun, dan user_id yang sedang login
        $data = Data::whereRaw('EXTRACT(MONTH FROM tgl) = ?', [$month])
                    ->whereRaw('EXTRACT(YEAR FROM tgl) = ?', [$year])
                    ->where('user_id', auth()->id())
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
                'hasilData' => [],
                'combinedLabels' => [],
                'combinedSuhuData' => [],
                'combinedO2Data' => [],
                'combinedPhData' => [],
                'combinedSalinityData' => [],
                'combinedHasilData' => [],
                'message' => 'Tidak ada data untuk bulan ini.',
            ]);
        }

        // Persiapkan data untuk grafik harian
        $labels = $data->pluck('tgl')->map(fn ($date) => Carbon::parse($date)->format('d-m-Y'));
        $suhuData = $data->pluck('suhu');
        $o2Data = $data->pluck('o2');
        $phData = $data->pluck('ph');
        $salinityData = $data->pluck('salinitas');
        $hasilData = $data->pluck('hasil');

        // Log data untuk debugging
        Log::info('Labels:', ['labels' => $labels]);
        Log::info('Suhu Data:', $suhuData->toArray());
        Log::info('O2 Data:', $o2Data->toArray());
        Log::info('pH Data:', $phData->toArray());
        Log::info('Salinitas Data:', $salinityData->toArray());
        Log::info('Hasil Data:', $hasilData->toArray());

        // Ambil data gabungan untuk seluruh bulan dalam tahun yang sama
        $combinedData = Data::whereRaw('EXTRACT(YEAR FROM tgl) = ?', [$year])
                            ->selectRaw('EXTRACT(MONTH FROM tgl) as month, AVG(suhu) as avg_suhu, AVG(o2) as avg_o2, AVG(ph) as avg_ph, AVG(salinitas) as avg_salinitas, AVG(hasil) as avg_hasil')
                            ->groupByRaw('EXTRACT(MONTH FROM tgl)')
                            ->get();

        // Persiapkan data untuk grafik gabungan bulanan
        $combinedLabels = $combinedData->pluck('month')->map(fn ($monthNumber) => Carbon::create()->month((int) $monthNumber)->translatedFormat('F'));
        $combinedSuhuData = $combinedData->pluck('avg_suhu');
        $combinedO2Data = $combinedData->pluck('avg_o2');
        $combinedPhData = $combinedData->pluck('avg_ph');
        $combinedSalinityData = $combinedData->pluck('avg_salinitas');
        $combinedHasilData = $combinedData->pluck('avg_hasil');

        return view('recap', [
            'selectedMonth' => Carbon::createFromDate($year, $month)->translatedFormat('F'),
            'labels' => $labels,
            'data' => $data,
            'suhuData' => $suhuData,
            'o2Data' => $o2Data,
            'phData' => $phData,
            'salinityData' => $salinityData,
            'hasilData' => $hasilData,
            'combinedLabels' => $combinedLabels,
            'combinedSuhuData' => $combinedSuhuData,
            'combinedO2Data' => $combinedO2Data,
            'combinedPhData' => $combinedPhData,
            'combinedSalinityData' => $combinedSalinityData,
            'combinedHasilData' => $combinedHasilData,
            'message' => null,
        ]);
    }
}
