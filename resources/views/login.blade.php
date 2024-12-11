<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kirana Coffee - Absensi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            display: flex;
            background-color: #f8f5f0;
        }
        .sidebar {
            min-width: 260px;
            max-width: 250px;
            background: #ffffff;
            color: black;
            height: 100vh;
            padding: 20px;
        }
        .sidebar h2 {
            margin-bottom: 50px;
        }
        .sidebar a {
            color: black;
            text-decoration: none;
            margin: 20px 0;
            display: block;
            font-size: 17px;
        }
        .sidebar a:hover {
            background: #d7ccc8;
            color: #3e2723;
            padding-left: 10px;
            transition: 0.3s;
        }
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }
        .navbar {
            background: #3C3D37;
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
            background-color: #fffaf0;
            border: none;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>KIRANA COFFEE</h2>
        <a href="#"><i class="fas fa-home"></i> Dashboard</a>
        <a href="{{ route('absensi.index') }}"><i class="fas fa-clock"></i> Absensi</a>
        <a href="{{ route('menus.index') }}"><i class="fas fa-coffee"></i> Menu</a>
        <a href="{{ route('pesanans.index') }}"><i class="fas fa-file-alt"></i> Pesanan</a>
        <a href="{{ route('transaksis.index') }}"><i class="fas fa-truck"></i> Transaksi</a>
        <!-- Tambahkan link lainnya sesuai kebutuhan -->
    </div>

    <!-- Main Content -->
    <div class="content">
        <nav class="navbar d-flex justify-content-between">
            <span class="navbar-brand text-white">KIRANA COFFEE - Absensi</span>
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
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Form Absensi -->
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow-sm rounded">
                        <div class="card-body">
                            <h3 class="mb-4">Form Absensi</h3>
                            <form action="{{ route('absensi.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="text" id="tanggal" class="form-control" value="{{ \Carbon\Carbon::now()->toDateString() }}" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="jam_datang" class="form-label">Jam Datang</label>
                                    <input type="text" id="jam_datang" class="form-control" value="{{ $absensi->jam_datang ?? '-' }}" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="jam_pulang" class="form-label">Jam Pulang</label>
                                    <input type="text" id="jam_pulang" class="form-control" value="{{ $absensi->jam_pulang ?? '-' }}" disabled>
                                </div>
                                <div class="d-flex gap-3">
                                    @if(empty($absensi) || !$absensi->jam_pulang)
                                        <button type="submit" name="action" value="datang" class="btn btn-primary">
                                            Catat Jam Datang
                                        </button>
                                    @endif
                                    @if(!empty($absensi) && empty($absensi->jam_pulang))
                                        <button type="submit" name="action" value="pulang" class="btn btn-danger">
                                            Catat Jam Pulang
                                        </button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            // SweetAlert untuk pesan berhasil/gagal
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
