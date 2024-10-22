<?php

namespace App\Http\Controllers;
use App\Models\Penjualan;

use Illuminate\Http\Request;

class DetailPenjualanController extends Controller
{
    public function index($id)
    {
        // Fetch the penjualan details along with related items and pelanggan
        $penjualan = Penjualan::with('pelanggan', 'items.barang')->find($id);

        if (!$penjualan) {
            return redirect()->back()->with('error', 'Penjualan tidak ditemukan');
        }

        return view('penjualan', compact('penjualan'));
    }
}
