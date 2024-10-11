<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan'; // Specify the table name if not plural
    protected $fillable = [
        'nama_pelanggan',
        'alamat_pelanggan',
        'no_telp_pelanggan',
    ];
}
