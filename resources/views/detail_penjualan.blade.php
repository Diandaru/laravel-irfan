@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Penjualan #{{ $penjualan->id }}</h1>
    
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Informasi Pelanggan</h5>
            <p><strong>Nama Pelanggan:</strong> {{ $penjualan->pelanggan->nama }}</p>
            <p><strong>Email Pelanggan:</strong> {{ $penjualan->pelanggan->email }}</p>
            <p><strong>Tanggal Penjualan:</strong> {{ $penjualan->created_at->format('d M Y H:i') }}</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Daftar Barang</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penjualan->items as $item)
                        <tr>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->pivot->jumlah }}</td>
                            <td>{{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td>{{ number_format($item->pivot->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Total Pembayaran</h5>
            <p><strong>Total:</strong> Rp {{ number_format($penjualan->total, 0, ',', '.') }}</p>
        </div>
    </div>
</div>
@endsection
