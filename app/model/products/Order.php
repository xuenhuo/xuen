<?php

namespace App\model\products;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = 'orders';
    protected $primaryKey = 'id';
    public $timestamp = true;
    protected $fillable = ['num', 'user_id', 'quantity', 'total'];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function products() {
        return $this->belongsToMany(Product::class, 'products_orders', 'order_id', 'product_id');
    }
}
