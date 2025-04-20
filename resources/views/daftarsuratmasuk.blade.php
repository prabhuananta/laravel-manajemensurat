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
                            Pengirim
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nomor Surat
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Keterangan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Aksi
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
                    <tr class="bg-white border-b border-gray-200 @if( $item->status == 'baru' ) font-semibold @endif">
                        <td class="px-6 py-4">
                            {{ $item->created_at->format('D, d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->pengirim->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->nomor_surat }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->keterangan }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->status }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($item->status === 'baru')
                            <a href="/suratmasuk/{{ $item->id }}" class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm
                                hover:cursor-pointer hover:bg-blue-200">
                                Lihat
                            </a>

                            @elseif($item->status === 'diproses')
                            <a href="/suratmasuk/{{ $item->id }}" class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm
                                hover:cursor-pointer hover:bg-yellow-200">Proses
                            </a>

                            @elseif($item->status === 'selesai')
                            <a href="/suratmasuk/{{ $item->id }}" class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm
                                hover:cursor-pointer hover:bg-green-200">Selesai
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