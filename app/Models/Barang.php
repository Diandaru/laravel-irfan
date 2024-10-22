<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang'; // Ensure the correct table name is specified    
    
    protected $fillable = [
        'nama_barang',
        'harga_barang',
        'stok_barang',
        'image_url',
    ];

    public function keranjang()
    {
        return $this->hasMany(keranjang::class, 'id_barang');
    }

    // Di model Barang
public function penjualan()
{
    return $this->belongsTo(Penjualan::class); // Pastikan mengganti dengan nama model yang benar
}

}
