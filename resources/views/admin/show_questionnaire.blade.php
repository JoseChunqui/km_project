@extends('layouts.admin')

@section('content')
  <vue-questionnaire :data-range='{{$questionnaire->data}}' function-form="show">
  </vue-questionnaire>
@endsection
