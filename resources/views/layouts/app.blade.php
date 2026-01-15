<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B-Panel | Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root { --sidebar-width: 260px; --navy: #0f172a; --bg-light: #f8fafc; }
        body { font-family: 'Inter', sans-serif; background-color: var(--bg-light); margin: 0; display: flex; }
        .sidebar { width: var(--sidebar-width); height: 100vh; background: var(--navy); color: white; position: fixed; padding: 1.5rem; display: flex; flex-direction: column; }
        .sidebar-brand { font-family: 'Playfair Display'; font-size: 1.5rem; font-weight: 700; margin-bottom: 2rem; border-bottom: 1px solid #1e293b; padding-bottom: 1rem; text-align: center; color: #3b82f6; }
        .nav-link { display: flex; align-items: center; padding: 0.8rem 1rem; color: #94a3b8; text-decoration: none; border-radius: 8px; margin-bottom: 0.5rem; transition: 0.3s; font-size: 0.9rem; }
        .nav-link:hover, .nav-link.active { background: rgba(255,255,255,0.1); color: white; }
        .main-content { margin-left: var(--sidebar-width); width: calc(100% - var(--sidebar-width)); padding: 2.5rem; min-height: 100vh; }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="sidebar-brand">B-Panel</div>
        <nav style="flex-grow: 1;">
    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">📊 Dashboard</a>
    <a href="{{ route('admin.pendaftar') }}" class="nav-link {{ request()->routeIs('admin.pendaftar') ? 'active' : '' }}">👥 Data Pendaftar</a>
</nav>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-link" style="background:none; border:none; width:100%; cursor:pointer; text-align:left; color: #ef4444;">🚪 Logout</button>
        </form>
    </aside>
    <main class="main-content">
        {{ $slot }}
    </main>
</body>
</html>