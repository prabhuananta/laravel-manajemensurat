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
            <label class="block mb-2 text-sm font-medium" for="file_input">Isi Surat</label>
            <input type="file" name="isi" aria-describedby="file_input_help" id="file_input" value="{{ old('isi') }}"
                accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                class="block w-full border rounded-lg border-gray-300 bg-gray-50 text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-s-md file:text-sm file:font-semibold file:bg-gray-800 file:text-white hover:file:bg-gray-700" />
            <p class="mt-1 text-sm text-gray-500 " id="file_input_help">
                File Surat .DOCX .PDF (Max 10MB).
            </p>
        </div>

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