<x-app-layout>
    <div style="
        background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
        min-height: 100vh;
        padding: 40px;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        position: relative;
        overflow: hidden;
    ">
        <!-- Decorative Background Elements -->
        <div style="position: absolute; width: 600px; height: 600px; background: radial-gradient(circle, rgba(45, 108, 223, 0.15) 0%, transparent 70%); border-radius: 50%; top: -200px; right: -200px; pointer-events: none;"></div>
        <div style="position: absolute; width: 400px; height: 400px; background: radial-gradient(circle, rgba(16, 185, 129, 0.08) 0%, transparent 70%); border-radius: 50%; bottom: -100px; left: -100px; pointer-events: none;"></div>
        <div style="position: absolute; width: 300px; height: 300px; background: radial-gradient(circle, rgba(59, 130, 246, 0.06) 0%, transparent 70%); border-radius: 50%; top: 50%; left: 30%; pointer-events: none;"></div>

        <div style="position: relative; z-index: 1; max-width: 1400px; margin: 0 auto;">
            <!-- Header Section -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; padding-bottom: 25px; border-bottom: 1px solid rgba(255,255,255,0.08);">
                <div>
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                        <div style="width: 6px; height: 36px; background: linear-gradient(180deg, #2d6cdf 0%, #10b981 100%); border-radius: 3px;"></div>
                        <h1 style="color: #ffffff; font-size: 2rem; font-weight: 700; letter-spacing: -0.5px; margin: 0;">
                            Dashboard Analitik
                        </h1>
                    </div>
                    <p style="color: #94a3b8; font-size: 0.95rem; margin: 0; padding-left: 18px; font-weight: 400;">
                        Sistem Informasi Data Center Kominfo Kota Binjai
                    </p>
                </div>
                <div style="
                    background: rgba(255,255,255,0.06); 
                    border: 1px solid rgba(255,255,255,0.12); 
                    padding: 12px 24px; 
                    border-radius: 14px; 
                    backdrop-filter: blur(10px);
                    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
                ">
                    <div style="color: #64748b; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 2px;">Tahun Anggaran</div>
                    <div style="color: #e2e8f0; font-size: 1.1rem; font-weight: 700;">{{ date('Y') }}</div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; margin-bottom: 35px;">
                @foreach([
                    'total' => ['label' => 'Total Pendaftar', 'icon' => '👥', 'color' => '#2d6cdf', 'bg' => 'rgba(45, 108, 223, 0.1)'],
                    'pending' => ['label' => 'Menunggu Verifikasi', 'icon' => '⏳', 'color' => '#f59e0b', 'bg' => 'rgba(245, 158, 11, 0.1)'],
                    'diterima' => ['label' => 'Diterima', 'icon' => '✓', 'color' => '#10b981', 'bg' => 'rgba(16, 185, 129, 0.1)'],
                    'ditolak' => ['label' => 'Ditolak', 'icon' => '✗', 'color' => '#ef4444', 'bg' => 'rgba(239, 68, 68, 0.1)']
                ] as $key => $cfg)
                <div style="
                    background: rgba(255, 255, 255, 0.04);
                    border: 1px solid rgba(255, 255, 255, 0.08);
                    backdrop-filter: blur(20px);
                    padding: 26px;
                    border-radius: 18px;
                    box-shadow: 0 8px 32px rgba(0,0,0,0.12);
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    cursor: pointer;
                    position: relative;
                    overflow: hidden;
                " onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 48px rgba(0,0,0,0.2)'; this.style.borderColor='{{ $cfg['color'] }}33';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 32px rgba(0,0,0,0.12)'; this.style.borderColor='rgba(255,255,255,0.08)';">
                    
                    <!-- Card Background Decoration -->
                    <div style="position: absolute; top: -20px; right: -20px; width: 100px; height: 100px; background: {{ $cfg['bg'] }}; border-radius: 50%; filter: blur(40px);"></div>
                    
                    <div style="position: relative; z-index: 1;">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 18px;">
                            <div style="color: #cbd5e1; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.8px; line-height: 1.4;">
                                {{ $cfg['label'] }}
                            </div>
                            <div style="
                                background: {{ $cfg['bg'] }}; 
                                width: 42px; 
                                height: 42px; 
                                border-radius: 12px; 
                                display: flex; 
                                align-items: center; 
                                justify-content: center; 
                                font-size: 1.3rem;
                                border: 1px solid {{ $cfg['color'] }}22;
                            ">{{ $cfg['icon'] }}</div>
                        </div>
                        
                        <div style="color: #ffffff; font-size: 2.5rem; font-weight: 800; letter-spacing: -1px; margin-bottom: 12px;">
                            {{ $stats[$key] }}
                        </div>
                        
                        <div style="
                            height: 3px; 
                            width: 40px; 
                            background: linear-gradient(90deg, {{ $cfg['color'] }} 0%, transparent 100%); 
                            border-radius: 10px;
                        "></div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Chart Section -->
            <div style="
                background: rgba(255, 255, 255, 0.04);
                border: 1px solid rgba(255, 255, 255, 0.08);
                backdrop-filter: blur(20px);
                border-radius: 20px;
                padding: 35px;
                box-shadow: 0 20px 60px rgba(0,0,0,0.15);
            ">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="
                            width: 44px; 
                            height: 44px; 
                            background: linear-gradient(135deg, #2d6cdf 0%, #1e40af 100%); 
                            border-radius: 12px; 
                            display: flex; 
                            align-items: center; 
                            justify-content: center;
                            box-shadow: 0 8px 20px rgba(45, 108, 223, 0.25);
                        ">
                            <span style="font-size: 1.3rem;">📊</span>
                        </div>
                        <div>
                            <h3 style="color: #f8fafc; font-size: 1.15rem; font-weight: 700; margin: 0; margin-bottom: 2px;">
                                Tren Pendaftaran Bulanan
                            </h3>
                            <p style="color: #94a3b8; font-size: 0.85rem; margin: 0; font-weight: 400;">
                                Monitoring data per bulan tahun {{ date('Y') }}
                            </p>
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 15px; align-items: center;">
                        @foreach([
                            ['label' => 'Diterima', 'color' => '#10b981'],
                            ['label' => 'Ditolak', 'color' => '#ef4444'],
                            ['label' => 'Pending', 'color' => '#f59e0b']
                        ] as $legend)
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <div style="width: 12px; height: 12px; background: {{ $legend['color'] }}; border-radius: 3px; box-shadow: 0 0 8px {{ $legend['color'] }}66;"></div>
                            <span style="color: #cbd5e1; font-size: 0.85rem; font-weight: 500;">{{ $legend['label'] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <div style="height: 420px; padding: 10px;">
                    <canvas id="chartPendaftaran"></canvas>
                </div>
            </div>

            <!-- Footer Info -->
            <div style="margin-top: 30px; text-align: center; color: #64748b; font-size: 0.85rem; font-weight: 400;">
                <p style="margin: 0;">© {{ date('Y') }} Dinas Komunikasi dan Informatika Kota Binjai</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('chartPendaftaran').getContext('2d');
        
        // Gradient backgrounds for bars
        const gradientDiterima = ctx.createLinearGradient(0, 0, 0, 400);
        gradientDiterima.addColorStop(0, '#10b981');
        gradientDiterima.addColorStop(1, '#059669');
        
        const gradientDitolak = ctx.createLinearGradient(0, 0, 0, 400);
        gradientDitolak.addColorStop(0, '#ef4444');
        gradientDitolak.addColorStop(1, '#dc2626');
        
        const gradientPending = ctx.createLinearGradient(0, 0, 0, 400);
        gradientPending.addColorStop(0, '#f59e0b');
        gradientPending.addColorStop(1, '#d97706');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                datasets: [
                    { 
                        label: 'Diterima', 
                        data: @json($dataGrafik['diterima']), 
                        backgroundColor: gradientDiterima,
                        borderRadius: 8,
                        borderSkipped: false,
                    },
                    { 
                        label: 'Ditolak', 
                        data: @json($dataGrafik['ditolak']), 
                        backgroundColor: gradientDitolak,
                        borderRadius: 8,
                        borderSkipped: false,
                    },
                    { 
                        label: 'Pending', 
                        data: @json($dataGrafik['pending']), 
                        backgroundColor: gradientPending,
                        borderRadius: 8,
                        borderSkipped: false,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: { 
                    legend: { 
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(15, 23, 42, 0.95)',
                        titleColor: '#f1f5f9',
                        bodyColor: '#cbd5e1',
                        borderColor: 'rgba(255, 255, 255, 0.1)',
                        borderWidth: 1,
                        padding: 12,
                        displayColors: true,
                        boxWidth: 8,
                        boxHeight: 8,
                        usePointStyle: true,
                        titleFont: {
                            size: 13,
                            weight: '600'
                        },
                        bodyFont: {
                            size: 12,
                            weight: '500'
                        }
                    }
                },
                scales: { 
                    y: { 
                        beginAtZero: true,
                        border: {
                            display: false
                        },
                        grid: { 
                            color: 'rgba(255, 255, 255, 0.04)',
                            drawTicks: false,
                        },
                        ticks: { 
                            color: '#94a3b8',
                            font: {
                                size: 12,
                                weight: '500'
                            },
                            stepSize: 1,
                            padding: 10
                        }
                    },
                    x: {
                        border: {
                            display: false
                        },
                        grid: { 
                            display: false 
                        },
                        ticks: { 
                            color: '#94a3b8',
                            font: {
                                size: 11,
                                weight: '500'
                            },
                            padding: 8
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>