<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['menu_makanan', 'jumlah', 'total_harga_dalam_lumen', 'id_pelanggan'];
}
