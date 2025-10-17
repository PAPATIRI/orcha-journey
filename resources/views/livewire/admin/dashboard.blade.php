<?php

use App\Models\Partner;
use App\Models\Testimoni;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
    #[Layout('components.layouts.admin')]
    #[Title('Orca Journey | Dashboard')]
    class extends Component {
        public function with(): array
        {
            return [
                "partners" => Partner::all()->count(),
                "reviews" => Testimoni::all()->count(),
            ];
        }
    }; ?>

<div class="mt-10">
    <div class="grid gap-4 grid-cols-12">
        <div class="p-4 col-span-12 md:col-span-6 lg:col-span-4 rounded-lg bg-white">
            <p>helo admin</p>
        </div>
        <div class="p-4 col-span-12 md:col-span-6 lg:col-span-4 rounded-lg bg-white">
            <p>helo admin</p>
        </div>
        <div class="p-4 col-span-12 md:col-span-6 lg:col-span-4 rounded-lg bg-white">
            <p>helo admin</p>
        </div>
    </div>
</div>