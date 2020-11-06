<?php

namespace App\model\products;

use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    //
    protected $table = 'order_details';
    protected $primaryKey = 'id';
    public $timestamp = true;
    protected $fillable = ['order_id', 'product_id', 'title', 'price', 'quantity'];
    public function order() {
        return $this->belongsTo(Order::class);
    }
    public function product() {
        return $this->belongsTo(Product::class);
    }
    public function order_attribute_details() {
        return $this->hasMany(Order_attribute_detail::class);
    }
}
