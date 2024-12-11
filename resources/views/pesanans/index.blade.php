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

        <div class="col-md-12 col-sm-12">
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <h3 class="text-center my-4">Data Pesanan</h3>
                        <hr>
                    </div>
                    <div class="card border-0 shadow-sm rounded">
                        <div class="card-body">
                            <a href="{{ route('pesanans.create') }}" class="btn btn-md btn-success mb-3">TAMBAH PESANAN</a>
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
                      <table class="table table-bordered">
                        <thead>
                          <tr class="headings text-center">
                            <th class="col">Tanggal </th>
                            <th class="col">Pelanggan </th>
                            <th class="col">Pegawai</th>
                            <th class="col">Menu </th>
                            <th class="col">Harga </th>
                            <th class="col">Jumlah Pesan </th>
                            <th class="col">Total Bayar </th>
                            <th scope="col" style="width: 20%">Aksi</th>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($pesanans as $pesanan)
                          <tr class="text-center">
                            <td>{{ $pesanan->tgl_pesan }}</td>
                            <td>{{ $pesanan->nama_pemesan }}</td>
                            <td>{{ $pesanan->user ? $pesanan->user->username : 'Tidak ada pegawai' }}</td>
                            <td>{{ $pesanan->menu ? $pesanan->menu->nama_menu : 'Menu tidak tersedia' }}</td>
                            <td>{{ "Rp " . number_format($pesanan->harga,2,',','.') }}</td>
                            <td>{{ $pesanan->jumlah_pesanan }}</td>
                            <td>{{ "Rp " . number_format($pesanan->total_pembayaran,2,',','.') }}</td>
                            <td class="text-center">
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('pesanans.destroy', $pesanan->id_pesanan) }}" method="POST">
                                                    <a href="{{ route('pesanans.show', $pesanan->id_pesanan) }}" class="btn btn-sm btn-dark">LIHAT</a>
                                                    <a href="{{ route('pesanans.edit', $pesanan->id_pesanan) }}" class="btn btn-sm btn-edit">EDIT</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-hapus">HAPUS</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">
                                                <div class="alert alert-danger">
                                                    Data pesanan belum tersedia.
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                        </tbody>
                    </table>
                    {{ $pesanans->links() }}	
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
    <p class="mt-5 mb-3 text-muted">&copy; 2024 Kirana Coffee</p>
</body>
</html>
