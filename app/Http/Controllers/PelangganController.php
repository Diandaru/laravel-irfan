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
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'alamat_pelanggan' => 'required|string|max:255',
            'no_telp_pelanggan' => 'required|string|max:15',
        ]);
    
        // Check if the phone number already exists
        if (Pelanggan::where('no_telp_pelanggan', $request->no_telp_pelanggan)->exists()) {
            return redirect()->route('pelanggan.index')->with('duplicate_phone', true);
        }
    
        // Create a new customer
        Pelanggan::create($request->all());
    
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan.');
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'alamat_pelanggan' => 'required|string|max:255',
            'no_telp_pelanggan' => 'required|string|max:15',
        ]);
    
        $pelanggan = Pelanggan::findOrFail($id);
    
        // Check if the new phone number already exists for other customers
        if (Pelanggan::where('no_telp_pelanggan', $request->no_telp_pelanggan)
            ->where('id', '!=', $id)
            ->exists()) {
            return redirect()->route('pelanggan.index')->with('duplicate_phone', true);
        }
    
        // Update the customer
        $pelanggan->update($request->all());
    
        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil diperbarui');
    }
    


    public function destroy(string $id)
    {
        $pelanggan = pelanggan::find($id);
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'pelanggan berhasil dihapus.');
    }
}
