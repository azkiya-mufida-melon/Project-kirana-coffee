<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kirana Coffee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
            body {
            display: flex;
            background-color: #f8f5f0; /* Warna latar belakang */
        }

        .sidebar {
            min-width: 260px;
            max-width: 250px;
            background: #ffffff; /* Warna latar sidebar */
            color: black;
            min-height: 150%;
            padding: 20px;
            position: relative;
        }

        .sidebar h2 {
            margin-bottom: 50px; /* Menambahkan jarak bawah */
        }

        .sidebar a {
            color: black;
            text-decoration: none;
            margin: 20px 0;
            display: block;
            font-size: 17px;
            font-family: 'Lilita One', sans-serif; /* Menggunakan font yang benar */
        }

        .sidebar a:hover {
            background: #d7ccc8; /* Warna latar saat hover */
            color: #3e2723;
            padding-left: 10px;
            transition: 0.3s;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }

        .navbar {
            background: #3C3D37; /* Warna navbar */
            width: 101.7%;
            padding: 25px;
            color: white;
            margin: 0;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
        }

        .card {
            background-color: #fffaf0; /* Warna latar kartu */
            border: none;
        }

        .btn-success {
            background-color: #8d6e63; /* Warna tombol */
            border: none;
        }

        .btn-success:hover {
            background-color: #6d4c41;
        }

        .btn-danger {
            background-color: #8d6e63; /* Warna tombol hapus */
            border: none;
        }

        .btn-danger:hover {
            background-color: #6d4c41;
        }

        table th {
            background-color: #e0e0e0; /* Warna latar header tabel */
        }

        .table thead th {
            background-color: #d9d9d9;
        }

        .btn-edit {
            background-color: #6d4c41;
            color: white;
        }

        .btn-hapus {
            background-color: #8d6e63;
            color: white;
        }

        /* Menyorot tautan aktif di sidebar */
        .sidebar a.active {
            background-color: #d7ccc8; /* Warna latar hijau untuk tautan aktif */
            color: black;
        }

    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>KIRANA COFFE</h2>
            <a href="#"><i class="fas fa-home"></i> Dashboard</a>
            <a href="{{ route('menus.index') }}"><i class="fas fa-coffee"></i> Menu</a>
            <a href="{{ route('pesanans.index') }}" class="{{ request()->is('pesanans*') ? 'active' : '' }}"><i class="fas fa-truck"></i> Pesanan</a>
            <a href="{{ route('transaksis.index') }}" class="{{ request()->is('transaksis*') ? 'active' : '' }}"><i class="fas fa-file-alt"></i> Transaksi</a>
            <a href="#"><i class="fas fa-chart-line"></i> Laporan</a>
            <a href="{{ route('biodatas.index') }}"><i class="fas fa-user"></i> Biodata</a>
            <a href="#"><i class="fas fa-chart-line"></i> TPK</a>
            <a href="#"><i class="fas fa-chart-line"></i> Hasil TPK</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <nav class="navbar d-flex justify-content-between">
            <span class="navbar-brand text-white">KIRANA COFFEE - Transaksi</span>
            <div class="d-flex align-items-center">
                <i class="fas fa-bell fa-lg me-3"></i>
                <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="Profile Picture">
                <div class="dropdown">
                    <a class="btn dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Admin
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Log out</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="col-md-12 col-sm-12">
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <h3 class="text-center my-4">Data Transaksi</h3>
                        <hr>
                    </div>
                    <div class="card border-0 shadow-sm rounded">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                            <form method="GET" action="{{ route('pesanans.index') }}" class="d-flex justify-content-between align-items-center mb-3 w-100">
                                <div>
                                    Show 
                                    <select name="entries" id="entries" class="form-select d-inline-block" style="width: 80px;">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                    </select>
                                    entries
                                </div>
                                <div>
                                    Search: <input type="text" name="search" class="form-control d-inline-block" style="width: 200px;" value="{{ request()->query('search') }}">
                                </div>
                                <button type="submit" class="btn btn-primary d-none">Search</button>
                            </form>
                            </div>
                        <!-- Tabel Transaksi -->
                        <table class="table table-bordered">
                            <thead>
                                <tr class="headings text-center">
                                    <th class="col">Id Pesanan</th>
                                    <th class="col">Tanggal Transaksi</th>
                                    <th class="col">Pelanggan</th>
                                    <th class="col">Menu</th>
                                    <th class="col">Harga</th>
                                    <th class="col">Total Bayar</th>
                                    <th class="col">Jumlah Pesanan</th>
                                    <th class="col">Metode Pembayaran</th>
                                    <th class="col">Status</th>
                                    <th scope="col" style="width: 20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transaksis as $transaksi)
                                    <tr class="text-center">
                                        <!-- Id Pesanan -->
                                        <td>{{ $transaksi->id_pesanan }}</td>
                            
                                        <!-- Tanggal Transaksi -->
                                        <td>{{ $transaksi->tgl_transaksi }}</td>
                            
                                        <!-- Nama Pemesan -->
                                        <td>{{ $transaksi->pesanan->nama_pemesan ?? 'Nama Pemesan tidak tersedia' }}</td>
                            
                                        <!-- Nama Menu -->
                                        <td>
                                            {{ $transaksi->pesanan && $transaksi->pesanan->menu 
                                                ? $transaksi->pesanan->menu->nama_menu 
                                                : 'Menu tidak tersedia' }}
                                        </td>
                            
                                        <!-- Harga -->
                                        <td>
                                            {{ $transaksi->pesanan && $transaksi->pesanan->menu 
                                                ? 'Rp ' . number_format($transaksi->pesanan->menu->harga, 2, ',', '.') 
                                                : 'Harga tidak tersedia' }}
                                        </td>
                            
                                        <!-- Total Bayar -->
                                        <td>
                                            {{ $transaksi->pesanan 
                                                ? 'Rp ' . number_format($transaksi->pesanan->total_pembayaran, 2, ',', '.') 
                                                : 'Total pembayaran tidak tersedia' }}
                                        </td>
                            
                                        <!-- Jumlah Pesanan -->
                                        <td>{{ $transaksi->pesanan->jumlah_pesanan ?? 'Jumlah tidak tersedia' }}</td>
                            
                                        <!-- Metode Pembayaran -->
                                        <td>
                                            <form action="{{ route('transaksis.update', $transaksi->id_transaksi) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <select name="metode_pembayaran" class="form-select" onchange="this.form.submit()">
                                                    <option value="Cash" {{ $transaksi->metode_pembayaran == 'Cash' ? 'selected' : '' }}>Cash</option>
                                                    <option value="QRIS" {{ $transaksi->metode_pembayaran == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                                                </select>
                                            </form>
                                        </td>
                                                                    
                                        <!-- Status Transaksi -->
                                        <td>
                                            <form action="{{ route('transaksis.update', $transaksi->id_transaksi) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <select name="status_transaksi" class="form-select" onchange="this.form.submit()">
                                                    <option value="Lunas" {{ $transaksi->status_transaksi == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                                                    <option value="Belum Lunas" {{ $transaksi->status_transaksi == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                                                </select>
                                            </form>
                                        </td>
                                                                    
                                        <!-- Aksi -->
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" 
                                                action="{{ route('transaksis.destroy', $transaksi->id_transaksi) }}" 
                                                method="POST">
                                                <a href="{{ route('transaksis.show', $transaksi->id_transaksi) }}" class="btn btn-sm btn-dark">LIHAT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">
                                            <div class="alert alert-danger">
                                                Data transaksi belum tersedia.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $transaksis->links() }}
                  </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            //message with sweetalert
            @if(session('success'))
                Swal.fire({
                    icon: "success",
                    title: "BERHASIL",
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 2000
                });
            @elseif(session('error'))
                Swal.fire({
                    icon: "error",
                    title: "GAGAL!",
                    text: "{{ session('error') }}",
                    showConfirmButton: false,
                    timer: 2000
                });
            @endif
        </script>
    </div>

</body>
</html>