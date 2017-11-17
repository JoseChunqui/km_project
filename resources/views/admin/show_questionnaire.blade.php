@extends('layouts.admin')

@section('content')
  <vue-questionnaire :data-range='{{json_encode($questionnaire->data)}}' function-form="show">
  </vue-questionnaire>
@endsection
