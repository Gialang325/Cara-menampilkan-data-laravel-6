<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail data siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                    <img src="{{ asset('storage/images/projek/' . $projek->foto) }}" class="rounded" style="width: 100%">
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h3>{{ $projek->nama }}</h3>
                        <hr/>
                        <p>{{ $projek->kelas }}</p>
                        <p>{{ $projek->jurusan }}</p>
                        <a href="{{ route('projek.index') }}" class="btn btn-primary btn-sm">Kembali</a>
                        <hr/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>