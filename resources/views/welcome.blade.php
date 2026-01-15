<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Magang - Dinas Kominfo Kota Binjai</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            overflow-x: hidden; 
            background-color: #0f172a; 
        }
        .swiper { width: 100%; height: 100vh; }
        .swiper-slide { position: relative; }
        .swiper-slide img { 
            width: 100%; 
            height: 100%; 
            object-fit: cover; 
            filter: brightness(0.35); 
        }
        
        .hero-content {
            position: absolute;
            top: 50%;
            left: 8%;
            transform: translateY(-50%);
            z-index: 10;
            color: white;
            max-width: 700px;
        }

        .navbar {
            position: fixed;
            top: 0; 
            left: 0; 
            right: 0;
            z-index: 50;
            padding: 18px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(12px);
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .logo-box {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #2563EB 0%, #1e40af 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            color: white;
            font-size: 1.5rem;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .logo-text-main {
            color: #0f172a;
            font-weight: 900;
            font-size: 1.25rem;
            text-transform: uppercase;
            letter-spacing: -0.5px;
            line-height: 1;
        }

        .logo-text-sub {
            color: #2563EB;
            font-weight: 700;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            line-height: 1;
        }

        .btn-daftar {
            background: linear-gradient(135deg, #2563EB 0%, #1e40af 100%);
            color: white;
            padding: 12px 28px;
            border-radius: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.8rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
            border: none;
            cursor: pointer;
        }

        .btn-daftar:hover { 
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.4);
        }

        .side-info {
            position: absolute;
            bottom: 60px;
            right: 8%;
            z-index: 20;
            display: flex;
            flex-direction: column;
            gap: 24px;
            max-width: 380px;
        }

        .info-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            padding: 24px;
            transition: all 0.3s ease;
        }

        .info-card:hover {
            background: rgba(255, 255, 255, 0.12);
            transform: translateX(-5px);
        }

        .info-card-icon {
            font-size: 2rem;
            margin-bottom: 12px;
        }

        .info-card h4 { 
            font-size: 0.75rem; 
            font-weight: 900; 
            text-transform: uppercase; 
            color: #60A5FA; 
            letter-spacing: 1.5px; 
            margin-bottom: 8px; 
        }
        
        .info-card p { 
            font-size: 0.9rem; 
            color: #E2E8F0; 
            line-height: 1.6;
            font-weight: 400;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(37, 99, 235, 0.15);
            border: 1px solid rgba(37, 99, 235, 0.3);
            color: #60A5FA;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 24px;
        }

        .swiper-pagination-bullet { 
            background: white !important; 
            opacity: 0.5;
            width: 10px;
            height: 10px;
        }
        
        .swiper-pagination-bullet-active { 
            opacity: 1;
            width: 32px !important; 
            border-radius: 5px !important; 
        }

        @media (max-width: 768px) {
            .hero-content { left: 5%; max-width: 90%; }
            .side-info { display: none; }
            .navbar { padding: 15px 5%; }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="logo-container">
            <div id="dynamic-logo" class="logo-box">K</div>
            <div style="display: flex; flex-direction: column; gap: 2px;">
                <span class="logo-text-main">DISKOMINFO</span>
                <span class="logo-text-sub">Kota Binjai</span>
            </div>
        </div>
        <a href="{{ route('pendaftaran.index') }}" class="btn-daftar">
            📝 Mulai Daftar
        </a>
    </nav>

    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            
            <!-- Slide 1: Informasi & Komunikasi Publik -->
            <div class="swiper-slide" data-letter="I">
                <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&q=80&w=1974" alt="Informasi & Komunikasi Publik">
                <div class="hero-content">
                    <div class="hero-badge">🎯 Bidang IKP</div>
                    <h1 style="font-size: 3.5rem; font-weight: 900; line-height: 1.1; margin-bottom: 24px; text-transform: uppercase; letter-spacing: -1px;">
                        Informasi & Komunikasi Publik
                    </h1>
                    <p style="font-size: 1.1rem; color: #CBD5E1; line-height: 1.7; margin-bottom: 32px;">
                        Menyebarkan informasi publik yang akurat, transparan, dan tepat waktu untuk masyarakat Kota Binjai melalui berbagai kanal komunikasi modern.
                    </p>
                    <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                        <div style="background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.3); padding: 8px 16px; border-radius: 8px; font-size: 0.85rem; color: #6EE7B7; font-weight: 600;">
                            ✓ Media Relations
                        </div>
                        <div style="background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.3); padding: 8px 16px; border-radius: 8px; font-size: 0.85rem; color: #6EE7B7; font-weight: 600;">
                            ✓ Publikasi Digital
                        </div>
                        <div style="background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.3); padding: 8px 16px; border-radius: 8px; font-size: 0.85rem; color: #6EE7B7; font-weight: 600;">
                            ✓ Dokumentasi
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2: Aplikasi & Informatika -->
            <div class="swiper-slide" data-letter="A">
                <img src="https://images.unsplash.com/photo-1510915228340-29c85a43dcfe?auto=format&fit=crop&q=80&w=2070" alt="Aplikasi & Informatika">
                <div class="hero-content">
                    <div class="hero-badge">💻 Bidang APTIKA</div>
                    <h1 style="font-size: 3.5rem; font-weight: 900; line-height: 1.1; margin-bottom: 24px; text-transform: uppercase; letter-spacing: -1px;">
                        Aplikasi & Informatika
                    </h1>
                    <p style="font-size: 1.1rem; color: #CBD5E1; line-height: 1.7; margin-bottom: 32px;">
                        Mendorong transformasi digital pemerintahan melalui pengembangan aplikasi pelayanan publik yang inovatif dan terintegrasi untuk Kota Binjai.
                    </p>
                    <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                        <div style="background: rgba(59, 130, 246, 0.15); border: 1px solid rgba(59, 130, 246, 0.3); padding: 8px 16px; border-radius: 8px; font-size: 0.85rem; color: #93C5FD; font-weight: 600;">
                            ✓ Smart City
                        </div>
                        <div style="background: rgba(59, 130, 246, 0.15); border: 1px solid rgba(59, 130, 246, 0.3); padding: 8px 16px; border-radius: 8px; font-size: 0.85rem; color: #93C5FD; font-weight: 600;">
                            ✓ E-Government
                        </div>
                        <div style="background: rgba(59, 130, 246, 0.15); border: 1px solid rgba(59, 130, 246, 0.3); padding: 8px 16px; border-radius: 8px; font-size: 0.85rem; color: #93C5FD; font-weight: 600;">
                            ✓ Digital Innovation
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 3: Statistik & Persandian -->
            <div class="swiper-slide" data-letter="S">
                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&q=80&w=2015" alt="Statistik & Persandian">
                <div class="hero-content">
                    <div class="hero-badge">🔐 Bidang STATISTIK</div>
                    <h1 style="font-size: 3.5rem; font-weight: 900; line-height: 1.1; margin-bottom: 24px; text-transform: uppercase; letter-spacing: -1px;">
                        Statistik & Persandian
                    </h1>
                    <p style="font-size: 1.1rem; color: #CBD5E1; line-height: 1.7; margin-bottom: 32px;">
                        Menjamin keamanan informasi daerah dan mengolah data statistik sektoral yang berkualitas untuk mendukung pengambilan keputusan berbasis data.
                    </p>
                    <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                        <div style="background: rgba(168, 85, 247, 0.15); border: 1px solid rgba(168, 85, 247, 0.3); padding: 8px 16px; border-radius: 8px; font-size: 0.85rem; color: #C4B5FD; font-weight: 600;">
                            ✓ Data Analytics
                        </div>
                        <div style="background: rgba(168, 85, 247, 0.15); border: 1px solid rgba(168, 85, 247, 0.3); padding: 8px 16px; border-radius: 8px; font-size: 0.85rem; color: #C4B5FD; font-weight: 600;">
                            ✓ Cyber Security
                        </div>
                        <div style="background: rgba(168, 85, 247, 0.15); border: 1px solid rgba(168, 85, 247, 0.3); padding: 8px 16px; border-radius: 8px; font-size: 0.85rem; color: #C4B5FD; font-weight: 600;">
                            ✓ Enkripsi Data
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Cards -->
        <div class="side-info">
            <div class="info-card">
                <div class="info-card-icon">🎯</div>
                <h4>Tujuan Program</h4>
                <p>Menghasilkan SDM profesional yang kompeten dan siap berkontribusi dalam pelayanan publik digital di era transformasi pemerintahan.</p>
            </div>
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

        <div class="swiper-pagination" style="bottom: 40px !important; left: 8% !important; text-align: left !important; width: auto !important;"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const logoElement = document.getElementById('dynamic-logo');

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
            on: {
                slideChange: function () {
                    const activeSlide = this.slides[this.activeIndex];
                    const char = activeSlide.getAttribute('data-letter');
                    
                    if(char) {
                        logoElement.style.opacity = '0';
                        logoElement.style.transform = 'scale(0.8)';
                        setTimeout(() => {
                            logoElement.innerText = char;
                            logoElement.style.opacity = '1';
                            logoElement.style.transform = 'scale(1)';
                        }, 250);
                    }
                }
            }
        });
    </script>
</body>
</html>