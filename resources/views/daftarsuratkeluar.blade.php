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
                            Penerima
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nomor Surat
                        </th>
                        <th scope="col" class="px-6 py-3">
                            File Surat
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Verifikasi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($surat) == 0)
                    <tr class="bg-white border-b border-gray-200">
                        <td colspan="5" class="px-6 py-4 text-center">
                            Tidak ada surat masuk.
                        </td>
                    </tr>
                    @else
                    @foreach($surat as $item)
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">
                            {{ $item->created_at->format('D, d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->tujuan->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->nomor_surat }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="/surat/download/{{ $item->id }}" class="text-blue-500 hover:underline">
                                {{ $item->isi }}
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            @if ($item->verifikasi === 'belum')
                            <span class="bg-pink-100 text-pink-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">
                                {{ $item->verifikasi }}
                            </span>
                            @elseif ($item->verifikasi === 'sudah')
                            <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">
                                {{ $item->verifikasi }}
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