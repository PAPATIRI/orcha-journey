<?php

use App\Models\DestinationPopuler;
use App\Models\DestinationPopulerk;
use App\Models\Partner;
use App\Models\Testimoni;
use App\Models\TravelPackage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new #[Layout('components.layouts.guest')] #[Title('Orca Journey')] class extends Component {
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

    public function with()
    {
        return [
            'packages' => TravelPackage::limit(3)->get(),
            'topDestinations' => DestinationPopuler::limit(3)->get(),
            'bookingSteps' => $this->bookingSteps,
            'testimonials' => Testimoni::limit(3)->get(),
            'partners' => Partner::all(),
        ];
    }
}; ?>

<div>
    {{-- whatsapp button --}}
    <div class="fixed bottom-10 right-10 z-50">
        <a href="https://wa.me/6289509882219?text=Halo%20min,%20saya%20ingin%20memesan%20produk%20Anda." target="_blank"
            rel="noopener noreferrer"
            class="fixed bottom-10 right-10 z-50 bg-green-700 rounded-full p-3 shadow-lg hover:scale-110 transition-transform duration-300">
            <x-bi-whatsapp class="h-8 w-8 text-white" />
        </a>
    </div>
    {{-- hero section --}}
    <section data-aos="fade-down" id="home" class="px-4 pt-24 pb-16 sm:px-6 lg:px-8 scroll-mt-10">
        <div class="mx-auto max-w-7xl rounded-3xl overflow-hidden relative h-[450px] md:h-[650px]">
            <img src="{{ asset('/images/pantai-wide.jpg') }}" class="h-full w-full object-cover" alt="">
            <div class="bg-linear-to-r z-10 from-cyan-500/60 to-black/60 absolute inset-0 backdrop-blur-xs"></div>
            <div data-aos="zoom-in" data-aos-delay="300"
                class="absolute z-20 grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-10 items-center justify-center inset-0 px-20">
                <div class="overflow-hidden rounded-3xl h-[60%] relative">
                    <img src="{{ asset('/images/laut.jpg') }}" class="h-full w-full object-cover" alt="">
                    <div class="absolute inset-0 bg-black/10"></div>
                </div>
                <div class="overflow-hidden rounded-3xl h-[60%] relative">
                    <img src="{{ asset('/images/pantai-atas.jpg') }}" class="h-full w-full object-cover" alt="">
                    <div class="absolute inset-0 bg-black/10"></div>
                </div>
                <div class="overflow-hidden rounded-3xl h-[60%] relative hidden md:block">
                    <img src="{{ asset('/images/pantai-ramai.jpg') }}" class="h-full w-full object-cover"
                        alt="">
                    <div class="absolute inset-0 bg-black/10"></div>
                </div>
                <div class="overflow-hidden rounded-3xl h-[60%] relative hidden md:block">
                    <img src="{{ asset('/images/gapura.jpg') }}" class="h-full w-full object-cover" alt="">
                    <div class="absolute inset-0 bg-black/10"></div>
                </div>

            </div>
            <div data-aos="zoom-in" data-aos-delay="400" class="absolute z-50 flex items-center inset-0 ">
                <div class="bg-black/30 py-10 md:py-12 lg:py-14 text-center w-full">
                    <p
                        class="main-text text-xl font-bold tracking-wide md:text-3xl lg:text-5xl text-white max-w-[70%] md:max-w-[50%] lg:max-w-[33%] mx-auto">
                        Would
                        you like
                        to explore
                        <span
                            class="highlight text-orange-300 font-semibold italic text-xl md:text-3xl lg:text-5xl">with
                            us?</span>
                    </p>
                    <div class="flex gap-4 items-center justify-center mt-5">
                        <a href="#packages"
                            class="px-8 py-3 transition-all duration-300 font-semibold text-center text-white rounded-full bg-orange-300 hover:bg-orange-400">
                            Lihat Paket
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Packages Section -->
    <section id="packages" class="px-4 py-16 sm:px-6 lg:px-8 sroll-mt-10">
        <div class="mx-auto max-w-7xl">
            <div data-aos="zoom-in" delay="200" class="mb-12 text-center">
                <p class="mb-2 font-semibold tracking-wider uppercase text-orange-300">
                    Paket Wisata</p>
                <h3 class="text-3xl font-bold text-slate-900 md:text-4xl">Pilihan Paket Bundling</h3>
                <p class="max-w-2xl mx-auto mt-4 text-slate-600">
                    Kami menyediakan berbagai paket wisata yang dapat disesuaikan dengan kebutuhan Anda
                </p>
            </div>

            <div data-aos="zoom-in" data-aos-delay="300" class="grid gap-8 md:grid-cols-3">
                @foreach ($packages as $package)
                    <div
                        class="relative overflow-hidden transition-all bg-white shadow-lg rounded-3xl hover:shadow-2xl
            {{ $package->is_best_choice ? 'ring-4 ring-orange-300 md:scale-105 transform' : '' }}">
                        @if ($package->is_best_choice)
                            <div
                                class="absolute top-0 right-0 px-4 py-1 text-sm font-semibold text-white rounded-bl-lg bg-orange-300">
                                BEST CHOICE
                            </div>
                        @endif

                        <div class="p-10 flex flex-col justify-between h-full">
                            <div>
                                <h4 class="mb-2 text-2xl font-bold text-slate-900">{{ $package->name }}</h4>

                                <div class="mb-6">
                                    <div class="flex items-baseline gap-2">
                                        <span
                                            class="text-3xl font-bold {{ $package->is_best_choice ? 'text-orange-300' : 'text-cyan-600' }}">
                                            Rp {{ number_format($package->price, 0, ',', '.') }}
                                        </span>
                                    </div>

                                    @if ($package->original_price > 0)
                                        <span class="text-sm line-through text-slate-400">
                                            Rp {{ number_format($package->original_price, 0, ',', '.') }}
                                        </span>
                                    @endif

                                    @if ($package->discount_percentage)
                                        <div
                                            class="inline-block px-2 py-1 ml-2 text-xs font-semibold text-red-600 bg-red-100 rounded">
                                            Hemat {{ $package->discount_percentage }}%
                                        </div>
                                    @endif
                                </div>

                                <div class="mb-6 space-y-3">
                                    <p class="font-semibold text-slate-900">Destinasi Wisata:</p>
                                    @foreach ($package->destination_list ?? [] as $destination)
                                        <div class="flex items-start gap-2">
                                            <svg class="w-5 h-5 flex-shrink-0 mt-0.5 {{ $package->is_best_choice ? 'text-orange-300' : 'text-cyan-500' }}"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="text-slate-600">{{ $destination }}</span>
                                        </div>
                                    @endforeach

                                </div>
                            </div>

                            <div class="text-center w-full">
                                <a href="https://wa.me/6289509882219?text=Halo%20min,%20saya%20ingin%20memesan%20produk%20Anda."
                                    target="_blank" rel="noopener noreferrer"
                                    class="cursor-pointer block py-3 transition-all duration-300 w-full font-semibold rounded-full
                        {{ $package->is_best_choice
                            ? 'text-white bg-orange-300 hover:bg-orange-400'
                            : 'bg-cyan-100 text-cyan-700 hover:bg-cyan-200' }}">
                                    Pesan Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Top Destinations -->
    <section id="destinations" class="px-4 py-16 sm:px-6 lg:px-8 scroll-mt-10 mb-20">
        <div class="mx-auto max-w-7xl">
            <div data-aos="zoom-in" data-aos-delay="200" class="mb-12 text-center">
                <p class="mb-2 font-semibold tracking-wide uppercase text-orange-300">Destinasi Populer
                </p>
                <h3 class="text-3xl font-bold text-gray-900 md:text-4xl">Tempat Wisata Favorit</h3>
            </div>

            <div data-aos="zoom-in" data-aos-delay="300" class="grid gap-8 md:grid-cols-3">
                <!-- Destination 1 -->
                @foreach ($topDestinations as $destination)
                    <div class="relative overflow-hidden shadow-lg cursor-pointer group rounded-3xl min-h-[550px]">
                        <img src="{{ $destination->foto }}" alt="{{ $destination->destination_name }} picture"
                            class="object-cover w-full transition-transform duration-300 h-full group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-cyan-500/20"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-10 text-white">
                            <h4 class="mb-2 text-2xl font-bold">{{ $destination->destination_name }}</h4>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <span class="text-sm">{{ shortNumber($destination->total_visitor) }} Pengunjung</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- {{-- Booking Steps --}} -->
    <section id="steps"
        class="bg-linear-to-tr from-cyan-500/10 to-cyan-500/20 px-4 py-16 bg-white sm:px-6 lg:px-8 scroll-mt-20">
        <div class="mx-auto max-w-7xl">
            <div class="grid items-center gap-12 md:grid-cols-5">
                <div data-aos="zoom-in" data-aos-delay="200" class="space-y-8 col-span-2">
                    <div>
                        <p class="mb-2 font-semibold tracking-wide uppercase text-orange-300">Cara Pemesanan</p>
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
                <div data-aos="zoom-in" data-aos-delay="200"
                    class="relative col-span-3 h-[620px] overflow-hidden shadow-2xl rounded-3xl bg-slate-300">
                    <img src="{{ asset('/images/pantai-pinggir-laut.jpg') }}" alt="Booking Process"
                        class="h-full scale-150 object-center" />
                    <div
                        class="absolute inset-0 bg-linear-to-r from-cyan-500/50 to-black/40 flex items-center justify-center gap-4 lg:gap-12">
                        <div data-aos="fade-right" data-aos-delay="300">
                            <p
                                class="text-2xl/10 lg:text-4xl/12 text-main text-white tracking-widest uppercase font-semibold">
                                orcha
                                <br /> journey
                            </p>
                        </div>
                        <div data-aos="fade-left" data-aos-delay="300"
                            class="border-l-2 border-l-white text-white tracking-widest text-xl/10 lg:text-2xl/12 font-medium uppercase ps-4 lg:ps-12">
                            <p>trusted</p>
                            <p>affordable prices</p>
                            <p>your travel buddies</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- galery sections --}}
    <section id="gallery" class="px-4 py-16 bg-white sm:px-6 lg:px-8 scroll-mt-10 mb-20">
        <div class="mx-auto max-w-7xl rounded-lg overflow-hidden relative">
            <div data-aos="zoom-in" data-aos-delay="200" class="mb-12 text-center">
                <p class="mb-2 font-semibold tracking-wide uppercase text-orange-300">Galeri Wisata</p>
                <h3 class="text-3xl font-bold text-gray-900 md:text-4xl">Foto-foto Keindahan Yogyakarta</h3>
            </div>
            <div
                class="grid gap-4 grid-cols-2 md:grid-cols-3 lg:grid-cols-4 justify-items-center justify-center inset-0 px-20">
                <div data-aos="zoom-in" data-aos-delay="200" class="overflow-hidden rounded-3xl h-[100%] group">
                    <img src="{{ asset('/images/web1.png') }}"
                        class="h-full group-hover:scale-110 transition-all duration-300 w-full object-contain rounded-3xl"
                        alt="">
                </div>
                <div data-aos="zoom-in" data-aos-delay="300" class="overflow-hidden rounded-3xl h-[100%] group">
                    <img src="{{ asset('/images/web9.png') }}"
                        class="h-full group-hover:scale-110 transition-all duration-300 w-full object-contain rounded-3xl"
                        alt="">
                </div>
                <div data-aos="zoom-in" data-aos-delay="400" class="overflow-hidden rounded-3xl h-[100%] group">
                    <img src="{{ asset('/images/web10.png') }}"
                        class="h-full group-hover:scale-110 transition-all duration-300 w-full object-contain rounded-3xl"
                        alt="">
                </div>
                <div data-aos="zoom-in" data-aos-delay="500" class="overflow-hidden rounded-3xl h-[100%] group">
                    <img src="{{ asset('/images/web11.png') }}"
                        class="h-full group-hover:scale-110 transition-all duration-300 w-full object-contain rounded-3xl"
                        alt="">
                </div>
            </div>
        </div>
    </section>

    <!-- {{-- Reviews Section --}} -->
    <section id="reviews" class="px-4 py-16 sm:px-6 lg:px-8 scroll-mt-40 relative">
        <div class="absolute z-10 inset-0 overflow-hidden">
            <img src="{{ asset('/images/pantai-atas.jpg') }}" class="w-full h-full object-cover" alt="">
        </div>
        <div
            class="absolute z-20 inset-0 bg-linear-to-br from-black/70 to-cyan-500/50 flex items-center justify-center">
            <img data-aos="zoom-in" data-aos-delay="100" src="{{ asset('/orcha-logo.png') }}"
                class="h-[300px] w-[300px]" alt="">
        </div>
        <div class="mx-auto max-w-7xl relative z-40">
            <div class="grid items-start gap-12 md:grid-cols-2">
                <div data-aos="zoom-in" data-aos-delay="200" class="sticky top-24">
                    <p class="mb-4 font-semibold tracking-wide uppercase text-orange-300">Testimoni</p>
                    <h3 class="text-4xl font-bold leading-tight text-white md:text-5xl">
                        Apa kata pelanggan kami sebelumnya?
                    </h3>
                </div>

                <div data-aos="fade-left" data-aos-delay="200" class="space-y-6">
                    @foreach ($testimonials as $idx => $testimoni)
                        <div class="p-6 bg-white/30 backdrop-blur-lg shadow-lg rounded-3xl">
                            <div class="flex items-center gap-4 mb-4">
                                @if ($testimoni->avatar)
                                    <img src="{{ $testimoni->avatar }}" alt="{{ $testimoni->avatar }}"
                                        class="rounded-full w-14 h-14 object-cover" />
                                @else
                                    <x-heroicon-o-user-circle class="text-slate-100 h-14 w-14 rounded-full " />
                                @endif
                                <div class="flex-1">
                                    <h4 class="font-bold text-white">{{ $testimoni->customer_name }}</h4>
                                    <div class="flex gap-1">
                                        @for ($i = 0; $i < $testimoni->rating; $i++)
                                            <x-heroicon-s-star class="w-4 h-4 text-orange-300" />
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <p class="italic text-slate-100">"{{ $testimoni->testimonial }}"</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- {{-- Partners Section --}} -->
    <section class="px-4 py-20 bg-white sm:px-6 lg:px-8 scroll-mt-10">
        <div class="py-10 mx-auto max-w-7xl">
            <div data-aos="zoom-in" data-aos-delay="200" class="mb-12 text-center">
                <p class="mb-2 font-semibold tracking-wide uppercase text-orange-300">Partner Terpercaya</p>
                <h3 class="text-3xl font-bold text-gray-900 md:text-4xl">Armada & Mitra Perjalanan</h3>
            </div>

            <div class="flex flex-wrap items-center gap-4 justify-center" data-aos="zoom-in" data-aos-delay="300">
                @foreach ($partners as $partner)
                    <div
                        class="flex items-center justify-center py-6 px-10 transition bg-gray-50 rounded-3xl hover:shadow-lg">
                        <div class="text-center">
                            <div
                                class="flex items-center justify-center w-16 h-16 mx-auto mb-2 text-2xl font-bold text-white rounded-full bg-cyan-500 overflow-hidden">
                                @if ($partner->foto)
                                    <img src="{{ $partner->foto }}" alt=""
                                        class="w-full h-full object-cover">
                                @else
                                    <p>{{ $partner->initials() }}</p>
                                @endif
                            </div>
                            <p class="text-sm font-semibold text-gray-700">{{ $partner->partner_name }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
