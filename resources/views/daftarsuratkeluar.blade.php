@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('route')
<span class="font-semibold">/</span>
<a class="font-semibold" href="#">
    Surat Keluar
</a>
<span class="font-semibold">/</span>
<a class="font-semibold" href="#">
    Daftar
</a>
@endsection

@section('content')

<main class="w-full bg-white rounded-md p-5">
    <div class="col-span-2 p-5 space-y-4 bg-white rounded">
        <h1 class="font-semibold text-lg">Daftar Surat Keluar</h1>
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
                            Verifikasi
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($surat) == 0)
                    <tr class="bg-white border-b border-gray-200">
                        <td colspan="8" class="px-6 py-4 text-center">
                            Tidak ada surat keluar.
                        </td>
                    </tr>
                    @else
                    @foreach($surat as $item)
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">
                            {{ $item->created_at->locale('id')->translatedFormat('D, d M Y') }}
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
                        <td class="text-center px-6 py-4">
                            @if ($item->verifikasi === 'belum')
                            <span class="bg-pink-100 text-pink-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">
                                Menunggu Verifikasi
                            </span>
                            @elseif ($item->verifikasi === 'sudah')
                            <span
                                class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">
                                Menunggu Tanda Tangan
                            </span>
                            @elseif ($item->verifikasi === 'tertanda')
                            <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">
                                Selesai
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if ($item->status === 'baru')
                            <span
                                class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">
                                Belum Dibaca
                            </span>
                            @elseif ($item->status === 'dibaca')
                            <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">
                                Dibaca
                            </span>
                            @elseif ($item->status === 'diproses')
                            <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">
                                Diproses
                            </span>
                            @elseif ($item->status === 'selesai')
                            <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">
                                Selesai
                            </span>
                            @endif
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