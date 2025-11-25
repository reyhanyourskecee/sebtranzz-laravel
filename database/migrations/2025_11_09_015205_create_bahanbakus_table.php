<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('bahanbakus', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('stok')->default(0);
            $table->integer('harga')->default(0);
            $table->string('status')->nullable();
            $table->string('satuan_harga')->nullable();
            $table->timestamps();
            
        });
    }

    /**
     * Balikkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahanbakus');
    }
};
