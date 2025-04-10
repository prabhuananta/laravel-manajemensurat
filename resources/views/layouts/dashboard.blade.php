<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <title>@yield('title')</title>
</head>

<body class="text-gray-500">
    <div class="flex w-full h-screen bg-gray-100">

        <!-- sidebar -->
        <div class="p-4">
            <aside class="items-center justify-center h-full p-8 overflow-y-auto bg-white rounded-lg w-full">
                <span class="text-2xl font-bold truncate me-5">Manajemen Surat</span>
                <hr class="my-6">
                <ul class="flex flex-col space-y-5 text-gray-500 text-nowrap">
                    <li>
                        <a href="/dashboard" class="flex items-center justify-between w-full cursor-pointer accordion">
                            <div class="flex items-center gap-4">
                                <svg class="p-2 text-gray-600 bg-gray-200 size-10 rounded-xl" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M4.857 3A1.857 1.857 0 0 0 3 4.857v4.286C3 10.169 3.831 11 4.857 11h4.286A1.857 1.857 0 0 0 11 9.143V4.857A1.857 1.857 0 0 0 9.143 3H4.857Zm10 0A1.857 1.857 0 0 0 13 4.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 21 9.143V4.857A1.857 1.857 0 0 0 19.143 3h-4.286Zm-10 10A1.857 1.857 0 0 0 3 14.857v4.286C3 20.169 3.831 21 4.857 21h4.286A1.857 1.857 0 0 0 11 19.143v-4.286A1.857 1.857 0 0 0 9.143 13H4.857Zm10 0A1.857 1.857 0 0 0 13 14.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 21 19.143v-4.286A1.857 1.857 0 0 0 19.143 13h-4.286Z"
                                        clip-rule="evenodd" />
                                </svg>

                                <span class="font-semibold">
                                    Beranda
                                </span>
                            </div>
                        </a>
                    </li>
                    <li class="py-2 text-xs font-bold">
                        MANAGEMENT SURAT
                    </li>
                    <li>
                        <button class="flex items-center justify-between w-full cursor-pointer accordion"
                            onclick="toggleAccordion(this)">
                            <div class="flex items-center gap-4">
                                <svg class="p-2 text-gray-600 bg-gray-200 size-10 rounded-xl"
                                    xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                    <!-- Icon from Unicons by Iconscout - https://github.com/Iconscout/unicons/blob/master/LICENSE -->
                                    <path fill="currentColor"
                                        d="M20.5 14a1 1 0 0 0-1 1v4a1 1 0 0 1-1 1h-14a1 1 0 0 1-1-1V9.41l5.88 5.89a3 3 0 0 0 4.24 0l1.64-1.64a1 1 0 1 0-1.42-1.42l-1.64 1.64a1 1 0 0 1-1.4 0L4.91 8h6.59a1 1 0 0 0 0-2h-7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-4a1 1 0 0 0-1-1m1.71-6.71a1 1 0 0 0-1.42 0l-1.29 1.3V3a1 1 0 0 0-2 0v5.59l-1.29-1.3a1 1 0 1 0-1.42 1.42l3 3a1 1 0 0 0 .33.21a.94.94 0 0 0 .76 0a1 1 0 0 0 .33-.21l3-3a1 1 0 0 0 0-1.42" />
                                </svg>
                                <span class="font-semibold">
                                    Surat Masuk
                                </span>
                            </div>
                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                viewBox="0 0 24 24">
                                <!-- Icon from Unicons by Iconscout - https://github.com/Iconscout/unicons/blob/master/LICENSE -->
                                <path fill="currentColor"
                                    d="M17 9.17a1 1 0 0 0-1.41 0L12 12.71L8.46 9.17a1 1 0 0 0-1.41 0a1 1 0 0 0 0 1.42l4.24 4.24a1 1 0 0 0 1.42 0L17 10.59a1 1 0 0 0 0-1.42" />
                            </svg>
                        </button>
                        <div class="mt-2 panel">
                            <ul class="ml-4 space-y-2 list-disc list-inside">
                                <li><a class="hover:text-gray-800" href="/suratmasuk/daftar">Daftar Surat Masuk</a></li>
                                <li><a class="hover:text-gray-800" href="/suratmasuk/disposisi">Disposisi</a></li>
                                <li><a class="hover:text-gray-800" href="/suratmasuk/log">Log Surat Masuk</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <button class="flex items-center justify-between w-full cursor-pointer accordion"
                            onclick="toggleAccordion(this)">
                            <div class="flex items-center gap-4">
                                <svg class="p-2 text-gray-600 bg-gray-200 size-10 rounded-xl"
                                    xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                    <!-- Icon from Unicons by Iconscout - https://github.com/Iconscout/unicons/blob/master/LICENSE -->
                                    <path fill="currentColor"
                                        d="M20.5 14a1 1 0 0 0-1 1v4a1 1 0 0 1-1 1h-14a1 1 0 0 1-1-1V9.41l5.88 5.89a3 3 0 0 0 4.24 0l1.64-1.64a1 1 0 1 0-1.42-1.42l-1.64 1.64a1 1 0 0 1-1.4 0L4.91 8h6.59a1 1 0 0 0 0-2h-7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-4a1 1 0 0 0-1-1m1.71-8.71l-3-3a1 1 0 0 0-.33-.21a1 1 0 0 0-.76 0a1 1 0 0 0-.33.21l-3 3a1 1 0 0 0 1.42 1.42l1.29-1.3V11a1 1 0 0 0 2 0V5.41l1.29 1.3a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.42" />
                                </svg>
                                <span class="font-semibold">
                                    Surat Keluar
                                </span>
                            </div>
                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                viewBox="0 0 24 24">
                                <!-- Icon from Unicons by Iconscout - https://github.com/Iconscout/unicons/blob/master/LICENSE -->
                                <path fill="currentColor"
                                    d="M17 9.17a1 1 0 0 0-1.41 0L12 12.71L8.46 9.17a1 1 0 0 0-1.41 0a1 1 0 0 0 0 1.42l4.24 4.24a1 1 0 0 0 1.42 0L17 10.59a1 1 0 0 0 0-1.42" />
                            </svg>
                        </button>
                        <div class="mt-2 panel">
                            <ul class="ml-4 space-y-2 list-disc list-inside">
                                <li>
                                    <a class="hover:text-gray-800" href="/suratkeluar/registrasi">
                                        Registrasi Surat Keluar
                                    </a>
                                </li>
                                <li>
                                    <a class="hover:text-gray-800" href="/suratkeluar/daftar">
                                        Daftar Surat Keluar
                                    </a>
                                </li>
                                <li>
                                    <a class="hover:text-gray-800" href="/suratkeluar/log">
                                        Log Surat Keluar
                                    </a>
                                </li>
                                <li>
                                    <a class="hover:text-gray-800" href="/suratkeluar/verifikasi">
                                        Verifikasi Surat Keluar
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="py-2 text-xs font-bold">
                        MASTER
                    </li>
                    <li>
                        <button class="flex items-center justify-between w-full cursor-pointer accordion"
                            onclick="toggleAccordion(this)">
                            <div class="flex items-center gap-4">
                                <svg class="p-2 text-gray-600 bg-gray-200 size-10 rounded-xl"
                                    xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                    <!-- Icon from Unicons by Iconscout - https://github.com/Iconscout/unicons/blob/master/LICENSE -->
                                    <path fill="currentColor"
                                        d="M12.3 12.22A4.92 4.92 0 0 0 14 8.5a5 5 0 0 0-10 0a4.92 4.92 0 0 0 1.7 3.72A8 8 0 0 0 1 19.5a1 1 0 0 0 2 0a6 6 0 0 1 12 0a1 1 0 0 0 2 0a8 8 0 0 0-4.7-7.28M9 11.5a3 3 0 1 1 3-3a3 3 0 0 1-3 3m9.74.32A5 5 0 0 0 15 3.5a1 1 0 0 0 0 2a3 3 0 0 1 3 3a3 3 0 0 1-1.5 2.59a1 1 0 0 0-.5.84a1 1 0 0 0 .45.86l.39.26l.13.07a7 7 0 0 1 4 6.38a1 1 0 0 0 2 0a9 9 0 0 0-4.23-7.68" />
                                </svg>
                                <span class="font-semibold">
                                    Pengguna
                                </span>
                            </div>
                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                viewBox="0 0 24 24">
                                <!-- Icon from Unicons by Iconscout - https://github.com/Iconscout/unicons/blob/master/LICENSE -->
                                <path fill="currentColor"
                                    d="M17 9.17a1 1 0 0 0-1.41 0L12 12.71L8.46 9.17a1 1 0 0 0-1.41 0a1 1 0 0 0 0 1.42l4.24 4.24a1 1 0 0 0 1.42 0L17 10.59a1 1 0 0 0 0-1.42" />
                            </svg>
                        </button>
                        <div class="mt-2 panel hidden">
                            <ul class="ml-4 space-y-2 list-disc list-inside">
                                <li><a class="hover:text-gray-800" href="/user">Daftar Pengguna</a></li>
                                <li><a class="hover:text-gray-800" href="/profil">Profil Saya</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </aside>
        </div>

        <!-- container -->
        <main class="relative overflow-auto h-full w-full p-4">

            <!-- top bar -->
            <div class="flex justify-between mb-5">
                <div class="flex items-center space-x-3">
                    <a href="/dashboard">
                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                            viewBox="0 0 24 24">
                            <!-- Icon from Google Material Icons by Material Design Authors - https://github.com/material-icons/material-icons/blob/master/LICENSE -->
                            <path fill="currentColor"
                                d="M10 19v-5h4v5c0 .55.45 1 1 1h3c.55 0 1-.45 1-1v-7h1.7c.46 0 .68-.57.33-.87L12.67 3.6c-.38-.34-.96-.34-1.34 0l-8.36 7.53c-.34.3-.13.87.33.87H5v7c0 .55.45 1 1 1h3c.55 0 1-.45 1-1" />
                        </svg>
                    </a>
                    @yield('route')
                </div>
                <div class="flex items-center gap-2 px-3 py-1 bg-white rounded-md w-fit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                        <!-- Icon from Unicons by Iconscout - https://github.com/Iconscout/unicons/blob/master/LICENSE -->
                        <path fill="currentColor"
                            d="M12 2a10 10 0 0 0-7.35 16.76a10 10 0 0 0 14.7 0A10 10 0 0 0 12 2m0 18a8 8 0 0 1-5.55-2.25a6 6 0 0 1 11.1 0A8 8 0 0 1 12 20m-2-10a2 2 0 1 1 2 2a2 2 0 0 1-2-2m8.91 6A8 8 0 0 0 15 12.62a4 4 0 1 0-6 0A8 8 0 0 0 5.09 16A7.9 7.9 0 0 1 4 12a8 8 0 0 1 16 0a7.9 7.9 0 0 1-1.09 4" />
                    </svg>

                    <div class="space-y-1">
                        <span class="text-sm font-semibold">{{Auth::user()->email}}</span>
                        <small class="block">{{ Auth::user()->role }}</small>
                    </div>
                    <button onclick="toggleDropdown(this)" id="dropdownProfileButton"
                        class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 hover:cursor-pointer focus:ring-0 focus:outline-none "
                        type="button">
                        <svg class="size-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 4 15">
                            <path
                                d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                        </svg>
                    </button>
                    <div class="absolute hidden top-18 right-4 shadow bg-white py-2 rounded-md w-fit">
                        <a href="/profil"
                            class="flex justify-between hover:bg-gray-100 hover:cursor-pointer py-2 px-4 gap-5 text-sm ">
                            Profil Saya
                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                viewBox="0 0 24 24">
                                <!-- Icon from Unicons by Iconscout - https://github.com/Iconscout/unicons/blob/master/LICENSE -->
                                <path fill="currentColor"
                                    d="M22 7.24a1 1 0 0 0-.29-.71l-4.24-4.24a1 1 0 0 0-.71-.29a1 1 0 0 0-.71.29l-2.83 2.83L2.29 16.05a1 1 0 0 0-.29.71V21a1 1 0 0 0 1 1h4.24a1 1 0 0 0 .76-.29l10.87-10.93L21.71 8a1.2 1.2 0 0 0 .22-.33a1 1 0 0 0 0-.24a.7.7 0 0 0 0-.14ZM6.83 20H4v-2.83l9.93-9.93l2.83 2.83ZM18.17 8.66l-2.83-2.83l1.42-1.41l2.82 2.82Z" />
                            </svg>
                        </a>
                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full flex justify-between hover:bg-gray-100 hover:cursor-pointer py-2 px-4 gap-5">
                                <span class="text-sm ">
                                    Sign Out
                                </span>
                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                    viewBox="0 0 24 24">
                                    <!-- Icon from Unicons by Iconscout - https://github.com/Iconscout/unicons/blob/master/LICENSE -->
                                    <path fill="currentColor"
                                        d="M4 12a1 1 0 0 0 1 1h7.59l-2.3 2.29a1 1 0 0 0 0 1.42a1 1 0 0 0 1.42 0l4-4a1 1 0 0 0 .21-.33a1 1 0 0 0 0-.76a1 1 0 0 0-.21-.33l-4-4a1 1 0 1 0-1.42 1.42l2.3 2.29H5a1 1 0 0 0-1 1M17 2H7a3 3 0 0 0-3 3v3a1 1 0 0 0 2 0V5a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-3a1 1 0 0 0-2 0v3a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V5a3 3 0 0 0-3-3" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @yield('content')
        </main>
    </div>
</body>

</html>

<script>
    function toggleDropdown(element) {
        const dropdown = element.nextElementSibling;
        dropdown.classList.toggle('hidden');
    }

    function toggleAccordion(element) {
        const panel = element.nextElementSibling;
        panel.classList.toggle('hidden');
    }
</script>