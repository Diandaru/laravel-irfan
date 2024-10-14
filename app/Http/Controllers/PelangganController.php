<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::all();
        return view('pelanggan', compact('pelanggan'));
    }
    
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'alamat_pelanggan' => 'required|string|max:255',
            'no_telp_pelanggan' => 'required|string|max:15', // Adjust max length as needed
        ]);

        // Create a new customer
        Pelanggan::create($request->all());

        // Redirect back with a success message
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'nama_pelanggan' => 'required',
        'alamat_pelanggan' => 'required',
        'no_telp_pelanggan' => 'required',
    ]);

    $pelanggan = Pelanggan::findOrFail($id);
    $pelanggan->update([
        'nama_pelanggan' => $request->nama_pelanggan,
        'alamat_pelanggan' => $request->alamat_pelanggan,
        'no_telp_pelanggan' => $request->no_telp_pelanggan,
    ]);

    return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil diperbarui');
}


    public function destroy(string $id)
    {
        $pelanggan = pelanggan::find($id);
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'pelanggan berhasil dihapus.');
    }
}
