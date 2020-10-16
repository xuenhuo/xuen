<?php

namespace App\model\products;

use Illuminate\Database\Eloquent\Model;

class Attribute_detail extends Model
{
    //
    protected $table = 'attribute_detail';
    protected $primaryKey = 'id';
    public $timestamp = true;
    protected $fillable = ['title', 'price', 'position', 'attribute_id'];
    public function attributes() {
        return $this->belongsTo(Attribute::class);
    }
}
