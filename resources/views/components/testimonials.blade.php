
<section class="tw-w-full tw-py-20 tw-px-6 lg:tw-px-12 tw-relative tw-overflow-hidden tw-bg-gray-50/80">
    <!-- Background Elements -->
    <div class="tw-absolute tw-inset-0 tw-bg-grid tw-bg-[size:40px_40px] tw-opacity-30 tw-z-0"></div>
    <div class="tw-absolute tw-top-40 -tw-right-20 tw-w-60 tw-h-60 tw-bg-primary-100 tw-rounded-full tw-filter tw-blur-[100px] tw-opacity-50 tw-animate-float"></div>
    
    <div class="tw-max-w-7xl tw-mx-auto tw-relative tw-z-10">
        <div class="tw-flex tw-flex-col tw-items-center tw-mb-14" data-aos="fade-up">
            <div class="tw-bg-primary tw-bg-opacity-10 tw-backdrop-blur-sm tw-rounded-full tw-px-4 tw-py-1.5 tw-flex tw-items-center tw-justify-center tw-mb-4 tw-border tw-border-primary-200"  >
                <span class="tw-text-primary tw-font-semibold tw-text-sm">Testimonials</span>
            </div>

            <!-- Heading -->
            <h2 class="tw-text-3xl md:tw-text-4xl tw-font-bold tw-text-center tw-text-gray-900 tw-mb-4" >
                Lihat apa kata <span class="text-gradient">1.500+ Pelanggan</span> Kami
            </h2>
            
            <!-- Subheading -->
            <p class="tw-text-lg tw-text-gray-600 tw-text-center tw-max-w-2xl">
                Cerita nyata dari customer kami mengenai TINPED SMM Panel
            </p>
        </div>
        
        <!-- Testimonials Grid -->
        <div class="tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 lg:tw-grid-cols-3 tw-gap-6" data-aos="fade-up" data-aos-delay="200">
            @php
            $testimonials = [
                [
                    "id" => 1,
                    "text" => "Jujur sejak kenal Tinped, Strategi marketing media sosial saya jadi jauh lebih efektif, Panel terbaik sejauh ini!",
                    "name" => "Rendy J.",
                    "role" => "Digital Marketer",
                    "image" => "https://randomuser.me/api/portraits/men/9.jpg"
                ],
                [
                    "id" => 2,
                    "text" => "Sudah mencoba banyak panel SMM sebelumnya, tapi yang ini benar-benar beda. Kualitas layanan dan dukungan pelanggannya luar biasa buat saya.",
                    "name" => "Michael C.",
                    "role" => "Content Creator",
                    "image" => "https://randomuser.me/api/portraits/men/2.jpg"
                ],
                [
                    "id" => 3,
                    "text" => "Sebagai pemilik usaha kecil, saya butuh solusi marketing media sosial yang terjangkau tapi efektif. Menggunakan layanan tinped adalah keputusan yang tepat untuk saya!",
                    "name" => "Jessica W.",
                    "role" => "Business Owner",
                    "image" => "https://randomuser.me/api/portraits/women/18.jpg"
                ],
                [
                    "id" => 4,
                    "text" => "Kecepatan pengirimannya cepet bangett! Baru 5 menit langsung masuk followersnya. Siap langganan disini😁",
                    "name" => "David S.",
                    "role" => "Musician",
                    "image" => "https://randomuser.me/api/portraits/men/4.jpg"
                ],
                [
                    "id" => 5,
                    "text" => "Terimakasih tinped karena udah bantuin akun instagram aku naik 10.000 Followers sekejap😋. Ga expect secepet itu",
                    "name" => "Emma T.",
                    "role" => "Lifestyle Influencer",
                    "image" => "https://randomuser.me/api/portraits/women/5.jpg"
                ],
                [
                    "id" => 6,
                    "text" => "CS-nya sangat responsif dan membantu. Semua kendala saya langsung ditangani dengan cepat. Recommended.",
                    "name" => "James W.",
                    "role" => "Startup Founder",
                    "image" => "https://randomuser.me/api/portraits/men/65.jpg"
                ]
            ];
            @endphp

            @foreach($testimonials as $testimonial)
            <div class="tw-bg-white tw-p-6 tw-rounded-xl tw-shadow-sm hover:tw-shadow-glow-primary tw-border tw-border-primary-50 hover:tw-border-primary-200 tw-transition-all tw-duration-300 tw-flex tw-flex-col" >
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
