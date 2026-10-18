<?php
namespace App\Http\Controllers;

use App\Models\Notulen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NotulenController extends Controller
{
    public function index(Request $request)
    {
        $tipe = $request->get('tipe', 'notulen_rapat');
        $data = Notulen::where('tipe', $tipe)->orderBy('tanggal', 'desc')->paginate(15);
        return view('notulen.index', compact('data', 'tipe'));
    }

    public function create(Request $request)
    {
        $tipe = $request->get('tipe', 'notulen_rapat');
        return view('notulen.create', compact('tipe'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipe' => 'required|in:notulen_rapat,surat_keluar',
            'judul' => 'required|string|max:200',
            'tanggal' => 'required|date',
            'jam' => 'nullable',
            'lokasi' => 'nullable|string|max:150',
            'nomor_surat' => 'nullable|string|max:100',
            'tujuan' => 'nullable|string|max:150',
            'perihal' => 'nullable|string|max:200',
            'isi' => 'required|string',
            'keputusan' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'file_lampiran' => 'nullable|file|mimes:pdf,doc,docx|max:5120'
        ]);

        if ($request->hasFile('file_lampiran')) {
            $validated['file_lampiran'] = $request->file('file_lampiran')->store('notulen', 'public');
        }

        $validated['dibuat_oleh'] = auth()->id();
        Notulen::create($validated);

        return redirect()->route('notulen.index', ['tipe' => $validated['tipe']])->with('success', 'Data berhasil disimpan.');
    }

    public function show(Notulen $notulen)
    {
        return view('notulen.show', compact('notulen'));
    }

    public function edit(Notulen $notulen)
    {
        return view('notulen.edit', compact('notulen'));
    }

    public function update(Request $request, Notulen $notulen)
    {
        $validated = $request->validate([
            'tipe' => 'required|in:notulen_rapat,surat_keluar',
            'judul' => 'required|string|max:200',
            'tanggal' => 'required|date',
            'jam' => 'nullable',
            'lokasi' => 'nullable|string|max:150',
            'nomor_surat' => 'nullable|string|max:100',
            'tujuan' => 'nullable|string|max:150',
            'perihal' => 'nullable|string|max:200',
            'isi' => 'required|string',
            'keputusan' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'file_lampiran' => 'nullable|file|mimes:pdf,doc,docx|max:5120'
        ]);

        if ($request->hasFile('file_lampiran')) {
            if ($notulen->file_lampiran) Storage::disk('public')->delete($notulen->file_lampiran);
            $validated['file_lampiran'] = $request->file('file_lampiran')->store('notulen', 'public');
        }

        $notulen->update($validated);
        return redirect()->route('notulen.show', $notulen)->with('success', 'Data diperbarui.');
    }

    public function destroy(Notulen $notulen)
    {
        if ($notulen->file_lampiran) Storage::disk('public')->delete($notulen->file_lampiran);
        $notulen->delete();
        return back()->with('success', 'Data dihapus.');
    }
}