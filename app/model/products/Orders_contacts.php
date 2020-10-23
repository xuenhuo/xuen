<?php

namespace App\model\products;

use Illuminate\Database\Eloquent\Model;

class Orders_contacts extends Model
{
    //
    protected $table = 'orders_contacts';
    protected $primaryKey = 'id';
    public $timestamp = true;
}
