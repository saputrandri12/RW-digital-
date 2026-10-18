<?php

namespace App\Http\Controllers;

use App\Models\Keputusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KeputusanController extends Controller
{
    public function index(Request $request)
    {
        $query = Keputusan::with('pembuat');

        if ($request->filled('q')) {
            $query->where(function ($sub) use ($request) {
                $sub->where('judul', 'like', '%' . $request->q . '%')
                    ->orWhere('nomor', 'like', '%' . $request->q . '%');
            });
        }
        if ($request->filled('jenis_rapat')) $query->where('jenis_rapat', $request->jenis_rapat);
        if ($request->filled('status')) $query->where('status', $request->status);
        if ($request->filled('dari')) $query->whereDate('tanggal_rapat', '>=', $request->dari);
        if ($request->filled('sampai')) $query->whereDate('tanggal_rapat', '<=', $request->sampai);

        $keputusans = $query->orderBy('tanggal_rapat', 'desc')->paginate(15)->withQueryString();

        $stats = [
            'total'   => Keputusan::count(),
            'final'   => Keputusan::where('status', 'final')->count(),
            'draft'   => Keputusan::where('status', 'draft')->count(),
            'tahun'   => Keputusan::whereYear('tanggal_rapat', now()->year)->count(),
        ];

        return view('keputusan.index', compact('keputusan', 'stats'));
    }

    public function create()
    {
        return view('keputusan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor' => 'required|string|max:100',
            'judul' => 'required|string|max:200',
            'tanggal_rapat' => 'required|date',
            'jenis_rapat' => 'nullable|string',
            'lokasi' => 'nullable|string',
            'agenda' => 'required|string',
            'hasil_keputusan' => 'required|string',
            'peserta' => 'nullable|string',
            'status' => 'nullable|string',
            'lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
        ]);

        if ($request->hasFile('lampiran')) {
            $validated['lampiran'] = $request->file('lampiran')->store('keputusan', 'public');
        }

        $validated['dibuat_oleh'] = auth()->id();
        $validated['status'] = $request->status ?? 'Final';

        Keputusan::create($validated);

        return redirect()->route('keputusan.index')->with('success', 'Keputusan berhasil disimpan.');
    }

    public function show(Keputusan $keputusan)
    {
        $keputusan->load('pembuat');
        return view('keputusan.show', compact('keputusan'));
    }

    public function edit(Keputusan $keputusan)
    {
        return view('keputusan.edit', compact('keputusan'));
    }

    public function update(Request $request, Keputusan $keputusan)
    {
        $validated = $request->validate([
            'nomor' => 'required|string|max:100',
            'judul' => 'required|string|max:200',
            'tanggal_rapat' => 'required|date',
            'jenis_rapat' => 'nullable|string',
            'lokasi' => 'nullable|string',
            'agenda' => 'required|string',
            'hasil_keputusan' => 'required|string',
            'peserta' => 'nullable|string',
            'status' => 'nullable|string',
            'lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
        ]);

        if ($request->hasFile('lampiran')) {
            if ($keputusan->lampiran) \Storage::disk('public')->delete($keputusan->lampiran);
            $validated['lampiran'] = $request->file('lampiran')->store('keputusan', 'public');
        }

        $validated['status'] = $request->status ?? $keputusan->status;

        $keputusan->update($validated);

        return redirect()->route('keputusan.show', $keputusan)->with('success', 'Keputusan diperbarui.');
    }

    public function destroy(Keputusan $keputusan)
    {
        if ($keputusan->lampiran && Storage::disk('public')->exists($keputusan->lampiran)) {
            Storage::disk('public')->delete($keputusan->lampiran);
        }
        $keputusan->delete();

        return redirect()->route('keputusan.index')
            ->with('success', 'Keputusan berhasil dihapus.');
    }
}