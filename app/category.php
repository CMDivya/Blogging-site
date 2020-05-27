<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends App
{
    protected $fillable = ['name', 'description','user_id','slug'];
    public function Blogs()
    {
        return $this->hasMany('App\Blog')->orderBy('created_at','desc');
    }
    
    public function user(){
        return $this->belongsTo('App\User');
    }

}
