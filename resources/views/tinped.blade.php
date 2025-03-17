
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TINPED SMM - Premium Social Media Marketing Services</title>
    <meta name="description" content="Get instant, high-quality engagement for all your social media platforms. Fast delivery, real engagement, 24/7 support.">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Inter Font -->
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    
    <script>
        tailwind.config = {
            prefix: 'tw-',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#7367f0',
                            50: '#f3f2ff',
                            100: '#e9e7ff',
                            200: '#d4d0fe',
                            300: '#b6affc',
                            400: '#9a8ff8',
                            500: '#7367f0',
                            600: '#6753e7',
                            700: '#5641cc',
                            800: '#4735a6',
                            900: '#3c2f85',
                            950: '#241a57',
                        },
                    },
                    fontFamily: {
                        sans: ['Inter var', 'sans-serif'],
                    },
                    animation: {
                        'carousel': 'carousel 25s linear infinite',
                        'pulse-glow': 'pulse-glow 3s ease-in-out infinite',
                        'float': 'float 4s ease-in-out infinite',
                    },
                    keyframes: {
                        'carousel': {
                            '0%': { transform: 'translateX(0)' },
                            '100%': { transform: 'translateX(-100%)' }
                        },
                        'pulse-glow': {
                            '0%, 100%': { opacity: '1', transform: 'scale(1)' },
                            '50%': { opacity: '0.85', transform: 'scale(1.05)' }
                        },
                        'float': {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' }
                        },
                    },
                    backgroundImage: {
                        'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
                        'grid': 'linear-gradient(to right, rgba(115, 103, 240, 0.1) 1px, transparent 1px), linear-gradient(to bottom, rgba(115, 103, 240, 0.1) 1px, transparent 1px)',
                    },
                    boxShadow: {
                        'glow-primary': '0 0 20px -5px rgba(115, 103, 240, 0.5)',
                        'glow-primary-lg': '0 0 30px -5px rgba(115, 103, 240, 0.7)',
                    },
                }
            }
        }
    </script>
    
    <style>
        /* Base styles */
        body {
            font-family: 'Inter var', sans-serif;
            font-feature-settings: "ss01", "ss02", "cv01", "cv02", "cv03";
        }
        
        /* Custom Utilities */
        .text-gradient {
            background: linear-gradient(to right, #7367f0, #9a8ff8);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .btn-primary {
            background-image: linear-gradient(to right, #7367f0, #8f85f3);
            @apply tw-bg-primary tw-text-white tw-font-medium tw-py-2.5 tw-px-6 tw-rounded-full tw-transition-all tw-duration-300 tw-shadow-md hover:tw-shadow-glow-primary tw-border tw-border-primary-400;
        }
        
        .btn-outline {
            @apply tw-bg-transparent tw-text-primary tw-font-medium tw-py-2.5 tw-px-6 tw-rounded-full tw-transition-all tw-duration-300 tw-border tw-border-primary hover:tw-bg-primary-50;
        }
        
        .btn-glow:hover {
            box-shadow: 0 0 25px 5px rgba(115, 103, 240, 0.5);
        }
        
        /* Animation classes */
        .heading-animation {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 0.8s ease forwards 0.1s;
        }
        
        .subheading-animation {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 0.8s ease forwards 0.3s;
        }
        
        .buttons-animation {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 0.8s ease forwards 0.5s;
        }
        
        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Accordion styles */
        .accordion-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }
        
        .accordion-item.active .accordion-content {
            max-height: 1000px;
        }
        
        .accordion-item.active .accordion-icon {
            transform: rotate(45deg);
        }

        /* Glass morphism */
        .glass-morphism {
            @apply tw-backdrop-blur-[10px] tw-bg-white/70 tw-border tw-border-white/20 tw-shadow-md;
        }
    </style>
</head>
<body class="tw-min-h-screen tw-bg-white tw-overflow-x-hidden">
    <!-- Navbar -->
    <header class="tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-transition-all tw-duration-300 tw-py-4 tw-px-6 lg:tw-px-12" id="navbar">
        <div class="tw-max-w-7xl tw-mx-auto">
            <nav class="tw-flex tw-items-center tw-justify-between">
                <!-- Logo -->
                <div class="tw-flex tw-items-center">
                    <a href="/" class="tw-flex tw-items-center tw-space-x-2">
                        <div class="tw-relative tw-h-8 tw-w-8 tw-overflow-hidden">
                            <div class="tw-absolute tw-inset-0 tw-bg-primary tw-rounded-lg tw-animate-pulse-glow"></div>
                            <div class="tw-absolute tw-inset-0.5 tw-bg-white tw-rounded-lg tw-flex tw-items-center tw-justify-center">
                                <span class="tw-font-bold tw-text-primary tw-text-xs">TINPED</span>
                            </div>
                        </div>
                        <span class="tw-font-bold tw-text-gray-800 tw-hidden sm:tw-block">TINPED <span class="tw-text-primary">SMM</span></span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="tw-hidden md:tw-flex tw-items-center tw-space-x-8">
                    <a href="#" class="tw-flex tw-items-center tw-space-x-1 tw-text-gray-700 hover:tw-text-primary tw-transition-colors link-underline">
                        <svg xmlns="http://www.w3.org/2000/svg" class="tw-w-4 tw-h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <span>Beranda</span>
                    </a>
                    <a href="#" class="tw-flex tw-items-center tw-space-x-1 tw-text-gray-700 hover:tw-text-primary tw-transition-colors link-underline">
                        <svg xmlns="http://www.w3.org/2000/svg" class="tw-w-4 tw-h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        <span>Cek Transaksi</span>
                    </a>
                    <a href="#" class="tw-flex tw-items-center tw-space-x-1 tw-text-gray-700 hover:tw-text-primary tw-transition-colors link-underline">
                        <svg xmlns="http://www.w3.org/2000/svg" class="tw-w-4 tw-h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="20" x2="18" y2="10"></line>
                            <line x1="12" y1="20" x2="12" y2="4"></line>
                            <line x1="6" y1="20" x2="6" y2="14"></line>
                        </svg>
                        <span>Leaderboard</span>
                    </a>
                    <a href="#" class="tw-flex tw-items-center tw-space-x-1 tw-text-gray-700 hover:tw-text-primary tw-transition-colors link-underline">
                        <svg xmlns="http://www.w3.org/2000/svg" class="tw-w-4 tw-h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect>
                            <line x1="12" y1="10" x2="16" y2="10"></line>
                            <line x1="12" y1="14" x2="16" y2="14"></line>
                            <line x1="12" y1="18" x2="16" y2="18"></line>
                            <line x1="8" y1="10" x2="8" y2="10"></line>
                            <line x1="8" y1="14" x2="8" y2="14"></line>
                            <line x1="8" y1="18" x2="8" y2="18"></line>
                        </svg>
                        <span>Kalkulator</span>
                    </a>
                </div>

                <!-- Action Buttons -->
                <div class="tw-hidden md:tw-flex tw-items-center tw-space-x-3">
                    <button class="btn-outline tw-text-sm">
                        Masuk
                    </button>
                    <button class="btn-primary tw-text-sm tw-flex tw-items-center tw-space-x-1 btn-glow">
                        <span>Daftar</span>
                    </button>
                </div>

                <!-- Mobile Menu Button -->
                <button 
                    class="tw-block md:tw-hidden tw-text-gray-700 hover:tw-text-primary tw-transition-colors" 
                    id="mobile-menu-button"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-w-6 tw-h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>
            </nav>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="tw-fixed tw-inset-0 tw-z-40 tw-bg-white tw-pt-20 tw-px-6 tw-transform tw-transition-all tw-duration-300 tw-ease-in-out md:tw-hidden tw-translate-x-full">
            <div class="tw-flex tw-flex-col tw-space-y-6">
                <a href="#" class="tw-flex tw-items-center tw-space-x-3 tw-text-gray-700 hover:tw-text-primary tw-transition-colors tw-py-3 tw-border-b tw-border-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-w-5 tw-h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    <span class="tw-font-medium">Beranda</span>
                </a>
                <a href="#" class="tw-flex tw-items-center tw-space-x-3 tw-text-gray-700 hover:tw-text-primary tw-transition-colors tw-py-3 tw-border-b tw-border-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-w-5 tw-h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <span class="tw-font-medium">Cek Transaksi</span>
                </a>
                <a href="#" class="tw-flex tw-items-center tw-space-x-3 tw-text-gray-700 hover:tw-text-primary tw-transition-colors tw-py-3 tw-border-b tw-border-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-w-5 tw-h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="20" x2="18" y2="10"></line>
                        <line x1="12" y1="20" x2="12" y2="4"></line>
                        <line x1="6" y1="20" x2="6" y2="14"></line>
                    </svg>
                    <span class="tw-font-medium">Leaderboard</span>
                </a>
                <a href="#" class="tw-flex tw-items-center tw-space-x-3 tw-text-gray-700 hover:tw-text-primary tw-transition-colors tw-py-3 tw-border-b tw-border-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-w-5 tw-h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect>
                        <line x1="12" y1="10" x2="16" y2="10"></line>
                        <line x1="12" y1="14" x2="16" y2="14"></line>
                        <line x1="12" y1="18" x2="16" y2="18"></line>
                        <line x1="8" y1="10" x2="8" y2="10"></line>
                        <line x1="8" y1="14" x2="8" y2="14"></line>
                        <line x1="8" y1="18" x2="8" y2="18"></line>
                    </svg>
                    <span class="tw-font-medium">Kalkulator</span>
                </a>
                
                <div class="tw-flex tw-flex-col tw-space-y-3 tw-pt-4">
                    <button class="btn-outline tw-w-full">
                        Masuk
                    </button>
                    <button class="btn-primary tw-w-full btn-glow">
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
    <x-price-list />
    
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
            const mobileMenu = document.getElementById('mobile-menu');
            let isMenuOpen = false;
            
            mobileMenuButton.addEventListener('click', function() {
                isMenuOpen = !isMenuOpen;
                if (isMenuOpen) {
                    mobileMenu.classList.remove('tw-translate-x-full');
                    mobileMenuButton.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="tw-w-6 tw-h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>';
                } else {
                    mobileMenu.classList.add('tw-translate-x-full');
                    mobileMenuButton.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="tw-w-6 tw-h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>';
                }
            });
            
            // Accordion functionality
            const accordionItems = document.querySelectorAll('.accordion-item');
            const accordionTriggers = document.querySelectorAll('.accordion-trigger');
            
            // Set first item in each column as active
            const firstItems = document.querySelectorAll('.accordion-item:first-child');
            firstItems.forEach(item => {
                item.classList.add('active');
                const content = item.querySelector('.accordion-content');
                if (content) {
                    content.style.display = 'block';
                }
                
                // Toggle plus/minus icons
                const plusIcon = item.querySelector('.plus');
                const minusIcon = item.querySelector('.minus');
                if (plusIcon) plusIcon.classList.add('hidden');
                if (minusIcon) minusIcon.classList.remove('hidden');
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
            
            // Hero section animations
            const heading = document.querySelector('.heading-animation');
            const subheading = document.querySelector('.subheading-animation');
            const buttonContainer = document.querySelector('.buttons-animation');
            
            if (heading) {
                heading.style.opacity = '0';
                heading.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    heading.style.opacity = '1';
                    heading.style.transform = 'translateY(0)';
                }, 100);
            }
            
            if (subheading) {
                subheading.style.opacity = '0';
                subheading.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    subheading.style.opacity = '1';
                    subheading.style.transform = 'translateY(0)';
                }, 300);
            }
            
            if (buttonContainer) {
                buttonContainer.style.opacity = '0';
                buttonContainer.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    buttonContainer.style.opacity = '1';
                    buttonContainer.style.transform = 'translateY(0)';
                }, 500);
            }
        });
    </script>
</body>
</html>
