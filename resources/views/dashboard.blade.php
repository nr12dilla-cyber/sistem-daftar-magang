<x-app-layout>
    <style>
        /* Container Sedang */
        .dashboard-container {
            background: linear-gradient(135deg, #f0f9ff 0%, #e2e8f0 100%);
            min-height: 100vh;
            padding: 20px;
            font-family: 'Inter', sans-serif;
            position: relative;
        }

        /* Lebar Konten Menengah (1150px) */
        .content-layer { 
            position: relative; 
            z-index: 10; 
            max-width: 1150px; 
            margin: 0 auto; 
        }

        /* Stat Card Proporsional */
        .stat-card { 
            animation: slideInUp 0.6s ease-out forwards; 
            opacity: 0; 
            padding: 18px; 
            border-radius: 16px;
            background: white;
            border: 1px solid rgba(0, 102, 204, 0.08);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
        }

        .hover-lift:hover { 
            transform: translateY(-4px); 
            box-shadow: 0 10px 20px rgba(0, 102, 204, 0.1); 
        }

        @keyframes slideInLeft { from { opacity: 0; transform: translateX(-25px); } to { opacity: 1; transform: translateX(0); } }
        @keyframes slideInUp { from { opacity: 0; transform: translateY(25px); } to { opacity: 1; transform: translateY(0); } }
    </style>

    <div class="dashboard-container">
        <div class="content-layer">
            <div style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(20px); border-radius: 18px; padding: 18px 24px; margin-bottom: 24px; box-shadow: 0 6px 25px rgba(0, 102, 204, 0.06); border: 1px solid rgba(255,255,255,0.5); animation: slideInLeft 0.8s ease-out; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h1 style="background: linear-gradient(135deg, #0066cc 0%, #004c99 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-size: 1.5rem; font-weight: 800; margin: 0; letter-spacing: -0.3px;">Dashboard Analitik</h1>
                    <p style="color: #64748b; font-size: 0.8rem; margin: 0; font-weight: 500;">Monitoring Data Registrasi Kominfo Binjai</p>
                </div>
                <div style="background: linear-gradient(135deg, #0066cc 0%, #004c99 100%); padding: 8px 18px; border-radius: 10px; color: white; text-align: center;">
                    <span style="display: block; font-size: 0.6rem; font-weight: 700; opacity: 0.8;">TAHUN</span>
                    <span style="font-size: 1rem; font-weight: 800;">{{ date('Y') }}</span>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; margin-bottom: 24px;">
                @foreach([
                    'total' => ['label' => 'Total Pendaftar', 'icon' => '👥', 'color' => '#0066cc'],
                    'pending' => ['label' => 'Pending', 'icon' => '⏳', 'color' => '#ff7800'],
                    'diterima' => ['label' => 'Diterima', 'icon' => '✓', 'color' => '#10b981'],
                    'ditolak' => ['label' => 'Ditolak', 'icon' => '✗', 'color' => '#ef4444']
                ] as $key => $cfg)
                <div class="stat-card hover-lift">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px;">
                        <span style="color: #64748b; font-size: 0.75rem; font-weight: 700; text-transform: uppercase;">{{ $cfg['label'] }}</span>
                        <span style="font-size: 1.2rem;">{{ $cfg['icon'] }}</span>
                    </div>
                    <div style="color: {{ $cfg['color'] }}; font-size: 1.6rem; font-weight: 800;">
                        {{ number_format($stats[$key] ?? 0) }}
                    </div>
                </div>
                @endforeach
            </div>

            <div style="background: white; border: 1px solid rgba(0, 102, 204, 0.08); border-radius: 20px; padding: 22px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03); animation: slideInUp 0.8s ease-out 0.4s backwards;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="width: 38px; height: 38px; background: #f0f7ff; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #0066cc; border: 1px solid rgba(0, 102, 204, 0.1);">📊</div>
                        <h3 style="color: #0f172a; font-size: 1.05rem; font-weight: 700; margin: 0;">Tren Pendaftaran Bulanan</h3>
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
                
                <div style="height: 300px; position: relative;">
                    <canvas id="chartPendaftaran"></canvas>
                </div>
            </div>

            <div style="margin-top: 25px; text-align: center; color: #94a3b8; font-size: 0.75rem;">
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
                    { label: 'Diterima', data: @json($dataGrafik['diterima']), backgroundColor: '#10b981', borderRadius: 5, barThickness: 12 },
                    { label: 'Ditolak', data: @json($dataGrafik['ditolak']), backgroundColor: '#ef4444', borderRadius: 5, barThickness: 12 },
                    { label: 'Pending', data: @json($dataGrafik['pending']), backgroundColor: '#ff7800', borderRadius: 5, barThickness: 12 }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { 
                    y: { beginAtZero: true, grid: { color: '#f1f5f9' }, ticks: { font: { size: 10 } } },
                    x: { grid: { display: false }, ticks: { font: { size: 10 } } }
                }
            }
        });
    </script>
</x-app-layout>