
<section class="tw-w-full tw-py-20 tw-px-6 lg:tw-px-12 tw-relative tw-overflow-hidden">
    <!-- Background Elements -->
    <div class="tw-absolute tw-bottom-20 -tw-left-20 tw-w-40 tw-h-40 tw-bg-primary-200 tw-rounded-full tw-filter tw-blur-[80px] tw-opacity-40 tw-animate-float" style="animation-delay: 0.5s;"></div>
    
    <div class="tw-max-w-7xl tw-mx-auto">
        <div class="tw-flex tw-flex-col tw-items-center tw-mb-14">
            <!-- Section Badge -->
            <div class="tw-bg-primary tw-bg-opacity-10 tw-backdrop-blur-sm tw-rounded-full tw-px-4 tw-py-1.5 tw-flex tw-items-center tw-justify-center tw-mb-4 tw-border tw-border-primary-200">
                <span class="tw-text-primary tw-font-semibold tw-text-sm">Payment Methods</span>
            </div>
            
            <!-- Heading -->
            <h2 class="tw-text-3xl md:tw-text-4xl tw-font-bold tw-text-center tw-text-gray-900 tw-mb-4">
                Multiple <span class="text-gradient">Secure Payment</span> Options
            </h2>
            
            <!-- Subheading -->
            <p class="tw-text-lg tw-text-gray-600 tw-text-center tw-max-w-2xl">
                Choose from a variety of trusted payment methods for your convenience
            </p>
        </div>
        
        <!-- Payment Methods Grid -->
        <div class="tw-grid tw-grid-cols-2 sm:tw-grid-cols-4 lg:tw-grid-cols-8 tw-gap-4">
            @php
            $paymentMethods = [
                [
                    "id" => 1,
                    "name" => "Alfamart",
                    "image" => "./landing/assets/images/pay-method/alfamart.png"
                ],
                [
                    "id" => 2,
                    "name" => "Indomaret",
                    "image" => "./landing/assets/images/pay-method/indomart.png"
                ],
                [
                    "id" => 3,
                    "name" => "BCA VA",
                    "image" => "./landing/assets/images/pay-method/bcava.jpg"
                ],
                [
                    "id" => 4,
                    "name" => "Qris",
                    "image" => "./landing/assets/images/pay-method/qris.png"
                ],
                [
                    "id" => 5,
                    "name" => "Dana",
                    "image" => "./landing/assets/images/pay-method/danasymbol.png"
                ],
                [
                    "id" => 6,
                    "name" => "Ovo",
                    "image" => "./landing/assets/images/pay-method/ovosymbol.png"
                ],
                [
                    "id" => 7,
                    "name" => "BRI VA",
                    "image" => "./landing/assets/images/pay-method/briva.jpg"
                ],
                [
                    "id" => 8,
                    "name" => "Shopeepay",
                    "image" => "./landing/assets/images/pay-method/shopeepay.png"
                ]
            ];
            @endphp

            @foreach($paymentMethods as $method)
            <div class="tw-bg-white tw-rounded-xl tw-p-4 tw-shadow-sm hover:tw-shadow-glow-primary tw-border tw-border-primary-50 hover:tw-border-primary-200 tw-transition-all tw-duration-300 tw-flex tw-flex-col tw-items-center tw-justify-center">
                <div class="tw-w-12 tw-h-12 tw-relative tw-mb-2">
                    @if($method['image'])
                    <img 
                        src="{{ $method['image'] }}" 
                        alt="{{ $method['name'] }}"
                        class="tw-w-full tw-h-full tw-object-contain"
                    />
                    @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-w-full tw-h-full tw-text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                        <line x1="1" y1="10" x2="23" y2="10"></line>
                    </svg>
                    @endif
                </div>
                <p class="tw-text-sm tw-font-medium tw-text-gray-700">{{ $method['name'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
