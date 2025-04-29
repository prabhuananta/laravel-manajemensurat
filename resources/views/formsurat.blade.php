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
        <div>
            <label for="tujuan" class="block mb-2 text-sm font-medium">
                Tujuan Surat
            </label>
            <select id="tujuan" name="tujuan_surat" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                <option value="">Pilih</option>
                @foreach ($penerima as $option)
                <option value="{{ $option->id }}" {{ old('tujuan_surat')==$option->id ? 'selected' : '' }} >{{
                    $option->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="space-y-3">
            <span class="block mb-2 text-sm font-medium text-center">Isi Surat</span>
            <div>
                <label class="block mb-2 text-sm font-medium" for="tanggalsurat">Tanggal Surat</label>
                <input type="text" name="tanggalsurat" id="tanggalsurat"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Tanggal Surat" value="{{ old('tanggalsurat') }}" required>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium" for="nomorsurat">Nomor Surat</label>
                <input type="text" name="nomorsurat" id="nomorsurat"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Nomor Surat" value="{{ old('nomorsurat') }}" required>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium" for="sifatsurat">Sifat Surat</label>
                <input type="text" name="sifatsurat" id="sifatsurat"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Sifat Surat" value="{{ old('sifatsurat') }}" required>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium" for="perihal">Perihal Surat</label>
                <input type="text" name="perihal" id="perihal"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Perihal Surat" value="{{ old('perihal') }}" required>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium" for="isisurat">Isi Surat</label>
                <textarea type="text" name="isisurat" id="isisurat"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Isi Surat" rows="10" required>{{ old('isisurat') }}</textarea>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium" for="haritanggal">Hari/Tanggal</label>
                <input type="text" name="haritanggal" id="haritanggal"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Hari, Tanggal Acara" value="{{ old('haritanggal') }}" required>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium" for="pukul">Pukul</label>
                <input type="text" name="pukul" id="pukul"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    placeholder="XX:XX s.d. XX:XX WITA" value="{{ old('pukul') }}" required>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium" for="tempat">Tempat</label>
                <input type="text" name="tempat" id="tempat"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Tempat" value="{{ old('tempat') }}" required>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium" for="acara">Acara</label>
                <input type="text" name="acara" id="acara"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Acara" value="{{ old('acara') }}" required>
            </div>
            <div id="undangan">
                <label class="block mb-2 text-sm font-medium" for="undangan">Undangan</label>
                <input type="text" name="undangan[]" id="undangan"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Undangan" value="{{ old('undangan.0') }}" required>
                @if (old('undangan'))
                @foreach (old('undangan') as $key => $value)
                @if ($key > 0)
                <input type="text" name="undangan[]" id="undangan"
                    class="block p-2.5 mt-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Undangan" value="{{ $value }}" required>
                @endif
                @endforeach
                @endif
            </div>
            <button type="button" onclick="addUndangan()">+</button>
            <hr>
            <div>
                <label for="message" class="block mb-2 text-sm font-medium" required>Keterangan</label>
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

<script>
    function addUndangan() {
        var undanganDiv = document.getElementById("undangan");
        var newUndanganInput = document.createElement("input");
        newUndanganInput.type = "text";
        newUndanganInput.name = "undangan[]";
        newUndanganInput.placeholder = "Undangan";
        newUndanganInput.className = "block p-2.5 mt-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500";
        undanganDiv.appendChild(newUndanganInput);
    }
</script>

@endsection