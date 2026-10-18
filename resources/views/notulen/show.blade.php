@extends('layouts.admin')

@section('title', $notulen->judul)

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h5 class="mb-1">
            {{ $notulen->tipe === 'notulen_rapat' ? 'Detail Notulen Rapat' : 'Detail Surat Keluar' }}
        </h5>
        <small class="text-muted">{{ $notulen->judul }}</small>
    </div>
    <div>
        @can('notulen.edit')
        <a href="{{ route('notulen.edit', $notulen) }}" class="btn btn-warning btn-sm">
            <i class="bi bi-pencil"></i> Edit
        </a>
        @endcan>
        <a href="{{ route('notulen.index', ['tipe' => $notulen->tipe]) }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        
        {{-- TABEL INFORMASI UMUM --}}
        <table class="table table-sm mb-4">
            <tr><th width="200">Judul / Agenda</th><td><strong>{{ $notulen->judul }}</strong></td></tr>
            <tr><th>Tanggal</th><td>{{ $notulen->tanggal->format('d F Y') }}</td></tr>
            
            {{-- KHUSUS NOTULEN RAPAT --}}
            @if($notulen->tipe === 'notulen_rapat')
                <tr><th>Jam Pelaksanaan</th><td>{{ $notulen->jam ? \Carbon\Carbon::parse($notulen->jam)->format('H:i') . ' WIB' : '-' }}</td></tr>
                <tr><th>Tempat</th><td>{{ $notulen->lokasi ?? '-' }}</td></tr>
            @endif

            {{-- KHUSUS SURAT KELUAR --}}
            @if($notulen->tipe === 'surat_keluar')
                <tr><th>Nomor Surat</th><td><code>{{ $notulen->nomor_surat ?? '-' }}</code></td></tr>
                <tr><th>Tujuan / Kepada</th><td>{{ $notulen->tujuan ?? '-' }}</td></tr>
                <tr><th>Perihal</th><td>{{ $notulen->perihal ?? '-' }}</td></tr>
            @endif
            
            <tr><th>Dibuat Oleh</th><td>{{ $notulen->pembuat->name ?? '-' }}</td></tr>
        </table>

        <hr>
        
        {{-- ISI / URAIAN --}}
        <h6 class="fw-bold mb-2">{{ $notulen->tipe === 'notulen_rapat' ? 'Uraian / Isi Rapat:' : 'Isi Surat:' }}</h6>
        <div style="white-space: pre-line; line-height: 1.8; background: #f8fafc; padding: 15px; border-radius: 8px; border: 1px solid #e2e8f0;">
            {{ $notulen->isi }}
        </div>

        {{-- KEPUTUSAN (KHUSUS RAPAT) --}}
        @if($notulen->tipe === 'notulen_rapat' && $notulen->keputusan)
            <hr>
            <h6 class="fw-bold mb-2">Keputusan Rapat:</h6>
            <div style="white-space: pre-line; line-height: 1.8; background: #f0fdf4; padding: 15px; border-radius: 8px; border: 1px solid #bbf7d0;">
                {{ $notulen->keputusan }}
            </div>
        @endif

        {{-- KETERANGAN (KHUSUS SURAT KELUAR) --}}
        @if($notulen->tipe === 'surat_keluar' && $notulen->keterangan)
            <hr>
            <h6 class="fw-bold mb-2">Keterangan Tambahan:</h6>
            <div style="white-space: pre-line; line-height: 1.8; background: #fefce8; padding: 15px; border-radius: 8px; border: 1px solid #fef08a;">
                {{ $notulen->keterangan }}
            </div>
        @endif

        {{-- LAMPIRAN --}}
        @if($notulen->file_lampiran)
            <hr>
            <h6 class="fw-bold">Lampiran Dokumen:</h6>
            <a href="{{ route('file.preview', $notulen->file_lampiran) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                <i class="bi bi-file-earmark-pdf"></i> Buka Lampiran
            </a>
        @endif

    </div>
</div>

@endsection