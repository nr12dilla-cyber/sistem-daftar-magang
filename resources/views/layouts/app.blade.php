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
            --primary-blue: #0066cc;
            --primary-orange: #ff7800;
        }
        
        body { 
            font-family: 'Inter', sans-serif; 
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 50%, #f0f9ff 100%);
        }
        
        .sidebar { 
            width: var(--sidebar-width); 
            height: 100vh; 
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
            position: fixed; 
            padding: 2rem 1.5rem; 
            display: flex; 
            flex-direction: column;
            box-shadow: 4px 0 24px rgba(0, 102, 204, 0.08);
            border-right: 2px solid rgba(0, 102, 204, 0.1);
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
        }
        
        /* UKURAN SEDANG (60px) */
        .logo-img {
            height: 70px; 
            width: auto;
            filter: drop-shadow(0 4px 6px rgba(255, 252, 252, 0.08));
            transition: all 0.3s ease;
        }

        .logo-img:hover {
            transform: translateY(-3px);
            filter: drop-shadow(0 6px 8px rgba(0, 0, 0, 0.12));
        }
        
        .sidebar-brand { 
            font-family: 'Poppins', sans-serif; 
            font-size: 1.4rem; 
            font-weight: 800; 
            background: linear-gradient(135deg, #0066cc 0%, #004c99 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.5px;
            text-transform: uppercase;
            line-height: 1.2;
        }
        
        .sidebar-subtitle {
            font-size: 0.65rem;
            color: #64748b;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 0.2rem;
        }

        .nav-link { 
            display: flex; 
            align-items: center; 
            padding: 0.8rem 1rem; 
            color: #64748b; 
            text-decoration: none; 
            border-radius: 12px; 
            margin-bottom: 0.4rem; 
            transition: all 0.3s ease;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .nav-link:hover {
            background: rgba(0, 102, 204, 0.06);
            color: var(--primary-blue);
            transform: translateX(5px);
        }
        
        .nav-link.active { 
            background: linear-gradient(135deg, #0066cc 0%, #004c99 100%);
            color: white;
            box-shadow: 0 8px 15px rgba(0, 102, 204, 0.2);
        }

        .sidebar-footer {
            margin-top: auto;
            padding-top: 1.5rem;
            border-top: 1px solid #e2e8f0;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 0.75rem;
            background: #fff1f2;
            color: #e11d48;
            border-radius: 10px;
            font-weight: 700;
            transition: all 0.2s;
            border: 1px solid rgba(225, 29, 72, 0.1);
            cursor: pointer;
        }

        .logout-btn:hover {
            background: #e11d48;
            color: white;
        }
    </style>
</head>
<body class="flex">

    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="logo-img-box">
                <img src="{{ asset('images/logobinjai.png') }}" alt="Logo Kota Binjai" class="logo-img">
            </div> 
            
            <div class="sidebar-brand">Admin </div>
            <div class="sidebar-subtitle">DISKOMINFO KOTA BINJAI</div>
        </div>
        
        <nav class="flex-grow">
            <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-[2px] ml-4 mb-4">Utama</p>
            
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="mr-3">📊</span>
                <span>Ringkasan</span>
            </a>
            
            <a href="{{ route('admin.pendaftar') }}" class="nav-link {{ request()->routeIs('admin.pendaftar') ? 'active' : '' }}">
                <span class="mr-3">👥</span>
                <span>Data Pendaftar</span>
            </a>

            <a href="{{ route('admin.manage') }}" class="nav-link {{ request()->routeIs('admin.manage') ? 'active' : '' }}">
                <span class="mr-3">🛡️</span>
                <span>Kelola Admin</span>
            </a>
        </nav>
        
        <div class="sidebar-footer">
            <div class="mb-4 px-2 text-center">
                <p class="text-xs font-bold text-slate-800">{{ Auth::user()->name ?? 'Administrator' }}</p>
                <div class="inline-block px-2 py-0.5 bg-blue-100 text-[9px] text-blue-700 font-bold rounded-full mt-1">
                    SUPER ADMIN
                </div>
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