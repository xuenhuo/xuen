<?php

namespace App\model\products;

use Illuminate\Database\Eloquent\Model;

class Cart_detail extends Model
{
    //
    protected $table = 'cart_details';
    protected $primaryKey = 'id';
    public $timestamp = true;
    protected $fillable = ['cart_id', 'attribute_id', 'attribute_detail_id',
                            'title', 'subtitle', 'price'];
    public function cart() {
        return $this->belongsTo(Cart::class);
    }
    public function attribute() {
        return $this->belongsTo(Attribute::class);
    }
    public function attribute_detail() {
        return $this->belongsTo(Attribute_detail::class);
    }
}
