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
        <a href="{{ route('pesanans.index') }}" class="{{ request()->is('pesanans*') ? 'active' : '' }}"><i class="fas fa-truck"></i> Pesanan</a>
        <a href="{{ route('transaksis.index') }}"><i class="fas fa-file-alt"></i> Transaksi</a>
        <a href="#"><i class="fas fa-chart-line"></i> Laporan</a>
        <a href="{{ route('biodatas.index') }}"><i class="fas fa-user"></i> Biodata</a>
        <a href="#"><i class="fas fa-lightbulb"></i> TPK</a>
        <a href="#"><i class="fas fa-chart-pie"></i> Hasil TPK</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <nav class="navbar d-flex justify-content-between">
            <span class="navbar-brand text-white">KIRANA COFFEE - Pesanan</span>
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
                        <form action="{{ route('pesanans.store') }}" method="POST" enctype="multipart/form-data">
                        
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">TANGGAL PESAN</label>
                                        <input type="date" class="form-control @error('tgl_pesan') is-invalid @enderror" name="tgl_pesan" value="{{ old('tgl_pesan') }}" placeholder="Masukkan Tanggal Pesan">
                                    
                                        <!-- error message untuk tanggal pesan -->
                                        @error('tgl_pesan')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">NAMA PEMESAN</label>
                                        <input type="text" class="form-control @error('nama_pemesan') is-invalid @enderror" name="nama_pemesan" value="{{ old('nama_pemesan') }}" placeholder="Masukkan Nama Pemesan">
                                    
                                        <!-- error message untuk nama pemesan -->
                                        @error('nama_pemesan')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username_pegawai">Nama Pegawai</label>
                                <select name="username_pegawai" id="username_pegawai" class="form-control">
                                    <option value="">Pilih Pegawai</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->username }}">{{ $user->username }}</option>
                                    @endforeach
                                </select>
                            </div>                                                       

                            <div class="row">
                                <!-- Baris untuk Menu dan Harga -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">MENU</label>
                                        <select id="menu-select" name="id_menu" class="form-control">
                                            <option value="">Pilih Menu</option>
                                            @foreach($menus as $menu)
                                                <option value="{{ $menu->id_menu }}" data-harga="{{ $menu->harga }}">
                                                    {{ $menu->nama_menu }}
                                                </option>
                                            @endforeach
                                        </select>
                            
                                        @error('id_menu')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">HARGA</label>
                                        <input type="number" id="harga" class="form-control @error('harga') is-invalid @enderror" name="harga" value="{{ old('harga') }}" readonly>
                                        
                                        @error('harga')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                                <div class="row">
                                    <!-- Baris untuk Jumlah Pesanan dan Total Bayar -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="font-weight-bold">JUMLAH PESANAN</label>
                                            <input type="number" id="jumlah_pesanan" class="form-control @error('jumlah_pesanan') is-invalid @enderror" name="jumlah_pesanan" value="{{ old('jumlah_pesanan') }}" placeholder="Masukkan Jumlah Pesanan">
                                            
                                            @error('jumlah_pesanan')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="font-weight-bold">TOTAL BAYAR</label>
                                            <input type="number" id="total_bayar" class="form-control @error('total_pembayaran') is-invalid @enderror" name="total_pembayaran" value="{{ old('total_pembayaran') }}" readonly>
                                            
                                            @error('total_pembayaran')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <script>
                                    // Mengisi otomatis harga berdasarkan pilihan menu dan menghitung total bayar
                                    document.getElementById('menu-select').addEventListener('change', function () {
                                        var selectedOption = this.options[this.selectedIndex];
                                        var harga = selectedOption.getAttribute('data-harga');
                                        document.getElementById('harga').value = harga ? harga : '';
                                        calculateTotal(); // Update total bayar setiap kali menu dipilih
                                    });
                                
                                    document.getElementById('jumlah_pesanan').addEventListener('input', function () {
                                        calculateTotal(); // Update total bayar setiap kali jumlah pesanan diubah
                                    });
                                
                                    function calculateTotal() {
                                        var harga = parseFloat(document.getElementById('harga').value) || 0;
                                        var jumlahPesanan = parseInt(document.getElementById('jumlah_pesanan').value) || 0;
                                        var totalBayar = harga * jumlahPesanan;
                                        document.getElementById('total_bayar').value = totalBayar;
                                    }
                                </script>
                            

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