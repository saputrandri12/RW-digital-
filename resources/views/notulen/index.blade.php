@extends('layouts.admin')

@section('title', 'Notulen & Surat')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-1">Daftar {{ $tipe === 'notulen_rapat' ? 'Notulen Rapat' : 'Surat Keluar' }}</h5>
    
    @can('notulen.create')
    <a href="{{ route('notulen.create', ['tipe' => $tipe]) }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Data
    </a>
    @endcan
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Judul</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->tanggal->format('d/m/Y') }}</td>
                    <td><strong>{{ $item->judul }}</strong></td>
                    <td class="text-center">
                        <a href="{{ route('notulen.show', $item->id) }}" class="btn btn-sm btn-outline-info">
                            <i class="bi bi-eye"></i>
                        </a>
                        
                        @can('notulen.edit')
                        <a href="{{ route('notulen.edit', $item->id) }}" class="btn btn-sm btn-outline-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        @endcan
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">Belum ada data.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection