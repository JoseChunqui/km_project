<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
  protected $fillable = ['form_id', 'data', 'token'];

  protected $casts = [
    'data' => 'array',
  ];
  public function form(){
    return $this->belongsto('App\Form');
  }

}
