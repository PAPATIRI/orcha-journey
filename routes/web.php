<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;


Volt::route('/', 'public.homepage')->name('home');

Route::middleware(['auth'])->group(function () {
    Volt::route('/admin/dashboard', 'admin.dashboard')->name('dashboard');
    Volt::route('/admin/testimoni', 'admin.testimoni.index');
    Volt::route('/admin/testimoni/create', 'admin.testimoni.create');
    Volt::route('/admin/testimoni/{testimonial}/edit', 'admin.testimoni.edit');

    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

require __DIR__ . '/auth.php';
