<!DOCTYPE html>
<html>
   <head>
      <title>Laravel 10 task List App</title>
      <script src="https://cdn.tailwindcss.com"></script>
      <style type="text/tailwindcss">
         .btn {
            @apply rounded-md px-2 py-1 text-center font-medium shadow-sm ring-1 ring-slate-700/10 hover:bg-slate-50 text-slate-700;
         }

         .link {
            @apply font-medium text-gray-700 underline decoration-pink-500;
         }
      </style>

      @yield('styles')
   </head>

   <body class="container mx-auto mt-10 mb-10 max-w-lg">
      <h1 class="mb-4 text-2xl">@yield('title')</h1>
      <div>
         {{-- This is for dicplay session --}}
         @if(session()->has('success'))
            <div>{{ session('success') }}</div>
         @endif
         @yield('content')
      </div>
   </body>
</html>
