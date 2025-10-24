<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/pelamar', function () {
    return view('pelamar');
});

Route::get('/karyawan', function () {
    return view('karyawan');
});

Route::get('/main', function () {
    return view('main');
});

Route::get('/resetpass', function () {
    return view('resetpass');
});