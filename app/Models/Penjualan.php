<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan'; 
    protected $fillable = [
        'nama_pelanggan',
        'alamat_pelanggan',
        'no_telp_pelanggan',
    ];

    public function pelanggan(): BelongsTo
{
    return $this->belongsTo(Pelanggan::class, 'id_pelanggan'); 
}

}
