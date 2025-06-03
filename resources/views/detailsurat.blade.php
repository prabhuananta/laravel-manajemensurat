@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('route')
<span class="font-semibold">/</span>
<a class="font-semibold" href="/suratmasuk/daftar">
    Surat Masuk
</a>
<span class="font-semibold">/</span>
<a class="font-semibold" href="#">
    {{ $surat->nomor_surat }}
</a>
@endsection

@section('content')
<main class="w-full bg-white rounded-xl shadow-md p-8">
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h1 class="font-semibold text-lg">Detail Surat</h1>
        <div class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
            {{ $surat->status }}
        </div>
    </div>

    @if (session('success'))
    <div class="p-4 mb-6 text-sm text-green-800 bg-green-100 rounded-lg border-l-4 border-green-500" role="alert">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zm-1 9a1 1 0 01-1-1v-4a1 1 0 112 0v4a1 1 0 01-1 1z"
                    clip-rule="evenodd"></path>
            </svg>
            {{ session('success') }}
        </div>
    </div>
    @elseif (session('error'))
    <div class="p-4 mb-6 text-sm text-red-800 bg-red-100 rounded-lg border-l-4 border-red-500" role="alert">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zm-1 9a1 1 0 01-1-1v-4a1 1 0 112 0v4a1 1 0 01-1 1z"
                    clip-rule="evenodd"></path>
            </svg>
            {{ session('error') }}
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
            <h2 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2">Informasi Surat</h2>
            <div class="space-y-4">
                <div>
                    <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Judul Surat
                    </label>
                    <p class="mt-1 text-gray-900 font-medium">{{ $surat->judul_surat }}</p>
                </div>

                <div>
                    <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nomor Surat
                    </label>
                    <p class="mt-1 text-gray-900 font-medium">{{ $surat->nomor_surat }}</p>
                </div>

                <div>
                    <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Dibuat Pada
                    </label>
                    <p class="mt-1 text-gray-900 font-medium">
                        {{ $surat->created_at->locale('id')->isoFormat('dddd, D MMMM Y')}}
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
            <h2 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2">Detail</h2>

            <div class="space-y-4">
                <div class="flex space-x-4">
                    <div>
                        <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Pengirim
                        </label>
                        <p class="mt-1 text-gray-900 font-medium">{{ $surat->pengirim->name }}</p>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-500 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </div>
                    <div>
                        <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tujuan Surat
                        </label>
                        <p class="mt-1 text-gray-900 font-medium">{{ $surat->tujuan->name }}</p>
                    </div>
                    @if ($surat->gruptujuan_id)
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-500 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Grup Tujuan
                            </label>
                            <p class="mt-1 text-gray-900 font-medium">
                                {{ $surat->gruptujuan->nama_grup }}</p>
                            </p>
                        </div>
                    </div>
                    @endif
                </div>
                <div>
                    <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Sifat Surat
                    </label>
                    <p class="mt-1 text-gray-900 font-medium">{{ $surat->sifat_surat }}</p>
                </div>

                <div>
                    <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Jenis Surat
                    </label>
                    <p class="mt-1 text-gray-900 font-medium">{{ $surat->jenis_surat }}</p>
                </div>

            </div>
        </div>
    </div>

    <div class="mt-6 bg-gray-50 p-6 rounded-lg shadow-sm">
        <h2 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2">Keterangan</h2>
        <p class="text-gray-700 whitespace-pre-line">{{ $surat->keterangan }}</p>
    </div>

    <a href="/surat/download/{{ $surat->id }}"
        class="block mt-6 bg-blue-50 p-6 rounded-lg shadow-sm hover:bg-blue-100  group">
        <div class="flex items-center">
            <div class="bg-blue-100 p-3 rounded-full mr-4 group-hover:bg-blue-200">
                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
            </div>
            <div>
                <h3 class="font-medium text-gray-700">File Lampiran</h3>
                <div class="text-blue-600 flex items-center mt-1">
                    <span class="group-hover:underline">{{ $surat->isi }}</span>
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                </div>
            </div>
        </div>
    </a>

    <div class="mt-8 flex justify-end">
        <a href="/suratmasuk/selesai/{{ $surat->id }}" @if ($surat->status === 'selesai') disabled @endif
            class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300
            font-medium rounded-lg px-6 py-3 text-center transition-all flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            Selesai
        </a>
    </div>
</main>

@endsection