<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\keranjang;
use App\Models\barang;
use App\models\pelanggan;
use Illuminate\Support\Facades\DB;

class keranjangController extends Controller
{
    public function index()
    {
        // Modify the join to use the correct column from penjualan to pelanggan
        $keranjang = DB::table('keranjang')
            ->join('barang', 'keranjang.id_barang',  'barang.id')
            ->select('keranjang.*', 'barang.nama_barang')
            ->get();


        // Fetch total sum of subtotal
        $total = DB::table('keranjang')->sum('subtotal');

        $pelanggan = Pelanggan::all();
        $barang = Barang::all();

        // Pass the data to the view
        return view('keranjang', compact('keranjang', 'pelanggan', 'barang', 'total'));
    }




    public function destroy($id)
    {
        // Hapus item dari keranjang
        $keranjang = Keranjang::findOrFail($id);
        $keranjang->delete();

        // Redirect atau kembali dengan pesan sukses
        return redirect()->route('keranjang.index')->with('success', 'Item berhasil dihapus.');
    }


    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:barang,id', // Validasi ID barang
            'jumlah_barang' => 'required|integer|min:1', // Validasi jumlah barang
        ]);

        $barang = Barang::findOrFail($request->id_barang);

        // Check if the item already exists in the cart
        $itemKeranjang = keranjang::where('id_barang', $barang->id)->first();

        if ($itemKeranjang) {
            // Update existing item
            $itemKeranjang->jumlah_barang += $request->jumlah_barang;
            $itemKeranjang->subtotal = $itemKeranjang->harga * $itemKeranjang->jumlah_barang;
            $itemKeranjang->save();
        } else {
            // Create new cart item
            Keranjang::create([
                'id_barang' => $barang->id,
                'jumlah_barang' => $request->jumlah_barang,
                'harga' => $barang->harga_barang,
                'subtotal' => $barang->harga_barang * $request->jumlah_barang,
            ]);
        }

        // Return a JSON response
        return redirect()->route('keranjang.index')->with('success', ' ditambahkan ke keranjang.');
    }


    public function add(Request $request)
    {
        // Validasi input (pastikan id barang ada dan jumlah barang harus angka)
        $request->validate([
            'id' => 'required|exists:barang,id',
            'jumlah_barang' => 'required|integer|min:1',
        ]);

        // Cek apakah barang sudah ada di keranjang
        $itemKeranjang = keranjang::where('id_barang', $request->id)->first();

        if ($itemKeranjang) {
            // Jika barang sudah ada, tambahkan jumlah barang ke barang yang ada
            $itemKeranjang->jumlah_barang += $request->jumlah_barang;

            // Perbarui subtotal
            $itemKeranjang->subtotal = $request->harga * $itemKeranjang->jumlah_barang;

            // Simpan perubahan
            $itemKeranjang->save();
        } else {
            // Jika barang belum ada di keranjang, buat entri baru
            keranjang::create([
                'id_barang' => $request->id,
                'jumlah_barang' => $request->jumlah_barang,
                'subtotal' => $request->harga * $request->jumlah_barang,
            ]);
        }

        // Kembalikan respons sukses
        return redirect()->route('keranjang.index')->with('success', ' ditambahkan ke keranjang.');
        // return response()->json(['success' => true]);
    }
}
