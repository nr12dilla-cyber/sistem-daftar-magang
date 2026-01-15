<x-app-layout>
    <div style="
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 50%, #f0f9ff 100%);
        min-height: 100vh;
        padding: 32px;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        position: relative;
        overflow: hidden;
    ">
        <!-- Decorative Background Elements -->
        <div style="position: absolute; width: 500px; height: 500px; background: radial-gradient(circle, rgba(0, 102, 204, 0.08) 0%, transparent 70%); border-radius: 50%; top: -100px; right: -100px; pointer-events: none;"></div>
        <div style="position: absolute; width: 400px; height: 400px; background: radial-gradient(circle, rgba(255, 120, 0, 0.06) 0%, transparent 70%); border-radius: 50%; bottom: -80px; left: -80px; pointer-events: none;"></div>
        <div style="position: absolute; width: 350px; height: 350px; background: radial-gradient(circle, rgba(0, 102, 204, 0.04) 0%, transparent 70%); border-radius: 50%; top: 40%; left: 50%; pointer-events: none;"></div>
        
        <!-- Animated floating shapes -->
        <div style="position: absolute; width: 80px; height: 80px; background: linear-gradient(135deg, rgba(0, 102, 204, 0.1), rgba(255, 120, 0, 0.1)); border-radius: 20px; top: 15%; left: 10%; animation: float 6s ease-in-out infinite; pointer-events: none;"></div>
        <div style="position: absolute; width: 60px; height: 60px; background: linear-gradient(135deg, rgba(255, 120, 0, 0.1), rgba(0, 102, 204, 0.1)); border-radius: 50%; top: 60%; right: 15%; animation: float 8s ease-in-out infinite 1s; pointer-events: none;"></div>

        <style>
            @keyframes float {
                0%, 100% { transform: translateY(0px) rotate(0deg); }
                50% { transform: translateY(-20px) rotate(5deg); }
            }
            
            @keyframes slideInLeft {
                from { opacity: 0; transform: translateX(-30px); }
                to { opacity: 1; transform: translateX(0); }
            }
            
            @keyframes slideInUp {
                from { opacity: 0; transform: translateY(30px); }
                to { opacity: 1; transform: translateY(0); }
            }
            
            @keyframes pulse {
                0%, 100% { transform: scale(1); }
                50% { transform: scale(1.05); }
            }
            
            .stat-card {
                animation: slideInUp 0.6s ease-out forwards;
            }
            
            .stat-card:nth-child(1) { animation-delay: 0.1s; }
            .stat-card:nth-child(2) { animation-delay: 0.2s; }
            .stat-card:nth-child(3) { animation-delay: 0.3s; }
            .stat-card:nth-child(4) { animation-delay: 0.4s; }
            
            .hover-lift {
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            
            .hover-lift:hover {
                transform: translateY(-8px) scale(1.02);
            }
        </style>

        <div style="position: relative; z-index: 1; max-width: 1400px; margin: 0 auto;">
            <!-- Header Section -->
            <div style="
                background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
                border-radius: 24px;
                padding: 28px 36px;
                margin-bottom: 32px;
                box-shadow: 0 4px 20px rgba(0, 102, 204, 0.08), 0 1px 3px rgba(0, 0, 0, 0.05);
                border: 2px solid rgba(0, 102, 204, 0.1);
                animation: slideInLeft 0.8s ease-out;
            ">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div style="display: flex; align-items: center; gap: 28px;">
                        <!-- Logo Kominfo -->
                        {{-- <div style="
                            background: #ffffff;
                            padding: 14px 24px;
                            border-radius: 18px;
                            box-shadow: 0 8px 24px rgba(0, 102, 204, 0.12), 0 2px 6px rgba(0, 0, 0, 0.04);
                            border: 2px solid rgba(0, 102, 204, 0.15);
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            transition: all 0.3s ease;
                        " class="hover-lift">
                         <img src="https://tse3.mm.bing.net/th/id/OIP.lT6599E9vZtjj81vWTllEwHaIO?pid=Api&P=0&h=180" alt="Logo" class="h-10 w-auto object-contain">
                        </div> --}}
                        
                        <!-- Title Section -->
                        <div>
                            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                                <div style="width: 6px; height: 42px; background: linear-gradient(180deg, #0066cc 0%, #ff7800 100%); border-radius: 4px; box-shadow: 0 4px 12px rgba(0, 102, 204, 0.3);"></div>
                                <h1 style="
                                    background: linear-gradient(135deg, #0066cc 0%, #004c99 100%);
                                    -webkit-background-clip: text;
                                    -webkit-text-fill-color: transparent;
                                    background-clip: text;
                                    font-size: 2.25rem;
                                    font-weight: 800;
                                    letter-spacing: -0.5px;
                                    margin: 0;
                                    text-shadow: 0 2px 4px rgba(0, 102, 204, 0.1);
                                ">
                                    Dashboard Analitik
                                </h1>
                            </div>
                            <p style="color: #64748b; font-size: 1rem; margin: 0; padding-left: 18px; font-weight: 500;">
                                Sistem Informasi Data Center • Kominfo Kota Binjai
                            </p>
                        </div>
                    </div>
                    
                    <!-- Year Badge -->
                    <div style="
                        background: linear-gradient(135deg, #0066cc 0%, #004c99 100%);
                        padding: 16px 28px;
                        border-radius: 18px;
                        box-shadow: 0 8px 24px rgba(0, 102, 204, 0.25);
                        border: 2px solid rgba(255, 255, 255, 0.2);
                    ">
                        <div style="color: rgba(255, 255, 255, 0.85); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">Tahun Anggaran</div>
                        <div style="color: #ffffff; font-size: 1.35rem; font-weight: 800; text-align: center;">{{ date('Y') }}</div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; margin-bottom: 32px;">
                @foreach([
                    'total' => ['label' => 'Total Pendaftar', 'icon' => '👥', 'color' => '#0066cc', 'bgGradient' => 'linear-gradient(135deg, #0066cc 0%, #0052a3 100%)', 'lightBg' => 'rgba(0, 102, 204, 0.08)'],
                    'pending' => ['label' => 'Menunggu Verifikasi', 'icon' => '⏳', 'color' => '#ff7800', 'bgGradient' => 'linear-gradient(135deg, #ff7800 0%, #e66b00 100%)', 'lightBg' => 'rgba(255, 120, 0, 0.08)'],
                    'diterima' => ['label' => 'Diterima', 'icon' => '✓', 'color' => '#10b981', 'bgGradient' => 'linear-gradient(135deg, #10b981 0%, #059669 100%)', 'lightBg' => 'rgba(16, 185, 129, 0.08)'],
                    'ditolak' => ['label' => 'Ditolak', 'icon' => '✗', 'color' => '#ef4444', 'bgGradient' => 'linear-gradient(135deg, #ef4444 0%, #dc2626 100%)', 'lightBg' => 'rgba(239, 68, 68, 0.08)']
                ] as $key => $cfg)
                <div class="stat-card hover-lift" style="
                    background: #ffffff;
                    border: 2px solid {{ $cfg['lightBg'] }};
                    padding: 28px;
                    border-radius: 20px;
                    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06), 0 1px 3px rgba(0, 0, 0, 0.04);
                    position: relative;
                    overflow: hidden;
                    opacity: 0;
                ">
                    <!-- Card Background Decoration -->
                    <div style="position: absolute; top: -30px; right: -30px; width: 120px; height: 120px; background: {{ $cfg['lightBg'] }}; border-radius: 50%; filter: blur(40px);"></div>
                    
                    <div style="position: relative; z-index: 1;">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px;">
                            <div style="color: #64748b; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; line-height: 1.4;">
                                {{ $cfg['label'] }}
                            </div>
                            <div style="
                                background: {{ $cfg['bgGradient'] }};
                                width: 52px;
                                height: 52px;
                                border-radius: 16px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                font-size: 1.5rem;
                                box-shadow: 0 8px 20px {{ $cfg['color'] }}40;
                                border: 2px solid rgba(255, 255, 255, 0.9);
                            ">{{ $cfg['icon'] }}</div>
                        </div>
                        
                        <div style="color: {{ $cfg['color'] }}; font-size: 3rem; font-weight: 900; letter-spacing: -1.5px; margin-bottom: 14px; text-shadow: 0 2px 4px {{ $cfg['color'] }}15;">
                            {{ $stats[$key] }}
                        </div>
                        
                        <div style="
                            height: 4px;
                            width: 50px;
                            background: {{ $cfg['bgGradient'] }};
                            border-radius: 10px;
                            box-shadow: 0 2px 8px {{ $cfg['color'] }}40;
                        "></div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Chart Section -->
            <div style="
                background: #ffffff;
                border: 2px solid rgba(0, 102, 204, 0.1);
                border-radius: 24px;
                padding: 36px;
                box-shadow: 0 8px 32px rgba(0, 102, 204, 0.08), 0 2px 6px rgba(0, 0, 0, 0.04);
                animation: slideInUp 0.8s ease-out 0.5s backwards;
            ">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px;">
                    <div style="display: flex; align-items: center; gap: 16px;">
                        <div style="
                            width: 56px;
                            height: 56px;
                            background: linear-gradient(135deg, #0066cc 0%, #004c99 100%);
                            border-radius: 18px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            box-shadow: 0 8px 24px rgba(0, 102, 204, 0.3);
                            border: 2px solid rgba(255, 255, 255, 0.9);
                        ">
                            <span style="font-size: 1.6rem;">📊</span>
                        </div>
                        <div>
                            <h3 style="color: #0f172a; font-size: 1.3rem; font-weight: 800; margin: 0; margin-bottom: 4px;">
                                Tren Pendaftaran Bulanan
                            </h3>
                            <p style="color: #64748b; font-size: 0.9rem; margin: 0; font-weight: 500;">
                                Monitoring data registrasi per bulan tahun {{ date('Y') }}
                            </p>
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 20px; align-items: center; flex-wrap: wrap;">
                        @foreach([
                            ['label' => 'Diterima', 'color' => '#10b981'],
                            ['label' => 'Ditolak', 'color' => '#ef4444'],
                            ['label' => 'Pending', 'color' => '#ff7800']
                        ] as $legend)
                        <div style="display: flex; align-items: center; gap: 10px; padding: 8px 16px; background: {{ $legend['color'] }}08; border-radius: 12px; border: 1px solid {{ $legend['color'] }}20;">
                            <div style="width: 14px; height: 14px; background: {{ $legend['color'] }}; border-radius: 4px; box-shadow: 0 2px 8px {{ $legend['color'] }}50;"></div>
                            <span style="color: #334155; font-size: 0.9rem; font-weight: 600;">{{ $legend['label'] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <div style="height: 450px; padding: 10px; background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%); border-radius: 16px;">
                    <canvas id="chartPendaftaran"></canvas>
                </div>
            </div>

            <!-- Footer Info -->
            <div style="margin-top: 32px; text-align: center; color: #64748b; font-size: 0.9rem; font-weight: 500; animation: slideInUp 1s ease-out 0.7s backwards;">
                <div style="display: flex; align-items: center; justify-content: center; gap: 12px;">
                    <div style="height: 1px; width: 60px; background: linear-gradient(90deg, transparent, #cbd5e1, transparent);"></div>
                    <p style="margin: 0;">© {{ date('Y') }} Dinas Komunikasi dan Informatika Kota Binjai • All Rights Reserved</p>
                    <div style="height: 1px; width: 60px; background: linear-gradient(90deg, transparent, #cbd5e1, transparent);"></div>
                </div>
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
        gradientPending.addColorStop(0, '#ff7800');
        gradientPending.addColorStop(1, '#e66b00');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                datasets: [
                    { 
                        label: 'Diterima', 
                        data: @json($dataGrafik['diterima']), 
                        backgroundColor: gradientDiterima,
                        borderRadius: 10,
                        borderSkipped: false,
                        barThickness: 24,
                    },
                    { 
                        label: 'Ditolak', 
                        data: @json($dataGrafik['ditolak']), 
                        backgroundColor: gradientDitolak,
                        borderRadius: 10,
                        borderSkipped: false,
                        barThickness: 24,
                    },
                    { 
                        label: 'Pending', 
                        data: @json($dataGrafik['pending']), 
                        backgroundColor: gradientPending,
                        borderRadius: 10,
                        borderSkipped: false,
                        barThickness: 24,
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
                        backgroundColor: 'rgba(255, 255, 255, 0.98)',
                        titleColor: '#0f172a',
                        bodyColor: '#334155',
                        borderColor: 'rgba(0, 102, 204, 0.2)',
                        borderWidth: 2,
                        padding: 16,
                        displayColors: true,
                        boxWidth: 10,
                        boxHeight: 10,
                        usePointStyle: true,
                        titleFont: {
                            size: 14,
                            weight: '700'
                        },
                        bodyFont: {
                            size: 13,
                            weight: '600'
                        },
                        cornerRadius: 12,
                        caretPadding: 10,
                        titleMarginBottom: 10,
                        bodySpacing: 6,
                    }
                },
                scales: { 
                    y: { 
                        beginAtZero: true,
                        border: {
                            display: false
                        },
                        grid: { 
                            color: 'rgba(0, 102, 204, 0.06)',
                            drawTicks: false,
                            lineWidth: 1.5,
                        },
                        ticks: { 
                            color: '#64748b',
                            font: {
                                size: 13,
                                weight: '600'
                            },
                            stepSize: 1,
                            padding: 12
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
                            color: '#64748b',
                            font: {
                                size: 12,
                                weight: '600'
                            },
                            padding: 10
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>