<?php

namespace App\model\products;

use Illuminate\Database\Eloquent\Model;

class Attribute_details extends Model
{
    //
    protected $table = 'attribute_details';
    protected $primaryKey = 'id';
    public $timestamp = true;
    protected $fillable = ['title', 'price', 'position', 'attribute_id'];
    public function attributes() {
        return $this->belongsTo(Attribute::class);
    }
    public function orders() {
        return $this->belongsToMany(Order::class, 'orders_attribute_details', 'attribute_detail_id', 'order_id');
    }
}
