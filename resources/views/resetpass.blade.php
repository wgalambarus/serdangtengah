<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Reset Password - SmartRecruiter</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen font-sans">

  <div class="bg-white rounded-2xl shadow-lg w-full max-w-sm p-8 text-center">
    <h2 class="text-2xl font-bold mb-2 text-gray-800">
      Reset Password
    </h2>
    <p class="text-gray-600 text-sm mb-6">
      Masukkan email Anda untuk menerima tautan reset password.
    </p>

    {{-- Form --}}
    {{-- <form action="{{ route('password.email') }}" method="POST" class="space-y-4"> --}}
      @csrf
      <div class="text-left">
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input 
          type="email" 
          id="email" 
          name="email" 
          placeholder="example@email.com"
          required
          class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600"
        >
      </div>

      <button 
        type="submit" 
        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded-lg transition">
        Kirim Link Reset
      </button>
    </form>

    <a href="/login" class="block mt-5 text-green-700 hover:underline text-sm font-medium">
      ← Kembali ke Login
    </a>
  </div>

</body>
</html>
