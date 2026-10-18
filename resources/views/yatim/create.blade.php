@extends('layouts.admin')
@section('title', 'Tambah Data Yatim')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-1">Tambah Data Yatim</h5>
    <a href="{{ route('yatim.index') }}" class="btn btn-outline-secondary btn-sm">Kembali</a>
</div>

<form method="POST" action="{{ route('yatim.store') }}">
    @csrf
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Pilih Anak (Warga < 18 Tahun) <span class="text-danger">*</span></label>
                    <select name="warga_id" class="form-select select2" required>
                        <option value="">-- Pilih Anak --</option>
                        @foreach($wargas as $w)
                            <option value="{{ $w->id }}">{{ $w->nik }} - {{ $w->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select" required>
                        <option value="yatim">Yatim (Ayah Wafat)</option>
                        <option value="piatu">Piatu (Ibu Wafat)</option>
                        <option value="yatim_piatu">Yatim Piatu (Keduanya Wafat)</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Nama Orang Tua yang Wafat</label>
                    <input type="text" name="nama_orang_tua_wafat" class="form-control">
                </div>
                <div class="col-12">
                    <label class="form-label">Keterangan Tambahan</label>
                    <textarea name="keterangan" class="form-control" rows="3"></textarea>
                </div>
            </div>
        </div>
        <div class="card-footer bg-white">
            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </div>
    </div>
</form>
@endsection