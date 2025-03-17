<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TINPED SMM - Premium Social Media Marketing Services</title>
    <meta name="description" content="Get instant, high-quality engagement for all your social media platforms. Fast delivery, real engagement, 24/7 support.">
    <meta name="keywords" content="SMM panel, social media marketing, followers, likes, engagement, Instagram, Facebook, YouTube, TikTok">
    <meta name="author" content="TINPED SMM">
    <meta property="og:title" content="TINPED SMM - Premium Social Media Marketing Services">
    <meta property="og:description" content="Get instant, high-quality engagement for all your social media platforms. Fast delivery, real engagement, 24/7 support.">
    <meta property="og:image" content="/img/og-image.png">
    <meta property="og:url" content="https://tinped.com">
    <meta name="twitter:card" content="summary_large_image">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/favicon.png">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Inter Font -->
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    
    <!-- AOS (Animate on Scroll) -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    
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
                    },
                }
            },
            plugins: {
                scrollbar: {
                    variants: ['rounded'],
                },
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
    </style>
</head>
<body class="tw-min-h-screen tw-bg-white tw-overflow-x-hidden">
    <!-- Navbar (placeholder) -->
    <header class="tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-bg-white/90 tw-backdrop-blur-md tw-border-b tw-border-gray-100">
        <div class="tw-max-w-7xl tw-mx-auto tw-px-4 sm:tw-px-6 lg:tw-px-8">
            <div class="tw-flex tw-justify-between tw-h-16 tw-items-center">
                <div class="tw-flex tw-items-center">
                    <a href="#" class="tw-text-xl tw-font-bold tw-text-primary">TINPED</a>
                </div>
                <nav class="tw-hidden md:tw-flex tw-space-x-8">
                    <a href="#" class="tw-text-gray-700 hover:tw-text-primary tw-transition-colors">Home</a>
                    <a href="#" class="tw-text-gray-700 hover:tw-text-primary tw-transition-colors">Services</a>
                    <a href="#" class="tw-text-gray-700 hover:tw-text-primary tw-transition-colors">Pricing</a>
                    <a href="#" class="tw-text-gray-700 hover:tw-text-primary tw-transition-colors">FAQ</a>
                </nav>
                <div class="tw-flex tw-items-center tw-space-x-4">
                    <a href="#" class="tw-text-gray-700 hover:tw-text-primary tw-transition-colors">Login</a>
                    <a href="#" class="btn-primary">Register</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <x-hero />
    
    <!-- What is Tinped Section -->
    <!-- Placeholder for what-is-tinped section -->
    
    <!-- Get Started Section -->
    <x-get-started />
    
    <!-- Price List Section -->
    <x-price-list />
    
    <!-- Features Section -->
    <x-features />
    
    <!-- Difference Section -->
    <x-difference-section />
    
    <!-- Testimonials Section -->
    <!-- Placeholder for testimonials section -->
    
    <!-- Payment Methods Section -->
    <!-- Placeholder for payment-methods section -->
    
    <!-- FAQ Section -->
    <x-faq />
    
    <!-- Footer -->
    <footer class="tw-bg-gray-900 tw-py-12 tw-px-6 tw-text-white">
        <div class="tw-max-w-7xl tw-mx-auto">
            <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-4 tw-gap-8">
                <div>
                    <h3 class="tw-text-xl tw-font-bold tw-mb-4">TINPED</h3>
                    <p class="tw-text-gray-400">Premium Social Media Marketing Services that help you grow your online presence.</p>
                </div>
                <div>
                    <h4 class="tw-font-bold tw-mb-4">Quick Links</h4>
                    <ul class="tw-space-y-2">
                        <li><a href="#" class="tw-text-gray-400 hover:tw-text-white tw-transition-colors">Home</a></li>
                        <li><a href="#" class="tw-text-gray-400 hover:tw-text-white tw-transition-colors">Services</a></li>
                        <li><a href="#" class="tw-text-gray-400 hover:tw-text-white tw-transition-colors">Pricing</a></li>
                        <li><a href="#" class="tw-text-gray-400 hover:tw-text-white tw-transition-colors">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="tw-font-bold tw-mb-4">Services</h4>
                    <ul class="tw-space-y-2">
                        <li><a href="#" class="tw-text-gray-400 hover:tw-text-white tw-transition-colors">Instagram</a></li>
                        <li><a href="#" class="tw-text-gray-400 hover:tw-text-white tw-transition-colors">Facebook</a></li>
                        <li><a href="#" class="tw-text-gray-400 hover:tw-text-white tw-transition-colors">Twitter</a></li>
                        <li><a href="#" class="tw-text-gray-400 hover:tw-text-white tw-transition-colors">YouTube</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="tw-font-bold tw-mb-4">Contact</h4>
                    <ul class="tw-space-y-2">
                        <li class="tw-text-gray-400">support@tinped.com</li>
                        <li class="tw-text-gray-400">+1 (555) 123-4567</li>
                        <li class="tw-text-gray-400">Live chat: 24/7</li>
                    </ul>
                </div>
            </div>
            <div class="tw-mt-12 tw-pt-8 tw-border-t tw-border-gray-800 tw-text-center">
                <p class="tw-text-gray-400">© 2023 TINPED. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <!-- AOS (Animate on Scroll) -->
    <script src="https://unpkg.com/aos@next/dist/aos.min.js"></script>
    
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
                content.style.display = 'block';
            });
            
            accordionTriggers.forEach(trigger => {
                trigger.addEventListener('click', function() {
                    const parent = this.parentElement;
                    const content = parent.querySelector('.accordion-content');
                    const column = parent.parentElement;
                    
                    // Close all accordions in this column
                    const columnItems = column.querySelectorAll('.accordion-item');
                    columnItems.forEach(item => {
                        if (item !== parent) {
                            item.classList.remove('active');
                            item.querySelector('.accordion-content').style.display = 'none';
                        }
                    });
                    
                    // Toggle current accordion
                    if (parent.classList.contains('active')) {
                        parent.classList.remove('active');
                        content.style.display = 'none';
                    } else {
                        parent.classList.add('active');
                        content.style.display = 'block';
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
