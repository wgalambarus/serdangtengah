<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SmartRecruiter</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-gray-200 shadow-lg rounded-2xl p-8 w-full max-w-sm">
        <h1 class="text-center text-2xl font-bold mb-6">
            <span class="text-black">Smart</span><span class="text-green-600">Recruiter</span>
        </h1>

        <form>
             {{-- method="POST" action="{{ route('register.post') }}" --}}
            @csrf

            <div class="mb-4">
                <input type="text" name="name" placeholder="Masukkan Nama Anda"
                    value="{{ old('name') }}"
                    class="w-full p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                    required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <input type="email" name="email" placeholder="Masukkan Email Anda"
                    value="{{ old('email') }}"
                    class="w-full p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                    required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <input type="password" name="password" placeholder="Masukkan Password Anda"
                    class="w-full p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                    required>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <input type="password" name="password_confirmation" placeholder="Ulangi Password Anda"
                    class="w-full p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                    required>
            </div>

            <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-full font-semibold transition">
                Register
            </button>

            <p class="text-center text-sm mt-4">
                Already have an account?
                <a href="/login" class="text-green-600 hover:underline">Log In</a>
            </p>
        </form>
    </div>

</body>
</html>
