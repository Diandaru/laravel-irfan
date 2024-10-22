<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\keranjang;
use Illuminate\Http\Request;
use App\Models\penjualan;
use App\Models\Barang;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\DB;


class PenjualanController extends Controller
{
    public function index()
    {
        $penjualan = Penjualan::with(['pelanggan', 'detailPenjualan.barang'])->get(); // Memuat relasi barang juga
        $pelanggan = Pelanggan::all();
        $barang = Barang::all();
        $detail_penjualan = DetailPenjualan::all();

            // Pass the data to the view
            return view('penjualan', compact('penjualan', 'pelanggan', 'barang','detail_penjualan'));
        }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'pilihPelanggan' => 'required|exists:pelanggan,id',
            'tanggal' => 'required|date',
            'id_barang' => 'required|array', // Pastikan id_barang adalah array
            'id_barang.*' => 'exists:barang,id', // Validasi setiap id_barang
            'jumlah_barang' => 'required|array', // Pastikan jumlah_barang adalah array
            'jumlah_barang.*' => 'numeric|min:1', // Validasi setiap jumlah_barang
        ]);
        // // 
        
        // Create a new penjualan record
        $penjualan = Penjualan::create([
            'id_pelanggan' => $request->pilihPelanggan,
            'tanggal' => $request->tanggal
        ]);
        
        
        for ($i = 0; $i < count($request->id_barang); $i++) {
            // Debug each iteration
            // dd([
            //     'id_penjualan' => $penjualan->id,
            //     'id_barang' => $request->id_barang[$i],
            //     'jumlah_barang' => $request->jumlah_barang[$i],
            //     'subtotal' => $request->subtotal[$i]
            // ]);
            
            DetailPenjualan::create([
                'id_penjualan' => $penjualan->id,
                'id_barang' => $request->id_barang[$i],
                'jumlah_barang' => $request->jumlah_barang[$i],
                'subtotal' => $request->subtotal[$i]
            ]);
        }
            return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil ditambahkan');
        
    }


    public function create()
    {
        $pelanggan = Pelanggan::all();
        $barangs = Barang::all(); // Ensure you are retrieving the barang data
        return view('penjualan.create', compact('pelanggan', 'barang')); // Pass both variables to the view
    }


    public function destroy($id)
    {
        $penjualan = penjualan::findOrFail($id);
        $penjualan->delete();

        return redirect()->route('penjualan.index')->with('success', 'penjualan berhasil dihapus.');
    }
}
