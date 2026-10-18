@extends('layouts.admin')

@section('title', 'Daftar Keputusan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-1">Daftar Surat Keputusan</h5>
    
    {{-- Tombol Tambah hanya untuk yang berhak --}}
    @can('keputusan.create')
    <a href="{{ route('keputusan.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Keputusan
    </a>
    @endcan
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th width="50">No</th>
                    <th>Tanggal</th>
                    <th>Tentang</th>
                    <th>Keterangan</th>
                    <th width="120" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($keputusans as $k)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $k->tanggal_keputusan->format('d/m/Y') }}</td>
                    <td>
                        <strong>{{ $k->tentang }}</strong><br>
                        <small class="text-muted">{{ $k->nomor_keputusan }}</small>
                    </td>
                    <td>{{ Str::limit($k->keterangan, 50) }}</td>
                    <td class="text-center">
                        {{-- Semua orang bisa lihat detail --}}
                        <a href="{{ route('keputusan.show', $k->id) }}" class="btn btn-sm btn-outline-info">
                            <i class="bi bi-eye"></i>
                        </a>
                        
                        {{-- Tombol Edit hanya untuk yang berhak --}}
                        @can('keputusan.edit')
                        <a href="{{ route('keputusan.edit', $k->id) }}" class="btn btn-sm btn-outline-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        @endcan

                        {{-- Tombol Hapus hanya untuk yang berhak --}}
                        @can('keputusan.delete')
                        <form action="{{ route('keputusan.destroy', $k->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus keputusan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                        @endcan
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">Belum ada data keputusan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection