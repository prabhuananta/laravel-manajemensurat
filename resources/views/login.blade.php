@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<main class="bg-cyan-50 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-md shadow-md max-w-md space-y-4">
        <img class="" src="{{ asset('storage/logo.png') }}" alt="">

        <h1 class="text-2xl font-bold text-center">LOGIN</h1>
        <form action="./login" method="POST" class="max-w-sm mx-auto">
            @csrf
            <div class="mb-5">
                @error('email')
                <div class="p-4 mb-4 text-sm text-red-800 bg-red-50" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <label for="email" class="block mb-2 text-sm font-medium">
                    Masukkan Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                    class="bg-gray-50 border border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="email" required />
            </div>
            <div class="mb-5">
                <label for="password" class="block mb-2 text-sm font-medium">
                    Masukkan Password
                </label>
                <input type="password" id="password" name="password"
                    class="bg-gray-50 border border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="password" required />
            </div>
            <div class="flex items-start mb-5">
                {{-- <div class="flex items-center h-5">
                    <input id="remember" type="checkbox" value=""
                        class="w-4 h-4 border border-gray-300 bg-gray-50 focus:ring-3 focus:ring-blue-300" required />
                </div> --}}
                <label for="remember" class="ms-2 text-sm font-medium">
                    Ingat Saya
                </label>
            </div>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium hover:cursor-pointer text-sm w-full px-5 py-2.5 text-center">
                Masuk
            </button>
        </form>


    </div>

</main>

@endsection