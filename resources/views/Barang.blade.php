<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <h2 class="mb-4 text-center">Daftar Barang</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tombol untuk membuka modal -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addBarangModal">
            Tambah Barang
        </button>

        <!-- Modal untuk menambah barang -->
        <div class="modal fade" id="addBarangModal" tabindex="-1" aria-labelledby="addBarangModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('barang.store') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addBarangModalLabel">Tambah Barang</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nama_barang" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="number" class="form-control" id="harga" name="harga_barang" required>
                            </div>
                            <div class="mb-3">
                                <label for="stok" class="form-label">Stok</label>
                                <input type="number" class="form-control" id="stok" name="stok_barang" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>



        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Nama Barang</th>
                    <th class="text-center">Harga</th>
                    <th class="text-center">Stok</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barang as $item)
                    <tr>
                        <td class="text-center">{{ $item->id }}</td>
                        <td class="text-center">{{ $item->nama_barang }}</td>
                        <td class="text-center">{{ number_format($item->harga_barang, 2, ',', '.') }}</td>
                        <td class="text-center">{{ $item->stok_barang }}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addedit">Edit</button>
                            <form action="{{ route('barang.destroy', $item->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus barang ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <!-- Modal untuk mengedit barang -->
                    <div class="modal fade" id="addedit" tabindex="-1" aria-labelledby="addeditmodel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <form id="editForm" action="{{ route('barang.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PUT') <!-- Menggunakan PUT untuk update -->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addBarangModalLabel">Edit Barang</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="edit_nama_barang" class="form-label">Nama Barang</label>
                                            <input type="text" class="form-control" id="edit_nama_barang"
                                                name="nama_barang" value ="{{ $item->nama_barang }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_harga" class="form-label">Harga</label>
                                            <input type="number" class="form-control" id="edit_harga"
                                                name="harga_barang" value="{{ $item->harga_barang }}" required>
                                        </div>
                                        <di v class="mb-3">
                                            <label for="edit_stok" class="form-label">Stok</label>
                                            <input type="number" class="form-control" id="edit_stok"
                                                name="stok_barang" value = "{{ $item->stok_barang }}" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="button" class="btn btn-primary">Simpan</button>
                                </div>
                        </div>
                        </form>
                    </div>
    </div>
    @endforeach
    </tbody>
    </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
