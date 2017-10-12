@extends('layouts.guest')

@section('content')
  <vue-questionnaire :data-range='{{$form->data}}' function-form="create">

  </vue-questionnaire>
@endsection
