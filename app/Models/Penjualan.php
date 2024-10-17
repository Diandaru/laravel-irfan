<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';

    protected $fillable = [
        'pelanggan_id',
        'tanggal',
        'total'
    ];

    public function detailPenjualan()
    {
        return $this->hasMany(detail_penjualan::class);
    }
}

