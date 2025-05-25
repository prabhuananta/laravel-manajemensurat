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
    Route::get('/login', [Usercontroller::class, 'indexlogin']);
    Route::post('/login', [Usercontroller::class, 'login'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [Usercontroller::class, 'logout'])->name('logout');
    Route::get('/dashboard', [Suratcontroller::class, 'index']);

    Route::get('/surat/download/{id}', [Suratcontroller::class, 'download']);

    Route::get('/suratkeluar', [Suratcontroller::class, 'pilihsuratkeluar']);
    Route::get('/suratkeluar/notadinas', [SuratKeluarcontroller::class, 'createnotadinas']);
    Route::get('/suratkeluar/suratperintah', [SuratKeluarcontroller::class, 'createsuratperintah']);
    Route::get('/suratkeluar/daftar', [SuratKeluarcontroller::class, 'index']);
    Route::get('/suratkeluar/tandatangan', [SuratKeluarcontroller::class, 'indextandatangan']);
    Route::get('/suratkeluar/verifikasi', [SuratKeluarcontroller::class, 'indexverifikasi']);
    Route::get('/suratkeluar/ditolak', [SuratKeluarcontroller::class, 'indexditolak']);
    Route::post('/suratkeluar/suratbaru', [SuratKeluarcontroller::class, 'store']);
    Route::post('/suratkeluar/tandatangan', [SuratKeluarcontroller::class, 'tandatangan']);
    Route::post('/suratkeluar/verifikasi', [SuratKeluarcontroller::class, 'verifikasi']);
    Route::post('/suratkeluar/tolak/{id}', [SuratKeluarcontroller::class, 'tolak']);

    Route::get('/suratmasuk/daftar', [SuratMasukcontroller::class, 'index']);
    Route::get('/suratmasuk/disposisi', [SuratMasukcontroller::class, 'indexdisposisi']);
    Route::get('/suratmasuk/{id}', [SuratMasukcontroller::class, 'show']);
    Route::get('/suratmasuk/proses/{id}', [SuratMasukcontroller::class, 'proses']);
    Route::get('/suratmasuk/selesai/{id}', [SuratMasukcontroller::class, 'selesai']);

    Route::get('/user', [Usercontroller::class, 'index']);
    Route::get('/user/edit/{id}', [Usercontroller::class, 'show']);
    Route::get('/profil',  [Usercontroller::class, 'indexprofil']);

    Route::delete('/user/delete/{id}', [Usercontroller::class, 'destroy']);
    Route::post('/user/update/{id}', [Usercontroller::class, 'update']);
    Route::post('/penggunabaru', [Usercontroller::class, 'create']);
    Route::post('/updateprofil', [Usercontroller::class, 'updateprofil']);


    Route::get('/gruptujuan',  [Usercontroller::class, 'indexgruptujuan']);
    Route::post('/gruptujuan',  [Usercontroller::class, 'creategruptujuan']);
    Route::get('/gruptujuan/edit/{id}',  [Usercontroller::class, 'showgruptujuan']);
    Route::post('/gruptujuan/update/{id}',  [Usercontroller::class, 'updategruptujuan']);
    route::delete('/gruptujuan/delete/{id}',  [Usercontroller::class, 'destroygruptujuan']);

    Route::get('/penandatangan',  [Usercontroller::class, 'indexpenandatangan']);
    Route::post('/penandatangan',  [Usercontroller::class, 'createpenandatangan']);
    Route::get('/penandatangan/edit/{id}',  [Usercontroller::class, 'showpenandatangan']);
    Route::post('/penandatangan/update/{id}',  [Usercontroller::class, 'updatepenandatangan']);
    Route::delete('/penandatangan/delete/{id}',  [Usercontroller::class, 'destroypenandatangan']);

    Route::get('/verifikator',  [Usercontroller::class, 'indexverifikator']);
    Route::post('/verifikator',  [Usercontroller::class, 'createverifikator']);
    Route::get('/verifikator/edit/{id}',  [Usercontroller::class, 'showverifikator']);
    Route::post('/verifikator/update/{id}',  [Usercontroller::class, 'updateverifikator']);
    Route::delete('/verifikator/delete/{id}',  [Usercontroller::class, 'destroyverifikator']);
});
