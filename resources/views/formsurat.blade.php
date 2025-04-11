@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('route')
<span class="font-semibold">/</span>
<a class="font-semibold" href="/suratkeluar">
    Surat Keluar
</a>
<span class="font-semibold">/</span>
<a class="font-semibold" href="#">
    Registrasi
</a>
@endsection

@section('content')
<main class="w-full bg-white rounded-md p-5">

    <h1 class="text-2xl mb-4">Registrasi Surat Baru</h1>
    @if (session('success'))
    <div class="p-4 mb-4 text-sm text-green-800 bg-green-100 rounded-lg" role="alert">
        {{ session('success') }}
    </div>
    @elseif (session('error'))
    <div class="p-4 mb-4 text-sm text-red-800 bg-red-100 rounded-lg" role="alert">
        {{ session('error') }}
    </div>
    @endif

    <form action="./suratbaru" method="POST" class="max-w-md space-y-4" enctype="multipart/form-data">
        @csrf
        <div class="">
            <label for="default-input" class="block mb-2 text-sm font-medium ">
                Judul Surat
            </label>
            <input type="text" id="default-input" placeholder="Judul Surat" name="judul_surat"
                value="{{ old('judul_surat') }}" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div>
            <label for="countries" class="block mb-2 text-sm font-medium">
                Tujuan Surat
            </label>
            <select id="countries" name="tujuan_surat" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                <option selected>Pilih</option>
                @foreach ($penerima as $option)
                <option value="{{ $option->id }}">{{ $option->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <span class="block mb-2 text-sm font-medium text-center">Isi Surat</span>
            <label class="block mb-2 text-sm font-medium" for="tanggal">Tanggal Surat</label>
            <input type="text" name="tanggal" id="tanggal"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                placeholder="Tanggal" value="{{ old('tanggal') }}" required>

            <label class="block mb-2 text-sm font-medium" for="nomor_surat">Nomor Surat</label>
            <input type="text" name="nomor_surat" id="nomor_surat"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                placeholder="Nomor Surat" value="{{ old('nomor_surat') }}" required>

            <label class="block mb-2 text-sm font-medium" for="lampiran_surat">Lampiran Surat</label>
            <input type="text" name="lampiran_surat" id="lampiran_surat"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                placeholder="(Halaman)" value="{{ old('lampiran_surat') }}" required>

            <label class="block mb-2 text-sm font-medium" for="perihal_surat">Perihal Surat</label>
            <input type="text" name="perihal_surat" id="perihal_surat"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                placeholder="Perihal Surat" value="{{ old('perihal_surat') }}" required>

            <label class="block mb-2 text-sm font-medium" for="isi">Isi Surat</label>
            <textarea type="text" name="isi" id="isi"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                placeholder="Isi Surat" required>{{ old('isi') }}</textarea>

            <label class="block mb-2 text-sm font-medium" for="hari">Hari/Tanggal</label>
            <input type="text" name="hari" id="hari"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                placeholder="Hari, Tanggal" value="{{ old('hari') }}" required>

            <label class="block mb-2 text-sm font-medium" for="waktu">Waktu</label>
            <input type="text" name="waktu" id="waktu"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                placeholder="XX:XX - XX:XX WITA" value="{{ old('waktu') }}" required>

            <label class="block mb-2 text-sm font-medium" for="tempat">Tempat</label>
            <input type="text" name="tempat" id="tempat"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                placeholder="Tempat" value="{{ old('tempat') }}" required>
        </div>
        <hr>
        <div>
            <label for="message" class="block mb-2 text-sm font-medium">Keterangan</label>
            <textarea id="message" rows="4" name="keterangan"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Tuliskan keterangan surat">{{ old('keterangan') }}</textarea>
        </div>

        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Buat Surat
        </button>
    </form>

</main>

@endsection