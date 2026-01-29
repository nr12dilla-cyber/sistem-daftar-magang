<x-app-layout>
    <style>
        :root { 
            --blue-primary: #1e5a8e; 
            --blue-dark: #15436b; 
            --blue-darker: #0d2f4d;
        }
        
        /* Import fonts yang sama */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@600;700;800;900&display=swap');
        
        /* Container Utama */
        .dashboard-wrapper {
            font-family: 'Inter', sans-serif;
            position: relative;
            min-height: 100vh;
            width: 100%;
            background: #f5f7fa;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
        }

        h1, h2, h3, label, .stat-label { 
            font-family: 'Poppins', sans-serif; 
        }

        /* Lapis Konten */
        .content-layer {
            position: relative;
            z-index: 10;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
            padding: 40px 24px;
        }

        /* Card dengan shadow yang sama seperti form pendaftaran */
        .glass-card {
            background: white;
            border-radius: 24px;
            border: 1px solid #f1f3f5;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        }

        /* Header card dengan gradient yang sama */
        .header-card {
            background: linear-gradient(135deg, #1e5a8e 0%, #15436b 100%);
            padding: 2rem;
            border-radius: 24px;
            color: white;
            margin-bottom: 32px;
            box-shadow: 0 4px 20px rgba(30, 90, 142, 0.3);
        }

        .stat-card {
            background: white;
            padding: 24px;
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
            border: 1px solid #f1f3f5;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
        }

        /* Logo wrapper dengan style yang sama */
        .logo-wrapper { 
            background: white; 
            border-radius: 50%; 
            display: inline-flex; 
            align-items: center; 
            justify-content: center; 
            width: 60px; 
            height: 60px; 
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); 
            border: 3px solid rgba(255, 255, 255, 0.3); 
        }

        /* Icon backgrounds dengan tema blue */
        .icon-bg-primary { background: #e3e8ff; }
        .icon-bg-warning { background: rgba(30, 90, 142, 0.1); }
        .icon-bg-success { background: rgba(30, 90, 142, 0.15); }
        .icon-bg-danger { background: rgba(30, 90, 142, 0.05); }

        /* Text colors mengikuti tema */
        .text-diskominfo {
            color: #2d3748;
        }

        .text-blue-primary {
            color: var(--blue-primary);
        }

        /* Chart container */
        .chart-card {
            background: white;
            border-radius: 24px;
            border: 1px solid #f1f3f5;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            padding: 32px;
        }

        /* Accent bar dengan warna primary */
        .accent-bar {
            width: 8px; 
            height: 24px; 
            background: linear-gradient(135deg, #1e5a8e 0%, #15436b 100%); 
            border-radius: 4px;
        }

        /* Responsive grid */
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr) !important;
            }
        }
        
        @media (max-width: 640px) {
            .stats-grid {
                grid-template-columns: 1fr !important;
            }
        }
    </style>

    <div class="dashboard-wrapper">
        <div class="content-layer">
            
            <!-- Header Card dengan gradient sama seperti form -->
            <div class="header-card">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div style="display: flex; align-items: center; gap: 20px;">
                        <div class="logo-wrapper">
                            <img src="{{ asset('images/logobinjai.png') }}" style="height: 32px;" alt="Logo Binjai">
                        </div>
                        <div>
                            <h1 style="font-size: 1.75rem; font-weight: 800; margin: 0; letter-spacing: -0.5px;">Dashboard Analitik</h1>
                            <p style="color: rgba(255,255,255,0.8); font-size: 0.75rem; font-weight: 600; margin: 0; text-transform: uppercase; letter-spacing: 1.5px;">Diskominfo Kota Binjai</p>
                        </div>
                    </div>
                    <div style="text-align: right;">
                        <span style="display: block; font-size: 0.65rem; font-weight: 800; color: rgba(255,255,255,0.6); letter-spacing: 1px; text-transform: uppercase;">Periode</span>
                        <span style="font-size: 1.25rem; font-weight: 900; color: white;">{{ date('Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; margin-bottom: 32px;">
                @foreach([
                    'total' => ['label' => 'Total Peserta', 'icon' => '👥', 'bg' => 'icon-bg-primary'],
                    'pending' => ['label' => 'Menunggu', 'icon' => '⏳', 'bg' => 'icon-bg-warning'],
                    'diterima' => ['label' => 'Diterima', 'icon' => '✅', 'bg' => 'icon-bg-success'],
                    'ditolak' => ['label' => 'Ditolak', 'icon' => '❌', 'bg' => 'icon-bg-danger']
                ] as $key => $cfg)
                <div class="stat-card">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                        <div style="width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;" class="{{ $cfg['bg'] }}">
                            {{ $cfg['icon'] }}
                        </div>
                        <span class="stat-label" style="color: #a0aec0; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">{{ $cfg['label'] }}</span>
                    </div>
                    <div style="font-size: 2.25rem; font-weight: 900; color: #2d3748; font-family: 'Poppins', sans-serif;">
                        {{ number_format($stats[$key] ?? 0) }}
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Chart Card -->
            <div class="chart-card">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 24px;">
                    <div class="accent-bar"></div>
                    <h3 style="font-weight: 800; font-size: 1.2rem; color: #2d3748; margin: 0; letter-spacing: -0.3px;">Statistik Pendaftaran Bulanan</h3>
                </div>
                <div style="height: 350px;">
                    <canvas id="chartPendaftaran"></canvas>
                </div>
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
                        backgroundColor: '#10b981', // Diubah dari biru ke hijau
                        borderRadius: 8,
                        borderSkipped: false
                    },
                    { 
                        label: 'Ditolak', 
                        data: @json($dataGrafik['ditolak']), 
                        backgroundColor: '#ef4444', 
                        borderRadius: 8,
                        borderSkipped: false
                    },
                    { 
                        label: 'Pending', 
                        data: @json($dataGrafik['pending']), 
                        backgroundColor: '#f59e0b', 
                        borderRadius: 8,
                        borderSkipped: false
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { 
                    legend: { 
                        position: 'bottom', 
                        labels: { 
                            usePointStyle: true, 
                            padding: 20, 
                            font: { 
                                weight: 'bold',
                                family: 'Inter'
                            }
                        } 
                    } 
                },
                scales: {
                    y: { 
                        beginAtZero: true, 
                        grid: { 
                            borderDash: [5, 5], 
                            color: '#f1f3f5' 
                        },
                        ticks: {
                            font: {
                                family: 'Inter',
                                weight: '500'
                            }
                        }
                    },
                    x: { 
                        grid: { display: false },
                        ticks: {
                            font: {
                                family: 'Inter',
                                weight: '600'
                            }
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
