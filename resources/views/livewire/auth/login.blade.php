<?php

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Features;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.empty')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        $user = $this->validateCredentials();

        if (Features::canManageTwoFactorAuthentication() && $user->hasEnabledTwoFactorAuthentication()) {
            Session::put([
                'login.id' => $user->getKey(),
                'login.remember' => $this->remember,
            ]);

            $this->redirect(route('two-factor.login'), navigate: true);

            return;
        }

        Auth::login($user, $this->remember);

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    /**
     * Validate the user's credentials.
     */
    protected function validateCredentials(): User
    {
        $user = Auth::getProvider()->retrieveByCredentials(['email' => $this->email, 'password' => $this->password]);

        if (! $user || ! Auth::getProvider()->validateCredentials($user, ['password' => $this->password])) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        return $user;
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email) . '|' . request()->ip());
    }
}; ?>

<div class="container mx-auto">
    <div class="flex flex-col gap-6 max-w-lg mx-auto my-auto pt-40">
        <div class="h-40 w-40 overflow-hidden self-center">
            <img src="{{asset('/orcha-logo.png')}}" class="object-cover h-full w-full" alt="">
        </div>
        <x-mary-form method="POST" wire:submit="login" class="flex flex-col gap-6">
            <!-- Email Address -->
            <x-mary-input wire:model="email" label="email" placeholder="email@example.com"></x-mary-input>

            <!-- Password -->
            <div class="relative">
                <x-mary-password wire:model="password" label="Password" type="password" placeholder="********" right></x-mary-password>

                @if (Route::has('password.request'))
                <x-mary-button class="btn-ghost" link="password.request">
                    {{ __('Forgot your password?') }}
                </x-mary-button>
                @endif
            </div>

            <!-- Remember Me -->
            <x-mary-checkbox wire:model="remember" label="Remember me"></x-mary-checkbox>

            <div class="flex items-center justify-end">
                <x-mary-button class="btn-primary w-full" type="submit">
                    {{ __('Log in') }}
                </x-mary-button>
            </div>
        </x-mary-form>

        @if (Route::has('register'))
        <div class="space-x-1 text-sm text-center rtl:space-x-reverse text-zinc-600 dark:text-zinc-400">
            <span>{{ __('Don\'t have an account?') }}</span>
            <x-mary-button link="register" class="btn-ghost">{{ __('Sign up') }}</x-mary-button>
        </div>
        @endif
    </div>
</div>