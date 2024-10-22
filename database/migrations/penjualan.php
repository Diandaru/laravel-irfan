<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
    Schema::create('penjualan', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('id_pelanggan');
    $table->unsignedBigInteger('id_barang'); // This should not be nullable
    $table->date('tanggal');
    $table->timestamps();

    $table->foreign('id_pelanggan')->references('id')->on('pelanggan');
    $table->foreign('id_barang')->references('id')->on('barang'); // Add foreign key for barang
}); 
 
    }

    public function down()
    {
        Schema::dropIfExists('penjualan');
    }
};