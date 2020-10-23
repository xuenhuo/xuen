<?php

namespace App\model\products;

use Illuminate\Database\Eloquent\Model;

class Orders_attribute_details extends Model
{
    //
    protected $table = 'orders_attribute_details';
    protected $primaryKey = 'id';
    public $timestamp = true;
}
