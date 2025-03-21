<section class="tw-w-full tw-py-20 tw-px-6 lg:tw-px-12 tw-relative tw-overflow-hidden tw-bg-gray-50/80" data-aos="fade-up">
    <!-- Background Elements -->
    <div class="tw-absolute tw-inset-0 tw-bg-grid tw-bg-[size:40px_40px] tw-opacity-30 tw-z-0"></div>
    <div class="tw-absolute tw-top-40 -tw-left-20 tw-w-60 tw-h-60 tw-bg-primary-100 tw-rounded-full tw-filter tw-blur-[100px] tw-opacity-50 tw-animate-float"></div>
    
    <div class="tw-max-w-7xl tw-mx-auto tw-relative tw-z-10">
        <div class="tw-flex tw-flex-col tw-items-center tw-mb-14" data-aos="fade-up">
            <div class="tw-bg-primary tw-bg-opacity-10 tw-backdrop-blur-sm tw-rounded-full tw-px-4 tw-py-1.5 tw-flex tw-items-center tw-justify-center tw-mb-4 tw-border tw-border-primary-200">
                <span class="tw-text-primary tw-font-semibold tw-text-sm">Support & Help</span>
            </div>

            <!-- Heading -->
            <h2 class="tw-text-3xl md:tw-text-4xl tw-font-bold tw-text-center tw-text-gray-900 tw-mb-4">
                <span class="text-gradient">Pertanyaan</span> Yang Sering Ditanyakan
            </h2>
            
            <!-- Subheading -->
            <p class="tw-text-lg tw-text-gray-600 tw-text-center tw-max-w-2xl">
                Temukan jawaban atas pertanyaan umum seputar layanan SMM kami.
            </p>
        </div>
        
        <!-- FAQ Accordion - Two-column layout -->
        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-6" data-aos="fade-up" data-aos-delay="100">
            @php
            $faqItems = [
                [
                    "question" => "Apa Itu SMM dan Bagaimana Cara Kerjanya?",
                    "answer" => "SMM Panel, atau Social Media Marketing panel, adalah platform berbasis web yang menyediakan layanan untuk meningkatkan media sosial, seperti penambahan followers, likes, views, dan komentar. SMM Panel banyak digunakan oleh agensi pemasaran, reseller, dan individu yang ingin meningkatkan kehadiran mereka di media sosial."
                ],
                [
                    "question" => "Seberapa Cepat Pesanan Saya Dikirim?",
                    "answer" => "Kecepatan pengiriman tergantung pada layanan dan jumlah pesanan. Umumnya, pesanan kecil diproses instan dan selesai dalam beberapa menit hingga jam. Pesanan besar mungkin membutuhkan waktu 24-48 jam. Anda dapat memantau status pesanan Anda secara real-time melalui dashboard."
                ],
                [
                    "question" => "Apakah Followers/Likes/Views-nya Real?",
                    "answer" => "Kami memberikan engagement berkualitas yang terlihat natural dan real. Dengan metode yang beragam, kami memastikan kualitas terbaik agar profil Anda aman dan interaksi terlihat organik."
                ],
                [
                    "question" => "Apakah Akun Saya Bisa Kena Ban Jika Menggunakan Layanan Ini?",
                    "answer" => "Tidak, layanan kami dirancang untuk menjaga keamanan akun Anda. Kami memberikan engagement dengan kecepatan yang natural dan selalu mengikuti panduan platform untuk meminimalisir risiko. Lebih dari 1.500 pelanggan telah menggunakan layanan kami tanpa masalah."
                ],
                [
                    "question" => "Apa saja metode pembayaran yang tersedia?",
                    "answer" => "Kami menerima berbagai metode pembayaran populer seperti Gopay, Dana, Shopeepay, Ovo, BCA, BRI, Indomart, Alfamart, dan tentunya QRIS All Payment."
                ],
                [
                    "question" => "Apa yang Terjadi Jika Pesanan Saya Tidak Diterima?",
                    "answer" => "Dalam kasus yang sangat jarang terjadi, jika pesanan Anda tidak terkirim sesuai waktu yang ditentukan, silakan hubungi support melalui tiket/whatsapp. Kami memberikan garansi uang kembali 100% jika pesanan tidak sesuai ekspektasi."
                ],
                [
                    "question" => "Apakah Ada Refill Jika Followers Turun?",
                    "answer" => "Tentu! Kami memberikan garansi refill hingga seumur hidup. Jika pesanan Anda drop, cukup gunakan tombol refill di dashboard riwayat pesanan. Gratis, tanpa biaya tambahan"
                ],
                [
                    "question" => "Bagaimana cara menghubungi customer support?",
                    "answer" => "Anda bisa menghubungi tim support kami via tiket, atau melalui WhatsApp CS."
                ]
            ];
            $halfCount = ceil(count($faqItems) / 2);
            $firstHalf = array_slice($faqItems, 0, $halfCount);
            $secondHalf = array_slice($faqItems, $halfCount);
            @endphp

            <!-- First column -->
            <div class="tw-bg-white tw-rounded-xl tw-shadow-lg hover:tw-shadow-glow-primary tw-border tw-border-[#e9e7ff] tw-overflow-hidden tw-transition-all tw-duration-300">
                <div class="tw-w-full">
                    @foreach($firstHalf as $index => $item)
                    <div class="accordion-item tw-border-b last:tw-border-0 tw-border-[#e9e7ff] tw-overflow-hidden hover:tw-bg-[#f3f2ff]/30 tw-transition-colors tw-duration-300">
                        <div class="accordion-trigger tw-px-6 tw-py-5 tw-text-left tw-text-gray-800 tw-font-semibold tw-group tw-flex tw-items-center tw-justify-between tw-cursor-pointer">
                            <span class="group-hover:tw-text-primary tw-transition-colors tw-duration-300">{{ $item['question'] }}</span>
                            <span class="plus tw-accordion-icon tw-transition-transform tw-duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-5 tw-w-5 tw-shrink-0 tw-text-[#9a8ff8] tw-transition-transform tw-duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            </span>
                            <span class="minus tw-hidden tw-accordion-icon tw-transition-transform tw-duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-5 tw-w-5 tw-shrink-0 tw-text-[#7367f0] tw-transition-transform tw-duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            </span>
                        </div>
                        <div class="accordion-content tw-hidden tw-px-6 tw-pb-5 tw-text-gray-600 tw-font-light">
                            {{ $item['answer'] }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Second column -->
            <div class="tw-bg-white tw-rounded-xl tw-shadow-lg hover:tw-shadow-glow-primary tw-border tw-border-[#e9e7ff] tw-overflow-hidden tw-transition-all tw-duration-300">
                <div class="tw-w-full">
                    @foreach($secondHalf as $index => $item)
                    <div class="accordion-item tw-border-b last:tw-border-0 tw-border-[#e9e7ff] tw-overflow-hidden hover:tw-bg-[#f3f2ff]/30 tw-transition-colors tw-duration-300">
                        <div class="accordion-trigger tw-px-6 tw-py-5 tw-text-left tw-text-gray-800 tw-font-semibold tw-group tw-flex tw-items-center tw-justify-between tw-cursor-pointer">
                            <span class="group-hover:tw-text-primary tw-transition-colors tw-duration-300">{{ $item['question'] }}</span>
                            <span class="plus tw-accordion-icon tw-transition-transform tw-duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-5 tw-w-5 tw-shrink-0 tw-text-[#9a8ff8] tw-transition-transform tw-duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            </span>
                            <span class="minus tw-hidden tw-accordion-icon tw-transition-transform tw-duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-5 tw-w-5 tw-shrink-0 tw-text-[#7367f0] tw-transition-transform tw-duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            </span>
                        </div>
                        <div class="accordion-content tw-hidden tw-px-6 tw-pb-5 tw-text-gray-600 tw-font-light">
                            {{ $item['answer'] }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <!-- Still Have Questions Section -->
        <div class="tw-mt-16 tw-text-center" data-aos="fade-up" data-aos-delay="200">
            <h3 class="tw-text-xl tw-font-semibold tw-mb-4">Masih ada pertanyaan?</h3>
            <p class="tw-text-gray-600 tw-mb-6">Team support kami siap untuk membantu anda</p>
            <button class="btn-primary tw-text-base tw-py-3 tw-px-8 btn-glow tw-flex tw-items-center tw-justify-center tw-mx-auto" onclick="window.location.href='https://wa.me/6285931018333'">
                <span>Contact Support</span>
            </button>
        </div>
    </div>
</section>