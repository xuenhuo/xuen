<?php

namespace App\model\articles;

use Illuminate\Database\Eloquent\Model;

class Articles_tags extends Model
{
    //
    protected $table = 'articles_tags';
    protected $primaryKey = 'id';
    public $timestamp = true;
}
