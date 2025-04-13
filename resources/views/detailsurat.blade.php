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
<main class="w-full bg-white rounded-md p-5">

    <h1 class="text-2xl mb-4">Detail Surat</h1>
    @if (session('success'))
    <div class="p-4 mb-4 text-sm text-green-800 bg-green-100 rounded-lg" role="alert">
        {{ session('success') }}
    </div>
    @elseif (session('error'))
    <div class="p-4 mb-4 text-sm text-red-800 bg-red-100 rounded-lg" role="alert">
        {{ session('error') }}
    </div>
    @endif

    <div class="max-w-md space-y-4" enctype="multipart/form-data">
        <div>
            <label for="tujuan" class="block mb-2 text-sm font-medium">
                Tujuan Surat
            </label>
            <input type="text" id="tujuan" placeholder="Tujuan Surat" value="{{ $surat->tujuan->name }}" disabled
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div>
            <label for="default-input" class="block mb-2 text-sm font-medium ">
                Judul Surat
            </label>
            <input type="text" id="default-input" placeholder="Judul Surat" value="{{ $surat->judul_surat }}" disabled
                class="bg-gray-50 border font-semibold border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div>
            <label for="nomor" class="block mb-2 text-sm font-medium ">
                Nomor Surat
            </label>
            <input type="text" id="nomor" placeholder="Judul Surat" value="{{ $surat->nomor_surat }}" disabled
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>

        <div>
            <label for="message" class="block mb-2 text-sm font-medium">Keterangan</label>
            <textarea id="message" rows="4" name="keterangan" disabled
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Tuliskan keterangan surat">{{ $surat->keterangan }}</textarea>
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium" for="file_input">File Surat</label>
            <a href="/surat/download/{{ $surat->id }}" class="text-blue-600 hover:underline mb-2">
                {{ $surat->isi }}
            </a>
        </div>
        @if ($surat->status == 'baru')
        <a href="/suratmasuk/proses/{{ $surat->id }}"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Disposisi Surat
        </a>
        @else
        <a href="/suratmasuk/selesai/{{ $surat->id }}"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Selesai
        </a>
        @endif
    </div>

</main>

@endsection