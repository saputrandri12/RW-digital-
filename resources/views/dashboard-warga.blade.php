@extends('layouts.warga-grid')

@section('title', 'Beranda')

@section('content')

    {{-- 1. KELUARGA SAYA --}}
    @can('keluarga.view')
    <a href="{{ route('keluarga.index') }}" class="menu-item">
        <div class="icon-box bg-primary bg-opacity-10 text-primary">
            <i class="bi bi-house-heart"></i>
        </div>
        <div class="menu-title">Keluarga Saya</div>
    </a>
    @endcan

    {{-- 2. PENGUMUMAN & BERITA --}}
    @can('pengumuman.view')
    <a href="{{ route('pengumuman.index', ['tipe' => 'pengumuman']) }}" class="menu-item">
        <div class="icon-box bg-warning bg-opacity-10 text-warning">
            <i class="bi bi-megaphone"></i>
        </div>
        <div class="menu-title">Pengumuman</div>
    </a>
    @endcan

    @can('berita.view')
    <a href="{{ route('pengumuman.index', ['tipe' => 'berita']) }}" class="menu-item">
        <div class="icon-box bg-info bg-opacity-10 text-info">
            <i class="bi bi-newspaper"></i>
        </div>
        <div class="menu-title">Berita RW</div>
    </a>
    @endcan

    {{-- 3. SURAT & PENGADUAN --}}
    @can('surat.create')
    <a href="{{ route('surat.index') }}" class="menu-item">
        <div class="icon-box bg-success bg-opacity-10 text-success">
            <i class="bi bi-envelope-paper"></i>
        </div>
        <div class="menu-title">Surat Menyurat</div>
    </a>
    @endcan

    @can('pengaduan.create')
    <a href="{{ route('pengaduan.index') }}" class="menu-item">
        <div class="icon-box bg-danger bg-opacity-10 text-danger">
            <i class="bi bi-chat-left-text"></i>
        </div>
        <div class="menu-title">Pengaduan</div>
    </a>
    @endcan

    {{-- 4. KEUANGAN SAYA (Tagihan) --}}
    @can('tagihan.view')
    <a href="{{ route('keuangan.warga.index') }}" class="menu-item">
        <div class="icon-box bg-primary bg-opacity-10 text-primary">
            <i class="bi bi-wallet2"></i>
        </div>
        <div class="menu-title">Tagihan Saya</div>
    </a>
    @endcan

    {{-- 5. SECURITY --}}
    @can('ronda.view')
    <a href="{{ route('ronda.index') }}" class="menu-item">
        <div class="icon-box bg-secondary bg-opacity-10 text-secondary">
            <i class="bi bi-shield-check"></i>
        </div>
        <div class="menu-title">Jadwal Ronda</div>
    </a>
    @endcan

    @can('panic.create')
    <a href="{{ route('panic.index') }}" class="menu-item border border-danger">
        <div class="icon-box bg-danger text-white">
            <i class="bi bi-exclamation-triangle"></i>
        </div>
        <div class="menu-title text-danger">Panic Button</div>
    </a>
    @endcan

    {{-- 6. POSYANDU & YATIM --}}
    @can('posyandu.view')
    <a href="{{ route('posyandu.index') }}" class="menu-item">
        <div class="icon-box bg-danger bg-opacity-10 text-danger">
            <i class="bi bi-heart-pulse"></i>
        </div>
        <div class="menu-title">Posyandu</div>
    </a>
    @endcan

    @can('yatim.view')
    <a href="{{ route('yatim.index') }}" class="menu-item">
        <div class="icon-box bg-warning bg-opacity-10 text-warning">
            <i class="bi bi-people"></i>
        </div>
        <div class="menu-title">Data Yatim</div>
    </a>
    @endcan

    {{-- 7. PETA, UMKM, LOWONGAN, INVENTARIS --}}
    @can('peta.view')
    <a href="{{ route('peta.index') }}" class="menu-item">
        <div class="icon-box bg-info bg-opacity-10 text-info">
            <i class="bi bi-geo-alt"></i>
        </div>
        <div class="menu-title">Peta RW</div>
    </a>
    @endcan

    @can('umkm.view')
    <a href="{{ route('umkm.index') }}" class="menu-item">
        <div class="icon-box bg-success bg-opacity-10 text-success">
            <i class="bi bi-shop"></i>
        </div>
        <div class="menu-title">UMKM Warga</div>
    </a>
    @endcan

    @can('inventaris.view')
    <a href="{{ route('inventaris.index') }}" class="menu-item">
        <div class="icon-box bg-secondary bg-opacity-10 text-secondary">
            <i class="bi bi-box-seam"></i>
        </div>
        <div class="menu-title">Inventaris</div>
    </a>
    @endcan

    {{-- 8. NOTULEN & KEPUTUSAN (Jika Warga Diizinkan Lihat) --}}
    @can('notulen.view')
    <a href="{{ route('notulen.index', ['tipe' => 'notulen_rapat']) }}" class="menu-item">
        <div class="icon-box bg-dark bg-opacity-10 text-dark">
            <i class="bi bi-journal-text"></i>
        </div>
        <div class="menu-title">Notulen Rapat</div>
    </a>
    @endcan

    @can('keputusan.view')
    <a href="{{ route('keputusan.index') }}" class="menu-item">
        <div class="icon-box bg-dark bg-opacity-10 text-dark">
            <i class="bi bi-file-earmark-check"></i>
        </div>
        <div class="menu-title">Daftar Keputusan</div>
    </a>
    @endcan

    @can('surat.view')
    <a href="{{ route('notulen.index', ['tipe' => 'surat_keluar']) }}" class="menu-item">
        <div class="icon-box bg-dark bg-opacity-10 text-dark">
            <i class="bi bi-journal-text"></i>
        </div>
        <div class="menu-title">Surat Keluar</div>
    </a>
    @endcan

@endsection