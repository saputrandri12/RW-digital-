@extends('layouts.admin')

@section('title', 'Edit Surat Keputusan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-1">✏️ Edit Surat Keputusan</h5>
    <a href="{{ route('keputusan.index') }}" class="btn btn-outline-secondary btn-sm">Kembali</a>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">@foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach</ul>
</div>
@endif

<form method="POST" action="{{ route('keputusan.update', $keputusan->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT') {{-- WAJIB UNTUK EDIT --}}
    
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nomor Keputusan <span class="text-danger">*</span></label>
                    <input type="text" name="nomor_keputusan" class="form-control" value="{{ old('nomor_keputusan', $keputusan->nomor_keputusan) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal Putusan <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_keputusan" class="form-control" value="{{ old('tanggal_keputusan', $keputusan->tanggal_keputusan->format('Y-m-d')) }}" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Tentang / Perihal <span class="text-danger">*</span></label>
                    <input type="text" name="tentang" class="form-control" value="{{ old('tentang', $keputusan->tentang) }}" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Keterangan Tambahan</label>
                    <textarea name="keterangan" class="form-control" rows="3">{{ old('keterangan', $keputusan->keterangan) }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Ganti Lampiran SK (PDF)</label>
                    <input type="file" name="file_lampiran" class="form-control" accept=".pdf">
                    @if($keputusan->file_lampiran)
                        <small class="text-muted">File sudah ada. Biarkan kosong jika tidak ingin mengganti.</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer bg-white">
            <button type="submit" class="btn btn-primary">Update Keputusan</button>
        </div>
    </div>
</form>
@endsection