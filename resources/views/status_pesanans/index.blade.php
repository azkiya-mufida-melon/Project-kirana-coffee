<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KIRANA COFFEE - Status Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #333;
            position: fixed;
            top: 0;
            left: 0;
            color: #fff;
            padding-top: 20px;
        }

        .sidebar-header {
            font-size: 24px;
            text-align: center;
            padding: 10px 0;
            background-color: #2b2b2b;
            font-weight: bold;
            width: 90%;
            margin: 10px auto;
            border-radius: 8px;
            position: sticky;
            top: 10px;
            z-index: 1000;
        }

        .sidebar ul {
            list-style: none;
            padding-left: 0;
        }

        .sidebar ul li {
            padding: 15px 20px;
            font-size: 16px;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
        }

        .sidebar ul li:hover {
            background-color: #444;
        }

        /* Top Header */
        .top-header {
            background-color: #2b2b2b;
            color: #fff;
            text-align: center;
            font-size: 24px;
            padding: 15px 0;
            width: calc(100% - 300px); /* Agar tidak menutupi sidebar */
            margin: 20px auto; /* Rata tengah dengan jarak dari atas */
            margin-left: 270px; /* Jarak dari sidebar */
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        /* Main Content */
        .main-content {
            margin-left: 270px; /* Offset untuk menghindari sidebar */
            padding: 20px;
            background-color: #f7f7f7;
        }

        /* Table Container */
        .table-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Add Button */
        .add-status-button {
            background-color: #8b6b61;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 20px;
            float: left;
        }

        .add-status-button:hover {
            background-color: #7a5a52;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #f0eceb;
            color: #333;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        /* Action Buttons */
        .actions {
            display: flex;
            justify-content: center;
            gap: 5px;
        }

        .actions .btn {
            padding: 3px 8px;
            font-size: 12px;
            border-radius: 3px;
        }

        .btn-dark {
            background-color: #4a3a28;
        }

        .btn-primary {
            background-color: #6c757d;
        }

        .btn-danger {
            background-color: #d9534f;
        }

    </style>
</head>
<body style="background: #f7f7f7; font-family: Arial, sans-serif;">

    <div class="sidebar">
        <div class="sidebar-header">KIRANA COFFEE</div>
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Pesanan</a></li>
            <li><a href="#">Delivery Order</a></li>
            <li><a href="#">Menu</a></li>
            <li><a href="#">Laporan</a></li>
            <li><a href="#">Status Pesanan</a></li>
        </ul>
    </div>

    <div class="top-header">KIRANA COFFEE - Status Pesanan</div>

    <div class="main-content">
        <div class="table-container">
            <a href="{{ route('status_pesanans.create') }}" class="add-status-button">ADD STATUS PESANAN</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID PESANAN</th>
                        <th scope="col">NAMA PEMESAN</th>
                        <th scope="col">DETAIL PESANAN</th>
                        <th scope="col">STATUS</th>
                        <th scope="col" style="width: 20%">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($statusPesanans as $statusPesanan)
                        <tr>
                            <td>{{ $statusPesanan->id_pesanan }}</td>
                            <td>{{ $statusPesanan->nama_pemesan }}</td>
                            <td>{!! $statusPesanan->detail_pesanan !!}</td>
                            <td>{{ $statusPesanan->status }}</td>
                            <td class="text-center actions">
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('status_pesanans.destroy', $statusPesanan->id_status) }}" method="POST">
                                    <a href="{{ route('status_pesanans.show', $statusPesanan->id_status) }}" class="btn btn-dark">SHOW</a>
                                    <a href="{{ route('status_pesanans.edit', $statusPesanan->id_status) }}" class="btn btn-primary">EDIT</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">HAPUS</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Data Status Pesanan belum Tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $statusPesanans->links() }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
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

</body>
</html>
