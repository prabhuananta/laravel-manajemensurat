@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('route')
<span class="font-semibold">/</span>
<a class="font-semibold" href="#">
    Master
</a>
<span class="font-semibold">/</span>
<a class="font-semibold" href="#">
    Surat Keluar
</a>
@endsection

@section('content')

<div
    class="absolute border border-gray-200 bg-white z-50 w-lg top-1/2 left-1/2 -translate-1/2 p-5 shadow-md rounded-lg px-5">
    <span class="flex gap-5 justify-between">
        <span class="text-2xl mb-4">Pilih Jenis Surat</span>
        <a href="/dashboard" class="bg-gray-50 rounded-sm size-8 hover:bg-gray-100 hover:cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                <!-- Icon from CodeX Icons by CodeX - https://github.com/codex-team/icons/blob/master/LICENSE -->
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="2"
                    d="m8 8l4 4m0 0l4 4m-4-4l4-4m-4 4l-4 4" />
            </svg>
        </a>
    </span>
    <div class="flex flex-col gap-4">
        <p class="text-gray-600">Pilih jenis surat keluar:</p>
        <div class="flex gap-4">
            <a href="/suratkeluar/notadinas"
                class="flex-1 bg-blue-500 hover:bg-blue-600 text-white py-3 px-4 rounded-md text-center transition duration-200">
                <div class="text-lg font-medium">Nota Dinas</div>
                <div class="text-sm mt-1">Surat internal antar unit</div>
            </a>
            <a href="/suratkeluar/suratperintah"
                class="flex-1 bg-green-500 hover:bg-green-600 text-white py-3 px-4 rounded-md text-center transition duration-200">
                <div class="text-lg font-medium">Surat Perintah</div>
                <div class="text-sm mt-1">Surat penugasan resmi</div>
            </a>
        </div>
        <div class="mt-2 text-sm text-gray-500">
            Pilih jenis surat untuk melanjutkan proses pembuatan surat keluar.
        </div>
    </div>
</div>


@endsection