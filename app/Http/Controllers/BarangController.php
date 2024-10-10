<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;  

class BarangController extends Controller
{
    
    public function index()
    {
        $barang = Barang::all();
        return view('barang', compact('barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga_barang' => 'required|numeric',
            'stok_barang' => 'required|numeric',
        ]);
        barang::create($request->all());

        return redirect()->route('barang.index')->with('succes', 'barang berhasil di tambahkan');

    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga_barang' => 'required|numeric',
            'stok_barang' => 'required|numeric',
        ]);

        $barang = barang::find($id);
        $barang->update($request->all());

        return redirect()->route('barang.index')->with('success', 'barang berhasil diperbarui.');

    }

     
    public function destroy(string $id)
    {
        $barang = barang::find($id);
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'barang berhasil dihapus.');
    }
}
