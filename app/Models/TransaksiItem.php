<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiItem extends Model
{
    use HasFactory;

    protected $fillable = ['transaksis_id', 'bahanbaku_id', 'jumlah', 'subtotal'];

    public function transaksi()
{
    return $this->belongsTo(Transaksi::class, 'transaksi_id');
}

    public function bahanbaku()
    {
        return $this->belongsTo(Bahanbaku::class);
    }
}
