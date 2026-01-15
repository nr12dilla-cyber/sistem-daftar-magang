<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Magang - Dinas Kominfo Kota Binjai</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800;900&family=Poppins:wght@600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            overflow-x: hidden; 
            margin: 0;
            padding: 0;
        }
        
        .swiper { 
            width: 100%; 
            height: 100vh;
        }
        
        .swiper-slide { 
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 50%, #f0f9ff 100%);
        }
        
        .swiper-slide img { 
            width: 100%; 
            height: 100%; 
            object-fit: cover; 
            opacity: 0.15;
            filter: blur(2px);
        }
        
        /* Decorative Background */
        .bg-decoration {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1;
            pointer-events: none;
        }
        
        .bg-decoration::before {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(0, 102, 204, 0.12) 0%, transparent 70%);
            border-radius: 50%;
            top: -200px;
            right: -200px;
        }
        
        .bg-decoration::after {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255, 120, 0, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            bottom: -150px;
            left: -150px;
        }
        
        .hero-content {
            position: absolute;
            top: 50%;
            left: 8%;
            transform: translateY(-50%);
            z-index: 10;
            max-width: 750px;
            animation: slideInLeft 1s ease-out;
        }

        @keyframes slideInLeft {
            from { opacity: 0; transform: translateY(-50%) translateX(-50px); }
            to { opacity: 1; transform: translateY(-50%) translateX(0); }
        }
        
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        @keyframes slideInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .navbar {
            position: fixed;
            top: 0; 
            left: 0; 
            right: 0;
            z-index: 50;
            padding: 20px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            backdrop-filter: blur(12px);
            box-shadow: 0 4px 20px rgba(0, 102, 204, 0.12);
            border-bottom: 2px solid rgba(0, 102, 204, 0.15);
            animation: slideDown 0.8s ease-out;
        }
        
        @keyframes slideDown {
            from { transform: translateY(-100%); }
            to { transform: translateY(0); }
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .logo-img-box {
            background: #ffffff;
            padding: 10px 20px;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0, 102, 204, 0.15);
            border: 2px solid rgba(0, 102, 204, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .logo-img-box:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 28px rgba(0, 102, 204, 0.25);
        }
        
        .logo-img-box img {
            height: 48px;
            width: auto;
        }

        .logo-text-main {
            font-family: 'Poppins', sans-serif;
            font-weight: 900;
            font-size: 1.5rem;
            text-transform: uppercase;
            letter-spacing: -0.5px;
            line-height: 1.1;
            background: linear-gradient(135deg, #0066cc 0%, #004c99 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .logo-text-sub {
            color: #64748b;
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1.8px;
            line-height: 1;
            margin-top: 2px;
        }

        .btn-daftar {
            background: linear-gradient(135deg, #0066cc 0%, #004c99 100%);
            color: white;
            padding: 16px 36px;
            border-radius: 16px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-size: 0.9rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 24px rgba(0, 102, 204, 0.35);
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-daftar:hover { 
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(0, 102, 204, 0.45);
        }

        .side-info {
            position: absolute;
            bottom: 100px;
            right: 8%;
            z-index: 20;
            display: flex;
            flex-direction: column;
            gap: 20px;
            max-width: 420px;
            animation: slideInRight 1.2s ease-out;
        }

        .info-card {
            background: #ffffff;
            border: 2px solid rgba(0, 102, 204, 0.15);
            border-radius: 20px;
            padding: 28px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 24px rgba(0, 102, 204, 0.12);
            position: relative;
            overflow: hidden;
        }
        
        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #0066cc 0%, #ff7800 100%);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .info-card:hover {
            background: #ffffff;
            transform: translateX(-10px);
            box-shadow: 0 12px 36px rgba(0, 102, 204, 0.2);
            border-color: rgba(0, 102, 204, 0.3);
        }
        
        .info-card:hover::before {
            transform: scaleX(1);
        }

        .info-card-icon {
            font-size: 3rem;
            margin-bottom: 16px;
            display: inline-block;
        }
        
        .info-card:nth-child(1) .info-card-icon {
            animation: float 3s ease-in-out infinite;
        }
        
        .info-card:nth-child(2) .info-card-icon {
            animation: float 3s ease-in-out infinite 0.5s;
        }
        
        .info-card:nth-child(3) .info-card-icon {
            animation: float 3s ease-in-out infinite 1s;
        }

        .info-card h4 { 
            font-size: 0.95rem; 
            font-weight: 900; 
            text-transform: uppercase; 
            color: #0066cc;
            letter-spacing: 1.5px; 
            margin-bottom: 12px;
            font-family: 'Poppins', sans-serif;
        }
        
        .info-card p { 
            font-size: 0.95rem; 
            color: #475569;
            line-height: 1.8;
            font-weight: 500;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #ffffff;
            border: 2px solid rgba(0, 102, 204, 0.2);
            color: #0066cc;
            padding: 12px 28px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 32px;
            box-shadow: 0 4px 16px rgba(0, 102, 204, 0.15);
            animation: slideInUp 0.6s ease-out 0.3s backwards;
        }
        
        .hero-title {
            font-family: 'Poppins', sans-serif;
            font-size: 4.2rem;
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 32px;
            text-transform: uppercase;
            letter-spacing: -2px;
            background: linear-gradient(135deg, #0066cc 0%, #004c99 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: fadeIn 0.8s ease-out 0.4s backwards;
        }
        
        .hero-description {
            font-size: 1.2rem;
            color: #475569;
            line-height: 1.9;
            margin-bottom: 40px;
            font-weight: 500;
            animation: fadeIn 0.8s ease-out 0.6s backwards;
        }
        
        .feature-tags {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            animation: fadeIn 0.8s ease-out 0.8s backwards;
        }
        
        .feature-tag {
            background: #ffffff;
            border: 2px solid rgba(0, 102, 204, 0.2);
            padding: 12px 24px;
            border-radius: 14px;
            font-size: 0.95rem;
            color: #0066cc;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(0, 102, 204, 0.1);
            transition: all 0.3s ease;
        }
        
        .feature-tag:hover {
            background: linear-gradient(135deg, #0066cc 0%, #004c99 100%);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 102, 204, 0.25);
            border-color: transparent;
        }

        .swiper-pagination-bullet { 
            background: #cbd5e1 !important; 
            opacity: 0.6;
            width: 12px;
            height: 12px;
            transition: all 0.3s ease;
        }
        
        .swiper-pagination-bullet-active { 
            opacity: 1;
            width: 48px !important; 
            height: 12px !important;
            border-radius: 6px !important;
            background: linear-gradient(135deg, #0066cc 0%, #ff7800 100%) !important;
        }
        
        .floating-shape {
            position: absolute;
            z-index: 2;
            pointer-events: none;
            opacity: 0.6;
        }
        
        .shape-1 {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, rgba(0, 102, 204, 0.15), rgba(255, 120, 0, 0.1));
            border-radius: 25px;
            top: 20%;
            left: 15%;
            animation: float 8s ease-in-out infinite;
        }
        
        .shape-2 {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, rgba(255, 120, 0, 0.15), rgba(0, 102, 204, 0.1));
            border-radius: 50%;
            bottom: 25%;
            left: 10%;
            animation: float 10s ease-in-out infinite 1s;
        }
        
        .shape-3 {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, rgba(0, 102, 204, 0.12), transparent);
            border-radius: 15px;
            top: 40%;
            left: 5%;
            animation: float 7s ease-in-out infinite 2s;
        }

        @media (max-width: 1024px) {
            .side-info {
                right: 4%;
                max-width: 350px;
            }
            .hero-title {
                font-size: 3.5rem;
            }
        }

        @media (max-width: 768px) {
            .hero-content { 
                left: 5%; 
                right: 5%;
                max-width: 90%;
            }
            .hero-title {
                font-size: 2.8rem;
                letter-spacing: -1px;
            }
            .hero-description {
                font-size: 1.05rem;
            }
            .side-info { 
                display: none; 
            }
            .navbar { 
                padding: 16px 5%;
                flex-wrap: wrap;
                gap: 12px;
            }
            .logo-text-main {
                font-size: 1.2rem;
            }
            .btn-daftar {
                padding: 14px 24px;
                font-size: 0.8rem;
            }
            .floating-shape {
                display: none;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="logo-container">
            <div class="logo-img-box">
                <img src="https://tse3.mm.bing.net/th/id/OIP.lT6599E9vZtjj81vWTllEwHaIO?pid=Api&P=0&h=180" alt="Logo Diskominfo Binjai">
            </div>
            <div style="display: flex; flex-direction: column;">
                <span class="logo-text-main">DISKOMINFO</span>
                <span class="logo-text-sub">Kota Binjai</span>
            </div>
        </div>
        <a href="{{ route('pendaftaran.index') }}" class="btn-daftar">
            <span>📝</span>
            <span>Mulai Daftar</span>
        </a>
    </nav>

    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            
            <!-- Slide 1: Informasi & Komunikasi Publik -->
            <div class="swiper-slide">
                <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&q=80&w=1974" alt="Informasi & Komunikasi Publik">
                
                <div class="bg-decoration"></div>
                
                <div class="floating-shape shape-1"></div>
                <div class="floating-shape shape-2"></div>
                <div class="floating-shape shape-3"></div>
                
                <div class="hero-content">
                    <div class="hero-badge">
                        <span>🎯</span>
                        <span>Bidang IKP</span>
                    </div>
                    <h1 class="hero-title">
                        Informasi & Komunikasi Publik
                    </h1>
                    <p class="hero-description">
                        Menyebarkan informasi publik yang akurat, transparan, dan tepat waktu untuk masyarakat Kota Binjai melalui berbagai kanal komunikasi modern.
                    </p>
                    <div class="feature-tags">
                        <div class="feature-tag">
                            ✓ Media Relations
                        </div>
                        <div class="feature-tag">
                            ✓ Publikasi Digital
                        </div>
                        <div class="feature-tag">
                            ✓ Dokumentasi
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2: Aplikasi & Informatika -->
            <div class="swiper-slide">
                <img src="https://images.unsplash.com/photo-1510915228340-29c85a43dcfe?auto=format&fit=crop&q=80&w=2070" alt="Aplikasi & Informatika">
                
                <div class="bg-decoration"></div>
                
                <div class="floating-shape shape-1"></div>
                <div class="floating-shape shape-2"></div>
                <div class="floating-shape shape-3"></div>
                
                <div class="hero-content">
                    <div class="hero-badge">
                        <span>💻</span>
                        <span>Bidang APTIKA</span>
                    </div>
                    <h1 class="hero-title">
                        Aplikasi & Informatika
                    </h1>
                    <p class="hero-description">
                        Mendorong transformasi digital pemerintahan melalui pengembangan aplikasi pelayanan publik yang inovatif dan terintegrasi untuk Kota Binjai.
                    </p>
                    <div class="feature-tags">
                        <div class="feature-tag">
                            ✓ Smart City
                        </div>
                        <div class="feature-tag">
                            ✓ E-Government
                        </div>
                        <div class="feature-tag">
                            ✓ Digital Innovation
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 3: Statistik & Persandian -->
            <div class="swiper-slide">
                
                 <img src="https://tse3.mm.bing.net/th/id/OIP.lT6599E9vZtjj81vWTllEwHaIO?pid=Api&P=0&h=180" alt="Logo" class="h-10 w-auto object-contain">
              
                
                <div class="bg-decoration"></div>
                
                <div class="floating-shape shape-1"></div>
                <div class="floating-shape shape-2"></div>
                <div class="floating-shape shape-3"></div>
                
                <div class="hero-content">
                    <div class="hero-badge">
                        <span>🔐</span>
                        <span>Bidang STATISTIK</span>
                    </div>
                    <h1 class="hero-title">
                        Statistik & Persandian
                    </h1>
                    <p class="hero-description">
                        Menjamin keamanan informasi daerah dan mengolah data statistik sektoral yang berkualitas untuk mendukung pengambilan keputusan berbasis data.
                    </p>
                    <div class="feature-tags">
                        <div class="feature-tag">
                            ✓ Data Analytics
                        </div>
                        <div class="feature-tag">
                            ✓ Cyber Security
                        </div>
                        <div class="feature-tag">
                            ✓ Enkripsi Data
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Cards -->
        <div class="side-info">
            {{-- <div class="info-card">
                <div class="info-card-icon">🎯</div>
                <h4>Tujuan Program</h4>
                <p>Menghasilkan SDM profesional yang kompeten dan siap berkontribusi dalam pelayanan publik digital di era transformasi pemerintahan.</p>
            </div> --}}
            <div class="info-card">
                <div class="info-card-icon">✨</div>
                <h4>Benefit Peserta</h4>
                <p>Sertifikat resmi, bimbingan mentor berpengalaman, dan pengalaman kerja nyata di lingkungan pemerintah Kota Binjai.</p>
            </div>
            <div class="info-card">
                <div class="info-card-icon">⏰</div>
                <h4>Durasi Magang</h4>
                <p>Program berlangsung 3-6 bulan dengan sistem pembelajaran terstruktur dan evaluasi berkala.</p>
            </div>
        </div>

        <div class="swiper-pagination" style="bottom: 60px !important; left: 8% !important; text-align: left !important; width: auto !important;"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            loop: true,
            effect: "fade",
            speed: 1200,
            autoplay: { 
                delay: 6000, 
                disableOnInteraction: false 
            },
            pagination: { 
                el: ".swiper-pagination", 
                clickable: true 
            },
            fadeEffect: {
                crossFade: true
            }
        });
    </script>
</body>
</html>