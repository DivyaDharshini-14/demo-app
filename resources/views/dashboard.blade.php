<style>
    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out both;
    }
</style>
<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
{{--        <div class="grid auto-rows-min gap-4 md:grid-cols-3">--}}
{{--            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">--}}
{{--                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />--}}
{{--            </div>--}}
{{--            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">--}}
{{--                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />--}}
{{--            </div>--}}
{{--            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">--}}
{{--                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">--}}
{{--            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />--}}
{{--        </div>--}}

        <!-- Grid with animated cards -->
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <!-- Card 1 -->
            <div class="relative rounded-xl border border-neutral-200 dark:border-neutral-700 p-4
                bg-gradient-to-br from-blue-200 to-blue-500 dark:from-blue-800 dark:to-blue-600
                text-white shadow-md transition-all duration-300 hover:scale-105 hover:shadow-lg animate-fade-in-up">
                <h3 class="text-lg font-bold">Bachelor of Computer Applications</h3>
                <p class="text-sm mt-1">XYZ University, 2018 - 2021</p>
                <p class="mt-2">Specialized in Web Development and Data Structures.</p>
            </div>

            <!-- Card 2 -->
            <div class="relative rounded-xl border border-neutral-200 dark:border-neutral-700 p-4
                bg-gradient-to-br from-green-200 to-green-500 dark:from-green-800 dark:to-green-600
                text-white shadow-md transition-all duration-300 hover:scale-105 hover:shadow-lg animate-fade-in-up delay-100">
                <h3 class="text-lg font-bold">Higher Secondary (12th Grade)</h3>
                <p class="text-sm mt-1">ABC Higher Secondary School, 2016 - 2018</p>
                <p class="mt-2">Studied Physics, Chemistry, Mathematics with Computer Science.</p>
            </div>

            <!-- Card 3 -->
            <div class="relative rounded-xl border border-neutral-200 dark:border-neutral-700 p-4
                bg-gradient-to-br from-purple-200 to-purple-500 dark:from-purple-800 dark:to-purple-600
                text-white shadow-md transition-all duration-300 hover:scale-105 hover:shadow-lg animate-fade-in-up delay-200">
                <h3 class="text-lg font-bold">High School (10th Grade)</h3>
                <p class="text-sm mt-1">LMN School, 2014 - 2016</p>
                <p class="mt-2">Focused on core subjects and basic computer literacy.</p>
            </div>
        </div>


        <!-- Full height animated card -->
        <!-- Include Alpine.js -->

        <!-- Slider Container -->
        <div class="relative h-64 flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-gray-100 dark:bg-neutral-800 mt-4"
             x-data="{
        images: [
          'https://source.unsplash.com/random/800x300?technology',
          'https://source.unsplash.com/random/800x300?education',
          'https://source.unsplash.com/random/800x300?code'
        ],
        activeIndex: 0,
        interval: null,
        startSlider() {
            this.interval = setInterval(() => {
                this.activeIndex = (this.activeIndex + 1) % this.images.length;
            }, 3000);
        },
        stopSlider() {
            clearInterval(this.interval);
            this.interval = null;
        }
     }"
             x-init="startSlider"
             @mouseover="stopSlider" @mouseleave="startSlider"
        >
            <!-- Images -->
            <template x-for="(image, index) in images" :key="index">
                <div x-show="activeIndex === index" x-transition
                     class="absolute inset-0 bg-cover bg-center"
                     :style="`background-image: url(${image})`">
                </div>
            </template>

            <!-- Dots Navigation -->
            <div class="absolute bottom-3 left-1/2 transform -translate-x-1/2 flex space-x-2">
                <template x-for="(image, index) in images" :key="index">
                    <button @click="activeIndex = index"
                            :class="activeIndex === index ? 'bg-white' : 'bg-white/50'"
                            class="w-3 h-3 rounded-full transition-colors duration-300"></button>
                </template>
            </div>
        </div>


    </div>
</x-layouts.app>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
