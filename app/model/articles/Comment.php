<?php

namespace App\model\articles;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = 'comments';
    protected $primaryKey = 'id';
    public $timestamp = true;
    protected $fillable = ['content', 'article_id', 'user_id'];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function article() {
        return $this->belongsTo(Article::class);
    }
}
