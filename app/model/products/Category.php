<?php

namespace App\model\products;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'categories';
    protected $primaryKey = 'id';
    public $timestamp = true;
    protected $fillable = ['title', 'photo', 'position', 'disabled'];
    public function products() {
        return $this->belongsToMany(Product::class, 'products_categories', 'category_id', 'product_id');
    }
    public function parent(){
        return $this->hasOne(get_class($this), $this->getKeyName(), 'parent_id');
    }
    public function children(){
        return $this->hasMany(get_class($this), 'parent_id', $this->getKeyName());
    }
}
