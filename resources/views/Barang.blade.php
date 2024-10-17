@include('sidebar')
<style>
    /* Modal Header Styling */
    .modal-header {
        background-color: #007bff;
        color: white;
    }

    /* Centering modal content */
    .modal-body {
        display: flex;
        align-items: center;
    }

    /* Success Icon Style */
    .modal-body i {
        font-size: 2rem;
        margin-right: 10px;
        color: #28a745;
    }

    /* Table Styling */
    table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 1.5rem;
    }

    table th, table td {
        padding: 12px;
        text-align: center;
    }

    table thead {
        background-color: #007bff;
        color: white;
    }

    table tbody tr {
        transition: background-color 0.3s;
    }

    table tbody tr:hover {
        background-color: #f1f1f1;
    }

    /* Button Styling */
    .btn-primary, .btn-danger {
        transition: transform 0.3s;
    }

    .btn-primary:hover, .btn-danger:hover {
        transform: scale(1.05);
    }

    /* Table Row Alignment */
    td, th {
        vertical-align: middle !important;
    }
</style>

<body>
    <div class="container mt-5 col-8">
        <h2 class="mb-4 text-center">Daftar barang</h2>

        <!-- Button to open the Add barang modal -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addbarangModal">
            <i class="fas fa-plus"></i> Tambah barang
        </button>

        <!-- Modal to add a new barang -->
        <div class="modal fade" id="addbarangModal" tabindex="-1" aria-labelledby="addbarangModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('barang.store') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addbarangModalLabel">Tambah barang</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3 p-2">
                                <label for="nama_barang" class="form-label">Nama barang</label>
                                <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
                            </div>
                            <div class="mb-3 p-2">
                                <label for="harga_barang" class="form-label">Harga barang</label>
                                <input type="text" class="form-control" id="harga_barang" name="harga_barang" required>
                            </div>
                            <div class="mb-3 p-2">
                                <label for="stok_barang" class="form-label">Stok</label>
                                <input type="text" class="form-control" id="stok_barang" name="stok_barang" required>
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

        <!-- Table of barang -->
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama barang</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barang as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->harga_barang }}</td>
                        <td>{{ $item->stok_barang }}</td>
                        <td>
                            <!-- Edit Button -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#editbarangModal{{ $item->id }}"><i class="fas fa-edit"></i> Edit
                            </button>

                            <!-- Delete Form -->
                            <form action="{{ route('barang.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus barang ini?')"><i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal to edit barang -->
                    <div class="modal fade" id="editbarangModal{{ $item->id }}" tabindex="-1" aria-labelledby="editbarangModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('barang.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title" id="editbarangModalLabel">Edit barang</h5>
                                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3 p-2">
                                            <label for="edit_nama_barang" class="form-label">Nama barang</label>
                                            <input type="text" class="form-control" id="edit_nama_barang" name="nama_barang" value="{{ $item->nama_barang }}" required>
                                        </div>
                                        <div class="mb-3 p-2">
                                            <label for="edit_harga_barang" class="form-label">harga barang</label>
                                            <input type="text" class="form-control" id="harga_barang" name="harga_barang" value="{{ $item->harga_barang }}" required>
                                        </div>
                                        <div class="mb-3 p-2">
                                            <label for="stok_barang" class="form-label">stok</label>
                                            <input type="text" class="form-control" id="stok_barang" name="stok_barang" value="{{ $item->stok_barang }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>

        <!-- Popup Notification -->
        @if (session('success'))
            <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="notificationModalLabel">Notifikasi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <i class="fas fa-check-circle"></i> <!-- Success icon -->
                            {{ session('success') }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Bootstrap and JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Show the notification modal if there's a success message
        document.addEventListener('DOMContentLoaded', function () {
            @if (session('success'))
                var notificationModal = new bootstrap.Modal(document.getElementById('notificationModal'));
                notificationModal.show();
            @endif
        });
    </script>
</body>
