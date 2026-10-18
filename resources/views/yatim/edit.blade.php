@extends('layouts.admin')
@section('title', 'Edit Data Yatim')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-1">Edit Data Yatim: {{ $yatim->warga->nama }}</h5>
    <a href="{{ route('yatim.index') }}" class="btn btn-outline-secondary btn-sm">Kembali</a>
</div>

<form method="POST" action="{{ route('yatim.update', $yatim->id) }}">
    @csrf @method('PUT')
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Anak</label>
                    <input type="text" class="form-control" value="{{ $yatim->warga->nama }}" readonly disabled>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select" required>
                        <option value="yatim" {{ $yatim->status == 'yatim' ? 'selected' : '' }}>Yatim (Ayah Wafat)</option>
                        <option value="piatu" {{ $yatim->status == 'piatu' ? 'selected' : '' }}>Piatu (Ibu Wafat)</option>
                        <option value="yatim_piatu" {{ $yatim->status == 'yatim_piatu' ? 'selected' : '' }}>Yatim Piatu (Keduanya Wafat)</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Nama Orang Tua yang Wafat</label>
                    <input type="text" name="nama_orang_tua_wafat" class="form-control" value="{{ $yatim->nama_orang_tua_wafat }}">
                </div>
                <div class="col-12">
                    <label class="form-label">Keterangan Tambahan</label>
                    <textarea name="keterangan" class="form-control" rows="3">{{ $yatim->keterangan }}</textarea>
                </div>
            </div>
        </div>
        <div class="card-footer bg-white">
            <button type="submit" class="btn btn-primary">Update Data</button>
        </div>
    </div>
</form>
@endsection