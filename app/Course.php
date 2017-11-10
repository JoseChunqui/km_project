<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function user(){
      return $this->belongsto('App\User');
    }

    public function forms(){
      return $this->hasMany('App\Form');
    }
}
