@extends('layouts.admin')

@section('content')
  <vue-answers :data-questionnaires="{{$questionnaires}}"
                answers-show-url="{{route('answers.show')}}" 
                csrf-token="{{ csrf_token() }}"
                >
  </vue-answers>
@endsection
