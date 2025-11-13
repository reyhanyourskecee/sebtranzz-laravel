<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = ['tanggal', 'total'];

    public function items()
{
    return $this->hasMany(TransaksiItem::class, 'transaksi_id');
}
        
}
