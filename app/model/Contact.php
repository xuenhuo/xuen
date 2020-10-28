<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    protected $table = 'contacts';
    protected $primaryKey = 'id';
    public $timestamp = true;
    protected $fillable = ['name', 'phone', 'address', 'user_id'];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function orders() {
        return $this->hasMany(Order::class);
    }
}
