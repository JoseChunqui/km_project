@extends('layouts.guest')

@section('content')
  <vue-guest-message data-message="{{$message}}"></vue-guest-message>
@endsection
