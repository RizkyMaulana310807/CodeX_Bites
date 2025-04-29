<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    protected $fillable = ['user_id', 'menu_id', 'total_harga'];
}
