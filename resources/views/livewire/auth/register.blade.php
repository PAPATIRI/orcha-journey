<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.empty')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        Session::regenerate();

        $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="container mx-auto">
    <div class="flex flex-col gap-6 max-w-lg mx-auto my-auto pt-32">
        <div class="h-40 w-40 overflow-hidden self-center">
            <img src="{{asset('/orcha-logo.png')}}" class="object-cover h-full w-full" alt="">
        </div>
        <x-mary-form method="POST" wire:submit="register" class="flex flex-col gap-6">
            <!-- Name -->
            <x-mary-input wire:model="name" placeholder="nama lengkap" label="Nama Lenkap" />

            <!-- Email Address -->
            <x-mary-input wire:model="email" label="Email" placeholder="email@example.com" />

            <!-- Password -->
            <x-mary-password wire:model="password" label="Password" placeholder="********" right />

            <!-- Confirm Password -->
            <x-mary-password wire:model="password_confirmation" label="Confirm Password" placeholder="********" right />

            <div class="flex items-center justify-end">
                <x-mary-button class="btn-primary w-full" type="submit">
                    {{ __('Create account') }}
                </x-mary-button>
            </div>
        </x-mary-form>

        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
            <span>{{ __('Already have an account?') }}</span>
            <x-mary-button link="login" class="btn-ghost">{{ __('Log in') }}</x-mary-button>
        </div>
    </div>