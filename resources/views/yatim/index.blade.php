@extends('layouts.admin')
@section('title', 'Data Yatim & Piatu')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-1">Data Yatim & Piatu</h5>
    @can('yatim.create')
    <a href="{{ route('yatim.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Tambah Data</a>
    @endcan
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>No</th><th>Nama Anak</th><th>RT</th><th>Status</th><th>Keterangan</th><th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dataYatims as $i => $y)
                <tr>
                    <td>{{ $dataYatims->firstItem() + $i }}</td>
                    <td><strong>{{ $y->warga->nama ?? '-' }}</strong></td>
                    <td>{{ $y->warga->rt->nama_rt ?? '-' }}</td>
                    <td><span class="badge bg-warning text-dark">{{ $y->status_label }}</span></td>
                    <td>{{ Str::limit($y->keterangan, 40) }}</td>
                    <td class="text-center">
                        <a href="{{ route('yatim.show', $y->id) }}" class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></a>
                        @can('yatim.edit')
                        <a href="{{ route('yatim.edit', $y->id) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                        @endcan
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-4 text-muted">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection