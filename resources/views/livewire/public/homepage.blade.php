<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
    #[Layout('components.layouts.guest')]
    #[Title('Orca Journey')]
    class extends Component {
        public array $packages = [
            [
                'name' => 'Paket Hemat',
                'price' => 1500000,
                'originalPrice' => 2000000,
                'destinations' => ['Candi Borobudur', 'Malioboro', 'Keraton Yogyakarta'],
                'duration' => '2D1N',
                'isBest' => false,
            ],
            [
                'name' => 'Paket Premium',
                'price' => 2500000,
                'originalPrice' => 3500000,
                'destinations' => ['Candi Borobudur', 'Candi Prambanan', 'Malioboro', 'Pantai Parangtritis', 'Tebing Breksi'],
                'duration' => '3D2N',
                'isBest' => true,
            ],
            [
                'name' => 'Paket Ekslusif',
                'price' => 3800000,
                'originalPrice' => 5000000,
                'destinations' => ['Borobudur Sunrise', 'Prambanan Sunset', 'Malioboro', 'Pantai Indrayanti', 'Goa Pindul', 'Kalibiru'],
                'duration' => '4D3N',
                'isBest' => false,
            ],
        ];

        public array $topDestinations = [
            [
                'name' => 'Candi Borobudur',
                'image' => 'https://images.unsplash.com/photo-1596422846543-75c6fc197f07?w=400&h=300&fit=crop',
                'visitors' => '2.5k+ Pengunjung',
            ],
            [
                'name' => 'Candi Prambanan',
                'image' => 'https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?w=400&h=300&fit=crop',
                'visitors' => '1.8k+ Pengunjung',
            ],
            [
                'name' => 'Pantai Parangtritis',
                'image' => 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=400&h=300&fit=crop',
                'visitors' => '3.2k+ Pengunjung',
            ],
        ];

        public array $bookingSteps = [
            [
                'icon' => 'map-pin', // nanti bisa di-blade pakai <x-icon name="map-pin" />
                'title' => 'Pilih Destinasi',
                'desc' => 'Pilih paket wisata yang sesuai dengan kebutuhan Anda',
            ],
            [
                'icon' => 'users',
                'title' => 'Isi Data Pengunjung',
                'desc' => 'Lengkapi data diri dan jumlah peserta wisata',
            ],
            [
                'icon' => 'check-circle',
                'title' => 'Konfirmasi & Bayar',
                'desc' => 'Lakukan pembayaran dan tunggu konfirmasi dari kami',
            ],
        ];

        public array $reviews = [
            [
                'name' => 'Budi Santoso',
                'avatar' => 'https://ui-avatars.com/api/?name=Budi+Santoso&background=f59e0b&color=fff',
                'rating' => 5,
                'comment' => 'Pelayanan sangat memuaskan! Tour guide ramah dan destinasi wisata sangat menarik. Recommended!',
            ],
            [
                'name' => 'Siti Aminah',
                'avatar' => 'https://ui-avatars.com/api/?name=Siti+Aminah&background=3b82f6&color=fff',
                'rating' => 5,
                'comment' => 'Paket wisata sangat lengkap dan harga terjangkau. Pengalaman liburan yang tak terlupakan di Jogja.',
            ],
            [
                'name' => 'Andi Wijaya',
                'avatar' => 'https://ui-avatars.com/api/?name=Andi+Wijaya&background=10b981&color=fff',
                'rating' => 5,
                'comment' => 'Perjalanan sangat terorganisir dengan baik. Semua berjalan lancar dan menyenangkan. Terima kasih!',
            ],
        ];

        public array $partners = [
            ['name' => 'Armada Jaya', 'logo' => 'AJ'],
            ['name' => 'Prima Trans', 'logo' => 'PT'],
            ['name' => 'Jogja Express', 'logo' => 'JE'],
            ['name' => 'Merapi Travel', 'logo' => 'MT'],
            ['name' => 'Borobudur Tours', 'logo' => 'BT'],
        ];

        public function with()
        {
            return [
                'packages' => $this->packages,
                'topDestinations' => $this->topDestinations,
                'bookingStes' => $this->bookingSteps,
                'reviews' => $this->reviews,
                'partners' => $this->partners
            ];
        }
    }; ?>

<div>
    <!-- Hero Section -->
    <section id="home" class="px-4 pt-24 pb-16 sm:px-6 lg:px-8 scroll-mt-10">
        <div class="mx-auto max-w-7xl">
            <div class="grid items-center gap-8 md:grid-cols-2">
                <div class="space-y-6">
                    <p class="font-semibold tracking-wide uppercase text-cyan-600">
                        Jelajahi Keindahan Yogyakarta
                    </p>
                    <h2 class="text-4xl font-bold leading-tight md:text-5xl lg:text-6xl text-slate-900">
                        Wisata Seru, Kenangan Tak Terlupakan
                    </h2>
                    <p class="text-lg text-slate-600">
                        Nikmati pengalaman wisata terbaik di Yogyakarta dengan paket tour lengkap,
                        guide profesional, dan harga yang bersahabat. Jadikan liburan Anda berkesan!
                    </p>
                    <div class="flex flex-col gap-4 sm:flex-row">
                        <a href="#packages"
                            class="px-8 py-3 font-semibold text-center text-white transition rounded-full bg-cyan-500 hover:bg-cyan-600">
                            Lihat Paket
                        </a>
                        <a href="#contact"
                            class="px-8 py-3 font-semibold text-center transition border-2 rounded-full border-cyan-500 text-cyan-600 hover:bg-cyan-50">
                            Konsultasi Gratis
                        </a>
                    </div>
                </div>
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=600&h=700&fit=crop"
                        alt="Travel Yogyakarta" class="w-full shadow-2xl rounded-3xl">
                    <div class="absolute hidden p-4 bg-white shadow-lg -bottom-6 -left-6 rounded-2xl sm:block">
                        <div class="flex items-center gap-3">
                            <div class="p-3 rounded-full bg-cyan-100">
                                <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-slate-900">5000+</p>
                                <p class="text-sm text-slate-600">Happy Travelers</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Packages Section -->
    <section id="packages" class="px-4 py-16 bg-white sm:px-6 lg:px-8 sroll-mt-10">
        <div class="mx-auto max-w-7xl">
            <div class="mb-12 text-center">
                <p class="mb-2 font-semibold tracking-wide uppercase text-cyan-600">Paket Wisata</p>
                <h3 class="text-3xl font-bold text-slate-900 md:text-4xl">Pilihan Paket Bundling</h3>
                <p class="max-w-2xl mx-auto mt-4 text-slate-600">
                    Kami menyediakan berbagai paket wisata yang dapat disesuaikan dengan kebutuhan Anda
                </p>
            </div>

            <div class="grid gap-8 md:grid-cols-3">
                <!-- Paket Hemat -->
                <div class="relative overflow-hidden transition-all bg-white shadow-lg rounded-2xl hover:shadow-2xl">
                    <div class="p-6">
                        <h4 class="mb-2 text-2xl font-bold text-slate-900">Paket Hemat</h4>
                        <div class="flex items-center gap-2 mb-4">
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-sm text-slate-600">2D1N</span>
                        </div>

                        <div class="mb-6">
                            <div class="flex items-baseline gap-2">
                                <span class="text-3xl font-bold text-cyan-600">Rp 1.500.000</span>
                            </div>
                            <span class="text-sm line-through text-slate-400">Rp 2.000.000</span>
                            <div
                                class="inline-block px-2 py-1 ml-2 text-xs font-semibold text-red-600 bg-red-100 rounded">
                                Hemat 25%
                            </div>
                        </div>

                        <div class="mb-6 space-y-3">
                            <p class="font-semibold text-slate-900">Destinasi Wisata:</p>
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-cyan-500 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-slate-600">Candi Borobudur</span>
                            </div>
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-cyan-500 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-slate-600">Malioboro</span>
                            </div>
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-cyan-500 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-slate-600">Keraton Yogyakarta</span>
                            </div>
                        </div>

                        <button
                            class="w-full py-3 font-semibold transition rounded-full bg-cyan-100 text-cyan-700 hover:bg-cyan-200">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>

                <!-- Paket Premium (BEST CHOICE) -->
                <div
                    class="relative overflow-hidden transition-all transform bg-white shadow-lg rounded-2xl hover:shadow-2xl ring-4 ring-cyan-500 md:scale-105">
                    <div
                        class="absolute top-0 right-0 px-4 py-1 text-sm font-semibold text-white rounded-bl-lg bg-cyan-500">
                        BEST CHOICE
                    </div>
                    <div class="p-6">
                        <h4 class="mb-2 text-2xl font-bold text-slate-900">Paket Premium</h4>
                        <div class="flex items-center gap-2 mb-4">
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-sm text-slate-600">3D2N</span>
                        </div>

                        <div class="mb-6">
                            <div class="flex items-baseline gap-2">
                                <span class="text-3xl font-bold text-cyan-600">Rp 2.500.000</span>
                            </div>
                            <span class="text-sm line-through text-slate-400">Rp 3.500.000</span>
                            <div
                                class="inline-block px-2 py-1 ml-2 text-xs font-semibold text-red-600 bg-red-100 rounded">
                                Hemat 29%
                            </div>
                        </div>

                        <div class="mb-6 space-y-3">
                            <p class="font-semibold text-slate-900">Destinasi Wisata:</p>
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-cyan-500 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-slate-600">Candi Borobudur</span>
                            </div>
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-cyan-500 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-slate-600">Candi Prambanan</span>
                            </div>
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-cyan-500 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-slate-600">Malioboro</span>
                            </div>
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-cyan-500 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-slate-600">Pantai Parangtritis</span>
                            </div>
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-cyan-500 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-slate-600">Tebing Breksi</span>
                            </div>
                        </div>

                        <button
                            class="w-full py-3 font-semibold text-white transition rounded-full bg-cyan-500 hover:bg-cyan-600">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>

                <!-- Paket Ekslusif -->
                <div class="relative overflow-hidden transition-all bg-white shadow-lg rounded-2xl hover:shadow-2xl">
                    <div class="p-6">
                        <h4 class="mb-2 text-2xl font-bold text-slate-900">Paket Ekslusif</h4>
                        <div class="flex items-center gap-2 mb-4">
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-sm text-slate-600">4D3N</span>
                        </div>

                        <div class="mb-6">
                            <div class="flex items-baseline gap-2">
                                <span class="text-3xl font-bold text-cyan-600">Rp 3.800.000</span>
                            </div>
                            <span class="text-sm line-through text-slate-400">Rp 5.000.000</span>
                            <div
                                class="inline-block px-2 py-1 ml-2 text-xs font-semibold text-red-600 bg-red-100 rounded">
                                Hemat 24%
                            </div>
                        </div>

                        <div class="mb-6 space-y-3">
                            <p class="font-semibold text-slate-900">Destinasi Wisata:</p>
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-cyan-500 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-slate-600">Borobudur Sunrise</span>
                            </div>
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-cyan-500 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-slate-600">Prambanan Sunset</span>
                            </div>
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-cyan-500 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-slate-600">Malioboro</span>
                            </div>
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-cyan-500 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-slate-600">Pantai Indrayanti</span>
                            </div>
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-cyan-500 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-slate-600">Goa Pindul</span>
                            </div>
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-cyan-500 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-slate-600">Kalibiru</span>
                            </div>
                        </div>

                        <button
                            class="w-full py-3 font-semibold transition rounded-full bg-cyan-100 text-cyan-700 hover:bg-cyan-200">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Top Destinations -->
    <section id="destinations" class="px-4 py-16 sm:px-6 lg:px-8 scroll-mt-10">
        <div class="mx-auto max-w-7xl">
            <div class="mb-12 text-center">
                <p class="mb-2 font-semibold tracking-wide uppercase text-cyan-600">Destinasi Populer</p>
                <h3 class="text-3xl font-bold text-gray-900 md:text-4xl">Tempat Wisata Favorit</h3>
            </div>

            <div class="grid gap-8 md:grid-cols-3">
                <!-- Destination 1 -->
                <div class="relative overflow-hidden shadow-lg cursor-pointer group rounded-2xl">
                    <img src="https://images.unsplash.com/photo-1596422846543-75c6fc197f07?w=400&h=300&fit=crop"
                        alt="Candi Borobudur"
                        class="object-cover w-full transition-transform duration-300 h-80 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                        <h4 class="mb-2 text-2xl font-bold">Candi Borobudur</h4>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span class="text-sm">2.5k+ Pengunjung</span>
                        </div>
                    </div>
                </div>

                <!-- Destination 2 -->
                <div class="relative overflow-hidden shadow-lg cursor-pointer group rounded-2xl">
                    <img src="https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?w=400&h=300&fit=crop"
                        alt="Candi Prambanan"
                        class="object-cover w-full transition-transform duration-300 h-80 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                        <h4 class="mb-2 text-2xl font-bold">Candi Prambanan</h4>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span class="text-sm">1.8k+ Pengunjung</span>
                        </div>
                    </div>
                </div>

                <!-- Destination 1 -->
                <div class="relative overflow-hidden shadow-lg cursor-pointer group rounded-2xl">
                    <img src="https://images.unsplash.com/photo-1596422846543-75c6fc197f07?w=400&h=300&fit=crop"
                        alt="Candi Borobudur"
                        class="object-cover w-full transition-transform duration-300 h-80 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                        <h4 class="mb-2 text-2xl font-bold">Cintahku cuman kamu</h4>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span class="text-sm">2.5k+ Pengunjung</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Booking Steps --}}
    <section class="px-4 py-16 bg-white sm:px-6 lg:px-8 scroll-mt-10">
        <div class="mx-auto max-w-7xl">
            <div class="grid items-center gap-12 md:grid-cols-2">
                <div class="space-y-8">
                    <div>
                        <p class="mb-2 font-semibold tracking-wide uppercase text-cyan-600">Cara Pemesanan</p>
                        <h3 class="text-3xl font-bold text-slate-900 md:text-4xl">
                            Pesan Paket Wisata dalam 3 Langkah Mudah
                        </h3>
                    </div>

                    @foreach ($bookingSteps as $idx => $step)
                    <div class="flex gap-4">
                        <div
                            class="flex items-center justify-center flex-shrink-0 w-16 h-16 rounded-full bg-cyan-100 text-cyan-600">
                            {{-- kalau pakai blade-icon seperti blade-heroicons --}}
                            <x-dynamic-component :component="'heroicon-o-' . $step['icon']" class="w-8 h-8" />
                        </div>
                        <div>
                            <h4 class="mb-2 text-xl font-bold text-slate-900">{{ $step['title'] }}</h4>
                            <p class="text-slate-600">{{ $step['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=600&h=700&fit=crop"
                        alt="Booking Process" class="w-full shadow-2xl rounded-3xl" />
                </div>
            </div>
        </div>
    </section>


    {{-- Reviews Section --}}
    <section id="reviews" class="px-4 py-16 sm:px-6 lg:px-8 scroll-mt-10">
        <div class="mx-auto max-w-7xl">
            <div class="grid items-start gap-12 md:grid-cols-2">
                <div class="sticky top-24">
                    <p class="mb-4 font-semibold tracking-wide uppercase text-cyan-600">Testimoni</p>
                    <h3 class="text-4xl font-bold leading-tight text-slate-900 md:text-5xl">
                        Apa kata pelanggan kami sebelumnya?
                    </h3>
                </div>

                <div class="space-y-6">
                    @foreach ($reviews as $idx => $review)
                    <div class="p-6 bg-white shadow-lg rounded-2xl">
                        <div class="flex items-center gap-4 mb-4">
                            <img src="{{ $review['avatar'] }}" alt="{{ $review['name'] }}"
                                class="rounded-full w-14 h-14" />
                            <div class="flex-1">
                                <h4 class="font-bold text-slate-900">{{ $review['name'] }}</h4>
                                <div class="flex gap-1">
                                    @for ($i = 0; $i
                                    < $review['rating']; $i++)
                                        <x-heroicon-s-star class="w-4 h-4 text-yellow-400" />
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <p class="italic text-slate-600">"{{ $review['comment'] }}"</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    {{-- Partners Section --}}
    <section class="px-4 py-20 bg-white sm:px-6 lg:px-8 scroll-mt-10">
        <div class="py-10 mx-auto max-w-7xl">
            <div class="mb-12 text-center">
                <p class="mb-2 font-semibold tracking-wide uppercase text-cyan-600">Partner Terpercaya</p>
                <h3 class="text-3xl font-bold text-gray-900 md:text-4xl">Armada & Mitra Perjalanan</h3>
            </div>

            <div class="grid grid-cols-2 gap-8 md:grid-cols-5">
                @foreach ($partners as $idx => $partner)
                <div class="flex items-center justify-center p-6 transition bg-gray-50 rounded-xl hover:shadow-lg">
                    <div class="text-center">
                        <div
                            class="flex items-center justify-center w-16 h-16 mx-auto mb-2 text-2xl font-bold text-white rounded-full bg-cyan-500">
                            {{ $partner['logo'] }}
                        </div>
                        <p class="text-sm font-semibold text-gray-700">{{ $partner['name'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>