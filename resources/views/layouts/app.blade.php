<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Admin Diskominfo</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root { 
            --sidebar-width: 280px; 
            --blue-primary: #1e5a8e;
            --blue-dark: #15436b;
            --blue-darker: #0d2f4d;
            --blue-light: #e3e8ff;
        }
        
        body { 
            font-family: 'Inter', sans-serif; 
            background: #f5f7fa;
        }
        
        .sidebar { 
            width: var(--sidebar-width); 
            height: 100vh; 
            background: white;
            position: fixed; 
            padding: 2rem 1.5rem; 
            display: flex; 
            flex-direction: column;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            border-right: 1px solid #f1f3f5;
        }
        
        .sidebar-header {
            margin-bottom: 2rem;
            text-align: center;
        }

        .logo-img-box {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 1rem;
            background: white;
            border-radius: 50%;
            width: 80px;
            height: 80px;
            box-shadow: 0 8px 20px rgba(30, 90, 142, 0.15);
            border: 3px solid rgba(30, 90, 142, 0.1);
            margin: 0 auto 1rem auto;
        }
        
        .logo-img {
            height: 50px; 
            width: auto;
            transition: all 0.3s ease;
        }

        .logo-img:hover {
            transform: scale(1.05);
        }
        
        .sidebar-brand { 
            font-family: 'Poppins', sans-serif; 
            font-size: 1.4rem; 
            font-weight: 800; 
            color: var(--blue-primary);
            letter-spacing: -0.5px;
            text-transform: uppercase;
            line-height: 1.2;
        }
        
        .sidebar-subtitle {
            font-size: 0.65rem;
            color: #718096;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 0.3rem;
        }

        .nav-link { 
            display: flex; 
            align-items: center; 
            padding: 0.875rem 1rem; 
            color: #6c757d; 
            text-decoration: none; 
            border-radius: 12px; 
            margin-bottom: 0.4rem; 
            transition: all 0.2s ease;
            font-weight: 600;
            font-size: 0.9rem;
            border: 2px solid transparent;
        }
        
        .nav-link:hover {
            background: #f8f9fa;
            color: var(--blue-primary);
            transform: translateX(3px);
            border-color: rgba(30, 90, 142, 0.1);
        }
        
        .nav-link.active { 
            background: linear-gradient(135deg, var(--blue-primary) 0%, var(--blue-dark) 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(30, 90, 142, 0.3);
            border-color: var(--blue-primary);
        }

        .sidebar-footer {
            margin-top: auto;
            padding-top: 1.5rem;
            border-top: 1px solid #f1f3f5;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 0.75rem;
            background: #fff5f5;
            color: #e53e3e;
            border-radius: 12px;
            font-weight: 700;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
            font-size: 0.85rem;
        }

        .logout-btn:hover {
            background: #e53e3e;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(229, 62, 62, 0.3);
        }

        .section-label {
            font-size: 10px;
            font-weight: 800;
            color: #a0aec0;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-left: 16px;
            margin-bottom: 12px;
            margin-top: 8px;
        }

        .admin-badge {
            display: inline-block;
            padding: 6px 12px;
            background: rgba(30, 90, 142, 0.1);
            color: var(--blue-primary);
            font-size: 9px;
            font-weight: 700;
            border-radius: 20px;
            margin-top: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .admin-info {
            margin-bottom: 16px;
            padding: 0 8px;
            text-align: center;
        }

        .admin-name {
            font-size: 13px;
            font-weight: 700;
            color: #2d3748;
            font-family: 'Poppins', sans-serif;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .sidebar.open {
                transform: translateX(0);
            }
            
            main {
                margin-left: 0 !important;
                width: 100% !important;
            }
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: #f1f3f5;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: var(--blue-primary);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: var(--blue-dark);
        }
    </style>
</head>
<body class="flex">

    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="logo-img-box">
                <img src="{{ asset('images/logobinjai.png') }}" alt="Logo Kota Binjai" class="logo-img">
            </div> 
            
            <div class="sidebar-brand">Admin</div>
            <div class="sidebar-subtitle">DISKOMINFO KOTA BINJAI</div>
        </div>
        
        <nav class="flex-grow">
            <p class="section-label">Menu Utama</p>
            
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="mr-3">📊</span>
                <span>Dashboard</span>
            </a>
            
            <a href="{{ route('admin.pendaftar') }}" class="nav-link {{ request()->routeIs('admin.pendaftar') ? 'active' : '' }}">
                <span class="mr-3">👥</span>
                <span>Data Pendaftar</span>
            </a>

            <a href="{{ route('admin.laporan') }}" class="nav-link {{ request()->routeIs('admin.laporan') ? 'active' : '' }}">
                <span class="mr-3">📝</span>
                <span>Laporan Magang</span>
            </a>

            <a href="{{ route('admin.manage') }}" class="nav-link {{ request()->routeIs('admin.manage') ? 'active' : '' }}">
                <span class="mr-3">🛡️</span>
                <span>Kelola Admin</span>
            </a>

            <p class="section-label">Laporan</p>

            <a href="{{ route('pendaftaran.cetak') }}" target="_blank" class="nav-link">
                <span class="mr-3">🖨️</span>
                <span>Cetak PDF</span>
            </a>
        </nav>
        
        <div class="sidebar-footer">
            <div class="admin-info">
                <p class="admin-name">{{ Auth::user()->name ?? 'Administrator' }}</p>
                <div class="admin-badge">Super Admin</div>
            </div>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <span>🚪</span> Logout
                </button>
            </form>
        </div>
    </aside>
    
    <main class="ml-[280px] w-full p-8">
        {{ $slot }}
    </main>

</body>
</html>