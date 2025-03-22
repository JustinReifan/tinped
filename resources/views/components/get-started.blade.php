<section class="tw-w-full tw-py-20 tw-px-6 lg:tw-px-12 tw-relative tw-overflow-hidden tw-bg-gray-50/80" data-aos="fade-up" data-aos-duration="800">
    <!-- Background Elements -->
    <div class="tw-absolute tw-inset-0 tw-bg-grid tw-bg-[size:40px_40px] tw-opacity-30 tw-z-0"></div>
    <div class="tw-absolute tw-top-40 -tw-left-20 tw-w-60 tw-h-60 tw-bg-primary-100 tw-rounded-full tw-filter tw-blur-[100px] tw-opacity-50 tw-animate-float"></div>
    
    <div class="tw-max-w-7xl tw-mx-auto tw-relative tw-z-10">
        <div class="tw-flex tw-flex-col tw-items-center tw-mb-14" data-aos="fade-up">
            <!-- Section Badge -->
            <div class="tw-bg-primary tw-bg-opacity-10 tw-backdrop-blur-sm tw-rounded-full tw-px-4 tw-py-1.5 tw-flex tw-items-center tw-justify-center tw-mb-4 tw-border tw-border-primary-200">
                <span class="tw-text-primary tw-font-semibold tw-text-sm">Get Started</span>
            </div>
            
            <!-- Heading -->
            <h2 class="tw-text-3xl md:tw-text-4xl tw-font-bold tw-text-center tw-text-gray-900 tw-mb-4">
                Langkah Menggunakan <span class="text-gradient">TINPED SMM</span>
            </h2>
            
            <!-- Subheading -->
            <p class="tw-text-lg tw-text-gray-600 tw-text-center tw-max-w-2xl">
                Mulai tingkatkan kehadiran media sosial Anda dalam 4 langkah mudah
            </p>
        </div>
        
        <!-- Cards Grid -->
        <div class="tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 lg:tw-grid-cols-4 tw-gap-6 tw-mb-16">
            @php
            $stepData = [
                [
                    "id" => 1,
                    "title" => "Registrasi Akun",
                    "icon" => "user-plus",
                    "description" => "Buat akun Anda dalam waktu kurang dari 1 menit dengan email atau google. Tidak diperlukan verifikasi tambahan."
                ],
                [
                    "id" => 2,
                    "title" => "Top Up Saldo",
                    "icon" => "wallet",
                    "description" => "Tambahkan saldo menggunakan beberapa metode pembayaran aman ke akun Anda."
                ],
                [
                    "id" => 3,
                    "title" => "Pilih Layanan",
                    "icon" => "list-checks",
                    "description" => "Jelajahi beragam layanan kami yang tersedia untuk berbagai platform media sosial."
                ],
                [
                    "id" => 4,
                    "title" => "Pesan & Pantau",
                    "icon" => "package-2",
                    "description" => "Lakukan pemesanan Anda dan pantau perkembangannya secara real-time melalui dashboard kami."
                ]
            ];
            @endphp
            
            @foreach($stepData as $step)
                <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <x-step-card :step="$step" />
                </div>
            @endforeach
        </div>
        
        <!-- YouTube Video Section -->
        <div class="tw-w-full tw-flex tw-justify-center tw-items-center tw-mt-6" data-aos="fade-up" data-aos-delay="200">
            <div class="tw-w-full tw-max-w-3xl tw-border tw-border-primary-200 tw-rounded-xl tw-overflow-hidden tw-shadow-sm">
                <div class="tw-relative tw-w-full tw-aspect-video">
                    <iframe 
                        class="tw-absolute tw-inset-0 tw-w-full tw-h-full" 
                        src="https://www.youtube.com/embed/Svz5F8J1Ap0?si=RgiLRRHdgLPRsAke" 
                        title="TINPED SMM Tutorial" 
                        frameborder="0" 
                        allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>
