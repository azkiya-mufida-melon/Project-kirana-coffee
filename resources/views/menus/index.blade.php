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
            <span class="navbar-brand text-white">KIRANA COFFEE - Menu</span>
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
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <h3 class="text-center my-4">Data Menu</h3>
                        <hr>
                    </div>
                    <div class="card border-0 shadow-sm rounded">
                        <div class="card-body">
                            <a href="{{ route('menus.create') }}" class="btn btn-md btn-success mb-3">TAMBAH MENU</a>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <form method="GET" action="{{ route('menus.index') }}" class="d-flex justify-content-between align-items-center mb-3 w-100">
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
                                    <tr class="text-center">
                                        <th scope="col">Gambar</th>
                                        <th scope="col">Nama Menu</th>
                                        <th scope="col">Deskripsi</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Stok</th>
                                        <th scope="col" style="width: 20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($menus as $menu)
                                        <tr class="text-center">
                                            <td class="text-center">
                                                <img src="{{ asset('/storage/menus/'.$menu->gambar_menu) }}" class="rounded" style="width: 150px">
                                            </td>
                                            <td>{{ $menu->nama_menu }}</td>
                                            <td>{!! $menu->detail_menu !!}</td>
                                            <td>{{ "Rp " . number_format($menu->harga,2,',','.') }}</td>
                                            <td>{{ $menu->stok }}</td>
                                            <td class="text-center">
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('menus.destroy', $menu->id_menu) }}" method="POST">
                                                    <a href="{{ route('menus.show', $menu->id_menu) }}" class="btn btn-sm btn-dark">LIHAT</a>
                                                    <a href="{{ route('menus.edit', $menu->id_menu) }}" class="btn btn-sm btn-edit">EDIT</a>
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
                                                    Data menu belum tersedia.
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $menus->links() }}
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
