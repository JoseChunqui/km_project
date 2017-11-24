<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $casts = [
      'data' => 'array',
    ];

    public function questionnaires()
    {
      return $this->hasMany('App\Questionnaire');
    }
    public function course()
    {
      return $this->belongsto('App\Course');
    }
}
