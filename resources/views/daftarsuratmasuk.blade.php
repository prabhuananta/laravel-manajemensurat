@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('route')
<span class="font-semibold">/</span>
<a class="font-semibold" href="#">
    Surat Masuk
</a>
@endsection

@section('content')

<main class="w-full bg-white rounded-md p-5">
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
        <h1 class="font-semibold text-lg">Daftar Surat Masuk</h1>
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
                                @if ($item->status === 'baru')
                                <div
                                    class="absolute inline-flex items-center justify-center size-4 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-1 -end-1">
                                </div>
                                @endif
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</main>

@endsection