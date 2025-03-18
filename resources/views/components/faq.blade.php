
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
                Frequently Asked <span class="text-gradient">Questions</span>
            </h2>
            
            <!-- Subheading -->
            <p class="tw-text-lg tw-text-gray-600 tw-text-center tw-max-w-2xl">
                Find answers to the most common questions about our SMM services
            </p>
        </div>
        
        <!-- FAQ Accordion - Two-column layout -->
        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-6" data-aos="fade-up" data-aos-delay="100">
            @php
            $faqItems = [
                [
                    "question" => "What is SMM and how does it work?",
                    "answer" => "Social Media Marketing (SMM) involves promoting your content or brand through social media platforms. TINPED SMM provides services like followers, likes, views, and comments to boost your social media presence and increase engagement on your profiles."
                ],
                [
                    "question" => "How fast will I receive my order?",
                    "answer" => "Delivery times vary based on the service and order size. Most orders begin processing instantly, with small orders completing within minutes to a few hours. Larger orders may take 24-48 hours to complete. You can always check your order status in real-time through your dashboard."
                ],
                [
                    "question" => "Are the followers/likes/views real?",
                    "answer" => "We provide high-quality engagement that looks natural and authentic. While we use various methods to deliver services, we prioritize quality to ensure your profiles remain safe and the engagement appears organic."
                ],
                [
                    "question" => "Will I get banned for using your services?",
                    "answer" => "No, our services are designed to be safe for your accounts. We deliver engagement at a natural pace and follow platform guidelines to minimize any risks. We've served over 56,000 customers without issues."
                ],
                [
                    "question" => "What payment methods do you accept?",
                    "answer" => "We accept a wide variety of payment methods including credit/debit cards (Visa, Mastercard), digital wallets (PayPal, Google Pay, Apple Pay), bank transfers, and cryptocurrencies (Bitcoin, Ethereum)."
                ],
                [
                    "question" => "What happens if I don't receive my order?",
                    "answer" => "In the rare case that your order isn't delivered within the expected timeframe, please contact our 24/7 support team. We offer a 100% money-back guarantee if we cannot deliver your order as promised."
                ],
                [
                    "question" => "Do you offer refills if followers drop?",
                    "answer" => "Yes, we offer a 30-day auto-refill guarantee for most of our services. If you experience any drops in engagement within 30 days of delivery, our system will automatically refill your order at no additional cost."
                ],
                [
                    "question" => "How do I contact customer support?",
                    "answer" => "Our customer support team is available 24/7 through live chat on our website, email support, and ticketing system. We typically respond within minutes during business hours and within a few hours during off-hours."
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
            <h3 class="tw-text-xl tw-font-semibold tw-mb-4">Still have questions?</h3>
            <p class="tw-text-gray-600 tw-mb-6">Our support team is ready to help you 24/7</p>
            <button class="btn-primary tw-text-base tw-py-3 tw-px-8 btn-glow tw-flex tw-items-center tw-justify-center tw-mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="tw-w-5 tw-h-5 tw-mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                </svg>
                <span>Contact Support</span>
            </button>
        </div>
    </div>
</section>
