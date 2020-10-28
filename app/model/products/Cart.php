<?php

namespace App\model\products;

use App\model\User;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    protected $table = 'carts';
    protected $primaryKey = 'id';
    public $timestamp = true;
    protected $fillable = ['user_id', 'product_id', 'title', 'price', 'quantity', 'photo'];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function product() {
        return $this->belongsTo(Product::class);
    }
    public function cart_details() {
        return $this->hasMany(Cart_detail::class);
    }
}
