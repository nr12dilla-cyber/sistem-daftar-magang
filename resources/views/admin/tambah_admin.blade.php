<x-app-layout>
    <style>
        .form-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 2rem 1.5rem;
        }

        .header-section {
            background: linear-gradient(135deg, #1e5a8e 0%, #15436b 100%);
            border-radius: 20px;
            padding: 24px 28px;
            margin-bottom: 24px;
            box-shadow: 0 4px 15px rgba(30, 90, 142, 0.2);
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            margin-bottom: 12px;
            transition: all 0.2s;
        }

        .back-link:hover {
            color: white;
            transform: translateX(-3px);
        }

        .back-icon {
            width: 16px;
            height: 16px;
            margin-right: 8px;
            transition: transform 0.2s;
        }

        .back-link:hover .back-icon {
            transform: translateX(-4px);
        }

        .page-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: white;
            margin: 0;
            letter-spacing: -0.5px;
        }

        .page-subtitle {
            color: rgba(255, 255, 255, 0.8);
            margin-top: 6px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            color: white;
            border-radius: 12px;
            font-size: 0.813rem;
            font-weight: 700;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: white;
            margin-right: 8px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .form-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid #f1f3f5;
            overflow: hidden;
        }

        .form-top-accent {
            height: 6px;
            background: linear-gradient(90deg, #1e5a8e 0%, #15436b 100%);
        }

        .form-content {
            padding: 32px 36px;
        }

        .section-title {
            font-size: 1.125rem;
            font-weight: 700;
            color: #2d3748;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .section-icon {
            width: 36px;
            height: 36px;
            background: #f8f9fa;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.125rem;
        }

        .form-label {
            display: block;
            font-size: 0.75rem;
            font-weight: 700;
            color: #718096;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .form-input {
            width: 100%;
            padding: 14px 18px;
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            font-size: 0.938rem;
            font-weight: 500;
            color: #2d3748;
            transition: all 0.2s;
            outline: none;
        }

        .form-input:focus {
            background: white;
            border-color: #1e5a8e;
            box-shadow: 0 0 0 3px rgba(30, 90, 142, 0.1);
        }

        .form-input::placeholder {
            color: #a0aec0;
        }

        .form-footer {
            margin-top: 32px;
            padding-top: 28px;
            border-top: 1px solid #f1f3f5;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        .btn-reset {
            padding: 12px 24px;
            background: #f8f9fa;
            color: #718096;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.938rem;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-reset:hover {
            background: #e9ecef;
            color: #495057;
        }

        .btn-submit {
            padding: 12px 32px;
            background: linear-gradient(135deg, #1e5a8e 0%, #15436b 100%);
            color: white;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.938rem;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(30, 90, 142, 0.3);
            transition: all 0.2s;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #15436b 0%, #0d2f4d 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(30, 90, 142, 0.4);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        @media (max-width: 768px) {
            .form-content {
                padding: 24px 20px;
            }
            
            .form-footer {
                flex-direction: column;
            }
            
            .btn-reset, .btn-submit {
                width: 100%;
            }
        }
    </style>

    <div class="form-container">
        <!-- Header Section -->
        <div class="header-section">
            <a href="{{ route('admin.manage') }}" class="back-link">
                <svg class="back-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Manajemen Akun
            </a>
            
            <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 20px;">
                <div>
                    <h1 class="page-title">Tambah Administrator</h1>
                    <p class="page-subtitle">Lengkapi formulir untuk mendaftarkan akun pengelola baru</p>
                </div>
                
                <span class="status-badge" style="flex-shrink: 0;">
                    <span class="status-dot"></span>
                    Sesi Aktif
                </span>
            </div>
        </div>

        <!-- Form Card -->
        <div class="form-card">
            <div class="form-top-accent"></div>
            
            <form action="{{ route('admin.register.store') }}" method="POST" class="form-content">
                @csrf
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 32px; margin-bottom: 8px;">
                    
                    <!-- Kolom Kiri - Informasi Identitas -->
                    <div>
                        <h2 class="section-title">
                            <span class="section-icon">👤</span>
                            Informasi Identitas
                        </h2>
                        
                        <div style="margin-bottom: 20px;">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" required class="form-input" placeholder="Masukkan nama lengkap...">
                        </div>

                        <div>
                            <label class="form-label">Alamat Email Instansi</label>
                            <input type="email" name="email" required class="form-input" placeholder="nama@binjai.go.id">
                        </div>
                    </div>

                    <!-- Kolom Kanan - Kredensial Keamanan -->
                    <div>
                        <h2 class="section-title">
                            <span class="section-icon">🔒</span>
                            Kredensial Keamanan
                        </h2>

                        <div style="margin-bottom: 20px;">
                            <label class="form-label">Kata Sandi Baru</label>
                            <input type="password" name="password" required class="form-input" placeholder="••••••••">
                        </div>

                        <div>
                            <label class="form-label">Ulangi Kata Sandi</label>
                            <input type="password" name="password_confirmation" required class="form-input" placeholder="••••••••">
                        </div>
                    </div>
                </div>

                <!-- Footer dengan Tombol -->
                <div class="form-footer">
                    <button type="reset" class="btn-reset">Reset Form</button>
                    <button type="submit" class="btn-submit">Simpan Akun</button>
                </div>
            </form>
        </div>
    </div>

    <style>
        @media (max-width: 768px) {
            .form-content > div:first-child {
                grid-template-columns: 1fr !important;
            }
            
            .header-section > div:first-child {
                flex-direction: column !important;
            }
        }
    </style>
</x-app-layout>