@extends('layouts.admin')

@section('content')
  <vue-users :data-users="{{$users}}" :data-institutions="{{$institutions}}" action-new-user="{{route('users.store')}}" csrf-token="{{ csrf_token() }}"></vue-users>
@endsection
