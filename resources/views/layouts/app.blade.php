<!DOCTYPE html>
<html>
   <head>
      <title>Laravel 10 task List App</title>
      @yield('styles')
   </head>

   <body>
      <h1>@yield('title')</h1>
      <div>
         {{-- This is for dicplay session --}}
         @if(session()->has('success'))
            <div>{{ session('success') }}</div>
         @endif
         @yield('content')
      </div>
   </body>
</html>
