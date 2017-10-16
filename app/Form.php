<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    public function questionnaires()
    {
      return $this->hasMany('App\Questionnaire');
    }
}
