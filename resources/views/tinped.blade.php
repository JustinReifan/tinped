<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $config->name_panel }}</title>
    <meta name="description" content="{{ $config->description_website }}">
    <meta name="keywords" content="{{ $config->keyword_website }}">
    <meta name="author" content="Justin Code">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ env('APP_URL') }}">
    <meta property="og:title" content="{{ $config->name_panel }}">
    <meta property="og:description" content="{{ $config->description_website }}">
    <meta property="og:image" content="{{ url($config->favicon) }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ env('APP_URL') }}">
    <meta property="twitter:title" content="{{ $config->name_panel }}">
    <meta property="twitter:description" content="{{ $config->description_website }}">
    <meta property="twitter:image" content="{{ url($config->favicon) }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ url($config->favicon) }}">
    
    <!-- Tailwind CSS -->
    @vite(['resources/views/landing/css/landing.css', 'resources/js/app.js'])

    
    <!-- AOS - Animate On Scroll Library -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ url('assets') }}/views/landing/css/landing.css">
    
    
</head>
<body class="tw-min-h-screen tw-bg-white tw-overflow-x-hidden">
    <!-- Navbar -->
    <header class="tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-transition-all tw-duration-300 tw-py-4 tw-px-6 lg:tw-px-12" id="navbar">
        <div class="tw-max-w-7xl tw-mx-auto">
            <nav class="tw-flex tw-items-center tw-justify-between">
                <!-- Logo -->
                <div class="tw-flex tw-items-center">
                    <a href="/" class="tw-flex tw-items-center tw-space-x-2" aria-label="TINPED SMM Home">
                        <div class="tw-relative tw-h-8 tw-w-8 tw-overflow-hidden">
                            <div class="tw-absolute tw-inset-0 tw-rounded-lg tw-animate-pulse-glow"></div>
                            <div class="tw-absolute tw-inset-0.5 tw-rounded-lg tw-flex tw-items-center tw-justify-center">
                                <img src="/landing/assets/images/logo/logo-tinped.png" alt="TINPED SMM Logo" loading="lazy">
                            </div>
                        </div>
                        <span class="tw-font-bold tw-text-gray-800 tw-hidden sm:tw-block">TINPED <span class="tw-text-primary">SMM</span></span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="tw-hidden md:tw-flex tw-items-center tw-space-x-8">
                    <a href="#" class="tw-flex tw-items-center tw-space-x-1 tw-text-gray-700 hover:tw-text-primary tw-transition-colors link-underline">
                        <svg xmlns="http://www.w3.org/2000/svg" class="tw-w-4 tw-h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <span>Beranda</span>
                    </a>
                    <a href="{{ route('sitemap.kontak') }}" class="tw-flex tw-items-center tw-space-x-1 tw-text-gray-700 hover:tw-text-primary tw-transition-colors link-underline">
                        <svg xmlns="http://www.w3.org/2000/svg" class="tw-w-4 tw-h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                        
                        <span>Kontak</span>
                    </a>
                    <a href="{{ route('dokumentasi') }}" class="tw-flex tw-items-center tw-space-x-1 tw-text-gray-700 hover:tw-text-primary tw-transition-colors link-underline">
                        <svg xmlns="http://www.w3.org/2000/svg" class="tw-w-4 tw-h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <line x1="10" y1="9" x2="8" y2="9"></line>
                        </svg>
                        <span>Dokumentasi</span>
                    </a>
                    <!-- Sitemap Dropdown -->
                    <div class="tw-relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" class="tw-flex tw-items-center tw-space-x-1 tw-text-gray-700 hover:tw-text-primary tw-transition-colors link-underline">
                            <svg xmlns="http://www.w3.org/2000/svg" class="tw-w-4 tw-h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="10" y1="6" x2="21" y2="6"></line>
                                <line x1="10" y1="12" x2="21" y2="12"></line>
                                <line x1="10" y1="18" x2="21" y2="18"></line>
                                <polyline points="3 6 4 7 6 5"></polyline>
                                <polyline points="3 12 4 13 6 11"></polyline>
                                <polyline points="3 18 4 19 6 17"></polyline>
                            </svg>
                            <span>Sitemap</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="tw-w-4 tw-h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>
                        <!-- Dropdown Menu -->
                        <div x-show="open" x-transition:enter="tw-transition tw-ease-out tw-duration-100" x-transition:enter-start="tw-transform tw-opacity-0 tw-scale-95" x-transition:enter-end="tw-transform tw-opacity-100 tw-scale-100" x-transition:leave="tw-transition tw-ease-in tw-duration-75" x-transition:leave-start="tw-transform tw-opacity-100 tw-scale-100" x-transition:leave-end="tw-transform tw-opacity-0 tw-scale-95" class="tw-absolute tw-z-50 tw-mt-2 tw-w-56 tw-rounded-md tw-shadow-lg tw-bg-white tw-border tw-border-gray-100" style="display: none;">
                            <div class="tw-rounded-md tw-ring-1 tw-ring-black tw-ring-opacity-5 tw-py-1">
                                <a href="{{ route('pemesanan') }}" class="tw-block tw-px-4 tw-py-2 tw-text-sm tw-text-gray-700 hover:tw-bg-gray-50 hover:tw-text-primary">Pesan Tanpa Daftar</a>
                                <a href="{{ route('ketentuan.layanan') }}" class="tw-block tw-px-4 tw-py-2 tw-text-sm tw-text-gray-700 hover:tw-bg-gray-50 hover:tw-text-primary">Ketentuan Layanan</a>
                                <a href="{{ route('contoh.pesanan') }}" class="tw-block tw-px-4 tw-py-2 tw-text-sm tw-text-gray-700 hover:tw-bg-gray-50 hover:tw-text-primary">Contoh Pesanan</a>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <!-- Action Buttons -->
                <div class="tw-hidden md:tw-flex tw-items-center tw-space-x-3">
                    <button class="btn-outline tw-text-sm" onclick="window.location.href='{{ route('login') }}'">
                        Masuk
                    </button>
                    <button class="btn-primary tw-text-sm tw-flex tw-items-center tw-space-x-1 btn-glow" onclick="window.location.href='{{ route('register') }}'">
                        <span>Daftar</span>
                    </button>
                </div>

                <!-- Mobile Menu Button -->
                <button 
                    class="tw-block md:tw-hidden tw-text-gray-700 hover:tw-text-primary tw-transition-colors" 
                    id="mobile-menu-button"
                    aria-label="Toggle mobile menu"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-w-6 tw-h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>
            </nav>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="tw-fixed tw-inset-0 tw-z-40 tw-bg-white tw-pt-20 tw-px-6 tw-transform tw-transition-all tw-duration-300 tw-ease-in-out md:tw-hidden tw-translate-x-full">
            <!-- Close Button -->
            <button 
                id="mobile-menu-close" 
                class="tw-absolute tw-top-6 tw-right-6 tw-text-gray-700 hover:tw-text-primary tw-transition-colors"
                aria-label="Close mobile menu"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="tw-w-6 tw-h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            
            <div class="tw-flex tw-flex-col tw-space-y-6">
                <a href="#" class="tw-flex tw-items-center tw-space-x-3 tw-text-gray-700 hover:tw-text-primary tw-transition-colors tw-py-3 tw-border-b tw-border-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-w-5 tw-h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    <span class="tw-font-medium">Beranda</span>
                </a>
                <a href="{{ route('sitemap.kontak') }}" class="tw-flex tw-items-center tw-space-x-3 tw-text-gray-700 hover:tw-text-primary tw-transition-colors tw-py-3 tw-border-b tw-border-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-w-5 tw-h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                    <span class="tw-font-medium">Kontak</span>
                </a>
                <a href="{{ route('dokumentasi') }}" class="tw-flex tw-items-center tw-space-x-3 tw-text-gray-700 hover:tw-text-primary tw-transition-colors tw-py-3 tw-border-b tw-border-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-w-5 tw-h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <line x1="10" y1="9" x2="8" y2="9"></line>
                    </svg>
                    <span class="tw-font-medium">Dokumentasi</span>
                </a>
               
                <div class="tw-py-3 tw-border-b tw-border-gray-100" x-data="{ open: false }">
                    <button @click="open = !open" class="tw-flex tw-items-center tw-justify-between tw-w-full tw-text-gray-700 hover:tw-text-primary tw-transition-colors">
                        <div class="tw-flex tw-items-center tw-space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="tw-w-4 tw-h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="10" y1="6" x2="21" y2="6"></line>
                                <line x1="10" y1="12" x2="21" y2="12"></line>
                                <line x1="10" y1="18" x2="21" y2="18"></line>
                                <polyline points="3 6 4 7 6 5"></polyline>
                                <polyline points="3 12 4 13 6 11"></polyline>
                                <polyline points="3 18 4 19 6 17"></polyline>
                            </svg>
                            <span class="tw-font-medium">Sitemap</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" :class="{'tw-transform tw-rotate-180': open}" class="tw-w-5 tw-h-5 tw-transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <div x-show="open" x-transition:enter="tw-transition tw-ease-out tw-duration-100" x-transition:enter-start="tw-transform tw-opacity-0 tw-scale-95" x-transition:enter-end="tw-transform tw-opacity-100 tw-scale-100" x-transition:leave="tw-transition tw-ease-in tw-duration-75" x-transition:leave-start="tw-transform tw-opacity-100 tw-scale-100" x-transition:leave-end="tw-transform tw-opacity-0 tw-scale-95" class="tw-pl-8 tw-mt-2 tw-space-y-2" style="display: none;">
                        <a href="{{ route('pemesanan') }}" class="tw-block tw-py-2 tw-text-gray-600 hover:tw-text-primary tw-transition-colors">Pesan Tanpa Daftar</a>
                        <a href="{{ route('ketentuan.layanan') }}" class="tw-block tw-py-2 tw-text-gray-600 hover:tw-text-primary tw-transition-colors">Ketentuan Layanan</a>
                        <a href="{{ route('contoh.pesanan') }}" class="tw-block tw-py-2 tw-text-gray-600 hover:tw-text-primary tw-transition-colors">Contoh Pesanan</a>
                    </div>
                </div>
                
                <div class="tw-flex tw-flex-col tw-space-y-3 tw-pt-4">
                    <button class="btn-outline tw-w-full" onclick="window.location.href='{{ route('login') }}'">
                        Masuk
                    </button>
                    <button class="btn-primary tw-w-full btn-glow" onclick="window.location.href='{{ route('register') }}'">
                        Daftar
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <x-hero />
    
    <!-- What is Tinped Section -->
    <x-what-is-tinped />
    
    <!-- Get Started Section -->
    <x-get-started />
    
    <!-- Price List Section -->
    
    <x-price-list :prices="$servicesPrices"/>
    
    <!-- Features Section -->
    <x-features />
    
    <!-- Difference Section -->
    <x-difference-section />
    
    <!-- Testimonials Section -->
    <x-testimonials />
    
    <!-- Payment Methods Section -->
    <x-payment-methods />
    
    <!-- FAQ Section -->
    <x-faq />
    
    <!-- Footer -->
    <x-footer />

    <!-- JavaScript -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS
            AOS.init({
                duration: 800,
                easing: 'ease-out',
                once: true,
                offset: 100
            });
            
            // Navbar scroll effect
            const navbar = document.getElementById('navbar');
            window.addEventListener('scroll', function() {
                if (window.scrollY > 20) {
                    navbar.classList.add('glass-morphism', 'tw-shadow-md');
                } else {
                    navbar.classList.remove('glass-morphism', 'tw-shadow-md');
                }
            });
            
            // Mobile menu functionality
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenuCloseButton = document.getElementById('mobile-menu-close');
            const mobileMenu = document.getElementById('mobile-menu');
            let isMenuOpen = false;
            
            function toggleMobileMenu(open) {
                isMenuOpen = open;
                if (isMenuOpen) {
                    mobileMenu.classList.remove('tw-translate-x-full');
                    mobileMenuButton.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="tw-w-6 tw-h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>';
                } else {
                    mobileMenu.classList.add('tw-translate-x-full');
                    mobileMenuButton.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="tw-w-6 tw-h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>';
                }
            }
            
            mobileMenuButton.addEventListener('click', function() {
                toggleMobileMenu(!isMenuOpen);
            });
            
            mobileMenuCloseButton.addEventListener('click', function() {
                toggleMobileMenu(false);
            });
            
            // Accordion functionality
            const accordionItems = document.querySelectorAll('.accordion-item');
            const accordionTriggers = document.querySelectorAll('.accordion-trigger');
            
            // Initialize accordion items to closed state
            accordionItems.forEach(item => {
                const content = item.querySelector('.accordion-content');
                if (content) {
                    content.style.display = 'none';
                }
                
                // Set plus/minus icons to initial state
                const plusIcon = item.querySelector('.plus');
                const minusIcon = item.querySelector('.minus');
                if (plusIcon) plusIcon.classList.remove('hidden');
                if (minusIcon) minusIcon.classList.add('hidden');
            });
            
            accordionTriggers.forEach(trigger => {
                trigger.addEventListener('click', function() {
                    const parent = this.parentElement;
                    const content = parent.querySelector('.accordion-content');
                    const column = parent.parentElement;
                    
                    // Get plus/minus icons
                    const plusIcon = parent.querySelector('.plus');
                    const minusIcon = parent.querySelector('.minus');
                    
                    // Close all accordions in this column
                    const columnItems = column.querySelectorAll('.accordion-item');
                    columnItems.forEach(item => {
                        if (item !== parent) {
                            item.classList.remove('active');
                            const itemContent = item.querySelector('.accordion-content');
                            if (itemContent) itemContent.style.display = 'none';
                            
                            // Toggle icons for closing items
                            const itemPlusIcon = item.querySelector('.plus');
                            const itemMinusIcon = item.querySelector('.minus');
                            if (itemPlusIcon) itemPlusIcon.classList.remove('hidden');
                            if (itemMinusIcon) itemMinusIcon.classList.add('hidden');
                        }
                    });
                    
                    // Toggle current accordion
                    if (parent.classList.contains('active')) {
                        parent.classList.remove('active');
                        if (content) content.style.display = 'none';
                        // Toggle icons
                        if (plusIcon) plusIcon.classList.remove('hidden');
                        if (minusIcon) minusIcon.classList.add('hidden');
                    } else {
                        parent.classList.add('active');
                        if (content) content.style.display = 'block';
                        // Toggle icons
                        if (plusIcon) plusIcon.classList.add('hidden');
                        if (minusIcon) minusIcon.classList.remove('hidden');
                    }
                });
            });
            
            // Lazy loading for images
            const lazyImages = document.querySelectorAll('img[loading="lazy"]');
            
            if ('loading' in HTMLImageElement.prototype) {
                // Browser supports native lazy loading
                lazyImages.forEach(img => {
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                    }
                });
            } else {
                // Fallback for browsers that don't support native lazy loading
                const lazyImageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const lazyImage = entry.target;
                            if (lazyImage.dataset.src) {
                                lazyImage.src = lazyImage.dataset.src;
                            }
                            lazyImage.removeAttribute('data-src');
                            lazyImageObserver.unobserve(lazyImage);
                        }
                    });
                });
                
                lazyImages.forEach(lazyImage => {
                    lazyImageObserver.observe(lazyImage);
                });
            }
        });
    </script>
</body>
</html>
