<?php

namespace App\Http\Controllers;

use App\Models\keranjang;
use Illuminate\Http\Request;
use App\Models\penjualan;
use App\Models\Pelanggan;


class PenjualanController extends Controller
{
    public function index()
    {
        $penjualan = penjualan::all();
        $pelanggan = Pelanggan::all();
        return view('penjualan', compact('penjualan', 'pelanggan'));
    }

    public  function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'tanggal' => 'required|numeric',
        ]);
        penjualan::create($request->all());

        // var_dump(value: $request->post());

        return redirect()->route('penjualan.index')->with('succes', 'penjualan berhasil di tambahkan');
    }

    public function destroy($id)
    {
        $penjualan = penjualan::findOrFail($id);
        $penjualan->delete();

        return redirect()->route('penjualan.index')->with('success', 'penjualan berhasil dihapus.');
    }
}
