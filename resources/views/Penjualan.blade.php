@include('sidebar')
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Roboto', sans-serif;
    }

    .container {
        background-color: #fff;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        padding: 20px;
        border-radius: 8px;
    }

    h2 {
        color: #343a40;
        font-weight: bold;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        font-weight: bold;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    table {
        border-collapse: separate;
        border-spacing: 0 15px;
    }

    th,
    td {
        vertical-align: middle !important;
    }

    th {
        background-color: #007bff;
        color: white;
        text-transform: uppercase;
    }

    td {
        background-color: #f8f9fa;
        border-top: 1px solid #dee2e6;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
    }

    .modal-header {
        background-color: #343a40;
        color: white;
    }

    .modal-body i {
        font-size: 2rem;
        margin-right: 10px;
        color: #28a745;
    }

    .modal-footer .btn {
        border-radius: 20px;
    }
</style>

<body>

    <div class="container mt-5 col-8">
        <h2 class="mb-4 text-center">Daftar Penjualan</h2>

        <!-- Tombol untuk membuka modal -->
        <a href="{{ route('keranjang.index') }}" class="btn btn-primary mb-2">
            <i class="fas fa-plus"></i> Tambah
        </a>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Nama Pelanggan</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penjualan as $key => $item)
                    <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td class="text-center">
                            @if ($item->pelanggan)
                                {{ $item->pelanggan->nama_pelanggan }}
                            @endif
                        </td>
                        <td class="text-center">{{ $item->tanggal }}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#modal{{ $item->id }}">
                                Detail Penjualan
                            </button>

                            <form action="{{ route('penjualan.destroy', $item->id) }}" method="POST"
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

    {{-- Modal Detail Penjualan --}}
    @foreach ($penjualan as $item)
    <div class="modal fade" id="modal{{ $item->id }}" tabindex="-1"
        aria-labelledby="modalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="modalLabel{{ $item->id }}">Detail Penjualan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <h6>Detail Pelanggan:</h6>
                        <p><strong>Nama:</strong> {{ $item->pelanggan->nama_pelanggan }}
                        </p>
                        <p><strong>Tanggal:</strong> {{ $item->tanggal }}</p>
                    </div>

                    <h6>Detail Barang:</h6>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->detailPenjualan as $detail)
                            <tr>
                                <td>{{ $detail->barang->nama_barang }}</td>
                                <td>{{ $detail->jumlah_barang }}</td>
                                <td>{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endforeach




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>



</body>

</html>
