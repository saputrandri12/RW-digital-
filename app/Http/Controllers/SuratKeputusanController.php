<?php

namespace App\Http\Controllers;

use App\Models\SuratKeputusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratKeputusanController extends Controller
{
    public function index()
    {
        $keputusans = SuratKeputusan::orderBy('tanggal_keputusan', 'desc')->paginate(15);
        return view('keputusan.index', compact('keputusans'));
    }

    public function create()
    {
        return view('keputusan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_keputusan' => 'required|string|max:100',
            'tanggal_keputusan' => 'required|date',
            'tentang' => 'required|string|max:200',
            'keterangan' => 'nullable|string',
            'file_lampiran' => 'nullable|file|mimes:pdf|max:5120'
        ]);

        if ($request->hasFile('file_lampiran')) {
            $validated['file_lampiran'] = $request->file('file_lampiran')->store('keputusan', 'public');
        }

        $validated['dibuat_oleh'] = auth()->id();
        SuratKeputusan::create($validated);

        return redirect()->route('keputusan.index')->with('success', 'Surat Keputusan berhasil disimpan.');
    }

    public function show(SuratKeputusan $keputusan)
    {
        return view('keputusan.show', compact('keputusan'));
    }

    public function edit(SuratKeputusan $keputusan)
    {
        return view('keputusan.edit', compact('keputusan'));
    }

    public function update(Request $request, SuratKeputusan $keputusan)
    {
        $validated = $request->validate([
            'nomor_keputusan' => 'required|string|max:100',
            'tanggal_keputusan' => 'required|date',
            'tentang' => 'required|string|max:200',
            'keterangan' => 'nullable|string',
            'file_lampiran' => 'nullable|file|mimes:pdf|max:5120'
        ]);

        if ($request->hasFile('file_lampiran')) {
            if ($keputusan->file_lampiran) Storage::disk('public')->delete($keputusan->file_lampiran);
            $validated['file_lampiran'] = $request->file('file_lampiran')->store('keputusan', 'public');
        }

        $keputusan->update($validated);

        return redirect()->route('keputusan.index')->with('success', 'Surat Keputusan diperbarui.');
    }

    public function destroy(SuratKeputusan $keputusan)
    {
        if ($keputusan->file_lampiran) Storage::disk('public')->delete($keputusan->file_lampiran);
        $keputusan->delete();
        return redirect()->route('keputusan.index')->with('success', 'Surat Keputusan dihapus.');
    }
}