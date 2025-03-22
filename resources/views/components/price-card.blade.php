@props(['service', 'key'])

<div class="tw-flex tw-flex-row tw-items-center tw-justify-between tw-bg-white tw-rounded-xl tw-p-4 sm:tw-p-6 tw-shadow-sm hover:tw-shadow-glow-primary tw-border tw-border-primary-100 hover:tw-border-primary-300 tw-transition-all tw-duration-300 tw-w-[260px] sm:tw-w-[320px] md:tw-w-[380px]">
    <!-- Left Side - Service Info -->
    <div class="tw-flex tw-items-center tw-space-x-2 sm:tw-space-x-3 tw-flex-1">
        <!-- Icon with background -->
        <div class="tw-w-10 tw-h-10 sm:tw-w-12 sm:tw-h-12 tw-flex tw-items-center tw-justify-center tw-rounded-full tw-bg-primary-100">
            <span class="tw-text-primary-600">
                <x-dynamic-component :component="'social-icons.' . $service['icon']" class="tw-w-5 tw-h-5 sm:tw-w-6 sm:tw-h-6" />
            </span>
        </div>
        
        <!-- Service Name -->
        <div>
            <h3 class="tw-font-semibold tw-text-sm sm:tw-text-base tw-text-gray-900">{{ $service['name'] }}</h3>
            <p class="tw-text-xs sm:tw-text-sm tw-text-gray-500">Services</p>
        </div>
    </div>
    
    <!-- Right Side - Price -->
    <div class="tw-text-right tw-ml-4 sm:tw-ml-8">
        <p class="tw-text-xs tw-text-gray-500">Mulai</p>
        <p class="tw-font-bold tw-text-xs sm:tw-text-sm tw-text-primary">{{ $service['startingPrice'] }}</p>
    </div>
</div>
