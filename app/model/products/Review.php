<?php

namespace App\model\products;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    protected $table = 'reviews';
    protected $primaryKey = 'id';
    public $timestamp = true;
    protected $fillable = ['content', 'user_id', 'product_id'];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function product() {
        return $this->belongsTo(Product::class);
    }
}
