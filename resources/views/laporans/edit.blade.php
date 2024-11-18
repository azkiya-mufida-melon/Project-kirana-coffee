<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background: lightgray">
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <!-- Form Edit Laporan -->
                        <form action="{{ route('laporans.update', $laporan->id_laporan) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- ID Pesanan -->
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">ID Pesanan</label>
                                <input type="number" class="form-control @error('id_pesanan') is-invalid @enderror"
                                    name="id_pesanan" value="{{ old('id_pesanan', $laporan->id_pesanan) }}"
                                    placeholder="Masukkan ID Pesanan">
                                @error('id_pesanan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Tanggal Laporan -->
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Tanggal Laporan</label>
                                <input type="date" class="form-control @error('tgl_laporan') is-invalid @enderror"
                                    name="tgl_laporan" value="{{ old('tgl_laporan', $laporan->tgl_laporan) }}"
                                    placeholder="Masukkan Tanggal Laporan">
                                @error('tgl_laporan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Update Laporan</button>
                            <a href="{{ route('laporans.index') }}" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
