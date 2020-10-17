<?php

namespace App\model\products;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'products';
    protected $primaryKey = 'id';
    public $timestamp = true;
    protected $fillable = ['title', 'price', 'sale', 'subtitle', 'description', 'additional_information', 'featured', 'position', 'photo'];
    public function reviews() {
        return $this->hasMany(Review::class);
    }
    public function attributes() {
        return $this->belongsToMany(Attribute::class, 'products_attributes', 'product_id', 'attribute_id');
    }
    public function categories() {
        return $this->belongsToMany(Category::class, 'products_categories', 'product_id', 'category_id');
    }
    public function orders() {
        return $this->belongsToMany(Order::class, 'products_orders', 'product_id', 'order_id');
    }
    public function delete(){
        $this->reviews()->delete();
        return parent::delete();
    }
}
