<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SmartRecruitment AI</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-b from-white via-gray-50 to-gray-100 text-gray-800 font-sans antialiased">

  <!-- Header -->
  <header class="fixed top-0 left-0 w-full z-50 bg-white/80 backdrop-blur-lg border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-6 lg:px-8 py-4">
      <div class="flex items-center space-x-3">
        <img src="https://cdn-icons-png.flaticon.com/512/1048/1048943.png" class="w-10 h-10" alt="Logo">
        <h1 class="text-xl lg:text-2xl font-bold tracking-tight">
          Smart<span class="text-blue-600">Recruitment</span> <span class="text-gray-800">AI</span>
        </h1>
      </div>
      <nav class="flex items-center space-x-3 lg:space-x-4">
        <a href="/login" class="text-gray-700 font-medium hover:text-blue-600 transition text-sm lg:text-base">
          Masuk
        </a>
        <a href="/register"
           class="px-4 lg:px-5 py-2 lg:py-2.5 bg-blue-600 text-white font-semibold rounded-full shadow-md hover:bg-blue-700 transition text-sm lg:text-base">
           Daftar
        </a>
      </nav>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="relative flex items-center justify-center min-h-screen text-center px-6 pt-20">
    <!-- Background gradient -->
    <div class="absolute inset-0 bg-gradient-to-b from-blue-50/40 via-white to-gray-50 -z-10"></div>

    <div class="relative z-10 max-w-4xl mx-auto">
      <h2 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight mb-6">
        Rekrut <span class="text-blue-600">Kandidat Terbaik</span> <br>
        dengan <span class="text-gray-700">Kecerdasan Buatan</span>
      </h2>

      <p class="text-base md:text-lg lg:text-xl text-gray-600 leading-relaxed mb-10 max-w-2xl mx-auto">
        SmartRecruitment AI membantu perusahaan menemukan talenta terbaik
        dengan analisis berbasis AI — cepat, akurat, dan efisien.
        Jadikan proses rekrutmen Anda lebih <span class="font-semibold text-blue-600">cerdas</span> hari ini.
      </p>

      <div class="flex flex-col sm:flex-row justify-center gap-4 items-center">
        <a href="/login"
           class="w-full sm:w-auto px-8 py-3.5 bg-blue-600 text-white rounded-full font-semibold text-base lg:text-lg shadow-lg hover:bg-blue-700 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
           Mulai Sekarang
        </a>
        <a href="/register"
           class="w-full sm:w-auto px-8 py-3.5 border-2 border-blue-600 text-blue-600 rounded-full font-semibold text-base lg:text-lg hover:bg-blue-50 transition-all duration-300 transform hover:scale-105">
           Sudah Punya Akun?
        </a>
      </div>
    </div>
  </section>
{{--
  <!-- Features Section -->
  <section class="py-16 lg:py-24 bg-white border-t border-gray-200">
    <div class="max-w-6xl mx-auto px-6 text-center">
      <h3 class="text-3xl md:text-4xl font-extrabold mb-12 lg:mb-16 text-gray-900">
        Mengapa <span class="text-blue-600">SmartRecruitment AI?</span>
      </h3>

      <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-8 lg:gap-10">
        <!-- Feature Card 1 -->
        <div class="p-8 lg:p-10 bg-gradient-to-br from-white to-gray-50 rounded-2xl lg:rounded-3xl border border-gray-200 shadow-md hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
          <div class="text-blue-600 mb-5">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 lg:w-14 lg:h-14 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
          <h4 class="text-lg lg:text-xl font-semibold mb-3 text-gray-900">Analisis Cerdas</h4>
          <p class="text-sm lg:text-base text-gray-600 leading-relaxed">
            AI kami menilai kompetensi kandidat berdasarkan data dan perilaku, bukan hanya CV.
          </p>
        </div>

        <!-- Feature Card 2 -->
        <div class="p-8 lg:p-10 bg-gradient-to-br from-white to-gray-50 rounded-2xl lg:rounded-3xl border border-gray-200 shadow-md hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
          <div class="text-blue-600 mb-5">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 lg:w-14 lg:h-14 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
          </div>
          <h4 class="text-lg lg:text-xl font-semibold mb-3 text-gray-900">Proses Lebih Cepat</h4>
          <p class="text-sm lg:text-base text-gray-600 leading-relaxed">
            Hemat waktu dengan penyaringan otomatis yang mempercepat proses rekrutmen hingga 70%.
          </p>
        </div>

        <!-- Feature Card 3 -->
        <div class="p-8 lg:p-10 bg-gradient-to-br from-white to-gray-50 rounded-2xl lg:rounded-3xl border border-gray-200 shadow-md hover:shadow-xl hover:-translate-y-2 transition-all duration-300 sm:col-span-2 md:col-span-1">
          <div class="text-blue-600 mb-5">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 lg:w-14 lg:h-14 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
          </div>
          <h4 class="text-lg lg:text-xl font-semibold mb-3 text-gray-900">Keputusan Akurat</h4>
          <p class="text-sm lg:text-base text-gray-600 leading-relaxed">
            Dukung keputusan HR dengan insight berbasis data untuk hasil rekrutmen yang lebih objektif dan akurat.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="py-16 lg:py-20 bg-gradient-to-br from-blue-600 to-blue-700 text-white text-center">
    <div class="max-w-4xl mx-auto px-6">
      <h3 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-6 leading-tight">
        Siap Mengubah Cara Anda Merekrut?
      </h3>
      <p class="text-blue-100 mb-8 lg:mb-10 text-base lg:text-lg max-w-2xl mx-auto">
        Bergabunglah bersama ratusan perusahaan yang telah menggunakan AI untuk menemukan talenta terbaik.
      </p>
      <a href="#"
         class="inline-block px-8 lg:px-10 py-3.5 lg:py-4 bg-white text-blue-700 font-semibold text-base lg:text-lg rounded-full shadow-lg hover:bg-gray-100 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
         Coba Gratis Sekarang
      </a>
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-8 lg:py-10 text-center text-gray-500 text-sm border-t border-gray-200 bg-gray-50">
    <p>© 2025 <span class="font-semibold text-gray-700">SmartRecruitment AI</span> — Semua hak dilindungi.</p>
  </footer> --}}

</body>
</html>
