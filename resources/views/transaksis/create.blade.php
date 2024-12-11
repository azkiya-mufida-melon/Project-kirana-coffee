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
            background-color: #f8f5f0; /* Background color */
        }
        .sidebar {
            min-width: 260px;
            max-width: 250px;
            background: #ffffff; /* Dark brown color */
            color: black;
            height: 100vh;
            padding: 20px;
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
            font-style: Lilita One;
        }
        .sidebar a:hover {
            background: #d7ccc8; /* Light grey hover */
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
            background: #3C3D37; /* Navbar color */
            width: 100%;
            padding: 25px;
            color: white;
            margin: 0;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
        .card {
            background-color: #fffaf0; /* Card background */
            border: none;
        }
        .btn-success {
            background-color: #8d6e63; /* Button color */
            border: none;
        }
        .btn-success:hover {
            background-color: #6d4c41;
        }
        .btn-danger {
            background-color: #8d6e63; /* Delete button color */
            border: none;
        }
        .btn-danger:hover {
            background-color: #6d4c41;
        }
        table th {
            background-color: #e0e0e0; /* Table header color */
        }
        .dropdown-menu {
            min-width: 110px; /* Kurangi ukuran minimum lebar */
            max-width: 150px; /* Batasi ukuran maksimum lebar */
            background-color: #f8f9fa; /* Warna latar dropdown */
            padding: 5px 10px; /* Sesuaikan padding */
            border-radius: 5px; /* Buat sudut melengkung */
        }
        .dropdown {
            position: relative;
            z-index: 1050; /* Agar dropdown tampil di atas elemen lain */
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
    <h2>KIRANA COFFE</h2>
        <a href="#"><i class="fas fa-home"></i> Dashboard</a>
        <a href="{{ route('menus.index') }}"><i class="fas fa-coffee"></i> Menu</a>
        <a href="{{ route('pesanans.index') }}"><i class="fas fa-truck"></i> Pesanan</a>
        <a href="{{ route('transaksis.index') }}"><i class="fas fa-file-alt"></i> Transaksi</a>
        <a href="#"><i class="fas fa-chart-line"></i> Laporan</a>
        <a href="{{ route('biodatas.index') }}"><i class="fas fa-user"></i> Biodata</a>
        <a href="#"><i class="fas fa-lightbulb"></i> TPK</a>
        <a href="#"><i class="fas fa-chart-pie"></i> Hasil TPK</a>
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
                        <li>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Log out
                            </a>
                            <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('absensis.index') }}">Absensi</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Data Menu Table -->
        <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('transaksis.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        
                            <div class="row">
                                <!-- ID Pesanan -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">ID PESANAN</label>
                                        <input type="number" class="form-control @error('id_pesanan') is-invalid @enderror" name="id_pesanan" value="{{ old('id_pesanan') }}" placeholder="Masukkan Id Pesanan">
                                        @error('id_pesanan')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                        
                                <!-- Tanggal Transaksi -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">TANGGAL TRANSAKSI</label>
                                        <input type="date" class="form-control @error('tgl_transaksi') is-invalid @enderror" name="tgl_transaksi" value="{{ old('tgl_transaksi') }}">
                                        @error('tgl_transaksi')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        
                            <div class="row">
                                <!-- Nama Pelanggan -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">NAMA PELANGGAN</label>
                                        <input type="text" class="form-control @error('nama_pemesan') is-invalid @enderror" name="nama_pemesan" value="{{ old('nama_pemesan') }}" placeholder="Masukkan Nama Pemesan">
                                        @error('nama_pemesan')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                        
                                <!-- Menu -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">MENU</label>
                                        <input type="text" class="form-control @error('nama_menu') is-invalid @enderror" name="nama_menu" value="{{ old('nama_menu') }}" placeholder="Masukkan Menu">
                                        @error('nama_menu')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        
                            <div class="row">
                                <!-- Harga -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">HARGA</label>
                                        <input type="number" class="form-control @error('harga') is-invalid @enderror" name="harga" value="{{ old('harga') }}" placeholder="Masukkan Harga">
                                        @error('harga')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                        
                                <!-- Total Bayar -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">TOTAL BAYAR</label>
                                        <input type="number" class="form-control @error('total_bayar') is-invalid @enderror" name="total_bayar" value="{{ old('total_bayar') }}" placeholder="Masukkan Total Bayar">
                                        @error('total_bayar')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        
                            <div class="row">
                                <!-- Jumlah Pesanan -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">JUMLAH PESANAN</label>
                                        <input type="number" class="form-control @error('jumlah_pesanan') is-invalid @enderror" name="jumlah_pesanan" value="{{ old('jumlah_pesanan') }}" placeholder="Masukkan Jumlah Pesanan">
                                        @error('jumlah_pesanan')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                        
                                <!-- Metode Pembayaran -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">METODE PEMBAYARAN</label>
                                        <input type="text" class="form-control @error('metode_pembayaran') is-invalid @enderror" name="metode_pembayaran" value="{{ old('metode_pembayaran') }}" placeholder="Masukkan Metode Pembayaran">
                                        @error('metode_pembayaran')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        
                            <div class="row">
                                <!-- Status Transaksi -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">STATUS TRANSAKSI</label>
                                        <input type="text" class="form-control @error('status_transaksi') is-invalid @enderror" name="status_transaksi" value="{{ old('status_transaksi') }}" placeholder="Masukkan Status Transaksi">
                                        @error('status_transaksi')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        
                            <!-- Buttons -->
                            <button type="submit" class="btn btn-md btn-primary me-3">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                        </form>
                        
                    </div>
                </div>
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
