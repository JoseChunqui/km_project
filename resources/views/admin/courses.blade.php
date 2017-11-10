@extends('layouts.admin')

@section('content')
  <vue-courses :data-courses="{{$courses}}" action-new-course="{{route('courses.store')}}" csrf-token="{{ csrf_token() }}"></vue-courses>
@endsection
