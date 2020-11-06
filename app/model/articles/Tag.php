<?php

namespace App\model\articles;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $table = 'tags';
    protected $primaryKey = 'id';
    public $timestamp = true;
    protected $fillable = ['title'];
    public function articles() {
        return $this->belongsToMany(Article::class, 'articles_tags', 'tag_id', 'article_id');
    }
    public function parent(){
        return $this->hasOne(get_class($this), $this->getKeyName(), 'parent_id');
    }
    public function children(){
        return $this->hasMany(get_class($this), 'parent_id', $this->getKeyName());
    }
}
