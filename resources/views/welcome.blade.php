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
        body { font-family: 'Inter', sans-serif; margin: 0; padding: 0; background: #000; }
        .swiper { width: 100%; height: 100vh; }
        .swiper-slide { position: relative; display: flex; align-items: center; overflow: hidden; }
        
        .slide-bg {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            z-index: 0;
        }

        /* Daftar Gambar */
        .bg-ikp { background-image: url('https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=2000'); }
        .bg-aptika { background-image: url('https://images.unsplash.com/photo-1510915228340-29c85a43dcfe?q=80&w=2000'); }
        .bg-statistik { background-image: url('https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=2426'); }

        .swiper-slide::after {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(to right, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.2) 100%);
            z-index: 1;
        }

        .hero-content { position: relative; z-index: 10; padding-left: 8%; max-width: 800px; }
        .hero-title { font-family: 'Poppins', sans-serif; font-size: 5rem; font-weight: 800; line-height: 1.1; color: white; margin-bottom: 20px; text-shadow: 0 4px 15px rgba(0,0,0,0.5); }
        .hero-description { font-size: 1.25rem; color: rgba(255, 255, 255, 0.95); max-width: 550px; margin-bottom: 30px; }

        .navbar { position: fixed; top: 0; left: 0; right: 0; z-index: 100; padding: 15px 8%; display: flex; justify-content: space-between; align-items: center; background: rgba(255, 255, 255, 0.98); backdrop-filter: blur(10px); }
        .badge-bidang { background: #1d4ed8; color: white; padding: 8px 18px; border-radius: 50px; font-weight: 700; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 8px; margin-bottom: 20px; text-transform: uppercase; }

        .side-info { 
            position: fixed; 
            right: 8%; 
            top: 50%; 
            transform: translateY(-50%); 
            display: flex; 
            flex-direction: column; 
            gap: 20px; 
            z-index: 50;
            opacity: 1;
            visibility: visible;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        .side-info.hidden-info {
            opacity: 0;
            visibility: hidden;
        }

        .info-card { 
            background: white; 
            padding: 22px; 
            border-radius: 20px; 
            width: 380px; 
            box-shadow: 0 20px 40px rgba(0,0,0,0.3); 
            border-left: 6px solid #1d4ed8;
        }
        
        .info-card h4 { font-weight: 800; color: #1e3a8a; margin-bottom: 8px; font-size: 1rem; text-transform: uppercase; display: flex; align-items: center; gap: 10px; }
        .info-card p { font-size: 0.95rem; color: #475569; line-height: 1.6; }

        .swiper-pagination-bullet { width: 12px; height: 12px; background: white !important; opacity: 0.5; }
        .swiper-pagination-bullet-active { width: 35px; border-radius: 6px; opacity: 1 !important; }

        @media (max-width: 1024px) { .side-info { display: none; } .hero-title { font-size: 3.5rem; } }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="flex items-center gap-3">
            <img src="{{asset('images/logobinjai.png')}}" alt="Logo" class="h-12">
            <div class="flex flex-col">
                <span class="font-black text-blue-900 leading-none text-xl">DISKOMINFO</span>
                <span class="text-xs font-bold text-gray-500 tracking-wider">KOTA BINJAI</span>
            </div>
        </div>
        <div class="flex items-center gap-6">
            <a href="{{ route('pendaftaran.index') }}" class="bg-blue-900 text-white px-7 py-3 rounded-xl font-bold text-sm flex items-center gap-2 hover:bg-blue-800 transition transform hover:-translate-y-1">
                <span>📝</span> DAFTAR SEKARANG
            </a>
            <a href="{{ route('login') }}" class="flex flex-col items-center text-gray-600 hover:text-blue-900 transition font-bold">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="text-[10px] uppercase tracking-tighter">Login</span>
            </a>
        </div>
    </nav>

    <div id="benefitCard" class="side-info">
        <div class="info-card">
            <h4><span>✨</span> BENEFIT PESERTA</h4>
            <p>Dapatkan sertifikat resmi, bimbingan langsung dari mentor ahli, dan pengalaman kerja nyata di pemerintahan.</p>
        </div>
        <div class="info-card">
            <h4><span>⏰</span> DURASI MAGANG</h4>
            <p>Program magang berlangsung intensif dengan durasi fleksibel mulai dari 3 hingga 6 bulan.</p>
        </div>
    </div>

    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="slide-bg bg-ikp"></div>
                <div class="hero-content">
                    <div class="badge-bidang">📢 BIDANG IKP</div>
                    <h1 class="hero-title">Informasi & <br> Komunikasi Publik</h1>
                    <p class="hero-description">Menyebarkan informasi publik yang akurat, transparan, dan terpercaya bagi masyarakat Kota Binjai.</p>
                </div>
            </div>
            
            <div class="swiper-slide">
                <div class="slide-bg bg-aptika"></div>
                <div class="hero-content">
                    <div class="badge-bidang">💻 BIDANG APTIKA</div>
                    <h1 class="hero-title">Aplikasi & <br> Informatika</h1>
                    <p class="hero-description">Mendorong transformasi digital melalui pengembangan ekosistem Smart City yang modern.</p>
                </div>
            </div>
            
            <div class="swiper-slide">
                <div class="slide-bg bg-statistik"></div>
                <div class="hero-content">
                    <div class="badge-bidang">📊 BIDANG STATISTIK</div>
                    <h1 class="hero-title">Statistik & <br> Persandian</h1>
                    <p class="hero-description">Mengolah data sektoral secara akurat untuk mendukung pengambilan kebijakan berbasis data.</p>
                </div>
            </div>
        </div>
        <div class="swiper-pagination" style="bottom: 40px !important; text-align: left; padding-left: 8%;"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const benefitCard = document.getElementById('benefitCard');

        var swiper = new Swiper(".mySwiper", {
            loop: true,
            effect: "fade",
            fadeEffect: { crossFade: true },
            speed: 1500,
            autoplay: { delay: 6000, disableOnInteraction: false },
            pagination: { el: ".swiper-pagination", clickable: true },
            on: {
                slideChange: function () {
                    if (this.realIndex === 0) {
                        benefitCard.classList.remove('hidden-info');
                    } else {
                        benefitCard.classList.add('hidden-info');
                    }
                }
            }
        });
    </script>
</body>
</html>