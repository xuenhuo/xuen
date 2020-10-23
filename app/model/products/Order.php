<?php

namespace App\model\products;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = 'orders';
    protected $primaryKey = 'id';
    public $timestamp = true;
    protected $fillable = ['num', 'user_id', 'status', 'quantity', 'total'];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function products() {
        return $this->belongsToMany(Product::class, 'products_orders', 'order_id', 'product_id');
    }
    public function attribute_details() {
        return $this->belongsToMany(Attribute_details::class, 'orders_attribute_details', 'order_id', 'attribute_detail_id');
    }
    public function contacts() {
        return $this->belongsToMany(Contact::class, 'orders_contacts', 'order_id', 'contact_id');
    }
}
