<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 'penjualan';
    protected $fillable = ['id_pelanggan', 'tanggal', 'id_barang', 'jumlah_barang'];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    // Di model Penjualan
public function barang()
{
    return $this->hasMany(Barang::class); // Pastikan mengganti dengan nama model yang benar
}


public function detailPenjualan()
{
    return $this->hasMany(DetailPenjualan::class, 'id_penjualan');
}
}
