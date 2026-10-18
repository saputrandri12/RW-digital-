@extends('layouts.admin')

@section('title', 'Edit ' . ($notulen->tipe === 'notulen_rapat' ? 'Notulen' : 'Surat Keluar'))

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-1">Edit {{ $notulen->tipe === 'notulen_rapat' ? 'Notulen Rapat' : 'Surat Keluar' }}</h5>
    <a href="{{ route('notulen.index', ['tipe' => $notulen->tipe]) }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">@foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach</ul>
</div>
@endif

<form method="POST" action="{{ route('notulen.update', $notulen) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="hidden" name="tipe" value="{{ $notulen->tipe }}"> {{-- TAMBAHAN UNTUK MEMPERBAIKI ERROR --}}

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="row g-3">
                @if($notulen->tipe === 'notulen_rapat')
                    {{-- FORM NOTULEN RAPAT --}}
                    <div class="col-md-12">
                        <label class="form-label">Judul Rapat <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control" value="{{ old('judul', $notulen->judul) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $notulen->tanggal->format('Y-m-d')) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Jam</label>
                        <input type="time" name="jam" class="form-control" value="{{ old('jam', $notulen->jam) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tempat</label>
                        <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi', $notulen->lokasi) }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Uraian / Isi Rapat <span class="text-danger">*</span></label>
                        <textarea name="isi" class="form-control" rows="6" required>{{ old('isi', $notulen->isi) }}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Keputusan Rapat</label>
                        <textarea name="keputusan" class="form-control" rows="4">{{ old('keputusan', $notulen->keputusan) }}</textarea>
                    </div>
                @else
                    {{-- FORM SURAT KELUAR --}}
                    <div class="col-md-6">
                        <label class="form-label">Nomor Surat <span class="text-danger">*</span></label>
                        <input type="text" name="nomor_surat" class="form-control" value="{{ old('nomor_surat', $notulen->nomor_surat) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Surat <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $notulen->tanggal->format('Y-m-d')) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tujuan / Kepada</label>
                        <input type="text" name="tujuan" class="form-control" value="{{ old('tujuan', $notulen->tujuan) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Perihal</label>
                        <input type="text" name="perihal" class="form-control" value="{{ old('perihal', $notulen->perihal) }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Isi Singkat Surat <span class="text-danger">*</span></label>
                        <textarea name="isi" class="form-control" rows="6" required>{{ old('isi', $notulen->isi) }}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Keterangan Tambahan</label>
                        <textarea name="keterangan" class="form-control" rows="2">{{ old('keterangan', $notulen->keterangan) }}</textarea>
                    </div>
                    <input type="hidden" name="judul" value="Surat Keluar: {{ old('nomor_surat', $notulen->nomor_surat) }}">
                @endif

                <div class="col-md-6 mt-4">
                    <label class="form-label">Ganti Lampiran (Opsional)</label>
                    <input type="file" name="file_lampiran" class="form-control" accept=".pdf,.doc,.docx">
                    @if($notulen->file_lampiran)
                        <small class="text-muted">File sudah ada. Biarkan kosong jika tidak ingin mengganti.</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer bg-white d-flex justify-content-between">
            <a href="{{ route('notulen.index', ['tipe' => $notulen->tipe]) }}" class="btn btn-outline-secondary">Batal</a>
            <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle"></i> Update</button>
        </div>
    </div>
</form>

@endsection