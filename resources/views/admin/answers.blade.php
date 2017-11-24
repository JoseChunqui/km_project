@extends('layouts.admin')

@section('content')
  <vue-answers :data-questionnaires="{{$questionnaires}}"
               :data-form="{{$form}}"
                answers-show-url="{{route('answers.show')}}"
                answers-export-url="{{route('answers.export_to_excel')}}"
                csrf-token="{{ csrf_token() }}"
                >
  </vue-answers>
@endsection
