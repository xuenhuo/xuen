<?php

namespace App\model\products;

use Illuminate\Database\Eloquent\Model;

class Products_orders extends Model
{
    //
    protected $table = 'products_orders';
    protected $primaryKey = 'id';
    public $timestamp = true;
}
