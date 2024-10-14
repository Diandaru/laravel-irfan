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

        <div class="container mt-5 col-8">
            <h2 class="mb-4 text-center">Daftar Penjualan</h2>

            <!-- Tombol untuk membuka modal -->
            <a href="{{ route('keranjang.index') }}" class="btn btn-primary mb-2"> <i class="fas fa-plus"></i>
                Tambah
            </a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Nama Penjual</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">No Telp</th>
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
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editPelangganModal{{ $item->id }}">Detail Penjualan</button>
                                <form action="{{ route('pelanggan.destroy', $item->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Yakin ingin menghapus pelanggan ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
