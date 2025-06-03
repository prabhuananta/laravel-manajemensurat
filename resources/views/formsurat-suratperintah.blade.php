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

    <h1 class="text-2xl mb-4">Registrasi Surat Perintah</h1>
    @if (session('success'))
    <div class="p-4 mb-4 text-sm text-green-800 bg-green-100 rounded-lg" role="alert">
        {{ session('success') }}
    </div>
    @elseif (session('error'))
    <div class="p-4 mb-4 text-sm text-red-800 bg-red-100 rounded-lg" role="alert">
        {{ session('error') }}
    </div>
    @endif

    <form action="./suratbaru" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="jenis_surat" value="SURAT PERINTAH">
        <div class="grid lg:grid-cols-2 gap-4">
            <div>
                <label for="tujuan" class="block mb-2 text-sm font-medium">
                    Tujuan Utama
                    <span class="text-red-600">*</span>
                </label>
                <select id="tujuan" name="tujuan_id" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    <option value="">Pilih</option>
                    @foreach ($penerima as $option)
                    <option value="{{ $option->id }}" {{ old('tujuan_id')==$option->id ? 'selected' : '' }} >{{
                        $option->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="gruptujuan_id" class="block mb-2 text-sm font-medium">
                    Grup Tujuan
                </label>
                <select id="gruptujuan_id" name="gruptujuan_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    <option value="">Pilih</option>
                    @foreach ($grupTujuan as $option)
                    <option value="{{ $option->id }}" {{ old('grup')==$option->id ? 'selected' : '' }} >{{
                        $option->nama_grup }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="penandatangan" class="block mb-2 text-sm font-medium">
                    Penandatangan
                    <span class="text-red-600">*</span>
                </label>
                <select id="penandatangan" name="penandatangan_id" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    <option value="">Pilih</option>
                    @foreach ($penandatangan as $option)
                    <option value="{{ $option->id }}" {{ old('penandatangan_id')==$option->id ? 'selected' : '' }} >{{
                        $option->user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="verifikator_id" class="block mb-2 text-sm font-medium">
                    Verifikator
                    <span class="text-red-600">*</span>
                </label>
                <select id="verifikator_id" name="verifikator_id" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    <option value="">Pilih</option>
                    @foreach ($verifikator as $option)
                    <option value="{{ $option->id }}" {{ old('verifikator_id')==$option->id ? 'selected' : '' }} >{{
                        $option->user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <hr>
        <div class="grid lg:grid-cols-2 gap-4">
            <div class="space-y-3">
                <span class="block mb-2 text-sm font-medium text-center">Informasi Surat</span>
                <div>
                    <label class="block mb-2 text-sm font-medium" for="nomor_surat">
                        Nomor Surat
                        <span class="text-red-600">*</span>
                    </label>
                    <input type="text" name="nomor_surat" id="nomor_surat"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Nomor Surat" value="{{ old('nomor_surat') }}" required>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium" for="judul_surat">
                        Judul Surat
                        <span class="text-red-600">*</span>
                    </label>
                    <input type="text" name="judul_surat" id="judul_surat"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Judul Surat" value="{{ old('judul_surat') }}" required>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium" for="tanggalsurat">
                        Tanggal Surat
                        <span class="text-red-600">*</span>
                    </label>
                    <input type="date" name="tanggalsurat" id="tanggalsurat"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Tanggal Surat" value="{{ old('tanggalsurat') }}" required>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium" for="sifat_surat">
                        Sifat Surat
                        <span class="text-red-600">*</span>
                    </label>
                    <select name="sifat_surat" id="sifat_surat" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        <option value="" selected disabled>Pilih Sifat</option>
                        @foreach (['biasa', 'penting', 'rahasia', 'sangat rahasia'] as $sifat)
                        <option value="{{ $sifat }}" {{ old('sifat_surat')===$sifat ? 'selected' : '' }}>
                            {{ ucfirst($sifat) }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="message" class="block mb-2 text-sm font-medium" required>
                        Keterangan
                        <span class="text-red-600">*</span>
                    </label>
                    <textarea id="message" rows="4" name="keterangan" required
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Tuliskan keterangan surat">{{ old('keterangan') }}</textarea>
                </div>
            </div>
            <div class="space-y-3">
                <span class="block mb-2 text-sm font-medium text-center">Isi Surat</span>
                <div>
                    <label class="block mb-2 text-sm font-medium" for="dasar">
                        Dasar
                        <span class="text-red-600">*</span>
                    </label>
                    <input type="text" name="dasar" id="dasar"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="dasar" value="{{ old('dasar') }}" required>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium" for="hal">
                        Hal
                        <span class="text-red-600">*</span>
                    </label>
                    <input type="text" name="hal" id="hal"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Hal" value="{{ old('hal') }}" required>
                </div>
                <p class="text-center">Memerintahkan</p>
                <div>
                    <label class="block mb-2 text-sm font-medium" for="kepada">
                        Kepada
                        <span class="text-red-600">*</span>
                    </label>
                    <input type="text" name="kepada" id="kepada"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Kepada" value="{{ old('kepada') }}" required>
                </div>
                <div>
                    <label for="untuk" class="block mb-2 text-sm font-medium" required>
                        Untuk
                        <span class="text-red-600">*</span>
                    </label>
                    <textarea id="untuk" rows="4" name="untuk" required
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Untuk">{{ old('untuk') }}</textarea>
                </div>
                <button type="submit"
                    class="text-white block bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 cursor-pointer">
                    Buat Surat
                </button>
            </div>

        </div>
    </form>

</main>

@endsection