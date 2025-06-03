@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<main class="bg-blue-80 min-h-screen flex items-center justify-center">
    <div class="flex rounded-lg shadow-md w-full max-w-4xl overflow-hidden">

        <div
            class="bg-blue-500 p-10 w-1/2 text-white flex flex-col items-center justify-center rounded-2xl shadow-sky-950">
            <h2 class="text-2xl font-bold mb-2">Login</h2>
            <p class="text-center text-sm mb-8">Untuk bergabung di kegiatan, silakan login menggunakan email yang telah
                terdaftar terlebih dahulu</p>

            <div class="flex justify-center w-full">
                <img src="{{ asset('storage/image.png') }}" alt="Login illustration" class="w-3/4">
            </div>z
        </div>


        <div class="bg-white p-10 w-1/2">
            <div class="flex justify-center mb-9">
                <img src="{{ asset('storage/logo.png') }}" alt="Logo" class="h-17">
            </div>

            @error('email')
            <div class="p-4 mb-4 text-sm text-red-800 bg-red-50" role="alert">
                {{ $message }}
            </div>
            @enderror

            <form action="./login" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="email" class="block mb-2 text-sm font-medium">Email:</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="bg-gray-50 border border-gray-300 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Alamat Email" required />
                </div>

                <div class="mb-5">
                    <label for="password" class="block mb-2 text-sm font-medium">Password:</label>
                    <input type="password" id="password" name="password"
                        class="bg-gray-50 border border-gray-300 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Kata Sandi" required />
                </div>

                <div class="flex items-center justify-between mb-5 text-xs">
                    <div class="flex items-center">
                        <div class="mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-4 h-4 text-gray-500">
                                <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                <path fill-rule="evenodd"
                                    d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span>Anda dapat login menggunakan akun <a href="#" class="text-blue-500">yang terdaftar</a>
                            pada website ini</span>
                    </div>
                </div>


                <button type="submit"
                    class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm w-full px-5 py-3 text-center">
                    Masuk
                </button>


            </form>
        </div>
    </div>
</main>
@endsection