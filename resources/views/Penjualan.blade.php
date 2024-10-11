    @include('sidebar')
        <style>
            .modal-header {
                background-color: blue; /* Success color */
                color: white;
            }
            .modal-body {
                display: flex;
                align-items: center;
            }
            .modal-body i {
                font-size: 2rem;
                margin-right: 10px;
                color: #28a745;
            }
        </style>

    <body>

        <div class="container mt-5">
            <h2 class="mb-4 text-center">Daftar pelanggan</h2>

            <!-- Tombol untuk membuka modal -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addpelangganModal">
                Tambah pelanggan
            </button>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Nama Penjual</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pelanggan as $key => $item)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-center">{{ $item->nama_pelanggan }}</td>
                            <td class="text-center">{{ $item->alamat_pelanggan }}</td>
                            <td class="text-center">{{ $item->no_telp_pelanggan }}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#editPelangganModal{{ $item->id }}">Edit</button>
                                <form action="{{ route('pelanggan.destroy', $item->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Yakin ingin menghapus pelanggan ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        <!-- Modal untuk mengedit pelanggan -->
                        <div class="modal fade" id="editPelangganModal{{ $item->id }}" tabindex="-1" aria-labelledby="editPelangganModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('pelanggan.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title" id="editPelangganModalLabel">Edit pelanggan</h5>
                                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="edit_nama_pelanggan" class="form-label">Nama pelanggan</label>
                                                <input type="text" class="form-control" id="edit_nama_pelanggan" name="nama_pelanggan" value="{{ $item->nama_pelanggan }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_alamat_pelanggan" class="form-label">Alamat pelanggan</label>
                                                <input type="text" class="form-control" id="edit_alamat_pelanggan" name="alamat_pelanggan" value="{{ $item->alamat_pelanggan }}" required>
                                            </div>
                                            <div class="mb-3">
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

    </html>
