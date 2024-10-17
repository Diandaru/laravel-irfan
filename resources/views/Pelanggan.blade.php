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
        <h2 class="mb-4 text-center">Daftar Pelanggan</h2>

        <!-- Button to open the Add Pelanggan modal -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addpelangganModal">
            <i class="fas fa-plus"></i> Tambah Pelanggan
        </button>

        <!-- Modal to add a new pelanggan -->
        <div class="modal fade" id="addpelangganModal" tabindex="-1" aria-labelledby="addpelangganModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('pelanggan.store') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addpelangganModalLabel">Tambah Pelanggan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3 p-2">
                                <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
                            </div>
                            <div class="mb-3 p-2">
                                <label for="alamat_pelanggan" class="form-label">Alamat Pelanggan</label>
                                <input type="text" class="form-control" id="alamat_pelanggan" name="alamat_pelanggan" required>
                            </div>
                            <div class="mb-3 p-2">
                                <label for="no_telp_pelanggan" class="form-label">No Telepon</label>
                                <input type="text" class="form-control" id="no_telp_pelanggan" name="no_telp_pelanggan" required>
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

        <!-- Table of Pelanggan -->
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pelanggan</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pelanggan as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->nama_pelanggan }}</td>
                        <td>{{ $item->alamat_pelanggan }}</td>
                        <td>{{ $item->no_telp_pelanggan }}</td>
                        <td>
                            <!-- Edit Button -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#editPelangganModal{{ $item->id }}"><i class="fas fa-edit"></i> Edit
                            </button>

                            <!-- Delete Form -->
                            <form action="{{ route('pelanggan.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus pelanggan ini?')"><i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal to edit pelanggan -->
                    <div class="modal fade" id="editPelangganModal{{ $item->id }}" tabindex="-1" aria-labelledby="editPelangganModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('pelanggan.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title" id="editPelangganModalLabel">Edit Pelanggan</h5>
                                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3 p-2">
                                            <label for="edit_nama_pelanggan" class="form-label">Nama Pelanggan</label>
                                            <input type="text" class="form-control" id="edit_nama_pelanggan" name="nama_pelanggan" value="{{ $item->nama_pelanggan }}" required>
                                        </div>
                                        <div class="mb-3 p-2">
                                            <label for="edit_alamat_pelanggan" class="form-label">Alamat Pelanggan</label>
                                            <input type="text" class="form-control" id="edit_alamat_pelanggan" name="alamat_pelanggan" value="{{ $item->alamat_pelanggan }}" required>
                                        </div>
                                        <div class="mb-3 p-2">
                                            <label for="edit_no_telp_pelanggan" class="form-label">No Telepon</label>
                                            <input type="text" class="form-control" id="edit_no_telp_pelanggan" name="no_telp_pelanggan" value="{{ $item->no_telp_pelanggan }}" required>
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

    <!-- Modal untuk Duplicate Phone -->
<div class="modal fade" id="duplicatePhoneModal" tabindex="-1" aria-labelledby="duplicatePhoneModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="duplicatePhoneModalLabel">Peringatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Nomor telepon yang Anda masukkan sudah terdaftar. Silakan gunakan nomor yang lain.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if (session('duplicate_phone'))
            var duplicatePhoneModal = new bootstrap.Modal(document.getElementById('duplicatePhoneModal'));
            duplicatePhoneModal.show();
        @endif
    });
</script>

</body>
