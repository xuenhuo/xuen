<?php

namespace App\model\articles;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = 'comments';
    protected $primaryKey = 'id';
    public $timestamp = true;
    protected $fillable = ['content', 'commentable_id', 'commentable_type', 'user_id'];
    public function commentable()
    {
        return $this->morphTo();
    }
}
