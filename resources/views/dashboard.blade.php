@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('route')
<span class="font-semibold">/</span>
<a class="font-semibold" href="#">
    Beranda
</a>
@endsection

@section('content')
<!-- content -->
<div class="grid grid-cols-2 gap-5 grid-rows">

    <div class="col-span-2 p-5 bg-white rounded-md">
        <img class="mx-auto" src="{{ asset('storage/logo.png') }}" alt="">
    </div>

    <!-- card -->
    <div class="p-5 bg-white rounded-md">
        <center class="font-semibold">Surat Keluar</center>
        <div class="grid grid-cols-2 gap-5 grid-rows">
            <div class="flex p-5 rounded-md shadow-md">
                <div class="p-2 bg-yellow-500 rounded-xl">
                    <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                        viewBox="0 0 24 24">
                        <!-- Icon from Unicons by Iconscout - https://github.com/Iconscout/unicons/blob/master/LICENSE -->
                        <path fill="currentColor"
                            d="M14 11.51h2.42a1 1 0 0 0 .71-.29l4.58-4.58a1 1 0 0 0 0-1.42L19.29 2.8a1 1 0 0 0-1.42 0l-4.58 4.58a1.05 1.05 0 0 0-.29.71v2.42a1 1 0 0 0 1 1m1-3l3.58-3.58l1 1L16 9.51h-1Zm6 2a1 1 0 0 0-1 1v7a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V8.9l5.88 5.89a3 3 0 0 0 4.27 0a1 1 0 0 0 0-1.4a1 1 0 0 0-1.43 0a1 1 0 0 1-1.4 0l-5.91-5.9H10a1 1 0 0 0 0-2H5a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-7a1 1 0 0 0-1-1Z" />
                    </svg>
                </div>
                <center class="mx-auto">
                    <p>Belum Dikirim</p>
                    <strong>0</strong>
                </center>
            </div>
            <div class="flex p-5 rounded-md shadow-md">
                <div class="p-2 bg-red-500 rounded-xl">
                    <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                        viewBox="0 0 24 24">
                        <!-- Icon from Unicons by Iconscout - https://github.com/Iconscout/unicons/blob/master/LICENSE -->
                        <path fill="currentColor"
                            d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2m0 18a8 8 0 0 1-8-8a7.92 7.92 0 0 1 1.69-4.9L16.9 18.31A7.92 7.92 0 0 1 12 20m6.31-3.1L7.1 5.69A7.92 7.92 0 0 1 12 4a8 8 0 0 1 8 8a7.92 7.92 0 0 1-1.69 4.9" />
                    </svg>
                </div>
                <center class="mx-auto">
                    <p>Ditolak</p>
                    <strong>0</strong>
                </center>
            </div>
        </div>
    </div>
    <!-- card -->
    <div class="p-5 bg-white rounded-md">
        <center class="font-semibold">Surat Masuk</center>
        <div class="grid grid-cols-2 gap-5 grid-rows">
            <div class="flex p-5 rounded-md shadow-md">
                <div class="p-2 bg-yellow-500 rounded-xl">
                    <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                        viewBox="0 0 24 24">
                        <!-- Icon from Unicons by Iconscout - https://github.com/Iconscout/unicons/blob/master/LICENSE -->
                        <path fill="currentColor"
                            d="M16.77 5.37A1 1 0 0 0 18.13 5a1 1 0 0 1 .87-.5a1 1 0 0 1 0 2a1 1 0 0 0 0 2A3 3 0 1 0 16.4 4a1 1 0 0 0 .37 1.37M21 13.5a1 1 0 0 0-1 1v4a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V8.91l5.88 5.89a3 3 0 0 0 4.24 0l1.64-1.64a1 1 0 1 0-1.42-1.42l-1.64 1.64a1 1 0 0 1-1.4 0L5.41 7.5H13a1 1 0 0 0 0-2H5a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-4a1 1 0 0 0-1-1m-2.71-3.71a1 1 0 0 0 0 1.42l.15.12a.8.8 0 0 0 .18.09a.6.6 0 0 0 .18.06h.2a1 1 0 0 0 .71-1.71a1 1 0 0 0-1.42.02" />
                    </svg>
                </div>
                <center class="mx-auto">
                    <p>Belum Dibaca</p>
                    <strong>0</strong>
                </center>
            </div>
            <div class="flex p-5 rounded-md shadow-md">
                <div class="p-2 bg-gray-500 rounded-xl">
                    <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                        viewBox="0 0 24 24">
                        <!-- Icon from Unicons by Iconscout - https://github.com/Iconscout/unicons/blob/master/LICENSE -->
                        <path fill="currentColor"
                            d="M12 16a1 1 0 1 0 1 1a1 1 0 0 0-1-1m10.67 1.47l-8.05-14a3 3 0 0 0-5.24 0l-8 14A3 3 0 0 0 3.94 22h16.12a3 3 0 0 0 2.61-4.53m-1.73 2a1 1 0 0 1-.88.51H3.94a1 1 0 0 1-.88-.51a1 1 0 0 1 0-1l8-14a1 1 0 0 1 1.78 0l8.05 14a1 1 0 0 1 .05 1.02ZM12 8a1 1 0 0 0-1 1v4a1 1 0 0 0 2 0V9a1 1 0 0 0-1-1" />
                    </svg>
                </div>
                <center class="mx-auto">
                    <p>Tindak Lanjut</p>
                    <strong>0</strong>
                </center>
            </div>
        </div>
    </div>
    <div class="col-span-2 p-5 space-y-4 bg-white rounded">
        <h2 class="font-semibold text-center">Tandatangan Surat</h2>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 rtl:text-right">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nomor Surat
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Pengirim
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            001/SM/2021
                        </th>
                        <td class="px-6 py-4">
                            Sekretaris
                        </td>
                        <td class="px-6 py-4">
                            2021-01-01
                        </td>
                        <td class="px-6 py-4">
                            <button class="px-3 py-1 text-white bg-blue-500 rounded-md">Tandatangani</button>
                        </td>
                    </tr>
                    <tr class="bg-white">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            002/SM/2021
                        </th>
                        <td class="px-6 py-4">
                            Kepala Dinas
                        </td>
                        <td class="px-6 py-4">
                            2021-01-02
                        </td>
                        <td class="px-6 py-4">
                            <button class="px-3 py-1 text-white bg-blue-500 rounded-md">Tandatangani</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            003/SM/2021
                        </th>
                        <td class="px-6 py-4">
                            Kepala Dinas
                        </td>
                        <td class="px-6 py-4">
                            2021-01-03
                        </td>
                        <td class="px-6 py-4">
                            <button class="px-3 py-1 text-white bg-blue-500 rounded-md">Tandatangani</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>

</main>
@endsection