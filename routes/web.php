<?php

use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\Suratcontroller;
use App\Http\Controllers\SuratKeluarcontroller;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect('login');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', function () {
        return view('login');
    });

    Route::post('/login', [Usercontroller::class, 'login'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [Usercontroller::class, 'logout'])->name('logout');
    Route::get('/dashboard', [Suratcontroller::class, 'index']);
    Route::get('/suratkeluar/registrasi', [SuratKeluarcontroller::class, 'index']);
    Route::post('/suratkeluar/suratbaru', [SuratKeluarcontroller::class, 'create']);
});
