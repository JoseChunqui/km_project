@extends('layouts.admin')

@section('content')
  <div class="">
    
  </div>

  <vue-questionnaire :data-range='{{$questionnaire->data}}' function-form="show">

  </vue-questionnaire>
@endsection
