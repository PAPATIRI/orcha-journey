<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title : config('app.name') }}</title>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/robsontenorio/mary@0.44.2/libs/currency/currency.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen font-sans antialiased bg-base-200">

    {{-- NAVBAR mobile only --}}
    <x-mary-nav sticky class="lg:hidden">
        <p>Orca Journey</p>
        <x-slot:actions>
            <label for="main-drawer" class="lg:hidden me-3">
                <x-mary-icon name="o-bars-3" class="cursor-pointer" />
            </label>
        </x-slot:actions>
    </x-mary-nav>

    {{-- MAIN --}}
    <x-mary-main>
        {{-- SIDEBAR --}}
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit">

            {{-- BRAND --}}
            <div class="flex items-center justify-center">
                <div class="h-24 w-24 overflow-hidden">
                    <img src="{{asset('/orca-logo.jpg')}}" class="w-full h-full object-cover" alt="">
                </div>
            </div>

            {{-- MENU --}}
            <x-mary-menu activate-by-route>
                <x-mary-menu-item title="Home" icon="o-sparkles" link="/admin/dashboard" />
                <x-mary-menu-item title="Testimoni" icon="o-chat-bubble-left-right" link="/admin/testimoni" />
                <x-mary-menu-item title="Partner" icon="o-user-group" link="/admin/partner" />
                <x-mary-menu-item title="Bundling Traveling" icon="o-cube" link="/admin/travel-package" />

                <x-mary-menu-sub title="Settings" icon="o-cog-6-tooth">
                    <x-mary-menu-item title="Wifi" icon="o-wifi" link="####" />
                    <x-mary-menu-item title="Archives" icon="o-archive-box" link="####" />
                </x-mary-menu-sub>
                </x-menu>
        </x-slot:sidebar>

        {{-- The `$slot` goes here --}}
        <x-slot:content>
            <div class="py-2 flex items-center justify-between">
                <div></div>
                @if($user = auth()->user())
                <div class="flex items-center gap-4">
                    <div>
                        <p class="text-slate-700 text-base">{{auth()->user()->name}}</p>
                        <p class="text-slate-600 text-sm">{{auth()->user()->email}}</p>
                    </div>
                    <x-mary-form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <x-mary-button as="button" type="submit" icon="o-power" class="w-full" data-test="logout-button" />
                    </x-mary-form>
                </div>
                @endif
            </div>
            {{ $slot }}
        </x-slot:content>
    </x-mary-main>

    {{-- TOAST area --}}
    <x-mary-toast />
</body>

</html>