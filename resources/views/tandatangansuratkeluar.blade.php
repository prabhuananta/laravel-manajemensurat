@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('route')
<span class="font-semibold">/</span>
<a class="font-semibold" href="#">
    Surat Keluar
</a>
<span class="font-semibold">/</span>
<a class="font-semibold" href="#">
    Tanda Tangan
</a>
@endsection

@section('content')

<main class="w-full bg-white rounded-md p-5">
    <!-- Modal -->
    <div id="modal"
        class="fixed inset-0 z-50 hidden overflow-auto backdrop-blur-xs bg-opacity-50 items-center justify-center">
        <div class="relative bg-white border rounded-lg top-1/2 -translate-y-1/2 shadow-lg p-6 w-full max-w-md mx-auto">
            <!-- Close button -->
            <button type="button" onclick="closeModal()"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-900">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>

            <!-- Modal content -->
            <h3 class="text-lg font-medium text-gray-900 mb-4">Tolak Surat</h3>
            <form id="modal-form" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="alasan" class="block mb-2 text-sm font-medium text-gray-900">
                        Alasan Penolakan
                    </label>
                    <textarea rows="5" name="keterangan" id="alasan" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Masukkan alasan penolakan surat">{{ old('keterangan') }}</textarea>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal()"
                        class="mr-2 px-4 py-2 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-red-300">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-span-2 p-5 space-y-4 bg-white rounded">
        @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 bg-green-100 rounded-lg" role="alert">
            {{ session('success') }}
        </div>
        @elseif (session('error'))
        <div class="p-4 mb-4 text-sm text-red-800 bg-red-100 rounded-lg" role="alert">
            {{ session('error') }}
        </div>
        @endif
        <h1 class="font-semibold text-lg">Tanda Tangan Surat Keluar</h1>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 rtl:text-right">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Tanggal Dibuat
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nomor Surat
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama Surat
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Informasi
                        </th>
                        <th scope="col" class="px-6 py-3">
                            File Surat
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($surat) == 0)
                    <tr class="bg-white border-b border-gray-200">
                        <td colspan="6" class="px-6 py-4 text-center">
                            Tidak ada surat keluar yang belum ditandatangan.
                        </td>
                    </tr>
                    @else
                    @foreach($surat as $item)
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">
                            {{ $item->created_at->locale('id')->isoFormat('dddd, D MMMM Y')}}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->nomor_surat }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->judul_surat }}
                        </td>
                        <td class="px-6 py-4">
                            <table class="text-sm min-w-full">
                                <tbody>
                                    <tr>
                                        <td class="font-medium">Pengirim</td>
                                        <td class="text-gray-600 px-2">:</td>
                                        <td>{{ $item->pengirim->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-medium">Tujuan</td>
                                        <td class="text-gray-600 px-2">:</td>
                                        <td>{{ $item->tujuan->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-medium">Sifat</td>
                                        <td class="text-gray-600 px-2">:</td>
                                        <td>{{ $item->sifat_surat }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-medium">Jenis</td>
                                        <td class="text-gray-600 px-2">:</td>
                                        <td>{{ $item->jenis_surat }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-medium">Verif</td>
                                        <td class="text-gray-600 px-2">:</td>
                                        <td>{{ $item->verifikator->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-medium">TTD</td>
                                        <td class="text-gray-600 px-2">:</td>
                                        <td>{{ $item->penandatangan->user->name }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td class="px-6 py-4">
                            <a href="/surat/download/{{ $item->id }}" class="text-blue-500 hover:underline">
                                Lihat
                            </a>
                        </td>
                        <td class="flex px-6 py-4">
                            <form action="/suratkeluar/tandatangan" method="POST">
                                @csrf
                                <button type="submit" name="id" value="{{ $item->id }}"
                                    class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm hover:cursor-pointer hover:bg-blue-200">
                                    Tandatangani
                                </button>
                            </form>
                            <div>
                                <button onclick="openModal({{ $item->id }})" type="button"
                                    class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm hover:cursor-pointer hover:bg-red-200">
                                    Tolak
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</main>

<script>
    function openModal(id) {
        // Clear previous form data
        document.getElementById('modal-form').reset();
        document.getElementById('modal-form').action = '/suratkeluar/tolak/' + id;
        // Show the modal
        document.getElementById('modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }
</script>

@endsection