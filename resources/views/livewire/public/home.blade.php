<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new #[Layout('components.layouts.new')] #[Title('Orcha Journey')] class extends Component
{
    //
}; ?>

<div>
    <section class="slider">
        <div class="list">
            <div class="item active">
                <div class="image" style="--url: url('/public/images/pantai-atas.jpg')"></div>
                <div class="content">
                    <h2>Slider Image Magic</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit autem incidunt quo ab. Officiis.</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo, tenetur.</p>
                </div>
            </div>
            <div class="item">
                <div class="image" style="--url: url('/public/images/pantai-pinggir.jpg')"></div>
                <div class="content">
                    <h2>Slider Image Magic</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit autem incidunt quo ab. Officiis.</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo, tenetur.</p>
                </div>
            </div>
            <div class="item">
                <div class="image" style="--url: url('/public/images/pantai-senja.jpg')"></div>
                <div class="content">
                    <h2>Slider Image Magic</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit autem incidunt quo ab. Officiis.</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo, tenetur.</p>
                </div>
            </div>
            <div class="arrows">
                <button id="prev">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7" />
                    </svg>

                </button>
                <button id="next">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
                    </svg>

                </button>
            </div>
        </div>
    </section>
</div>