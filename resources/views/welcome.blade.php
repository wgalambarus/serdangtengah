<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NamaWeb - Landing Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-green-700">

  {{-- Navbar --}}
  <nav class="bg-gray-200 px-8 py-4 flex justify-between items-center shadow-sm">
    <div class="flex items-center gap-3">
      <div class="bg-green-600 w-10 h-10 rounded-full flex items-center justify-center text-white font-bold">L</div>
      <span class="text-2xl font-bold text-green-700">NamaWeb</span>
    </div>

    <ul class="flex gap-6 text-green-700 font-medium">
      <li><a href="#" class="hover:text-green-800 border-b-2 border-transparent hover:border-green-700">Dashboard</a></li>
      <li><a href="#" class="hover:text-green-800 border-b-2 border-transparent hover:border-green-700">Tentang</a></li>
      <li><a href="#" class="hover:text-green-800 border-b-2 border-transparent hover:border-green-700">Layanan</a></li>
      <li><a href="#" class="hover:text-green-800 border-b-2 border-transparent hover:border-green-700">Kontak</a></li>
    </ul>

    <div class="flex gap-4">
      <a href="/login" class="text-green-700 hover:underline">Login</a>
      <a href="/register" class="bg-green-600 text-white px-4 py-2 rounded-full hover:bg-green-700 transition">Register</a>
    </div>
  </nav>

  {{-- Hero Section --}}
  <section class="flex flex-col md:flex-row items-center justify-between px-12 md:px-24 py-20">
    <div class="max-w-lg space-y-4">
      <h1 class="text-5xl font-extrabold text-green-700">NamaWeb</h1>
      <h2 class="text-2xl font-semibold">Nama Perusahaan</h2>
      <p class="text-green-600">Motto / Deskripsi singkat perusahaan yang menjelaskan visi dan layanan utama.</p>

      <div class="flex gap-4 pt-4">
        <a href="/login" class="bg-green-600 text-white px-6 py-2 rounded-full font-semibold hover:bg-green-700 transition">
          Mulai Sekarang
        </a>
        <a href="#about" class="border-2 border-green-600 px-6 py-2 rounded-full font-semibold hover:bg-green-50 transition">
          Pelajari Lebih Lanjut
        </a>
      </div>
    </div>

    {{-- Gambar Lingkaran --}}
    <div class="relative mt-10 md:mt-0">
      <div class="w-64 h-64 md:w-80 md:h-80 rounded-full bg-green-600 flex items-center justify-center opacity-80 overflow-hidden">
        {{-- Gambar bisa diganti di sini --}}
        <img src="{{ asset('images/hero.jpeg') }}" alt="Gambar Hero"
             class="object-cover w-full h-full opacity-60">
      </div>
    </div>
  </section>

</body>
</html>
