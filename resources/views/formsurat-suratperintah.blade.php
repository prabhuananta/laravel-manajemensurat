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
                    <option value="{{ $option->id }}" {{ old('tujuan_surat')==$option->id ? 'selected' : '' }} >{{
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
                <p>Dengan ini menyatakan sesungguhnya bahwa</p>
                <div>
                    <label class="block mb-2 text-sm font-medium" for="nama">
                        Nama
                        <span class="text-red-600">*</span>
                    </label>
                    <input type="text" name="nama" id="nama"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Nama" value="{{ old('nama') }}" required>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium" for="NIP">
                        NIP
                        <span class="text-red-600">*</span>
                    </label>
                    <input type="text" name="nip" id="NIP"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="NIP" value="{{ old('nip') }}" required>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium" for="pangkat">
                        Pangkat/Golongan
                        <span class="text-red-600">*</span>
                    </label>
                    <input type="text" name="pangkat" id="pangkat"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Pangkat/Golongan" value="{{ old('pangkat') }}" required>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium" for="jabatan">
                        Jabatan
                        <span class="text-red-600">*</span>
                    </label>
                    <input type="text" name="jabatan" id="jabatan"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Jabatan" value="{{ old('jabatan') }}" required>
                </div>
                <div>
                    <div class="space-y-2 mb-4">
                        <label class="block mb-2 text-sm font-medium">Peraturan</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            <input type="text" name="peraturan" id="peraturan"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Peraturan" value="{{ old('peraturan') }}" required>
                            <div class="flex gap-2">
                                <div class="flex-1">
                                    <input type="text" name="nomor" id="nomor"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Nomor" value="{{ old('nomor') }}" required>
                                </div>
                                <div class="flex-1">
                                    <input type="text" name="tahun" id="tahun"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Tahun" value="{{ old('tahun') }}" required>
                                </div>
                            </div>
                        </div>
                        <input type="text" name="tentang" id="tentang"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Tentang" value="{{ old('tentang') }}" required>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            <input type="date" name="terhitung_mulai" id="terhitung_mulai"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('terhitung_mulai') }}" required>
                            <input type="date" name="terhitung_selesai" id="terhitung_selesai"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('terhitung_selesai') }}" required>
                        </div>
                        <input type="text" name="sebagai" id="sebagai"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Sebagai" value="{{ old('sebagai') }}" required>
                        <input type="text" name="tempat" id="tempat"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Di tempat" value="{{ old('tempat') }}" required>
                    </div>
                    <p>
                        Yang diangkat berdasarkan Peraturan <span class="font-medium" id="preview-peraturan">___</span>
                        Nomor <span class="font-medium" id="preview-nomor">___</span> Tahun <span class="font-medium"
                            id="preview-tahun">___</span> tentang
                        <span class="font-medium" id="preview-tentang">___</span>, terhitung <span class="font-medium"
                            id="preview-terhitung_mulai">___</span> sampai <span class="font-medium"
                            id="preview-terhitung_sampai">___</span> telah nyata menjalankan tugas sebagai <span
                            class="font-medium" id="preview-sebagai">___</span> di
                        <span class="font-medium" id="preview-di_tempat">___</span>
                    </p>
                    <br>
                    <p>
                        Demikian surat pernyataan melaksanakan tugas ini saya buat dengan sesungguhnya dengan mengingat
                        sumpah jabatan/pegawai negeri sipil dan apabila dikemudian hari isi surat pernyataan ini
                        ternyata tidak benar yang berakibat kerugian bagi negara, maka saya bersedia menanggung kerugian
                        tersebut.
                    </p>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium" for="tembusan">
                        Tembusan
                        <span class="text-red-600">*</span>
                    </label>
                    <input type="text" name="tembusan[]" id="tembusan"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="tembusan" value="{{ old('tembusan.0') }}" required>
                    @if (old('tembusan'))
                    @foreach (old('tembusan') as $key => $value)
                    @if ($key > 0)
                    <input type="text" name="tembusan[]" id="tembusan"
                        class="block p-2.5 mt-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="tembusan" value="{{ $value }}" required>
                    @endif
                    @endforeach
                    @endif
                </div>
                <button type="button"
                    class="bg-gray-200 text-xs px-4 py-2 cursor-pointer hover:bg-gray-300 rounded-full"
                    onclick="addTembusan()">Tambah Tembusan</button>
                <br>
                <button type="submit"
                    class="text-white block bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 cursor-pointer">
                    Buat Surat
                </button>
            </div>

        </div>
    </form>

</main>

<script>
    function addTembusan() {
        const tembusanDiv = document.getElementById("tembusan");
        
            // Clone the existing select element
            const clone = tembusanDiv.cloneNode(true);
            // Reset the selected value in the clone
            clone.value = "";
            // Create a container div for the new select
            const container = document.createElement('div');
            container.className = 'mt-1 flex items-center gap-2';
            container.appendChild(clone);

            // Add remove button
            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'bg-red-200 text-xs px-2 py-1 cursor-pointer hover:bg-red-300 rounded-full';
            removeBtn.textContent = 'Hapus';
            removeBtn.onclick = function() { container.remove(); };
            container.appendChild(removeBtn);

            // Insert the new select after the original one
            tembusanDiv.parentNode.appendChild(container);
    }
    // Live preview for peraturan fields
    document.addEventListener('DOMContentLoaded', function() {
        const fields = ['peraturan', 'nomor', 'tahun', 'tentang', 'terhitung_mulai', 'terhitung_selesai', 'sebagai', 'tempat'];
        
        fields.forEach(field => {
            const input = document.getElementById(field);
            const preview = document.getElementById('preview-' + field);
            
            input.addEventListener('input', function() {
                preview.textContent = this.value || '___';
            });
            
            // Initialize with any existing values
            if (input.value) {
                preview.textContent = input.value;
            }
        });
    });
</script>

@endsection