<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900" x-data="{ mobileMenuOpen: false }">
    <!-- Navbar -->
    <nav class="fixed top-0 z-50 w-full bg-white shadow-sm">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center flex-shrink-0">
                    <h1 class="text-2xl font-bold text-cyan-600">Orcha Journey</h1>
                </div>

                <!-- Desktop Menu -->
                <div class="items-center hidden space-x-8 md:flex">
                    <a href="#home" class="transition text-slate-700 hover:text-cyan-600">Beranda</a>
                    <a href="#packages" class="transition text-slate-700 hover:text-cyan-600">Paket Wisata</a>
                    <a href="#destinations" class="transition text-slate-700 hover:text-cyan-600">Destinasi</a>
                    <a href="#reviews" class="transition text-slate-700 hover:text-cyan-600">Review</a>
                    <a href="#contact"
                        class="px-6 py-2 text-white transition rounded-full bg-cyan-500 hover:bg-cyan-600">
                        Hubungi Kami
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-slate-700 hover:text-cyan-600">
                        <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform -translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-2" class="bg-white border-t md:hidden">
            <div class="px-4 pt-2 pb-4 space-y-2">
                <a href="#home" class="block py-2 text-slate-700 hover:text-cyan-600">Beranda</a>
                <a href="#packages" class="block py-2 text-slate-700 hover:text-cyan-600">Paket Wisata</a>
                <a href="#destinations" class="block py-2 text-slate-700 hover:text-cyan-600">Destinasi</a>
                <a href="#reviews" class="block py-2 text-slate-700 hover:text-cyan-600">Review</a>
                <a href="#contact"
                    class="block py-2 text-center text-white rounded-full bg-cyan-500 hover:bg-cyan-600">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </nav>

    <div class="">
        {{ $slot }}
    </div>

    {{-- footer section --}}
    <footer id="contact" class="relative px-4 pt-24 pb-12 overflow-hidden text-white bg-slate-900 sm:px-6 lg:px-8">
        <!-- Background Text -->
        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
            <h1 class="text-[10rem] md:text-[15rem] font-extrabold tracking-tighter text-white/5 select-none">
                Orcha Journey
            </h1>
        </div>

        <div class="relative mx-auto max-w-7xl">
            <div class="grid gap-8 mb-20 md:grid-cols-4">
                <div>
                    <h3 class="mb-4 text-2xl font-bold text-cyan-400">Orcha Journey</h3>
                    <p class="text-gray-400">
                        Travel agent terpercaya di Yogyakarta dengan pengalaman lebih dari 10 tahun melayani wisatawan.
                    </p>
                </div>

                <div>
                    <h4 class="mb-4 font-bold">Layanan</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#packages" class="transition hover:text-cyan-400">Paket Wisata</a></li>
                        <li><a href="#" class="transition hover:text-cyan-400">Custom Tour</a></li>
                        <li><a href="#" class="transition hover:text-cyan-400">Sewa Kendaraan</a></li>
                        <li><a href="#" class="transition hover:text-cyan-400">Tour Guide</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="mb-4 font-bold">Perusahaan</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="transition hover:text-cyan-400">Tentang Kami</a></li>
                        <li><a href="#" class="transition hover:text-cyan-400">Karir</a></li>
                        <li><a href="#" class="transition hover:text-cyan-400">Blog</a></li>
                        <li><a href="#" class="transition hover:text-cyan-400">FAQ</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="mb-4 font-bold">Kontak</h4>
                    <ul class="space-y-3 text-gray-400">
                        <li class="flex items-start gap-2">
                            <x-heroicon-s-map-pin class="flex-shrink-0 w-5 h-5 mt-1 text-cyan-400" />
                            <span>Jl. Malioboro No. 123, Yogyakarta</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <x-heroicon-s-phone class="w-5 h-5 text-cyan-400" />
                            <span>+62 812-3456-7890</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <x-heroicon-s-envelope class="w-5 h-5 text-cyan-400" />
                            <span>info@orchajourney.com</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="relative pt-8 text-center text-gray-400">
                <p>&copy; 2025 Orcha Journey. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>

</html>