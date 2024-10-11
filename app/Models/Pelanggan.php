<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    // Specify the table if it's not the plural of the model name
    protected $table = 'pelanggan';

    // Fillable fields
    protected $fillable = [
        'nama_pelanggan',
        'alamat_pelanggan',
        'no_telp_pelanggan',
    ];
}
