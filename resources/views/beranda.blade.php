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
<div class="grid grid-cols-2 overflow-y-auto gap-5 grid-rows">

    <div class="col-span-2 p-5 bg-white rounded-md">
        <img class="mx-auto" src="{{ asset('storage/logo.png') }}" alt="">
    </div>

    <!-- card -->
    <div class="p-5 bg-white rounded-md">
        <div class="text-center font-semibold">Surat Keluar</div>
        <div class="grid grid-cols-2 gap-5 grid-rows">
            <a href="/suratkeluar/verifikasi" class="flex p-5 rounded-md shadow-md">
                <div class="p-2 bg-yellow-500 my-auto rounded-xl">
                    <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                        viewBox="0 0 24 24">
                        <!-- Icon from Unicons by Iconscout - https://github.com/Iconscout/unicons/blob/master/LICENSE -->
                        <path fill="currentColor"
                            d="M14 11.51h2.42a1 1 0 0 0 .71-.29l4.58-4.58a1 1 0 0 0 0-1.42L19.29 2.8a1 1 0 0 0-1.42 0l-4.58 4.58a1.05 1.05 0 0 0-.29.71v2.42a1 1 0 0 0 1 1m1-3l3.58-3.58l1 1L16 9.51h-1Zm6 2a1 1 0 0 0-1 1v7a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V8.9l5.88 5.89a3 3 0 0 0 4.27 0a1 1 0 0 0 0-1.4a1 1 0 0 0-1.43 0a1 1 0 0 1-1.4 0l-5.91-5.9H10a1 1 0 0 0 0-2H5a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-7a1 1 0 0 0-1-1Z" />
                    </svg>
                </div>
                <div class="text-center mx-auto">
                    <p>Belum Diverifikasi</p>
                    <strong>{{ $data['belum_dikirim'] }}</strong>
                </div>
            </a>
            <a href="/suratkeluar/ditolak" class="flex p-5 rounded-md shadow-md">
                <div class="p-2 bg-red-500 my-auto rounded-xl">
                    <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                        viewBox="0 0 24 24">
                        <!-- Icon from Unicons by Iconscout - https://github.com/Iconscout/unicons/blob/master/LICENSE -->
                        <path fill="currentColor"
                            d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2m0 18a8 8 0 0 1-8-8a7.92 7.92 0 0 1 1.69-4.9L16.9 18.31A7.92 7.92 0 0 1 12 20m6.31-3.1L7.1 5.69A7.92 7.92 0 0 1 12 4a8 8 0 0 1 8 8a7.92 7.92 0 0 1-1.69 4.9" />
                    </svg>
                </div>
                <div class="text-center mx-auto">
                    <p>Ditolak</p>
                    <strong>{{ $data['ditolak'] }}</strong>
                </div>
            </a>
        </div>
    </div>
    <!-- card -->
    <div class="p-5 bg-white rounded-md">
        <div class="text-center font-semibold">Surat Masuk</div>
        <div class="grid grid-cols-2 gap-5 grid-rows">
            <a href="/suratmasuk/daftar" class="flex p-5 rounded-md shadow-md">
                <div class="p-2 bg-yellow-500 my-auto rounded-xl">
                    <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                        viewBox="0 0 24 24">
                        <!-- Icon from Unicons by Iconscout - https://github.com/Iconscout/unicons/blob/master/LICENSE -->
                        <path fill="currentColor"
                            d="M16.77 5.37A1 1 0 0 0 18.13 5a1 1 0 0 1 .87-.5a1 1 0 0 1 0 2a1 1 0 0 0 0 2A3 3 0 1 0 16.4 4a1 1 0 0 0 .37 1.37M21 13.5a1 1 0 0 0-1 1v4a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V8.91l5.88 5.89a3 3 0 0 0 4.24 0l1.64-1.64a1 1 0 1 0-1.42-1.42l-1.64 1.64a1 1 0 0 1-1.4 0L5.41 7.5H13a1 1 0 0 0 0-2H5a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-4a1 1 0 0 0-1-1m-2.71-3.71a1 1 0 0 0 0 1.42l.15.12a.8.8 0 0 0 .18.09a.6.6 0 0 0 .18.06h.2a1 1 0 0 0 .71-1.71a1 1 0 0 0-1.42.02" />
                    </svg>
                </div>
                <div class="text-center mx-auto">
                    <p>Belum Dibaca</p>
                    <strong>{{ $data['belum_dibaca']}} </strong>
                </div>
            </a>
            <div class="flex p-5 rounded-md shadow-md">
                <div class="p-2 bg-gray-500 my-auto rounded-xl">
                    <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                        viewBox="0 0 24 24">
                        <!-- Icon from Unicons by Iconscout - https://github.com/Iconscout/unicons/blob/master/LICENSE -->
                        <path fill="currentColor"
                            d="M12 16a1 1 0 1 0 1 1a1 1 0 0 0-1-1m10.67 1.47l-8.05-14a3 3 0 0 0-5.24 0l-8 14A3 3 0 0 0 3.94 22h16.12a3 3 0 0 0 2.61-4.53m-1.73 2a1 1 0 0 1-.88.51H3.94a1 1 0 0 1-.88-.51a1 1 0 0 1 0-1l8-14a1 1 0 0 1 1.78 0l8.05 14a1 1 0 0 1 .05 1.02ZM12 8a1 1 0 0 0-1 1v4a1 1 0 0 0 2 0V9a1 1 0 0 0-1-1" />
                    </svg>
                </div>
                <div class="text-center mx-auto">
                    <p>Tindak Lanjut</p>
                    <strong>{{ $data['tindaklanjut'] }}</strong>
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-2 p-5 space-y-4 bg-white rounded">
        <h2 class="font-semibold text-center">Daftar Surat Masuk</h2>
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
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($surat) == 0)
                    <tr class="bg-white border-b border-gray-200">
                        <td colspan="6" class="px-6 py-4 text-center">
                            Tidak ada surat masuk.
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
                            @if ($item->status === 'baru')
                            <a href="/suratmasuk/{{ $item->id }}"
                                class="relative inline-flex items-center p-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 16">
                                    <path
                                        d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
                                    <path
                                        d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
                                </svg>
                                <span class="sr-only">Notifications</span>
                                <div
                                    class="absolute inline-flex items-center justify-center size-4 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-1 -end-1">
                                </div>
                            </a>
                            @elseif ($item->status === 'dibaca' || $item->status === 'diproses')
                            <a href="/suratmasuk/{{ $item->id }}"
                                class="relative inline-flex items-center p-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 16">
                                    <path
                                        d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
                                    <path
                                        d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
                                </svg>
                                <span class="sr-only">Notifications</span>
                            </a>
                            @elseif ($item->status === 'selesai' || true)
                            <a href="/suratmasuk/{{ $item->id }}"
                                class="relative inline-flex items-center p-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 16">
                                    <path
                                        d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
                                    <path
                                        d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
                                </svg>
                                <span class="sr-only">Notifications</span>
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>

    </div>
</div>

</main>
@endsection