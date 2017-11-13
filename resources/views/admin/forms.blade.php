@extends('layouts.admin')

@section('content')
  <vue-forms :data-courses="{{$courses}}" action-new-form="{{route('users.store')}}" csrf-token="{{ csrf_token() }}"></vue-forms>
@endsection
