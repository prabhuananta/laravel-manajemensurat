<?php

use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\Suratcontroller;
use App\Http\Controllers\SuratKeluarcontroller;
use App\Http\Controllers\SuratMasukcontroller;
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
    Route::post('/logout', [Usercontroller::class, 'logout'])->name('logout');
    Route::get('/dashboard', [Suratcontroller::class, 'index']);

    Route::get('/suratkeluar/registrasi', [SuratKeluarcontroller::class, 'create']);
    Route::get('/suratkeluar/daftar', [SuratKeluarcontroller::class, 'index']);
    Route::get('/suratkeluar/tandatangan', [SuratKeluarcontroller::class, 'indextandatangan']);
    Route::post('/suratkeluar/tandatangan', [SuratKeluarcontroller::class, 'tandatangan']);
    Route::get('/suratkeluar/verifikasi', [SuratKeluarcontroller::class, 'indexverifikasi']);
    Route::post('/suratkeluar/verifikasi', [SuratKeluarcontroller::class, 'verifikasi']);
    Route::post('/suratkeluar/tolak', [SuratKeluarcontroller::class, 'verifikasi']);
    Route::post('/suratkeluar/suratbaru', [SuratKeluarcontroller::class, 'store']);

    Route::get('/suratmasuk/daftar', [SuratMasukcontroller::class, 'index']);
    Route::get('/suratmasuk/disposisi', [SuratMasukcontroller::class, 'indexdisposisi']);
    Route::get('/suratmasuk/{id}', [SuratMasukcontroller::class, 'show']);
    Route::get('/suratmasuk/proses/{id}', [SuratMasukcontroller::class, 'proses']);
    Route::get('/suratmasuk/selesai/{id}', [SuratMasukcontroller::class, 'selesai']);

    Route::get('/user', [Usercontroller::class, 'index']);
    Route::get('/user/edit/{id}', [Usercontroller::class, 'create']);

    Route::delete('/user/delete/{id}', [Usercontroller::class, 'destroy']);
    Route::post('/user/update/{id}', [Usercontroller::class, 'edit']);
    Route::post('/penggunabaru', [Usercontroller::class, 'store']);
    Route::post('/updateprofil', [Usercontroller::class, 'update']);

    Route::get('/profil', function () {
        return view('profilpengguna');
    });
});
