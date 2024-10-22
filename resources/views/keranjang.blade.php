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
                        <input type="date" class="form-control" id="tanggal" name="tanggal"
                            value="{{ old('tanggal', date('Y-m-d')) }}">
                    </div>
                </div>
            </div>

            <!-- Input for Barang and Jumlah Barang -->
            @foreach ($keranjang as $key => $item)
                <input type="hidden" name="id_barang[]" value="{{ $item->id_barang }}" />
                <input type="hidden" name="jumlah_barang[]" value="{{ $item->jumlah_barang }}" />
                <input type="hidden" name="subtotal[]" value="{{ $item->harga * $item->jumlah_barang }}">
            @endforeach

            <div class="d-flex justify-content-end mb-3">
                <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    Tambah Barang
                </button>
                <button class="btn btn-success" type="submit">Simpan Penjualan</button>
            </div>
        </form>


        <!-- Table for Keranjang -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Nama Barang</th>
                    <th class="text-center">Harga</th>
                    <th class="text-center">Jumlah Barang</th>
                    <th class="text-center">Subtotal</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($keranjang as $key => $item)
                    <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td class="text-center">{{ $item->nama_barang }}</td>
                        <td class="text-center">{{ $item->harga }}</td>
                        <td class="text-center">{{ $item->jumlah_barang }}</td>
                        <td class="text-center">Rp.
                            {{ number_format($item->harga * $item->jumlah_barang, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('keranjang.destroy', $item->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus pelanggan ini?')"><i
                                        class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                <tr class="table-light">
                    <td class="text-center fw-bold" colspan="4">Total</td>
                    <td class="text-center fw-bold" colspan="2">
                        <h5 class="text-success">Rp. {{ number_format($total, 0, ',', '.') }}</h5>
                    </td>
                </tr>
            </tbody>
        </table>


        <!-- Add Barang Modal -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body">
                            <div id="message" class="alert d-none" role="alert"></div> <!-- Tempat untuk pesan -->
                            <div class="row">
                                @foreach ($barang as $b)
                                    <div class="col-md-3 mb-3">
                                        <div class="card shadow-sm border-light">
                                            <img src="https://placehold.co/200x200?text={{ $b->nama_barang }}"
                                                class="card-img-top" alt="{{ $b->nama_barang }}">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $b->nama_barang }}</h5>
                                                <p class="card-text">Rp.
                                                    {{ number_format($b->harga_barang, 0, ',', '.') }}
                                                </p>
                                                <p class="card-text"><strong>Stok:</strong> {{ $b->stok_barang }}</p>
                                                <form action="{{ route('keranjang.store') }}" method="POST"
                                                    onsubmit="return handleFormSubmit(event, this);">
                                                    @csrf
                                                    <input type="hidden" name="id_barang" value="{{ $b->id }}">
                                                    <input type="hidden" name="harga"
                                                        value="{{ $b->harga_barang }}">
                                                    <div class="input-group">
                                                        <input type="number" name="jumlah_barang"
                                                            class="form-control" placeholder="Jumlah" min="1"
                                                            max="{{ $b->stok_barang }}" required>
                                                        <button class="btn btn-primary" type="submit">Tambah</button>
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>


</body>

</html>
