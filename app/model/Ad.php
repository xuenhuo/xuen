<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    //
    protected $table = 'ads';
    protected $primaryKey = 'id';
    public $timestamp = true;
    protected $fillable = ['title', 'subtitle', 'photo'];
}
