<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\keranjang;
use App\Models\barang;
use App\models\pelanggan;

class keranjangController extends Controller
{
    public function index() {
        $keranjang = keranjang::all();
        $pelanggan =  pelanggan::all();
        $barang = barang::all();
        return view('keranjang', compact('keranjang','pelanggan', 'barang'));
    }

    public function destroy($id)
    {
        $keranjang = keranjang::find($id);
        $keranjang->delete();

        return redirect()->route('keranjang.index')->with('success', 'keranjang berhasil dihapus.');
    }

    // Controller Method
public function showTransaksiPenjualan()
{
    // Retrieve all items from the barang table
    $barangs = Barang::all(); // Make sure to replace 'Barang' with your actual model name

    // Pass the barangs variable to the view
    return view('keranjang', compact( 'barang')); // Replace 'your_view_name' with the actual view name
}


public function tambahBarangKeKeranjang(Request $request)
{
    $request->validate([
        'barang_id' => 'required|exists:barang,id',
        'jumlah' => 'required|numeric|min:1',
    ]);

    // Ambil data barang yang dipilih
    $barang = Barang::find($request->barang_id);

    // Buat entry baru di keranjang
    Keranjang::create([
        'barang_id' => $barang->id,
        'jumlah_barang' => $request->jumlah,
        'harga' => $barang->harga,
        'subtotal' => $barang->harga * $request->jumlah,
    ]);

    // Redirect kembali ke halaman transaksi dengan pesan sukses
    return redirect()->route('keranjang.index')->with('success', 'Barang berhasil ditambahkan ke keranjang');
}

    public function add(Request $request)
    {
        // Validasi input
        $request->validate([
            'id' => 'required|exists:barang,id', // Ganti 'barang' dengan nama tabel yang sesuai
            'nama_barang' => 'required|string',
            'harga' => 'required|numeric',
            'jumlah_barang' => 'required|integer|min:1',
        ]);

        // Tambahkan barang ke keranjang
        Keranjang::create([
            'barang_id' => $request->id,
            'jumlah_barang' => $request->jumlah_barang,
            'subtotal' => $request->harga * $request->jumlah_barang,
            // Tambahkan atribut lain jika perlu
        ]);

        return response()->json(['success' => true]);
    }   
}



