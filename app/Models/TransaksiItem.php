<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_id',
        'bahanbaku_id',
        'nama_barang',
        'harga_satuan',
        'jumlah',
        'subtotal'
    ];


    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }

    public function bahanbaku()
    {
        return $this->belongsTo(Bahanbaku::class, 'bahanbaku_id');
    }
}
