<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\penjualan;

class PenjualanController extends Controller
{
    public function index() {
        $penjualan = penjualan::all();
        return view('penjualan', compact('penjualan'));
    }

    public function destroy($id)
    {
        $penjualan = penjualan::find($id);
        $penjualan->delete();

        return redirect()->route('penjualan.index')->with('success', 'penjualan berhasil dihapus.');
    }

    
    
}
