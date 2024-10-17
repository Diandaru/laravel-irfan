<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_penjualan', function (Blueprint $table) {
            $table->id();  // Primary key
            $table->unsignedBigInteger('id_penjualan');  // Foreign key to penjualan
            $table->unsignedBigInteger('id_barang');     // Foreign key to barang
            $table->integer('jumlah_barang');            // Quantity of items sold
            $table->decimal('harga', 10, 2);             // Price per item
            $table->decimal('subtotal', 10, 2);          // Subtotal (harga * jumlah_barang)
            $table->timestamps();                        // Created at and updated at timestamps

            // Set foreign keys
            $table->foreign('id_penjualan')->references('id')->on('penjualan')->onDelete('cascade');
            $table->foreign('id_barang')->references('id')->on('barang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_penjualan');
    }
};