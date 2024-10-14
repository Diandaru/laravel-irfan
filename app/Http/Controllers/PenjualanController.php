<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\penjualan;
use App\Models\Pelanggan; 


class PenjualanController extends Controller
{
    public function index() {
        $penjualan = penjualan::all();
        $pelanggan = Pelanggan::all(); 
        return view('penjualan', compact('penjualan', 'pelanggan'));    }

    public function destroy($id)
    {
        $penjualan = penjualan::find($id);
        $penjualan->delete();

        return redirect()->route('penjualan.index')->with('success', 'penjualan berhasil dihapus.');
    }

    
    
}
