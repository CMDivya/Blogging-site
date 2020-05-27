<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends App
{
   public function Blogs()
   {
       return $this->belongsToMany('App\Blog');
   }
}
