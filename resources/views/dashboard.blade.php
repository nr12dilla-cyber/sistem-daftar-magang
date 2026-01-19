<x-app-layout>
    <style>
        /* Animated Background */
        .dashboard-container {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 50%, #f0f9ff 100%);
            min-height: 100vh;
            padding: 24px;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            position: relative;
            overflow: hidden;
        }

        /* Background Animation Layer */
        .dashboard-container::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.6;
            background: 
                radial-gradient(circle at 20% 30%, rgba(0, 102, 204, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(255, 120, 0, 0.12) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(0, 102, 204, 0.1) 0%, transparent 50%);
            animation: gradientShift 15s ease-in-out infinite;
        }

        @keyframes gradientShift {
            0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.6; }
            33% { transform: translate(30px, -30px) scale(1.1); opacity: 0.8; }
            66% { transform: translate(-20px, 20px) scale(0.95); opacity: 0.7; }
        }

        /* Decorative Background Elements */
        .bg-decoration { position: fixed; border-radius: 50%; z-index: -1; pointer-events: none; filter: blur(80px); }
        .circle-1 { width: 600px; height: 600px; background: radial-gradient(circle, rgba(0, 102, 204, 0.25) 0%, transparent 70%); top: -250px; right: -150px; animation: float1 20s infinite; }
        .circle-2 { width: 500px; height: 500px; background: radial-gradient(circle, rgba(255, 120, 0, 0.2) 0%, transparent 70%); bottom: -200px; left: -150px; animation: float2 25s infinite; }
        
        @keyframes float1 { 0%, 100% { transform: translate(0,0); } 50% { transform: translate(30px, -30px); } }
        @keyframes float2 { 0%, 100% { transform: translate(0,0); } 50% { transform: translate(-30px, 30px); } }

        .pattern-dots {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1; opacity: 0.035;
            background-image: radial-gradient(circle, #0066cc 1.5px, transparent 1.5px);
            background-size: 35px 35px;
        }

        /* Animations */
        @keyframes slideInLeft { from { opacity: 0; transform: translateX(-30px); } to { opacity: 1; transform: translateX(0); } }
        @keyframes slideInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        
        .stat-card { animation: slideInUp 0.6s ease-out forwards; opacity: 0; }
        .stat-card:nth-child(1) { animation-delay: 0.1s; }
        .stat-card:nth-child(2) { animation-delay: 0.2s; }
        .stat-card:nth-child(3) { animation-delay: 0.3s; }
        .stat-card:nth-child(4) { animation-delay: 0.4s; }
        
        .hover-lift { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 12px 24px rgba(0, 102, 204, 0.15); }

        .content-layer { position: relative; z-index: 10; max-width: 1300px; margin: 0 auto; }
    </style>

    <div class="pattern-dots"></div>
    <div class="bg-decoration circle-1"></div>
    <div class="bg-decoration circle-2"></div>

    <div class="dashboard-container">
        <div class="content-layer">
            <div style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(20px); border-radius: 20px; padding: 20px 28px; margin-bottom: 24px; box-shadow: 0 8px 32px rgba(0, 102, 204, 0.08); border: 1px solid rgba(0, 102, 204, 0.1); animation: slideInLeft 0.8s ease-out; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 4px;">
                        <div style="width: 4px; height: 28px; background: linear-gradient(180deg, #0066cc 0%, #ff7800 100%); border-radius: 2px;"></div>
                        <h1 style="background: linear-gradient(135deg, #0066cc 0%, #004c99 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-size: 1.6rem; font-weight: 800; margin: 0; letter-spacing: -0.5px;">Dashboard Analitik</h1>
                    </div>
                    <p style="color: #64748b; font-size: 0.85rem; margin: 0; padding-left: 14px; font-weight: 500;">Sistem Informasi Data Center • Kominfo Kota Binjai</p>
                </div>
                
                <div style="background: linear-gradient(135deg, #0066cc 0%, #004c99 100%); padding: 10px 20px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 102, 204, 0.2); text-align: center;">
                    <div style="color: rgba(255, 255, 255, 0.8); font-size: 0.65rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">TAHUN</div>
                    <div style="color: #ffffff; font-size: 1.1rem; font-weight: 800;">{{ date('Y') }}</div>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px;">
                @foreach([
                    'total' => ['label' => 'Total Pendaftar', 'icon' => '👥', 'color' => '#0066cc', 'lightBg' => 'rgba(0, 102, 204, 0.06)'],
                    'pending' => ['label' => 'Menunggu Verifikasi', 'icon' => '⏳', 'color' => '#ff7800', 'lightBg' => 'rgba(255, 120, 0, 0.06)'],
                    'diterima' => ['label' => 'Diterima', 'icon' => '✓', 'color' => '#10b981', 'lightBg' => 'rgba(16, 185, 129, 0.06)'],
                    'ditolak' => ['label' => 'Ditolak', 'icon' => '✗', 'color' => '#ef4444', 'lightBg' => 'rgba(239, 68, 68, 0.06)']
                ] as $key => $cfg)
                <div class="stat-card hover-lift" style="background: white; border: 1px solid {{ $cfg['lightBg'] }}; padding: 16px; border-radius: 16px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03); position: relative; overflow: hidden;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                        <span style="color: #64748b; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">{{ $cfg['label'] }}</span>
                        <span style="font-size: 1.1rem;">{{ $cfg['icon'] }}</span>
                    </div>
                    
                    <div style="color: {{ $cfg['color'] }}; font-size: 1.8rem; font-weight: 800; letter-spacing: -0.5px;">
                        {{ number_format($stats[$key] ?? 0) }}
                    </div>
                    
                    <div style="margin-top: 10px; height: 3px; width: 30px; background: {{ $cfg['color'] }}; border-radius: 2px; opacity: 0.6;"></div>
                </div>
                @endforeach
            </div>

            <div style="background: white; border: 1px solid rgba(0, 102, 204, 0.1); border-radius: 20px; padding: 24px; box-shadow: 0 10px 30px rgba(0, 0, 20, 0.04); animation: slideInUp 0.8s ease-out 0.5s backwards;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="width: 40px; height: 40px; background: #f0f7ff; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #0066cc; font-size: 1.2rem; border: 1px solid rgba(0, 102, 204, 0.1);">📊</div>
                        <div>
                            <h3 style="color: #0f172a; font-size: 1.05rem; font-weight: 700; margin: 0;">Tren Pendaftaran Bulanan</h3>
                            <p style="color: #64748b; font-size: 0.75rem; margin: 0;">Data registrasi real-time tahun {{ date('Y') }}</p>
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 12px;">
                        @foreach(['Diterima' => '#10b981', 'Ditolak' => '#ef4444', 'Pending' => '#ff7800'] as $label => $color)
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <div style="width: 8px; height: 8px; background: {{ $color }}; border-radius: 2px;"></div>
                            <span style="color: #64748b; font-size: 0.7rem; font-weight: 600;">{{ $label }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <div style="height: 350px; position: relative;">
                    <canvas id="chartPendaftaran"></canvas>
                </div>
            </div>

            <div style="margin-top: 24px; text-align: center; color: #94a3b8; font-size: 0.75rem; font-weight: 500; animation: slideInUp 1s ease-out 0.7s backwards;">
                <p>© {{ date('Y') }} Dinas Komunikasi dan Informatika Kota Binjai</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('chartPendaftaran').getContext('2d');
        
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [
                    { 
                        label: 'Diterima', 
                        data: @json($dataGrafik['diterima']), 
                        backgroundColor: '#10b981',
                        borderRadius: 6,
                        barThickness: 15,
                    },
                    { 
                        label: 'Ditolak', 
                        data: @json($dataGrafik['ditolak']), 
                        backgroundColor: '#ef4444',
                        borderRadius: 6,
                        barThickness: 15,
                    },
                    { 
                        label: 'Pending', 
                        data: @json($dataGrafik['pending']), 
                        backgroundColor: '#ff7800',
                        borderRadius: 6,
                        barThickness: 15,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { 
                    y: { 
                        beginAtZero: true,
                        grid: { color: '#f1f5f9' },
                        ticks: { color: '#94a3b8', font: { size: 10 } }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#94a3b8', font: { size: 10 } }
                    }
                }
            }
        });
    </script>
</x-app-layout>