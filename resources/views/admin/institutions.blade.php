@extends('layouts.admin')

@section('content')
  <vue-institutions :data-institutions="{{$institutions}}" action-new-institution="{{route('institutions.store')}}" csrf-token="{{ csrf_token() }}"></vue-institutions>
@endsection
