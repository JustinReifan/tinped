
<section class="tw-w-full tw-py-20 tw-px-6 lg:tw-px-12 tw-relative tw-overflow-hidden tw-bg-gray-50/80">
    <!-- Background Elements -->
    <div class="tw-absolute tw-inset-0 tw-bg-grid tw-bg-[size:40px_40px] tw-opacity-30 tw-z-0"></div>
    <div class="tw-absolute tw-top-40 -tw-right-20 tw-w-60 tw-h-60 tw-bg-primary-100 tw-rounded-full tw-filter tw-blur-[100px] tw-opacity-50 tw-animate-float"></div>
    
    <div class="tw-max-w-7xl tw-mx-auto tw-relative tw-z-10">
        <div class="tw-flex tw-flex-col tw-items-center tw-mb-14">
            <div class="tw-bg-primary tw-bg-opacity-10 tw-backdrop-blur-sm tw-rounded-full tw-px-4 tw-py-1.5 tw-flex tw-items-center tw-justify-center tw-mb-4 tw-border tw-border-primary-200">
                <span class="tw-text-primary tw-font-semibold tw-text-sm">Testimonials</span>
            </div>

            <!-- Heading -->
            <h2 class="tw-text-3xl md:tw-text-4xl tw-font-bold tw-text-center tw-text-gray-900 tw-mb-4">
                See what our <span class="text-gradient">56k+ Customers</span> have to say about us
            </h2>
            
            <!-- Subheading -->
            <p class="tw-text-lg tw-text-gray-600 tw-text-center tw-max-w-2xl">
                Real stories from real customers who have transformed their social media presence
            </p>
        </div>
        
        <!-- Testimonials Grid -->
        <div class="tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 lg:tw-grid-cols-3 tw-gap-6">
            @php
            $testimonials = [
                [
                    "id" => 1,
                    "text" => "TINPED SMM has truly revolutionized my social media marketing strategy. The followers I gained are real and engaged with my content!",
                    "name" => "Sarah Johnson",
                    "role" => "Digital Marketer",
                    "image" => "https://randomuser.me/api/portraits/women/1.jpg"
                ],
                [
                    "id" => 2,
                    "text" => "I've tried many SMM panels before, but TINPED stands out with its quality and customer service. My YouTube channel grew exponentially!",
                    "name" => "Michael Chen",
                    "role" => "Content Creator",
                    "image" => "https://randomuser.me/api/portraits/men/2.jpg"
                ],
                [
                    "id" => 3,
                    "text" => "As a small business owner, I needed affordable yet effective social media solutions. TINPED SMM delivered beyond my expectations.",
                    "name" => "Jessica Williams",
                    "role" => "Boutique Owner",
                    "image" => "https://randomuser.me/api/portraits/women/3.jpg"
                ],
                [
                    "id" => 4,
                    "text" => "The speed of delivery is incredible. I placed an order and saw results within minutes. Will definitely use their services again!",
                    "name" => "David Rodriguez",
                    "role" => "Musician",
                    "image" => "https://randomuser.me/api/portraits/men/4.jpg"
                ],
                [
                    "id" => 5,
                    "text" => "TINPED SMM helped me grow my Instagram following by 10K in just one month. The engagement is fantastic and looks completely natural.",
                    "name" => "Emma Thompson",
                    "role" => "Lifestyle Influencer",
                    "image" => "https://randomuser.me/api/portraits/women/5.jpg"
                ],
                [
                    "id" => 6,
                    "text" => "Their customer support is exceptional. Any questions I had were answered promptly. A truly reliable service for growing your social presence.",
                    "name" => "James Wilson",
                    "role" => "Startup Founder",
                    "image" => "https://randomuser.me/api/portraits/men/6.jpg"
                ]
            ];
            @endphp

            @foreach($testimonials as $testimonial)
            <div class="tw-bg-white tw-p-6 tw-rounded-xl tw-shadow-sm hover:tw-shadow-glow-primary tw-border tw-border-primary-50 hover:tw-border-primary-200 tw-transition-all tw-duration-300 tw-flex tw-flex-col">
                <!-- Stars -->
                <div class="tw-flex tw-space-x-1 tw-mb-4">
                    @for($i = 0; $i < 5; $i++)
                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-w-4 tw-h-4 tw-fill-primary tw-text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                    @endfor
                </div>
                
                <!-- Testimonial Text -->
                <p class="tw-text-gray-700 tw-mb-6 tw-flex-1">{{ $testimonial['text'] }}</p>
                
                <!-- Customer Info -->
                <div class="tw-flex tw-items-center">
                    <div class="tw-w-10 tw-h-10 tw-rounded-full tw-overflow-hidden tw-mr-3">
                        <img 
                            src="{{ $testimonial['image'] }}" 
                            alt="{{ $testimonial['name'] }}"
                            class="tw-w-full tw-h-full tw-object-cover"
                        />
                    </div>
                    <div>
                        <h4 class="tw-font-semibold tw-text-gray-900">{{ $testimonial['name'] }}</h4>
                        <p class="tw-text-sm tw-text-gray-500">{{ $testimonial['role'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
