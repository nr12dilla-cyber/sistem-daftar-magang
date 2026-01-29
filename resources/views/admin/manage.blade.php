<x-app-layout>
    <style>
        .manage-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 2rem 1.5rem;
        }

        .header-section {
            background: linear-gradient(135deg, #1e5a8e 0%, #15436b 100%);
            border-radius: 20px;
            padding: 24px 28px;
            margin-bottom: 24px;
            box-shadow: 0 4px 15px rgba(30, 90, 142, 0.2);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
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
            margin-top: 4px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .btn-add-admin {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: white;
            color: #1e5a8e;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.875rem;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transition: all 0.2s;
            white-space: nowrap;
        }

        .btn-add-admin:hover {
            background: rgba(255, 255, 255, 0.95);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        }

        .table-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid #f1f3f5;
            overflow: hidden;
        }

        .table-header {
            background: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }

        .table-header th {
            padding: 16px 20px;
            font-size: 0.75rem;
            font-weight: 700;
            color: #718096;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table-row {
            border-bottom: 1px solid #f8f9fa;
            transition: background 0.2s;
        }

        .table-row:hover {
            background: #f8f9fa;
        }

        .table-row:last-child {
            border-bottom: none;
        }

        .table-row td {
            padding: 18px 20px;
        }

        .admin-avatar {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: linear-gradient(135deg, #1e5a8e 0%, #15436b 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 800;
            font-size: 1.125rem;
            box-shadow: 0 2px 8px rgba(30, 90, 142, 0.25);
        }

        .admin-name {
            font-weight: 700;
            color: #2d3748;
            font-size: 0.938rem;
        }

        .admin-email {
            color: #718096;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .badge-active {
            display: inline-block;
            padding: 6px 12px;
            background: linear-gradient(135deg, #1e5a8e 0%, #15436b 100%);
            color: white;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(30, 90, 142, 0.25);
        }

        .btn-delete {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            background: #fff5f5;
            color: #e53e3e;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.813rem;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-delete:hover {
            background: #e53e3e;
            color: white;
        }

        @media (max-width: 768px) {
            .header-section {
                flex-direction: column;
                align-items: flex-start;
            }

            .btn-add-admin {
                width: 100%;
                justify-content: center;
            }

            .table-card {
                overflow-x: auto;
            }
        }
    </style>

    <div class="manage-container">
        <!-- Header Section -->
        <div class="header-section">
            <div>
                <h1 class="page-title">Kelola Admin</h1>
                <p class="page-subtitle">Manajemen akun administrator sistem</p>
            </div>
            
            <a href="{{ route('admin.register') }}" class="btn-add-admin">
                <span>➕</span>
                <span>Tambah Admin Baru</span>
            </a>
        </div>

        <!-- Table Card -->
        <div class="table-card">
            <table style="width: 100%; border-collapse: collapse;">
                <thead class="table-header">
                    <tr>
                        <th style="text-align: left;">Nama Admin</th>
                        <th style="text-align: left;">Email</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $admin)
                    <tr class="table-row">
                        <td>
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div class="admin-avatar">
                                    {{ strtoupper(substr($admin->name, 0, 1)) }}
                                </div>
                                <span class="admin-name">{{ $admin->name }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="admin-email">{{ $admin->email }}</span>
                        </td>
                        <td style="text-align: center;">
                            @if($admin->id !== Auth::id())
                                <form action="{{ route('admin.destroy', $admin->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus admin ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-delete">
                                        <span>🗑️</span>
                                        <span>Hapus</span>
                                    </button>
                                </form>
                            @else
                                <span class="badge-active">ANDA (AKTIF)</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>