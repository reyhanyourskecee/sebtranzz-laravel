<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
{
    Schema::create('transaksi_items', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('transaksi_id');
    $table->unsignedBigInteger('bahanbaku_id');
    $table->integer('jumlah');
    $table->decimal('subtotal', 12, 2);
    $table->timestamps();

    $table->foreign('transaksi_id')->references('id')->on('transaksis')->onDelete('cascade');
    $table->foreign('bahanbaku_id')->references('id')->on('bahanbakus')->onDelete('cascade');
});

}


    public function down(): void
    {
        Schema::dropIfExists('transaksi_items');
    }
};
