<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends App
{
    protected $fillable=['user_id','title','description'];
    public function Category()
    {
        return $this->belongsTo('App\Category')->inRandomOrder();
    }
    public function Tags()
    {
        return $this->belongsToMany('App\Tag');
    }
    public function Comments()
    {
        return $this->hasMany('App\Comment');
    }
}

