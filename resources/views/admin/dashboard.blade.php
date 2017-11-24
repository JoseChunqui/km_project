@extends('layouts.admin')

@section('content')
  <vue-home :data-user="{{$user}}" data-institution="{{isset($institution->name) ? $institution->name : "Administrador"}}" :data-courses="{{$courses}}"></vue-home>
@endsection
