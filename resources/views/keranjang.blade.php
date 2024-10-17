@include('sidebar')

<body>
    <div class="container w-75 mt-5 text-center">
        <div class="text-center mb-4">
            <h2>Transaksi Keranjang</h2>
            <p>No Invoice : XXXXX</p>
        </div>

        <!-- Form to select customer and date -->
        <form action="{{ route('penjualan.store') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="pilihPelanggan" class="form-label">Pilih Pelanggan</label>
                    <select class="form-select" id="pilihPelanggan" name="pilihPelanggan">
                        <option selected>Pilih Pelanggan</option>
                        @foreach ($pelanggan as $p)
                            <option value="{{ $p->id }}">{{ $p->nama_pelanggan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <div class="input-group">
                        <input type="date" class="form-control" id="tanggal" value="2024-10-03" name="tanggal">
                    </div>
                </div>
            </div>

            <!-- Buttons aligned in the same row -->
            <div class="d-flex justify-content-end mb-3">
                <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addModal">Tambah
                    Barang</button>
                <input type="hidden" name="id_pelanggan" id="id_pelanggan">
                <input type="hidden" name="tanggal" id="tanggal">
                <button class="btn btn-success" type="submit">Simpan Penjualan</button>
            </div>

            <!-- Table for Keranjang -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Barang</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($keranjang as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ number_format($item->jumlah_barang, 0, ',', '.') }}</td>
                            <td>Rp. {{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td>Rp. {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <!-- Delete Button -->
                            </td>
                        </tr>
                        <input type="hidden" name="nama_barang[]" value="{{ $item->nama_barang }}">
                        <input type="hidden" name="jumlah_barang[]" value="{{ $item->jumlah_barang }}">
                        <input type="hidden" name="harga[]" value="{{ $item->harga }}">
                        <input type="hidden" name="subtotal[]" value="{{ $item->subtotal }}">
                    @endforeach
                    <!-- Row to show total -->
                    <tr>
                        <td colspan="4" class="text-center"><strong>Total:</strong></td>
                        <td><strong>Rp. {{ number_format($total, 0, ',', '.') }}</strong></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

        </form>

        <!-- Add Barang Modal -->
        <div class="modal " id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Tambah Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            @foreach ($barang as $b)
                                <div class="col-md-3 mb-3">
                                    <div class="card shadow-sm border-light">
                                        <img src="{{ $b->image_url }}" class="card-img-top"
                                            alt="{{ $b->nama_barang }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $b->nama_barang }}</h5>
                                            <p class="card-text">Rp. {{ number_format($b->harga_barang, 0, ',', '.') }}
                                            </p>
                                            <p class="card-text"><strong>Stok:</strong> {{ $b->stok_barang }}</p>
                                            <form action="{{ route('keranjang.store') }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="id_barang" value="{{ $b->id }}">
                                                <input type="hidden" name="harga" value="{{ $b->harga_barang }}">
                                                <div class="input-group">
                                                    <input type="number" name="jumlah_barang" class="form-control"
                                                        placeholder="Jumlah" min="1" max="{{ $b->stok_barang }}"
                                                        required>
                                                    <button class="btn btn-primary" type="submit"
                                                        data-bs-dismiss="modal">Tambah</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>


</body>

</html>
