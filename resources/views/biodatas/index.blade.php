<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kirana Coffee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Data Pegawai</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('biodatas.create') }}" class="btn btn-md btn-success mb-3">TAMBAH PEGAWAI</a>
                        <table class="table table-sm table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">Gambar</th>
                                <th scope="col">Nama Pegawai</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Tanggal Lahir</th>
                                <th scope="col">No.Telp</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Email</th>
                                <th >Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($biodatas as $biodata)
                                <tr class="text-center">
                                    <td>
                                        <img src="{{ asset('storage/biodatas/' . $biodata->foto_profil) }}" alt="Foto Profil" class="rounded-circle" width="70" height="70">
                                    </td>
                                    <td>{{ $biodata->nama }}</td>
                                    <td>{{ $biodata->jenis_kelamin == 'Laki-Laki' ? 'Laki-Laki' : 'Perempuan' }}</td>
                                    <td>{{ $biodata->tgl_lahir }}</td>
                                    <td>+62 {{ $biodata->no_telp }}</td>
                                    <td>{{ $biodata->alamat }}</td>
                                    <td>{{ $biodata->email }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('biodatas.destroy', $biodata->id_biodata) }}" method="POST">
                                            <a href="{{ route('biodatas.show', $biodata->id_biodata) }}" class="btn btn-sm btn-dark">LIHAT</a>
                                            <a href="{{ route('biodatas.edit', $biodata->id_biodata) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">
                                        <div class="alert alert-danger">
                                            Data pegawai belum Tersedia.
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                        {{ $biodatas->links() }}
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

</body>
</html>