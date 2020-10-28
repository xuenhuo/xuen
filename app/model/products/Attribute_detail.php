<?php

namespace App\model\products;

use Illuminate\Database\Eloquent\Model;

class Attribute_detail extends Model
{
    //
    protected $table = 'attribute_details';
    protected $primaryKey = 'id';
    public $timestamp = true;
    protected $fillable = ['title', 'price', 'position', 'attribute_id'];
    public function attributes() {
        return $this->belongsTo(Attribute::class);
    }
    public function cart_details() {
        return $this->hasMany(Cart_detail::class);
    }
    public function order_attribute_details() {
        return $this->hasMany(Order_attribute_detail::class);
    }
}
