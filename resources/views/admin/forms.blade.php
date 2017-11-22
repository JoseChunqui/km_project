@extends('layouts.admin')

@section('content')
  <vue-forms :data-courses="{{$courses}}" answers-index-url="{{route('answers.index')}}" action-new-form="{{route('forms.store')}}" csrf-token="{{ csrf_token() }}" action-manage-form="{{route('forms.manage')}}"></vue-forms>
@endsection
