<?php

namespace App\model\articles;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $table = 'articles';
    protected $primaryKey = 'id';
    public $timestamp = true;
    protected $fillable = ['title', 'author', 'photo', 'content'];
    public function comments() {
        return $this->hasMany(Comment::class);
    }
    public function tags() {
        return $this->belongsToMany(Tag::class, 'articlestags', 'article_id', 'tag_id');
    }
    public function delete(){
        $this->comments()->delete();
        return parent::delete();
    }
}
