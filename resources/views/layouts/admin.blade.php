<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('css')
  </head>
  <body>
    <div id="app">
      <admin-layout logout-link="{{ route('logout') }}" l-csrf-token="{{ csrf_token() }}" is-admin="{{Auth::user()->isAdmin() ? 'true' : 'false'}}">
        @yield('content')
      </admin-layout>
    </div>
    <script src="{{asset('js/app.js')}}" charset="utf-8"></script>
    @stack('js')
  </body>
</html>
