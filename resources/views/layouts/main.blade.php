<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title') | SmartRecruitment</title>
  @vite('resources/css/app.css')
  @vite('resources/css/style.css')
</head>
<body class="bg-gray-50">
  <div class="flex h-screen">
    {{-- Sidebar --}}
    @include('partials.sidebar')

    {{-- Konten Utama --}}
    <div class="flex-1 flex flex-col overflow-hidden">
      {{-- Header --}}
      @include('partials.header')

      {{-- Konten halaman --}}
      <main class="flex-1 overflow-y-auto p-6">
        @yield('content')
      </main>
    </div>
  </div>

  @vite('resources/js/app.js')
</body>
</html>
