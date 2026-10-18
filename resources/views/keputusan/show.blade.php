@extends('layouts.admin')

@section('title', 'Detail Keputusan')

@section('content')

@can('keputusan.edit')
<a href="{{ route('keputusan.edit', $keputusan->id) }}" class="btn btn-warning btn-sm">
    <i class="bi bi-pencil"></i> Edit
</a>
@endcan

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <h4>{{ $keputusan->tentang }}</h4>
        <p class="text-muted">No: {{ $keputusan->nomor_keputusan }} | Tanggal: {{ $keputusan->tanggal_keputusan->format('d F Y') }}</p>
        <hr>
        <p>{{ $keputusan->keterangan }}</p>
        
        @if($keputusan->file_lampiran)
            <a href="{{ route('file.preview', $keputusan->file_lampiran) }}" target="_blank" class="btn btn-outline-primary btn-sm mt-3">
                <i class="bi bi-file-pdf"></i> Lihat Lampiran SK
            </a>
        @endif
    </div>
</div>
@endsection