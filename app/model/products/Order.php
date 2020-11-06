<?php

namespace App\model\products;

use App\model\Contact;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = 'orders';
    protected $primaryKey = 'id';
    public $timestamp = true;
    protected $fillable = ['num', 'status', 'total', 'user_id', 'remark',
                            'contact_id', 'name', 'phone', 'address'];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function contact() {
        return $this->belongsTo(Contact::class);
    }
    public function order_details() {
        return $this->hasMany(Order_detail::class);
    }
}
