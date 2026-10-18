<?php

namespace App\Http\Controllers;

use App\Models\DataYatim;
use App\Models\Warga;
use Illuminate\Http\Request;

class DataYatimController extends Controller
{
    public function index(Request $request)
    {
        $query = DataYatim::with(['warga.rt']);

        // Filter Pencarian
        if ($request->filled('q')) {
            $query->whereHas('warga', function($sub) use ($request) {
                $sub->where('nama', 'like', '%' . $request->q . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $dataYatims = $query->orderBy('created_at', 'desc')->paginate(15);
        return view('yatim.index', compact('dataYatims'));
    }

    public function create()
    {
        // Hanya ambil warga yang usianya di bawah 18 tahun (anak-anak)
        $wargas = Warga::where('status_hidup', 'hidup')
            ->whereRaw('TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) < 18')
            ->orderBy('nama')
            ->get();

        return view('yatim.create', compact('wargas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'warga_id' => 'required|exists:warga,id|unique:data_yatim,warga_id',
            'status' => 'required|in:yatim,piatu,yatim_piatu',
            'nama_orang_tua_wafat' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        DataYatim::create($validated);

        return redirect()->route('yatim.index')->with('success', 'Data yatim berhasil disimpan.');
    }

    public function show(DataYatim $yatim)
    {
        $yatim->load(['warga.keluarga', 'warga.rt']);
        return view('yatim.show', compact('yatim'));
    }

    public function edit(DataYatim $yatim)
    {
        return view('yatim.edit', compact('yatim'));
    }

    public function update(Request $request, DataYatim $yatim)
    {
        $validated = $request->validate([
            'status' => 'required|in:yatim,piatu,yatim_piatu',
            'nama_orang_tua_wafat' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        $yatim->update($validated);

        return redirect()->route('yatim.index')->with('success', 'Data yatim berhasil diperbarui.');
    }

    public function destroy(DataYatim $yatim)
    {
        $yatim->delete();
        return redirect()->route('yatim.index')->with('success', 'Data yatim berhasil dihapus.');
    }
}