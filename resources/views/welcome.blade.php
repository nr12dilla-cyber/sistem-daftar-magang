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
        body { font-family: 'Inter', sans-serif; overflow-x: hidden; margin: 0; padding: 0; }
        .swiper { width: 100%; height: 100vh; }
        .swiper-slide { position: relative; overflow: hidden; background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 50%, #f0f9ff 100%); }
        .swiper-slide img { width: 100%; height: 100%; object-fit: cover; opacity: 0.15; filter: blur(2px); }
        
        .hero-content {
            position: absolute;
            top: 50%;
            left: 8%;
            transform: translateY(-50%);
            z-index: 10;
            max-width: 850px;
        }

        /* --- NAVBAR --- */
        .navbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
            padding: 12px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            box-shadow: 0 4px 20px rgba(0, 102, 204, 0.1);
        }

        .logo-img-box img { height: 52px; width: auto; }
        .logo-text-main { font-family: 'Poppins', sans-serif; font-weight: 800; font-size: 1.25rem; background: linear-gradient(135deg, #0066cc 0%, #004c99 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; line-height: 1; }
        .logo-text-sub { color: #64748b; font-weight: 700; font-size: 0.75rem; letter-spacing: 1px; }

        .btn-daftar { background: linear-gradient(135deg, #0066cc 0%, #004c99 100%); color: white; padding: 12px 24px; border-radius: 12px; font-weight: 700; font-size: 0.95rem; display: flex; align-items: center; gap: 10px; }
        .btn-login { display: flex; flex-direction: column; align-items: center; font-size: 0.85rem; color: #334155; font-weight: 700; }
        .btn-login svg { width: 26px; height: 26px; }

        .hero-title { font-family: 'Poppins', sans-serif; font-size: 4.8rem; font-weight: 950; line-height: 1.05; margin-bottom: 25px; background: linear-gradient(135deg, #0066cc 0%, #004c99 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; letter-spacing: -2px; }
        .hero-description { font-size: 1.25rem; color: #334155; line-height: 1.8; max-width: 650px; margin-bottom: 35px; }

        /* --- SIDE INFO: KEMBALI KE TENGAH --- */
        .side-info { 
            position: absolute; 
            top: 50%; /* Posisi di tengah secara vertikal */
            right: 8%; 
            transform: translateY(-50%); /* Menjaga titik pusat kartu di tengah layar */
            z-index: 20; 
            display: flex; 
            flex-direction: column; 
            gap: 20px; 
            max-width: 420px; 
        }

        .info-card { 
            background: white; 
            border-radius: 24px; 
            padding: 25px; 
            box-shadow: 0 15px 35px rgba(0, 102, 204, 0.08); 
            border: 1px solid rgba(0, 102, 204, 0.1); 
        }

        .info-card h4 { font-weight: 900; color: #0066cc; margin-bottom: 8px; text-transform: uppercase; font-size: 1rem; }
        .info-card p { font-size: 1rem; color: #475569; line-height: 1.5; }

        /* --- PAGINATION --- */
        .swiper-pagination-bullet { width: 12px; height: 12px; background: #0066cc !important; opacity: 0.3; }
        .swiper-pagination-bullet-active { opacity: 1 !important; width: 35px; border-radius: 6px; }

        @media (max-width: 1024px) {
            .side-info { display: none; }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="logo-container flex items-center gap-3">
            <div class="logo-img-box">
                <img src="{{asset('images/logobinjai.png')}}" alt="Logo">
            </div>
            <div class="hidden sm:flex flex-col">
                <span class="logo-text-main">DISKOMINFO</span>
                <span class="logo-text-sub">KOTA BINJAI</span>
            </div>
        </div>
        <div class="nav-actions flex items-center gap-6">
            <a href="{{ route('pendaftaran.index') }}" class="btn-daftar"><span>📝</span> DAFTAR SEKARANG</a>
            <a href="{{ route('login') }}" class="btn-login">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" /></svg>
                <span>Admin</span>
            </a>
        </div>
    </nav>

    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&q=80&w=1974" alt="IKP">
                <div class="hero-content">
                    <div class="bg-white shadow-lg inline-flex items-center gap-2 px-6 py-2 rounded-full font-bold text-blue-600 mb-6">🎯 BIDANG IKP</div>
                    <h1 class="hero-title">Informasi & <br> Komunikasi Publik</h1>
                    <p class="hero-description">Menyebarkan informasi publik yang akurat dan transparan untuk masyarakat Kota Binjai.</p>
                </div>
            </div>

            <div class="swiper-slide">
                <img src="https://images.unsplash.com/photo-1510915228340-29c85a43dcfe?auto=format&fit=crop&q=80&w=2070" alt="APTIKA">
                <div class="hero-content">
                    <div class="bg-white shadow-lg inline-flex items-center gap-2 px-6 py-2 rounded-full font-bold text-blue-600 mb-6">💻 BIDANG APTIKA</div>
                    <h1 class="hero-title">Aplikasi & <br> Informatika</h1>
                    <p class="hero-description">Mendorong transformasi digital pemerintahan melalui pengembangan ekosistem Smart City.</p>
                </div>
            </div>

            <div class="swiper-slide">
                <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&q=80&w=2070" alt="STATISTIK">
                <div class="hero-content">
                    <div class="bg-white shadow-lg inline-flex items-center gap-2 px-6 py-2 rounded-full font-bold text-blue-600 mb-6">📊 BIDANG STATISTIK</div>
                    <h1 class="hero-title">Statistik & <br> Persandian</h1>
                    <p class="hero-description">Mengolah data sektoral secara akurat untuk mendukung pengambilan kebijakan berbasis data.</p>
                </div>
            </div>
        </div>

        <div class="swiper-pagination" style="bottom: 50px !important; left: 8% !important; text-align: left !important; width: auto !important;"></div>

        <div class="side-info">
            <div class="info-card">
                <h4>✨ BENEFIT PESERTA</h4>
                <p>Sertifikat resmi, bimbingan mentor ahli, dan pengalaman kerja nyata.</p>
            </div>
            <div class="info-card">
                <h4>⏰ DURASI MAGANG</h4>
                <p>Program berlangsung intensif selama 3 hingga 6 bulan.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            loop: true,
            effect: "fade",
            speed: 1200,
            autoplay: { delay: 6000, disableOnInteraction: false },
            pagination: { el: ".swiper-pagination", clickable: true },
        });
    </script>
</body>
</html>