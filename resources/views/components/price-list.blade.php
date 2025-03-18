
<section class="tw-w-full tw-py-20 tw-px-6 lg:tw-px-12 tw-relative tw-overflow-hidden" data-aos="fade-up">
    <!-- Background Elements -->
    <div class="tw-absolute tw-bottom-40 -tw-right-20 tw-w-60 tw-h-60 tw-bg-primary-100 tw-rounded-full tw-filter tw-blur-[100px] tw-opacity-40 tw-animate-float" style="animation-delay: 0.5s;"></div>
    
    <div class="tw-max-w-7xl tw-mx-auto">
        <div class="tw-flex tw-flex-col tw-items-center tw-mb-14" data-aos="fade-up">
            <!-- Section Badge -->
            <div class="tw-bg-primary tw-bg-opacity-10 tw-backdrop-blur-sm tw-rounded-full tw-px-4 tw-py-1.5 tw-flex tw-items-center tw-justify-center tw-mb-4 tw-border tw-border-primary-200">
                <span class="tw-text-primary tw-font-semibold tw-text-sm">Price List</span>
            </div>
            
            <!-- Heading -->
            <h2 class="tw-text-3xl md:tw-text-4xl tw-font-bold tw-text-center tw-text-gray-900 tw-mb-4">
                Layanan <span class="text-gradient">Terbaik </span>dengan Harga Terbaik
            </h2>
            
            <!-- Subheading -->
            <p class="tw-text-lg tw-text-gray-600 tw-text-center tw-max-w-2xl">
                Temukan harga kompetitif untuk layanan SMM premium di berbagai platform sosial media. Dapatkan kualitas terbaik tanpa khawatir melebihi budget!
            </p>
        </div>
        
        <!-- Carousel -->
        <div class="tw-relative tw-w-full tw-overflow-hidden" data-aos="fade-up" data-aos-delay="200">
            <div class="tw-flex tw-gap-6 tw-py-4 tw-animate-carousel">
                @php
                $services = [
                    [
                        'id' => 1,
                        'name' => 'Facebook',
                        'icon' => 'facebook',
                        'startingPrice' => 'Rp. 1,000'
                    ],
                    [
                        'id' => 2,
                        'name' => 'Instagram',
                        'icon' => 'instagram',
                        'startingPrice' => 'Rp. 1,000'
                    ],
                    [
                        'id' => 3,
                        'name' => 'Twitter',
                        'icon' => 'twitter',
                        'startingPrice' => 'Rp. 1,000'
                    ],
                    [
                        'id' => 4,
                        'name' => 'YouTube',
                        'icon' => 'youtube',
                        'startingPrice' => 'Rp. 1,000'
                    ],
                    [
                        'id' => 5,
                        'name' => 'Twitch',
                        'icon' => 'twitch',
                        'startingPrice' => 'Rp. 1,000'
                    ],
                    [
                        'id' => 6,
                        'name' => 'TikTok',
                        'icon' => 'tiktok',
                        'startingPrice' => 'Rp. 1,000'
                    ],
                    [
                        'id' => 7,
                        'name' => 'Website',
                        'icon' => 'globe',
                        'startingPrice' => 'Rp. 1,000'
                    ]
                ];
                
                // Double the services for smoother infinite loop
                $allServices = array_merge($services, $services);
                @endphp
                
                @foreach($allServices as $index => $service)
                    <div data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                        <x-price-card :service="$service" :key="$service['id'] . '-' . $index" />
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
