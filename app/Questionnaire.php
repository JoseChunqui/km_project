<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
  public function form(){
    return $this->belongsto('App\Form');
  }

}
