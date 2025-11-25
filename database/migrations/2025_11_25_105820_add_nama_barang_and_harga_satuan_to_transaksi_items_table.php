<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('transaksi_items', function (Blueprint $table) {
        $table->string('nama_barang')->nullable()->after('bahanbaku_id');
        $table->decimal('harga_satuan', 12, 2)->nullable()->after('nama_barang');
    });
}

public function down()
{
    Schema::table('transaksi_items', function (Blueprint $table) {
        $table->dropColumn(['nama_barang', 'harga_satuan']);
    });
}

};
