<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    {{-- Meta tag agar tampilan pas di HP --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="#667eea">
    <title>@yield('title', 'Beranda Warga') - RW Digital</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body { 
            background: #f4f6f9; 
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; 
            -webkit-tap-highlight-color: transparent; /* Hilangkan efek biru saat di-tap di HP */
        }

        /* Header Profil */
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 0 0 30px 30px;
            padding: 30px 20px 50px;
            color: #fff;
            text-align: center;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        /* Grid Menu Responsif */
        /* Grid Menu Responsif (Otomatis menyesuaikan layar) */
        .menu-grid {
            display: grid;
            /* Di HP tampil 3 kolom, di tablet 4, di desktop 6 */
            grid-template-columns: repeat(3, 1fr); 
            gap: 12px;
            margin-top: -35px;
            padding: 0 15px 30px;
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
        }

        @media (min-width: 576px) { .menu-grid { grid-template-columns: repeat(4, 1fr); } }
        @media (min-width: 768px) { .menu-grid { grid-template-columns: repeat(6, 1fr); gap: 20px; } }

        .menu-item {
            background: #fff; border-radius: 12px; padding: 15px 5px;
            text-align: center; text-decoration: none; color: #333;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            transition: transform 0.1s, box-shadow 0.1s;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            height: 100%; -webkit-tap-highlight-color: transparent;
        }

        .menu-item:active {
            transform: scale(0.95); box-shadow: 0 1px 4px rgba(0,0,0,0.1); background: #f8fafc;
        }

        /* Icon bulat */
        .icon-box {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 8px;
        }

        .menu-title {
            font-size: 11px;
            font-weight: 600;
            line-height: 1.2;
            /* Pastikan teks panjang turun ke bawah dengan rapi */
            word-wrap: break-word; 
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Optimasi Desktop (jika dibuka di laptop) */
        @media (min-width: 768px) {
            .menu-grid { max-width: 900px; margin-left: auto; margin-right: auto; }
            .menu-item { padding: 20px 10px; }
            .icon-box { width: 55px; height: 55px; font-size: 26px; }
            .menu-title { font-size: 13px; }
        }
    </style>
</head>
<body>

    {{-- Header Profil Warga --}}
    <div class="hero-section">
        <div class="d-flex justify-content-between align-items-center mb-3 px-2">
            <span class="fs-5 fw-bold"><i class="bi bi-house-heart-fill me-1"></i> RW Digital</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-sm btn-light text-danger fw-bold rounded-pill px-3">
                    <i class="bi bi-box-arrow-right"></i> Keluar
                </button>
            </form>
        </div>
        
        <div class="mt-3">
            <div class="bg-white bg-opacity-25 rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 70px; height: 70px;">
                <i class="bi bi-person-fill text-white" style="font-size: 40px;"></i>
            </div>
            <h5 class="mt-1 fw-bold mb-0">Halo, {{ auth()->user()->name }}</h5>
            <small class="opacity-75">Warga {{ auth()->user()->rt->nama_rt ?? '' }} / RW 07</small>
        </div>
    </div>

    {{-- Grid Menu --}}
    <div class="container-fluid">
        <div class="menu-grid">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>