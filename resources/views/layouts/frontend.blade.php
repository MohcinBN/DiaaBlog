<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ config('app.name') }} - @yield('title')</title>
  
  <!-- Frontend-specific assets -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  @stack('styles')
</head>
<body class="min-h-screen bg-white">
  @include('layouts.header')
  
  <main class="pt-20 pb-8 px-4">
    @yield('content')
  </main>
  
  @include('layouts.footer')
  
  @stack('scripts')
</body>
</html>
