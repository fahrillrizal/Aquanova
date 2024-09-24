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
        $data = Data::where('user_id', auth()->id());
        $minDate = (clone $data)->min('tgl');

        if ($request->has('month')) {
            $month = $request->input('month');
            $data->whereMonth('tgl', Carbon::parse($month)->month)
                ->whereYear('tgl', Carbon::parse($month)->year);
        }

        if ($search) {
            $data->where('nama', 'like', "%{$search}%");
        }

        if ($sort) {
            $direction = 'asc';
            if (strpos($sort, '-') == 0) {
                $direction = 'desc';
                $sort = substr($sort, 1);
            }

            if ($sort === 'hasil') {
                $data->orderBy('hasil', $direction);
            } elseif (in_array($sort, ['tgl', 'suhu', 'ph', 'o2', 'salinitas'])) {
                $data->orderBy($sort, $direction);
            }
        }

        $data = $data->paginate(10);

        return view('monitoring', compact('data'));
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
        if (($request->o2 < 4 || $request->o2 > 8) || ($request->suhu < 28 || $request->suhu > 30) || ($request->salinitas < 0 || $request->salinitas > 30) || ($request->ph < 6 || $request->ph > 8)) {
            $hasil = 2;
        } elseif ($request->o2 == 4 && $request->suhu == 28 && $request->salinitas == 0 && $request->ph == 6) {
            $hasil = 1;
        }  else {
            $hasil = 0; 
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
        ]);

        return redirect()->route('monitoring')->with('success', 'Data added successfully.');
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
        
        if (($request->o2 < 4 || $request->o2 > 8) ||
            ($request->suhu < 28 || $request->suhu > 30) ||
            ($request->salinitas < 0 || $request->salinitas > 30) ||
            ($request->ph < 6 || $request->ph > 8)
        ) {
            $hasil = 2;
        } elseif ($request->o2 == 4 && $request->suhu == 28 && $request->salinitas == 0 && $request->ph == 6) {
            $hasil = 1;
        } else {
            $hasil = 0; 
        }
        
        try {
            $data->update(array_merge($request->all(), ['hasil' => $hasil]));
        } catch (\Exception $e) {
            return redirect()->route('monitoring')->with('error', 'Failed to update data: ' . $e->getMessage());
        }
        
        return redirect()->route('monitoring')->with('success', 'Data updated successfully.');
    }

    public function destroy($id)
    {
        $data = Data::findOrFail($id);
        $data->delete();

        return redirect()->route('monitoring')->with('success', 'Data deleted successfully.');
    }
}
