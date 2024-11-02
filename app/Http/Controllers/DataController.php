<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;
use Carbon\Carbon;

class DataController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $dataQuery = Data::where('user_id', auth()->id())
            ->whereMonth('tgl', Carbon::now()->month)
            ->whereYear('tgl', Carbon::now()->year);

        if ($search) {
            $dataQuery->where('nama', 'like', "%{$search}%");
        }//search

        $data = $dataQuery->paginate(10);
        $dailyData = $dataQuery->get();

        Carbon::setLocale('id');
        $currentWeekNumber = Carbon::now()->weekOfMonth;

        $daysOfWeek = [
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu'
        ];

        $weeklyData = [
            'currentWeek' => $currentWeekNumber,
            'temperature' => [],
            'ph' => [],
            'oxygen' => [],
            'salinity' => [],
            'quality' => [],
        ];

        $monthYear = null;

        foreach ($daysOfWeek as $day) {
            $weeklyData['temperature'][$day] = [];
            $weeklyData['ph'][$day] = [];
            $weeklyData['oxygen'][$day] = [];
            $weeklyData['salinity'][$day] = [];
        }

        foreach ($dailyData as $entry) {
            $date = Carbon::parse($entry->tgl);
            $weekNumber = $date->weekOfMonth;
            $dayName = $date->isoFormat('dddd'); 
            $dateFormatted = $date->format('Y-m-d');
        
            if ($monthYear === null) {
                $monthYear = $date->isoFormat('MMMM YYYY');
            }
            
            $weeklyData['quality'][$dateFormatted] = [
                'temperature' => (int)$entry->suhu,
                'ph' => (int)$entry->ph,
                'oxygen' => (int)$entry->o2,
                'salinity' => (int)$entry->salinitas,
                'score' => $entry->hasil,
                'week' => $weekNumber
            ];
            
            if (in_array($dayName, $daysOfWeek)) {
                $weeklyData['temperature'][$dayName][$weekNumber] = (int)$entry->suhu;
                $weeklyData['ph'][$dayName][$weekNumber] = (int)$entry->ph;
                $weeklyData['oxygen'][$dayName][$weekNumber] = (int)$entry->o2;
                $weeklyData['salinity'][$dayName][$weekNumber] = (int)$entry->salinitas;
            }
        }        
        
        ksort($weeklyData['quality']);

        return view('monitoring', compact('data', 'weeklyData', 'monthYear', 'currentWeekNumber'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tgl' => 'required|date',
            'suhu' => 'required|numeric',
            'ph' => 'required|numeric',
            'o2' => 'required|numeric',
            'salinitas' => 'required|numeric',
        ]);

        $hasil = 0;
        $saran = '';

        if (($request->o2 < 4 || $request->o2 > 8) ||
            ($request->suhu < 28 || $request->suhu > 30) ||
            ($request->salinitas < 0 || $request->salinitas > 30) ||
            ($request->ph < 6 || $request->ph > 8)
        ) {
            $hasil = 2; 
            if ($request->ph < 6) {
                $saran .= 'pH kurang dari standar. ';
            } elseif ($request->ph > 8) {
                $saran .= 'pH melebihi standar. ';
            }
            if ($request->suhu < 28) {
                $saran .= 'Suhu kurang dari standar. ';
            } elseif ($request->suhu > 30) {
                $saran .= 'Suhu melebihi standar. ';
            }
            if ($request->o2 < 4) {
                $saran .= 'Oksigen kurang dari standar. ';
            } elseif ($request->o2 > 8) {
                $saran .= 'Oksigen melebihi standar. ';
            }
            if ($request->salinitas < 0) {
                $saran .= 'Salinitas kurang dari standar. ';
            } elseif ($request->salinitas > 30) {
                $saran .= 'Salinitas melebihi standar. ';
            }
        } elseif ($request->o2 == 4 && $request->suhu == 28 && $request->salinitas == 0 && $request->ph == 6) {
            $hasil = 0; 
            $saran = 'Semua parameter dalam batas netral.';
        } else {
            $hasil = 1; 
            $saran = 'Semua parameter dalam batas standar.';
        }

        Data::create([
            'user_id' => auth()->id(),
            'nama' => $request->nama,
            'tgl' => $request->tgl,
            'suhu' => $request->suhu,
            'ph' => $request->ph,
            'o2' => $request->o2,
            'salinitas' => $request->salinitas,
            'hasil' => $hasil,
            'saran' => $saran,
        ]);

        return redirect()->route('monitoring')->with('success', 'Data berhasil ditambahkan.');
    }

    public function show($id)
    {
        $data = Data::findOrFail($id);
        return view('edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tgl' => 'required|date',
            'suhu' => 'required|numeric',
            'ph' => 'required|numeric',
            'o2' => 'required|numeric',
            'salinitas' => 'required|numeric',
        ]);

        $data = Data::findOrFail($id);

        $hasil = 0;
        $saran = '';

        if (($request->o2 < 4 || $request->o2 > 8) ||
            ($request->suhu < 28 || $request->suhu > 30) ||
            ($request->salinitas < 0 || $request->salinitas > 30) ||
            ($request->ph < 6 || $request->ph > 8)
        ) {
            $hasil = 2; 
            if ($request->ph < 6) {
                $saran .= 'pH kurang dari standar. ';
            } elseif ($request->ph > 8) {
                $saran .= 'pH melebihi standar. ';
            }
            if ($request->suhu < 28) {
                $saran .= 'Suhu kurang dari standar. ';
            } elseif ($request->suhu > 30) {
                $saran .= 'Suhu melebihi standar. ';
            }
            if ($request->o2 < 4) {
                $saran .= 'Oksigen kurang dari standar. ';
            } elseif ($request->o2 > 8) {
                $saran .= 'Oksigen melebihi standar. ';
            }
            if ($request->salinitas < 0) {
                $saran .= 'Salinitas kurang dari standar. ';
            } elseif ($request->salinitas > 30) {
                $saran .= 'Salinitas melebihi standar. ';
            }
        } elseif ($request->o2 == 4 && $request->suhu == 28 && $request->salinitas == 0 && $request->ph == 6) {
            $hasil = 0; 
            $saran = 'Semua parameter dalam batas netral.';
        } else {
            $hasil = 1; 
            $saran = 'Semua parameter dalam batas standar.';
        }

        try {
            $updateData = array_merge($request->all(), ['hasil' => $hasil, 'saran' => $saran]);
            $data->update($updateData);

            \Log::info('Updated data:', $updateData);

            return redirect()->route('monitoring')->with('success', 'Data Berhasil diupdate.');
        } catch (\Exception $e) {
            \Log::error('Update failed: ' . $e->getMessage());
            return redirect()->route('monitoring')->with('error', 'Gagal mengupdate data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $data = Data::findOrFail($id);
            $data->delete();

            return response()->json(['message' => 'Data berhasil dihapus.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menghapus data: ' . $e->getMessage()], 500);
        }
    }
}
