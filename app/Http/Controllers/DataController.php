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
        $sort = $request->input('sort', 'tgl');
        $dataQuery = Data::where('user_id', auth()->id());

        if ($request->has('month')) {
            $month = $request->input('month');
            $dataQuery->whereMonth('tgl', Carbon::parse($month)->month)
                ->whereYear('tgl', Carbon::parse($month)->year);
        }

        if ($search) {
            $dataQuery->where('nama', 'like', "%{$search}%");
        }

        if ($sort) {
            $direction = 'asc';
            if (strpos($sort, '-') === 0) {
                $direction = 'desc';
                $sort = substr($sort, 1);
            }
            if (in_array($sort, ['tgl', 'suhu', 'ph', 'o2', 'salinitas', 'hasil'])) {
                $dataQuery->orderBy($sort, $direction);
            }
        }

        $data = $dataQuery->paginate(10);
        $dailyData = $dataQuery->get();

        Carbon::setLocale('id');

        $daysOfWeek = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        $groupedData = [
            'temperature' => array_fill_keys($daysOfWeek, []),
            'ph' => array_fill_keys($daysOfWeek, []),
            'oxygen' => array_fill_keys($daysOfWeek, []),
            'salinity' => array_fill_keys($daysOfWeek, []),
            'quality' => [],
        ];

        $monthYear = null;

        foreach ($dailyData as $entry) {
            $date = Carbon::parse($entry->tgl);
            $dateFormatted = $date->format('Y-m-d');
            $dayOfWeek = $date->isoFormat('dddd');

            if ($monthYear === null) {
                $monthYear = $date->isoFormat('MMMM YYYY');
            }

            $groupedData['temperature'][$dayOfWeek][] = $entry->suhu;
            $groupedData['ph'][$dayOfWeek][] = $entry->ph;
            $groupedData['oxygen'][$dayOfWeek][] = $entry->o2;
            $groupedData['salinity'][$dayOfWeek][] = $entry->salinitas;

            $groupedData['quality'][$dateFormatted] = [
                'temperature' => $entry->suhu,
                'ph' => $entry->ph,
                'oxygen' => $entry->o2,
                'salinity' => $entry->salinitas,
                'score' => $entry->hasil,
            ];
        }

        $groupedData = [
            'temperature' => array_map(fn($data) => count($data) ? array_sum($data) / count($data) : null, $groupedData['temperature']),
            'ph' => array_map(fn($data) => count($data) ? array_sum($data) / count($data) : null, $groupedData['ph']),
            'oxygen' => array_map(fn($data) => count($data) ? array_sum($data) / count($data) : null, $groupedData['oxygen']),
            'salinity' => array_map(fn($data) => count($data) ? array_sum($data) / count($data) : null, $groupedData['salinity']),
            'quality' => $groupedData['quality'],
        ];

        return view('monitoring', compact('data', 'groupedData', 'monthYear'));
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
            $hasil = 2; // Buruk
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
            $hasil = 0; // Netral
            $saran = 'Semua parameter dalam batas netral.';
        } else {
            $hasil = 1; // Baik
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
            $hasil = 2; // Buruk
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
            $hasil = 0; // Netral
            $saran = 'Semua parameter dalam batas netral.';
        } else {
            $hasil = 1; // Baik
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
