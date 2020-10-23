<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    protected $table = 'contacts';
    protected $primaryKey = 'id';
    public $timestamp = true;
    protected $fillable = ['name', 'phone_num', 'address', 'user_id'];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function orders() {
        return $this->belongsToMany(Order::class, 'orders_contacts', 'contact_id', 'order_id');
    }
}
