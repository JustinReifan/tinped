
@props(['step'])

<div class="tw-group tw-relative tw-h-full">
    <!-- Card -->
    <div class="tw-h-full tw-flex tw-flex-col tw-relative tw-z-10 tw-bg-white tw-rounded-xl tw-overflow-hidden tw-p-6 tw-border tw-border-primary-100 hover:tw-border-primary-300 tw-shadow-sm hover:tw-shadow-glow-primary tw-transition-all tw-duration-300">
        <!-- Inner Glow Effect -->
        <div class="tw-absolute tw-inset-0 tw-bg-gradient-to-br tw-from-primary-100/30 tw-to-transparent tw-opacity-0 group-hover:tw-opacity-100 tw-transition-opacity tw-duration-500"></div>
        
        <!-- Step Number Circle -->
        <div class="tw-absolute tw-top-4 tw-right-4 tw-w-8 tw-h-8 tw-rounded-full tw-bg-primary-100 tw-flex tw-items-center tw-justify-center tw-z-10">
            <span class="tw-text-primary-600 tw-font-semibold">{{ $step['id'] }}</span>
        </div>
        
        <!-- Icon -->
        <div class="tw-mb-4 tw-relative tw-z-10">
            <x-dynamic-component :component="'icons.' . $step['icon']" class="tw-w-8 tw-h-8 tw-text-primary-500" />
        </div>
        
        <!-- Content -->
        <h3 class="tw-text-xl tw-font-semibold tw-text-gray-800 tw-mb-2 tw-relative tw-z-10">{{ $step['title'] }}</h3>
        
        <!-- Description (hidden until hover) -->
        <p class="tw-mt-2 tw-text-gray-600 tw-opacity-0 tw-max-h-0 group-hover:tw-opacity-100 group-hover:tw-max-h-40 tw-transition-all tw-duration-300 tw-overflow-hidden tw-relative tw-z-10">
            {{ $step['description'] }}
        </p>
    </div>
    
    <!-- Card Background Glow (visible on hover) -->
    <div class="tw-absolute tw-inset-0 tw-bg-primary-50 tw-rounded-xl tw-scale-95 tw-opacity-0 group-hover:tw-scale-105 group-hover:tw-opacity-70 tw-transition-all tw-duration-300 tw-z-0"></div>
</div>
