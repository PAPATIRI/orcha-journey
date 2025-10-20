<div x-show="showLoading"
    class="fixed inset-0 z-[999] bg-white/95 backdrop-blur-sm flex items-center justify-center"
    style="display: none;">

    <div class="flex flex-col items-center justify-center gap-6">
        <!-- Spinner Animation -->
        <div class="relative w-16 h-16 md:w-20 md:h-20">
            <div class="absolute inset-0 rounded-full border-4 border-transparent border-t-cyan-500 border-r-cyan-500 animate-spin"></div>
            <div class="absolute inset-2 rounded-full border-4 border-transparent border-b-orange-300 animate-spin" style="animation-direction: reverse; animation-duration: 1.5s;"></div>
        </div>

        <!-- Loading Text -->
        <div class="text-center">
            <p class="text-lg md:text-xl font-semibold text-gray-800">
                Loading Your Adventure...
            </p>
            <p class="text-sm md:text-base text-gray-600 mt-2">
                <span x-text="loadingProgress"></span>%
            </p>
        </div>

        <!-- Progress Bar -->
        <div class="w-48 md:w-64 h-2 bg-gray-200 rounded-full overflow-hidden">
            <div :style="`width: ${loadingProgress}%`"
                class="h-full bg-gradient-to-r from-cyan-500 to-orange-300 transition-all duration-300"></div>
        </div>
    </div>
</div>