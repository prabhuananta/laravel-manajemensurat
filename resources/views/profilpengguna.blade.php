@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('route')
<span class="font-semibold">/</span>
<a class="font-semibold" href="#">
    Master
</a>
<span class="font-semibold">/</span>
<a class="font-semibold" href="#">
    Profil Saya
</a>
@endsection

@section('content')
<main class="w-full bg-white rounded-md p-5">

    <h1 class="text-2xl mb-4">Profil Saya</h1>
    @if (session('success'))
    <div class="p-4 mb-4 text-sm text-green-800 bg-green-100 rounded-lg" role="alert">
        {{ session('success') }}
    </div>
    @elseif (session('error'))
    <div class="p-4 mb-4 text-sm text-red-800 bg-red-100 rounded-lg" role="alert">
        {{ session('error') }}
    </div>
    @endif

    <form action="./updateprofil" method="POST" class="max-w-md space-y-4">
        @csrf
        <div>
            <label for="nama-lengkap" class="block mb-2 text-sm font-medium ">
                Nama Lengkap
            </label>
            <input type="text" id="nama-lengkap" placeholder="Nama Lengkap" name="name" value="{{ Auth::user()->name }}"
                required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>

        <div>
            <label for="email" class="block mb-2 text-sm font-medium ">
                Email
            </label>
            <input type="email" id="email" placeholder="Email" name="email" value="{{ Auth::user()->email }}" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div>
            <label for="password" class="block mb-2 text-sm font-medium ">
                Ganti Password
            </label>
            <input type="password" id="password" placeholder="Password Baru" name="password"
                value="{{ old('password') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div>
            <label for="password-confirm" class="block mb-2 text-sm font-medium ">
                Tulis Ulang Password
            </label>
            <input type="password" id="password-confirm" placeholder="Password Baru" name="password_confirmation"
                value="{{ old('password_confirm') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>

        <button type="submit"
            class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 hover:cursor-pointer">
            Edit Profil
        </button>
    </form>

</main>

@endsection