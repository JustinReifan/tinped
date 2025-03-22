
<section class="tw-w-full tw-py-20 tw-px-6 lg:tw-px-12 tw-relative tw-overflow-hidden tw-bg-gray-50/80">
    <!-- Background Elements -->
    <div class="tw-absolute tw-inset-0 tw-bg-grid tw-bg-[size:40px_40px] tw-opacity-30 tw-z-0"></div>
    <div class="tw-absolute tw-top-40 -tw-right-20 tw-w-60 tw-h-60 tw-bg-primary-100 tw-rounded-full tw-filter tw-blur-[100px] tw-opacity-50 tw-animate-float"></div>
    
    <div class="tw-max-w-7xl tw-mx-auto tw-relative tw-z-10">
        <div class="tw-flex tw-flex-col tw-items-center tw-mb-14" data-aos="fade-up">
            <!-- Section Badge -->
            <div class="tw-bg-primary tw-bg-opacity-10 tw-backdrop-blur-sm tw-rounded-full tw-px-4 tw-py-1.5 tw-flex tw-items-center tw-justify-center tw-mb-4 tw-border tw-border-primary-200">
                <span class="tw-text-primary tw-font-semibold tw-text-sm">Features</span>
            </div>
            
            <!-- Heading -->
            <h2 class="tw-text-3xl md:tw-text-4xl tw-font-bold tw-text-center tw-text-gray-900 tw-mb-4">
                Kenapa <span class="text-gradient">TINPED SMM?</span>
            </h2>
            
            <!-- Subheading -->
            <p class="tw-text-lg tw-text-gray-600 tw-text-center tw-max-w-2xl">
                Solusi terbaik - kami hadir untuk memberikan layanan berkualitas tinggi yang memenuhi setiap kebutuhan media sosial Anda.
            </p>
        </div>
        
        <!-- Dashboard Screenshot with enhanced glow -->
        <div class="tw-mb-16 tw-flex tw-justify-center" data-aos="fade-up" data-aos-delay="200">
            <div class="tw-relative tw-group">
                <!-- Screenshot with mask -->
                <div class="tw-relative tw-z-10 tw-bg-white tw-rounded-2xl tw-overflow-hidden tw-shadow-lg tw-border tw-border-primary-200 tw-max-w-4xl tw-transition-all tw-duration-300 group-hover:tw-shadow-lg">
                    <img src="/landing/assets/images/landing/featuresUI.png" alt="">
                </div>
                
                <!-- Enhanced glow effect behind screenshot -->
                <div class="tw-absolute tw-inset-0 tw-bg-primary-300 tw-rounded-xl tw-blur-[40px] tw-opacity-20 group-hover:tw-opacity-40 tw-z-0 tw-animate-pulse-glow tw-transition-opacity"></div>
            </div>
        </div>
        
        <!-- Features Grid -->
        <div class="tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 lg:tw-grid-cols-2 tw-gap-6" data-aos="fade-up" data-aos-delay="300">
            @php
            $features = [
                [
                    "id" => 1,
                    "title" => "Pengiriman Cepat",
                    "description" => "Pesanan diproses instan dan dikirim dalam hitungan menit hingga jam, sesuai ukuran pesanan.",
                    "icon" => "zap"
                ],
                [
                    "id" => 2,
                    "title" => "Kualitas Terjamin",
                    "description" => "Layanan kami memberikan engagement berkualitas tinggi dan terlihat alami untuk profil Anda.",
                    "icon" => "shield-check"
                ],
                [
                    "id" => 3,
                    "title" => "Customer Support 24/7",
                    "description" => "Tim kami siap membantu Anda kapan pun, menjamin pengalaman lancar dan solusi cepat setiap saat.",
                    "icon" => "headset"
                ],
                [
                    "id" => 4,
                    "title" => "Refill Layanan",
                    "description" => "Kami memberikan refill gratis hingga seumur hidup untuk pesanan yang mengalami penurunan/drop.",
                    "icon" => "clock"
                ]
            ];
            @endphp
            
            @foreach($features as $feature)
                <x-feature-card :feature="$feature" />
            @endforeach
        </div>
    </div>
</section>
