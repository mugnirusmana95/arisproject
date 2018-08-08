<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/print.css')}}">
  </head>
  <body onload="window.print()">
    @yield('main')
  </body>
</html>
