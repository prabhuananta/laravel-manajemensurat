@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('route')
<span class="font-semibold">/</span>
<a class="font-semibold" href="#">
    Master
</a>
<span class="font-semibold">/</span>
<a class="font-semibold" href="#">
    Penandatangan
</a>
@endsection

@section('content')
<main class="w-full bg-white rounded-md p-5 space-y-4">

    {{-- create modal --}}
    <div id="create-modal" class="fixed hidden backdrop-blur-xs w-full h-full top-0 left-0">
        <div
            class="absolute border border-gray-200 bg-white z-50 top-1/2 left-1/2 -translate-1/2 p-5 shadow-md rounded-lg px-5 w-lg max-h-3/4 overflow-y-auto">
            <span class="flex justify-between gap-5">
                <h1 class="font-semibold text-lg">Penandatangan Baru</h1>
                <button onclick="createmodal()"
                    class="bg-gray-50 rounded-sm size-8 hover:bg-gray-100 hover:cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                        <!-- Icon from CodeX Icons by CodeX - https://github.com/codex-team/icons/blob/master/LICENSE -->
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="m8 8l4 4m0 0l4 4m-4-4l4-4m-4 4l-4 4" />
                    </svg>
                </button>
            </span>

            <form action="/penandatangan" method="POST" class="space-y-4" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="user_id" class="block mb-2 text-sm font-medium ">
                        Pilih Penandatangan
                    </label>
                    <select id="user_id" name="user_id" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        <option value="">Pilih</option>
                        @foreach ($user as $option)
                        <option value="{{ $option->id }}" {{ old('user_id')==$option->id ? 'selected' : '' }}>
                            {{ $option->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="nip" class="block mb-2 text-sm font-medium">
                        NIP
                    </label>
                    <input type="text" id="nip" name="nip" value="{{ old('nip') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="NIP Penandatangan" required>
                </div>
                <div>
                    <label for="file_tanda_tangan" class="block mb-2 text-sm font-medium ">
                        Tanda Tangan
                    </label>
                    <input type="file" id="file_tanda_tangan" name="file_tanda_tangan"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
                <button type="submit"
                    class="text-white rounded-lg bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium hover:cursor-pointer text-sm px-5 py-2.5 text-center">
                    Buat Penandatangan
                </button>
            </form>
        </div>
    </div>

    {{-- alert modal --}}
    <div id="alert-modal" class="fixed hidden backdrop-blur-xs w-full h-full top-0 left-0">
        <div
            class="absolute border border-gray-200 bg-white z-50 top-1/2 left-1/2 -translate-1/2 p-5 shadow-md rounded-lg px-5">
            <span class="flex justify-between gap-5">
                <span class="text-2xl mb-4">Peringatan!</span>
                <button onclick="alertmodal()"
                    class="bg-gray-50 rounded-sm size-8 hover:bg-gray-100 hover:cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                        <!-- Icon from CodeX Icons by CodeX - https://github.com/codex-team/icons/blob/master/LICENSE -->
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="m8 8l4 4m0 0l4 4m-4-4l4-4m-4 4l-4 4" />
                    </svg>
                </button>
            </span>
            <svg class="mx-auto size-15 text-red-500" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                viewBox="0 0 24 24">
                <!-- Icon from Solar by 480 Design - https://creativecommons.org/licenses/by/4.0/ -->
                <path fill="currentColor"
                    d="M10.03 8.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.97 1.97a.75.75 0 1 0 1.06 1.06L12 13.06l1.97 1.97a.75.75 0 0 0 1.06-1.06L13.06 12l1.97-1.97a.75.75 0 1 0-1.06-1.06L12 10.94z" />
                <path fill="currentColor" fill-rule="evenodd"
                    d="M12 1.25c-.937 0-1.833.307-3.277.801l-.727.25c-1.481.506-2.625.898-3.443 1.23c-.412.167-.767.33-1.052.495c-.275.16-.55.359-.737.626c-.185.263-.281.587-.341.9c-.063.324-.1.713-.125 1.16c-.048.886-.048 2.102-.048 3.678v1.601c0 6.101 4.608 9.026 7.348 10.224l.027.011c.34.149.66.288 1.027.382c.387.1.799.142 1.348.142c.55 0 .96-.042 1.348-.142c.367-.094.687-.233 1.026-.382l.028-.011c2.74-1.198 7.348-4.123 7.348-10.224V10.39c0-1.576 0-2.792-.048-3.679a9 9 0 0 0-.125-1.16c-.06-.312-.156-.636-.34-.9c-.188-.266-.463-.465-.738-.625a9 9 0 0 0-1.052-.495c-.818-.332-1.962-.724-3.443-1.23l-.727-.25c-1.444-.494-2.34-.801-3.277-.801M9.08 3.514c1.615-.552 2.262-.764 2.92-.764s1.305.212 2.92.764l.572.196c1.513.518 2.616.896 3.39 1.21c.387.158.667.29.864.404q.144.084.208.139c.038.03.053.048.055.05a.4.4 0 0 1 .032.074q.03.082.063.248a7 7 0 0 1 .1.958c.046.841.046 2.015.046 3.624v1.574c0 5.176-3.87 7.723-6.449 8.849c-.371.162-.586.254-.825.315c-.228.059-.506.095-.976.095s-.748-.036-.976-.095c-.24-.06-.454-.153-.825-.315c-2.58-1.126-6.449-3.674-6.449-8.849v-1.574c0-1.609 0-2.783.046-3.624a7 7 0 0 1 .1-.958q.032-.166.063-.248c.018-.05.03-.07.032-.074a.4.4 0 0 1 .055-.05q.064-.055.208-.14c.197-.114.477-.245.864-.402c.774-.315 1.877-.693 3.39-1.21z"
                    clip-rule="evenodd" />
            </svg>

            <p class=" text-gray-500 mb-4">
                Apakah Anda yakin ingin menghapus Penandatangan ini?
            </p>
            <form id="alertform" action="/penandatangan/delete/" method="POST" class="grid grid-cols-2 gap-4">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="text-white rounded-lg bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium hover:cursor-pointer text-sm px-5 py-2.5 text-center">
                    Ya, Hapus
                </button>
                <button onclick="alertmodal()"
                    class="text-white rounded-lg bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium hover:cursor-pointer text-sm px-5 py-2.5 text-center">
                    Batal
                </button>
            </form>
        </div>
    </div>
    {{-- content --}}
    <div class="col-span-2 space-y-4 bg-white rounded">
        @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 bg-green-100 rounded-lg" role="alert">
            {{ session('success') }}
        </div>
        @elseif (session('error'))
        <div class="p-4 mb-4 text-sm text-red-800 bg-red-100 rounded-lg" role="alert">
            {{ session('error') }}
        </div>
        @endif
        <div class="w-full flex gap-5 justify-between items-center mb-5">
            <h1 class="font-semibold text-lg text-nowrap">Daftar Penandatangan</h1>
            <div class="flex justify-between items-center w-full">
                <input type="text" id="default-search" placeholder="Search"
                    class="block p-2.5 w-1/3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    required>
                <button onclick="createmodal()"
                    class="flex items-center gap-2 text-white bg-green-500 hover:bg-green-600 hover:cursor-pointer rounded-lg py-2 px-4">
                    Penandatangan Baru
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
                            Nama Penandatangan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jabatan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            NIP
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanda Tangan
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
                    @foreach($datas as $item)
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">
                            {{ $item->user->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->user->jabatan }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->nip }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->file_tanda_tangan ? 'Tersedia' : 'Tidak Tersedia' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->created_at->format('d M Y H:i') }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="/penandatangan/edit/{{ $item->id }}"
                                class="px-3 py-1 text-white bg-blue-500 rounded-md">Edit</a>
                            <button onclick="alertmodal({{ $item->id }})"
                                class="px-3 py-1 text-white bg-red-500 rounded-md hover:cursor-pointer">Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function createmodal() {
            const modal = document.querySelector('#create-modal');
            modal.classList.toggle('hidden');
            modal.classList.toggle('flex');
        }
        function alertmodal(id) {
            const modal = document.querySelector('#alert-modal');
            modal.classList.toggle('hidden');
            modal.classList.toggle('flex');
            const form = modal.querySelector('#alertform');
            form.action = '/penandatangan/delete/' + id;
        }
    </script>
    @endsection