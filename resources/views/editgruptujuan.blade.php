@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('route')
<span class="font-semibold">/</span>
<a class="font-semibold" href="#">
    Master
</a>
<span class="font-semibold">/</span>
<a class="font-semibold" href="#">
    Daftar Pengguna
</a>
@endsection

@section('content')
<script>
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' || e.keyCode === 27) {
            window.location.href = '/gruptujuan';
        }
    });
</script>
<main class="w-full bg-white rounded-md p-5 space-y-4">

    {{-- modal --}}
    <div class="fixed backdrop-blur-xs w-full h-full top-0 left-0">
        <div id="create-modal" class="fixed backdrop-blur-xs w-full h-full top-0 left-0">
            <div
                class="absolute border border-gray-200 bg-white z-50 top-1/2 left-1/2 -translate-1/2 p-5 shadow-md rounded-lg px-5 w-lg max-h-3/4 overflow-y-auto">
                <span class="flex justify-between gap-5">
                    <h1 class="font-semibold text-lg">Edit Tujuan Baru</h1>
                    <a href="/gruptujuan" class="bg-gray-50 rounded-sm size-8 hover:bg-gray-100 hover:cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                            <!-- Icon from CodeX Icons by CodeX - https://github.com/codex-team/icons/blob/master/LICENSE -->
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                d="m8 8l4 4m0 0l4 4m-4-4l4-4m-4 4l-4 4" />
                        </svg>
                    </a>
                </span>
                @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 bg-green-100 rounded-lg" role="alert">
                    {{ session('success') }}
                </div>
                @elseif (session('error'))
                <div class="p-4 mb-4 text-sm text-red-800 bg-red-100 rounded-lg" role="alert">
                    {{ session('error') }}
                </div>
                @endif

                <form action="/gruptujuan/update/{{ $datas->id }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="nama" class="block mb-2 text-sm font-medium ">
                            Nama Grup Tujuan
                        </label>
                        <input type="text" id="nama" placeholder="Nama" name="nama_grup"
                            value="{{ (!$datas->nama_grup) ? old('nama_grup') : $datas->nama_grup }}" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div>
                        <label for="keterangan" class="block mb-2 text-sm font-medium ">
                            Keterangan
                        </label>
                        <textarea name="keterangan" id="keterangan" rows="5" placeholder="Keterangan" requred
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">{{ (!$datas->keterangan) ? old('keterangan') : $datas->keterangan }}</textarea>
                    </div>
                    <div>
                        <label for="anggota" class="block mb-2 text-sm font-medium ">
                            Anggota
                        </label>
                        <button type="button"
                            class="bg-gray-200 text-xs mb-2 px-4 py-2 cursor-pointer hover:bg-gray-300 rounded-full"
                            onclick="addAnggota()">Tambah Anggota</button>
                        <div id="anggotaContainer">
                            @if(count($datas->users) > 0)
                            @foreach($datas->users as $item)
                            <div class="flex items-center mb-2">
                                <select name="user_id[]" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="">Pilih</option>
                                    @foreach($user as $option)
                                    <option value="{{ $option->id }}" {{ $item->id == $option->id ? 'selected' : '' }}>
                                        {{ $option->name }}
                                    </option>
                                    @endforeach
                                </select>
                                <button type="button" class="ml-2 text-red-500 hover:text-red-700"
                                    onclick="this.parentElement.remove()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M18 6L6 18M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            @endforeach
                            @else
                            <div class="flex items-center mb-2">
                                <select name="user_id[]" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="">Pilih</option>
                                    @foreach($user as $option)
                                    <option value="{{ $option->id }}">{{ $option->name }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="ml-2 text-red-500 hover:text-red-700"
                                    onclick="this.parentElement.remove()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M18 6L6 18M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            @endif
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white rounded-lg bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium hover:cursor-pointer text-sm px-5 py-2.5 text-center">
                        Edit Grup Tujuan
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- content --}}
    <div class="col-span-2 space-y-4 bg-white rounded">
        <div class="w-full flex gap-5 justify-between items-center mb-5">
            <p class="text-2xl font-bold text-nowrap">Daftar Pengguna</p>
            <div class="flex justify-between items-center w-full">
                <input type="text" id="default-search" placeholder="Search"
                    class="block p-2.5 w-1/3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    required>
                <button
                    class="flex items-center gap-2 text-white bg-green-600 hover:bg-green-700 hover:cursor-pointer rounded-lg py-2 px-4">
                    Pengguna Baru
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                        <!-- Icon from Unicons by Iconscout - https://github.com/Iconscout/unicons/blob/master/LICENSE -->
                        <path fill="currentColor"
                            d="M21 10.5h-1v-1a1 1 0 0 0-2 0v1h-1a1 1 0 0 0 0 2h1v1a1 1 0 0 0 2 0v-1h1a1 1 0 0 0 0-2m-7.7 1.72A4.92 4.92 0 0 0 15 8.5a5 5 0 0 0-10 0a4.92 4.92 0 0 0 1.7 3.72A8 8 0 0 0 2 19.5a1 1 0 0 0 2 0a6 6 0 0 1 12 0a1 1 0 0 0 2 0a8 8 0 0 0-4.7-7.28M10 11.5a3 3 0 1 1 3-3a3 3 0 0 1-3 3" />
                    </svg>
                </button>

            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 rtl:text-right">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nama Grup
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Keterangan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jumlah Anggota
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Dibuat Pada
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function addAnggota() {
        const container = document.getElementById('anggotaContainer');
        const div = document.createElement('div');
        div.className = 'flex items-center mb-2';
        div.innerHTML = `
            <select name="user_id[]" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="">Pilih</option>
                @foreach($user as $option)
                    <option value="{{ $option->id }}">{{ $option->name }}</option>
                @endforeach
            </select>
            <button type="button" class="ml-2 text-red-500 hover:text-red-700" onclick="this.parentElement.remove()">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6L6 18M6 6l12 12"></path>
                </svg>
            </button>
        `;
        container.appendChild(div);
    }
    </script>
    @endsection