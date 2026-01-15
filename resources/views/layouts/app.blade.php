<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B-Panel | Admin Dashboard</title>
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
            margin-bottom: 2.5rem;
            text-align: center;
        }
        
        /* Logo tanpa card/kotak putih */
        .logo-img {
            height: 85px; /* Ukuran ditingkatkan agar lebih jelas */
            width: auto;
            margin: 0 auto 1.25rem;
            display: block;
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
        }
        
        .sidebar-brand { 
            font-family: 'Poppins', sans-serif; 
            font-size: 1.6rem; 
            font-weight: 800; 
            background: linear-gradient(135deg, #0066cc 0%, #004c99 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.5px;
        }
        
        .sidebar-subtitle {
            font-size: 0.75rem;
            color: #64748b;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-top: 0.25rem;
        }

        .nav-link { 
            display: flex; 
            align-items: center; 
            padding: 0.9rem 1.1rem; 
            color: #64748b; 
            text-decoration: none; 
            border-radius: 12px; 
            margin-bottom: 0.5rem; 
            transition: all 0.3s ease;
            font-weight: 600;
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
            padding: 0.8rem;
            background: #fff1f2;
            color: #e11d48;
            border-radius: 10px;
            font-weight: 700;
            transition: all 0.2s;
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
            <img src="https://tse3.mm.bing.net/th/id/OIP.lT6599E9vZtjj81vWTllEwHaIO?pid=Api&P=0&h=180" alt="Logo" class="h-10 w-auto object-contain" width="300">
            
            <div class="sidebar-brand">B-Panel</div>
            <div class="sidebar-subtitle">Admin Dashboard</div>
        </div>
        
        <nav class="flex-grow">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-4 mb-4">Menu Utama</p>
            
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="mr-3 text-xl">📊</span>
                <span>Dashboard</span>
            </a>
            
            <a href="{{ route('admin.pendaftar') }}" class="nav-link {{ request()->routeIs('admin.pendaftar') ? 'active' : '' }}">
                <span class="mr-3 text-xl">👥</span>
                <span>Data Pendaftar</span>
            </a>
        </nav>
        
        <div class="sidebar-footer">
            <div class="mb-4 px-2 text-center">
                <p class="text-xs font-bold text-slate-800">{{ Auth::user()->name ?? 'Administrator' }}</p>
                <p class="text-[10px] text-slate-500 font-medium">Super Admin</p>
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