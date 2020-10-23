<?php

namespace App\model\products;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    //
    protected $table = 'attributes';
    protected $primaryKey = 'id';
    public $timestamp = true;
    protected $fillable = ['title', 'is_multi', 'position'];
    public function products() {
        return $this->belongsToMany(Product::class, 'products_attributes', 'attribute_id', 'product_id');
    }
    public function attribute_details() {
        return $this->hasMany(Attribute_details::class);
    }
    public function delete(){
        $this->attribute_details()->delete();
        return parent::delete();
    }
}
