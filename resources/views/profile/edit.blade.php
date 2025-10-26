@extends('layouts.main')

@section('title', 'Profile')

@section('content')
<div class="mx-8 max-w-5xl space-y-10">

    <!-- Judul Halaman -->
    <div class="border-b pb-4">
        <h1 class="text-2xl font-semibold text-gray-800">Pengaturan Profil</h1>
        <p class="text-sm text-gray-500 mt-1">
            Kelola informasi akun, kata sandi, dan penghapusan akun Anda.
        </p>
    </div>

    <!-- Update Profile Information -->
    <section class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow duration-200">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi Akun</h2>
        <div class="max-w-2xl">
            @include('profile.partials.update-profile-information-form')
        </div>
    </section>

    <!-- Update Password -->
    <section class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow duration-200">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Ubah Kata Sandi</h2>
        <div class="max-w-2xl">
            @include('profile.partials.update-password-form')
        </div>
    </section>

    <!-- Delete User -->
    <section class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow duration-200">
        <h2 class="text-lg font-semibold text-red-600 mb-4">Hapus Akun</h2>
        <p class="text-sm text-gray-500 mb-4">
            Menghapus akun bersifat permanen dan tidak dapat dipulihkan.
        </p>
        <div class="max-w-2xl">
            @include('profile.partials.delete-user-form')
        </div>
    </section>

</div>
@endsection
