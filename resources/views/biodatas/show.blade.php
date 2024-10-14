<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kiraan Coffee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded" style="background-color: transparent;">
                    <img src="{{ asset('/storage/biodatas/'.$biodata->foto_profil) }}" 
                        class="rounded-circle" 
                        style="width: 150px; height: 150px; border-radius: 50%; display: block; margin: 0 auto;">
                </div>
            </div>

            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h3>{{ $biodata->nama }}</h3>
                        <hr/>
                        <p>{{ $biodata->jenis_kelamin }}</p>
                        <hr/>
                        <p>{{ \Carbon\Carbon::parse($biodata->tgl_lahir)->format('d-m-Y') }}</p>
                        <hr/>
                        <p>{{ preg_replace("/^(\d{2})(\d{3})(\d{4})(\d{4})$/", "+$1 $2 $3 $4", $biodata->no_telp) }}</p>
                        <hr/>
                        <p>{{ $biodata->alamat }}</p>
                        <hr/>
                        <p>{{ $biodata->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>