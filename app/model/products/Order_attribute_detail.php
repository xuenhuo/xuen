<?php

namespace App\model\products;

use Illuminate\Database\Eloquent\Model;

class Order_attribute_detail extends Model
{
    //
    protected $table = 'orders_attribute_details';
    protected $primaryKey = 'id';
    public $timestamp = true;
    protected $fillable = ['order_detail_id', 'attribute_id', 'attribute_detail_id',
                            'title', 'subtitle', 'price'];
    public function order_detail() {
        return $this->belongsTo(Order_detail::class);
    }
    public function attribute() {
        return $this->belongsTo(Attribute::class);
    }
    public function attribute_detail() {
        return $this->belongsTo(Attribute_detail::class);
    }
}
