<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class order extends Model
{
    protected $connection = "mongodb";
    protected $collection = "order";
    protected $fillable = ["id_produk", "jumlah", "harga", "total"];
}
