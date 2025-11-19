<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bahanbaku extends Model
{
    use HasFactory;

    protected $table = 'bahanbakus';
    protected $fillable = ['nama', 'stok', 'harga'];
}
