<section class="tw-relative tw-w-full tw-overflow-hidden tw-bg-gray-50/80 tw-px-6 tw-py-20 lg:tw-px-12" data-aos="fade-up"
    data-aos-duration="800">
    <!-- Background Elements -->
    <div class="tw-absolute tw-inset-0 tw-z-0 tw-bg-grid tw-bg-[size:40px_40px] tw-opacity-30"></div>
    <div
        class="tw-absolute -tw-left-20 tw-top-40 tw-h-60 tw-w-60 tw-animate-float tw-rounded-full tw-bg-primary-100 tw-opacity-50 tw-blur-[100px] tw-filter">
    </div>

    <div class="tw-relative tw-z-10 tw-mx-auto tw-max-w-7xl">
        <div class="tw-mb-14 tw-flex tw-flex-col tw-items-center" data-aos="fade-up">
            <!-- Section Badge -->
            <div
                class="tw-mb-4 tw-flex tw-items-center tw-justify-center tw-rounded-full tw-border tw-border-primary-200 tw-bg-primary tw-bg-opacity-10 tw-px-4 tw-py-1.5 tw-backdrop-blur-sm">
                <span class="tw-text-sm tw-font-semibold tw-text-primary">Get Started</span>
            </div>

            <!-- Heading -->
            <h2 class="tw-mb-4 tw-text-center tw-text-3xl tw-font-bold tw-text-gray-900 md:tw-text-4xl">
                Langkah Menggunakan <span class="text-gradient">TINPED SMM</span>
            </h2>

            <!-- Subheading -->
            <p class="tw-max-w-2xl tw-text-center tw-text-lg tw-text-gray-600">
                Mulai tingkatkan kehadiran media sosial Anda dalam 4 langkah mudah
            </p>
        </div>

        <!-- Cards Grid -->
        <div class="tw-mb-16 tw-grid tw-grid-cols-1 tw-gap-6 sm:tw-grid-cols-2 lg:tw-grid-cols-4">
            @php
                $stepData = [
                    [
                        'id' => 1,
                        'title' => 'Registrasi Akun',
                        'icon' => 'user-plus',
                        'description' =>
                            'Buat akun Anda dalam waktu kurang dari 1 menit dengan email atau google. Tidak diperlukan verifikasi tambahan.',
                    ],
                    [
                        'id' => 2,
                        'title' => 'Top Up Saldo',
                        'icon' => 'wallet',
                        'description' => 'Tambahkan saldo menggunakan beberapa metode pembayaran aman ke akun Anda.',
                    ],
                    [
                        'id' => 3,
                        'title' => 'Pilih Layanan',
                        'icon' => 'list-checks',
                        'description' =>
                            'Jelajahi beragam layanan kami yang tersedia untuk berbagai platform media sosial.',
                    ],
                    [
                        'id' => 4,
                        'title' => 'Pesan & Pantau',
                        'icon' => 'package-2',
                        'description' =>
                            'Lakukan pemesanan Anda dan pantau perkembangannya secara real-time melalui dashboard kami.',
                    ],
                ];
            @endphp

            @foreach ($stepData as $step)
                <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <x-step-card :step="$step" />
                </div>
            @endforeach
        </div>

        <!-- YouTube Video Section -->
        <div class="tw-mt-6 tw-flex tw-w-full tw-items-center tw-justify-center" data-aos="fade-up"
            data-aos-delay="200">
            <div
                class="tw-w-full tw-max-w-4xl tw-overflow-hidden tw-rounded-xl tw-border tw-border-primary-200 tw-shadow-sm">
                <div class="tw-relative tw-aspect-video tw-w-full">
                    <iframe class="tw-absolute tw-inset-0 tw-h-full tw-w-full"
                        src="https://www.youtube.com/embed/L0RSC-aVCVA?si=tiQuC-_8fabL_CVp" title="TINPED SMM Tutorial"
                        frameborder="0"
                        allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>
