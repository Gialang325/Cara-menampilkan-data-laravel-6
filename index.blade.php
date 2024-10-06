<!DOCTYPE html>
<html>
<head>
    <title>Daftar Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="mb-4">Daftar Data Siswa</h1>
        <form action="{{ route('projek.index') }}" method="GET" class="d-flex mb-3">
            <input class="form-control me-2" type="search" name="search" placeholder="Cari Berdasarkan Nama..." aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <a href="{{ route('projek.create') }}" class="btn btn-primary mb-3">Tambah Data Siswa</a>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projek as $index => $p)
                <tr>
                    <td>{{ $index + 1 + ($projek->currentPage() - 1) * $projek->perPage() }}</td>
                    <td class="text-center">
                        <img src="{{ asset('storage/images/projek/' . $p->foto) }}" class="rounded" style="width: 150px">
                    </td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->kelas }}</td>
                    <td>{{ $p->jurusan }}</td>
                    <td>
                        <form onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');" 
                              action="{{ route('projek.destroy', $p->id) }}" method="POST">
                            <a href="{{ route('projek.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('projek.show', $p->id) }}" class="btn btn-primary btn-sm">Show</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item {{ $projek->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $projek->previousPageUrl() }}">Sebelumnya</a>
                </li>

                <li class="page-item {{ $projek->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $projek->nextPageUrl() }}">Berikutnya</a>
                </li>
            </ul>
        </nav>
        <div class="text-center">
            <span>Halaman {{ $projek->currentPage() }} dari {{ $projek->lastPage() }}</span>
        </div>
    </div>
</body>
</html>