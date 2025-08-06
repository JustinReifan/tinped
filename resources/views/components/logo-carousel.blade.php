
<div class="tw-relative tw-w-full tw-py-4 tw-overflow-hidden">
    <div class="tw-relative tw-w-full">
        <!-- Carousel Container -->
        <div class="tw-inline-flex tw-animate-carousel">
            @php
            $socialPlatforms = [
                ['name' => 'Facebook', 'icon' => 'facebook'],
                ['name' => 'Instagram', 'icon' => 'instagram'],
                ['name' => 'Twitter', 'icon' => 'twitter'],
                ['name' => 'Youtube', 'icon' => 'youtube'],
                ['name' => 'Twitch', 'icon' => 'twitch'],
                ['name' => 'TikTok', 'icon' => 'tiktok'],
                ['name' => 'LinkedIn', 'icon' => 'linkedin'],
            ];
            
            // Double the platforms for smoother infinite loop
            $allPlatforms = array_merge($socialPlatforms, $socialPlatforms, $socialPlatforms);
            @endphp
            
            @foreach($allPlatforms as $index => $platform)
                <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-mx-8">
                    <div class="tw-w-12 tw-h-12 tw-flex tw-items-center tw-justify-center tw-rounded-full tw-bg-white tw-shadow-md tw-border tw-border-gray-100">
                        <x-dynamic-component :component="'social-icons.' . $platform['icon']" class="tw-w-6 tw-h-6" />
                    </div>
                    <span class="tw-text-xs tw-text-gray-600 tw-mt-2">{{ $platform['name'] }}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>
