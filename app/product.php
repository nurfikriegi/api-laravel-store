<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class product extends Model
{
    protected $connection = "mongodb";
    protected $collection = "product";
    protected $fillable = ["nama_product", "warna", "jumlah", "harga"];
}
