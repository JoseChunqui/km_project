<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    @stack('css')
  </head>
  <body>
    <div id="app">
        @yield('content')
    </div>
    <script src="{{asset('js/app.js')}}" charset="utf-8"></script>
    @stack('js')
  </body>
</html>
