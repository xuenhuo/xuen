<?php

namespace App\model\products;

use Illuminate\Database\Eloquent\Model;

class Products_attributes extends Model
{
    //
    protected $table = 'products_attributes';
    protected $primaryKey = 'id';
    public $timestamp = true;
}
