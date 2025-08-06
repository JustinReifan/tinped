
@props(['feature'])

<div class="tw-group tw-relative tw-overflow-hidden">
    <!-- Inner glow effect -->
    <div class="tw-absolute tw-inset-0 tw-bg-gradient-to-br tw-from-primary-100/50 tw-via-primary-50/30 tw-to-transparent tw-opacity-0 group-hover:tw-opacity-100 tw-transition-opacity tw-duration-500 tw-rounded-xl"></div>
    
    <!-- Card content -->
    <div class="tw-bg-white tw-p-6 tw-rounded-xl tw-shadow-sm group-hover:tw-shadow-glow-primary tw-border tw-border-primary-50 group-hover:tw-border-primary-200 tw-transition-all tw-duration-300 tw-relative tw-z-10">
        <div class="tw-w-12 tw-h-12 tw-rounded-full tw-bg-primary-100 tw-flex tw-items-center tw-justify-center tw-mb-4 tw-relative tw-z-10">
            <x-dynamic-component :component="'icons.' . $feature['icon']" class="tw-w-6 tw-h-6 tw-text-primary-500" />
        </div>
        <h3 class="tw-text-xl tw-font-semibold tw-text-gray-800 tw-mb-2 tw-relative tw-z-10">{{ $feature['title'] }}</h3>
        <p class="tw-text-gray-600 tw-relative tw-z-10">{{ $feature['description'] }}</p>
    </div>
</div>
