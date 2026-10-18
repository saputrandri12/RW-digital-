@extends('layouts.admin')
@section('title', 'Detail Data Yatim')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-1">Detail Data Yatim</h5>
    <a href="{{ route('yatim.index') }}" class="btn btn-outline-secondary btn-sm">Kembali</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <table class="table table-sm">
            <tr><th width="200">Nama Anak</th><td><strong>{{ $yatim->warga->nama }}</strong></td></tr>
            <tr><th>NIK Anak</th><td>{{ $yatim->warga->nik }}</td></tr>
            <tr><th>RT</th><td>{{ $yatim->warga->rt->nama_rt }}</td></tr>
            <tr><th>Status</th><td><span class="badge bg-warning text-dark">{{ $yatim->status_label }}</span></td></tr>
            <tr><th>Nama Orang Tua Wafat</th><td>{{ $yatim->nama_orang_tua_wafat ?? '-' }}</td></tr>
            <tr><th>Keterangan</th><td>{{ $yatim->keterangan ?? '-' }}</td></tr>
        </table>
        
        <hr>
        <h6>Data Keluarga (KK)</h6>
        <p class="mb-0">
            <strong>{{ $yatim->warga->keluarga->kepala_keluarga_nama ?? '-' }}</strong><br>
            Alamat: {{ $yatim->warga->keluarga->alamat ?? '-' }}
        </p>
    </div>
</div>
@endsection