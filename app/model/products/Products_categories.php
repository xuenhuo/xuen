<?php

namespace App\model\products;

use Illuminate\Database\Eloquent\Model;

class Products_categories extends Model
{
    //
    protected $table = 'products_categories';
    protected $primaryKey = 'id';
    public $timestamp = true;
}
