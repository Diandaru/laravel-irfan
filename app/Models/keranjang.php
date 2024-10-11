<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keranjang extends Model
{
    use HasFactory;

    protected $table = 'keranjang'; // If your table name doesn't follow Laravel's naming conventions
    protected $fillable = ['id_barang', 'jumlah_barang', 'harga', 'subtotal'];
}
