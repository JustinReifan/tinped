<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TINPED SMM - Premium Social Media Marketing Services</title>
    <meta name="description" content="Boost your social media presence with TINPED SMM. We provide high-quality engagement for all major social platforms with fast delivery and 24/7 support." />
    <meta name="author" content="TINPED SMM" />
    <meta property="og:image" content="{{ asset('og-image.png') }}" />
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            prefix: 'tw-',
            theme: {
                container: {
                    center: true,
                    padding: '2rem',
                    screens: {
                        '2xl': '1400px'
                    }
                },
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
                    boxShadow: {
                        'glow-primary': '0 0 20px -5px rgba(115, 103, 240, 0.5)',
                        'glow-primary-lg': '0 0 30px -5px rgba(115, 103, 240, 0.7)',
                        'glass': '0 8px 32px 0 rgba(31, 38, 135, 0.07)',
                    },
                    backgroundImage: {
                        'hero-pattern': 'url("/patterns/hero-pattern.svg")',
                        'grid-pattern': 'linear-gradient(to right, rgba(115, 103, 240, 0.1) 1px, transparent 1px), linear-gradient(to bottom, rgba(115, 103, 240, 0.1) 1px, transparent 1px)',
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-out forwards',
                        'fade-in-right': 'fadeInRight 0.6s ease-out forwards',
                        'fade-in-left': 'fadeInLeft 0.6s ease-out forwards',
                        'carousel': 'carousel 25s linear infinite',
                        'pulse-glow': 'pulseGlow 3s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(10px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        fadeInRight: {
                            '0%': { opacity: '0', transform: 'translateX(20px)' },
                            '100%': { opacity: '1', transform: 'translateX(0)' }
                        },
                        fadeInLeft: {
                            '0%': { opacity: '0', transform: 'translateX(-20px)' },
                            '100%': { opacity: '1', transform: 'translateX(0)' }
                        },
                        carousel: {
                            '0%': { transform: 'translateX(0)' },
                            '100%': { transform: 'translateX(-100%)' }
                        },
                        pulseGlow: {
                            '0%, 100%': { opacity: '1', transform: 'scale(1)' },
                            '50%': { opacity: '0.85', transform: 'scale(1.05)' }
                        },
                    }
                }
            },
            plugins: [],
        }
    </script>
    
    <style>
        body {
            font-family: 'Inter var', sans-serif;
            background-color: white;
            color: #333;
            overflow-x: hidden;
        }
        
        /* Card styles */
        .card {
            border-radius: 0.5rem;
            border: 1px solid #e5e7eb;
            background-color: white;
            color: #333;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }
        
        .card:hover {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-color: #d4d0fe;
        }
        
        .card-with-glow {
            position: relative;
        }
        
        .card-with-glow::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 0.5rem;
            padding: 2px;
            background: linear-gradient(to right, #7367f0, #9a8ff8);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0.5;
            transition: opacity 0.3s ease;
        }
        
        .card-with-glow:hover::before {
            opacity: 0.8;
        }
        
        /* Button styles */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            white-space: nowrap;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.3s;
            padding: 0.5rem 1rem;
            height: 2.5rem;
        }
        
        .btn:hover {
            transform: scale(1.02);
        }
        
        .btn:active {
            transform: scale(0.98);
        }
        
        .btn-primary {
            background-color: #7367f0;
            color: white;
        }
        
        .btn-primary:hover {
            background-color: rgba(115, 103, 240, 0.9);
        }
        
        .btn-outline {
            border: 1px solid #e5e7eb;
            background-color: transparent;
        }
        
        .btn-outline:hover {
            background-color: #f3f4f6;
            border-color: #d4d0fe;
            box-shadow: 0 0 10px -5px rgba(115, 103, 240, 0.5);
        }
        
        /* FAQ Accordion Styles */
        .faq-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        @media (min-width: 768px) {
            .faq-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        .faq-item {
            border-radius: 0.5rem;
            border: 1px solid #e5e7eb;
            overflow: hidden;
            transition: all 0.3s;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .faq-item:hover {
            box-shadow: 0 4px 15px rgba(115, 103, 240, 0.15);
        }
        
        .faq-question {
            padding: 1.25rem;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
            background-color: #f9fafb;
            transition: background-color 0.3s;
        }
        
        .faq-question:hover {
            background-color: #f5f3ff;
        }
        
        .faq-toggle {
            font-size: 1.25rem;
            font-weight: bold;
            transition: transform 0.3s ease;
        }
        
        .faq-answer {
            padding: 0;
            max-height: 0;
            overflow: hidden;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 300;
            color: #4b5563;
            background-color: white;
        }
        
        .faq-answer-inner {
            padding: 1.25rem;
        }
        
        .faq-item.active .faq-toggle {
            transform: rotate(45deg);
        }
        
        .faq-item.active .faq-answer {
            max-height: 500px;
        }
        
        /* Comparison Table Styles */
        .comparison-table {
            border-radius: 0.5rem;
            overflow: hidden;
            position: relative;
        }
        
        .comparison-table::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 0.5rem;
            padding: 2px;
            background: linear-gradient(to right, #7367f0, #9a8ff8);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0.5;
            transition: opacity 0.3s ease;
            pointer-events: none;
            z-index: 10;
        }
        
        .comparison-table:hover::before {
            opacity: 0.8;
        }
        
        /* Social Icons */
        .social-icons {
            display: flex;
            gap: 0.75rem;
        }
        
        .social-icon {
            width: 2.5rem;
            height: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.375rem;
            background-color: #f3f4f6;
            color: #4b5563;
            transition: all 0.3s;
        }
        
        .social-icon:hover {
            background-color: #7367f0;
            color: white;
            transform: translateY(-3px);
        }
    </style>
</head>

<body>
    <main class="tw-min-h-screen tw-bg-white tw-overflow-x-hidden">
        <!-- Navbar -->
        <nav class="tw-sticky tw-top-0 tw-z-50 tw-bg-white/80 tw-backdrop-blur-md tw-shadow-sm tw-w-full">
            <div class="tw-container tw-mx-auto tw-px-4 tw-py-4 tw-flex tw-justify-between tw-items-center">
                <div class="tw-flex tw-items-center tw-space-x-4">
                    <a href="#" class="tw-text-2xl tw-font-bold tw-text-primary">
                        TINPED<span class="tw-text-gray-700">SMM</span>
                    </a>
                    
                    <div class="tw-hidden md:tw-flex tw-space-x-6 tw-ml-10">
                        <a href="#what-is-tinped" class="tw-text-gray-600 hover:tw-text-primary tw-transition-colors">About</a>
                        <a href="#services" class="tw-text-gray-600 hover:tw-text-primary tw-transition-colors">Services</a>
                        <a href="#features" class="tw-text-gray-600 hover:tw-text-primary tw-transition-colors">Features</a>
                        <a href="#faq" class="tw-text-gray-600 hover:tw-text-primary tw-transition-colors">FAQ</a>
                    </div>
                </div>
                
                <div class="tw-flex tw-items-center tw-space-x-3">
                    <a href="#get-started" class="btn btn-outline tw-hidden sm:tw-flex">
                        Login
                    </a>
                    <a href="#get-started" class="btn btn-primary">
                        Get Started
                    </a>
                    <button id="mobile-menu-button" class="tw-block md:tw-hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-6 tw-w-6 tw-text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Mobile menu (hidden by default) -->
            <div id="mobile-menu" class="tw-hidden tw-px-4 tw-py-3 tw-shadow-lg tw-bg-white md:tw-hidden">
                <a href="#what-is-tinped" class="tw-block tw-py-2 tw-text-gray-600 hover:tw-text-primary">About</a>
                <a href="#services" class="tw-block tw-py-2 tw-text-gray-600 hover:tw-text-primary">Services</a>
                <a href="#features" class="tw-block tw-py-2 tw-text-gray-600 hover:tw-text-primary">Features</a>
                <a href="#faq" class="tw-block tw-py-2 tw-text-gray-600 hover:tw-text-primary">FAQ</a>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="tw-relative tw-overflow-hidden tw-bg-hero-pattern tw-py-20 md:tw-py-32">
            <div class="tw-container tw-mx-auto tw-px-4 tw-relative tw-z-10">
                <div class="tw-grid tw-grid-cols-1 lg:tw-grid-cols-2 tw-gap-12 tw-items-center">
                    <div class="tw-animate-fade-in">
                        <h1 class="tw-text-4xl md:tw-text-5xl lg:tw-text-6xl tw-font-bold tw-text-gray-800 tw-mb-6">
                            Premium <span class="tw-text-primary">Social Media</span> Marketing Services
                        </h1>
                        <p class="tw-text-lg tw-text-gray-600 tw-mb-8 tw-max-w-xl">
                            Get high-quality social media services to boost your online presence. Perfect for influencers, businesses, and content creators.
                        </p>
                        <div class="tw-flex tw-flex-wrap tw-gap-4">
                            <a href="#get-started" class="btn btn-primary">
                                Get Started
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right">
                                    <path d="M5 12h14"></path>
                                    <path d="m12 5 7 7-7 7"></path>
                                </svg>
                            </a>
                            <a href="#what-is-tinped" class="btn btn-outline">
                                Learn More
                            </a>
                        </div>
                    </div>
                    <div class="tw-flex tw-justify-center tw-animate-fade-in">
                        <img src="{{ asset('images/hero-image.png') }}" alt="Social Media Marketing" class="tw-max-w-full tw-rounded-lg tw-shadow-lg" />
                    </div>
                </div>
            </div>
        </section>
        
        <!-- What is Tinped Section -->
        <section id="what-is-tinped" class="tw-py-20 tw-bg-white">
            <div class="tw-container tw-mx-auto tw-px-4">
                <div class="tw-text-center tw-mb-16">
                    <h2 class="tw-text-3xl md:tw-text-4xl tw-font-bold tw-mb-4">What is <span class="tw-text-primary">Tinped SMM</span>?</h2>
                    <p class="tw-text-gray-600 tw-max-w-3xl tw-mx-auto">
                        Tinped SMM is a premier social media marketing platform that provides high-quality engagement services for all major social networks.
                    </p>
                </div>
                
                <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 lg:tw-grid-cols-3 tw-gap-8">
                    @php
                    $platforms = [
                        [
                            'name' => 'Instagram',
                            'description' => 'Boost your Instagram presence with likes, followers, comments, and more',
                            'icon' => 'instagram'
                        ],
                        [
                            'name' => 'TikTok',
                            'description' => 'Increase your TikTok engagement with views, likes, followers, and shares',
                            'icon' => 'tiktok'
                        ],
                        [
                            'name' => 'YouTube',
                            'description' => 'Grow your YouTube channel with subscribers, views, likes, and comments',
                            'icon' => 'youtube'
                        ],
                        [
                            'name' => 'Facebook',
                            'description' => 'Enhance your Facebook page with likes, followers, and engagement',
                            'icon' => 'facebook'
                        ],
                        [
                            'name' => 'Twitter',
                            'description' => 'Get more Twitter followers, retweets, likes, and impressions',
                            'icon' => 'twitter'
                        ],
                        [
                            'name' => 'LinkedIn',
                            'description' => 'Build your professional network with LinkedIn connections and engagement',
                            'icon' => 'linkedin'
                        ]
                    ];
                    @endphp
                    
                    @foreach($platforms as $platform)
                    <div class="card tw-p-6 tw-h-full tw-flex tw-flex-col tw-animate-fade-in">
                        <div class="tw-rounded-full tw-bg-primary-50 tw-w-14 tw-h-14 tw-flex tw-items-center tw-justify-center tw-mb-4">
                            <i class="fab fa-{{ $platform['icon'] }} tw-text-primary tw-text-xl"></i>
                        </div>
                        <h3 class="tw-text-xl tw-font-semibold tw-mb-2">{{ $platform['name'] }}</h3>
                        <p class="tw-text-gray-600 tw-mb-4 tw-flex-grow">{{ $platform['description'] }}</p>
                        <a href="#services" class="tw-text-primary tw-font-medium tw-flex tw-items-center tw-mt-auto">
                            View Services
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="tw-ml-1">
                                <path d="m9 18 6-6-6-6"></path>
                            </svg>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        
        <!-- Get Started Section -->
        <section id="get-started" class="tw-py-24 tw-bg-gray-50">
            <div class="tw-container tw-mx-auto tw-px-4">
                <div class="tw-text-center tw-mb-16">
                    <h2 class="tw-text-3xl md:tw-text-4xl tw-font-bold tw-mb-4">How to <span class="tw-text-primary">Get Started</span></h2>
                    <p class="tw-text-gray-600 tw-max-w-3xl tw-mx-auto">
                        Getting started with Tinped SMM is quick and easy. Follow these simple steps to begin boosting your social media presence.
                    </p>
                </div>
                
                <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 lg:tw-grid-cols-3 tw-gap-8">
                    @php
                    $steps = [
                        [
                            'number' => '01',
                            'title' => 'Sign Up',
                            'description' => 'Create an account and verify your email to get started with our services',
                            'icon' => 'user-plus'
                        ],
                        [
                            'number' => '02',
                            'title' => 'Add Funds',
                            'description' => 'Deposit funds into your account using various payment methods',
                            'icon' => 'credit-card'
                        ],
                        [
                            'number' => '03',
                            'title' => 'Place Order',
                            'description' => 'Select the service you want and provide the required details',
                            'icon' => 'shopping-cart'
                        ]
                    ];
                    @endphp
                    
                    @foreach($steps as $step)
                    <div class="card card-with-glow tw-p-8 tw-h-full tw-flex tw-flex-col tw-animate-fade-in">
                        <div class="tw-flex tw-items-center tw-justify-between tw-mb-6">
                            <span class="tw-text-4xl tw-font-bold tw-text-primary-200">{{ $step['number'] }}</span>
                            <div class="tw-rounded-full tw-bg-primary-50 tw-w-12 tw-h-12 tw-flex tw-items-center tw-justify-center">
                                <i data-feather="{{ $step['icon'] }}" class="tw-text-primary"></i>
                            </div>
                        </div>
                        <h3 class="tw-text-xl tw-font-semibold tw-mb-3">{{ $step['title'] }}</h3>
                        <p class="tw-text-gray-600">{{ $step['description'] }}</p>
                    </div>
                    @endforeach
                </div>
                
                <div class="tw-mt-16 tw-text-center">
                    <a href="#" class="btn btn-primary">
                        Create Account
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"></path>
                            <path d="m12 5 7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        <!-- Price List Section -->
        <section id="services" class="tw-py-24 tw-bg-white">
            <div class="tw-container tw-mx-auto tw-px-4">
                <div class="tw-text-center tw-mb-16">
                    <h2 class="tw-text-3xl md:tw-text-4xl tw-font-bold tw-mb-4">Our <span class="tw-text-primary">Services</span></h2>
                    <p class="tw-text-gray-600 tw-max-w-3xl tw-mx-auto">
                        We offer a wide range of social media marketing services at competitive prices. All services come with fast delivery and 24/7 support.
                    </p>
                </div>
                
                <div class="tw-overflow-hidden tw-relative">
                    <div class="tw-flex tw-animate-carousel">
                        @php
                        $services = [
                            [
                                'platform' => 'Instagram',
                                'service' => 'Followers',
                                'price' => '$2.99',
                                'quantity' => '1,000',
                                'quality' => 'High Quality',
                                'delivery' => 'Fast'
                            ],
                            [
                                'platform' => 'TikTok',
                                'service' => 'Views',
                                'price' => '$1.99',
                                'quantity' => '10,000',
                                'quality' => 'High Quality',
                                'delivery' => 'Instant'
                            ],
                            [
                                'platform' => 'YouTube',
                                'service' => 'Subscribers',
                                'price' => '$15.99',
                                'quantity' => '1,000',
                                'quality' => 'Premium',
                                'delivery' => 'Gradual'
                            ],
                            [
                                'platform' => 'Facebook',
                                'service' => 'Page Likes',
                                'price' => '$3.99',
                                'quantity' => '1,000',
                                'quality' => 'Real',
                                'delivery' => 'Fast'
                            ],
                            [
                                'platform' => 'Twitter',
                                'service' => 'Followers',
                                'price' => '$4.99',
                                'quantity' => '1,000',
                                'quality' => 'High Quality',
                                'delivery' => 'Fast'
                            ],
                            [
                                'platform' => 'Instagram',
                                'service' => 'Likes',
                                'price' => '$0.99',
                                'quantity' => '1,000',
                                'quality' => 'High Quality',
                                'delivery' => 'Instant'
                            ],
                            [
                                'platform' => 'TikTok',
                                'service' => 'Followers',
                                'price' => '$5.99',
                                'quantity' => '1,000',
                                'quality' => 'Premium',
                                'delivery' => 'Fast'
                            ],
                            [
                                'platform' => 'YouTube',
                                'service' => 'Views',
                                'price' => '$2.99',
                                'quantity' => '10,000',
                                'quality' => 'High Retention',
                                'delivery' => 'Steady'
                            ]
                        ];
                        @endphp
                        
                        @foreach($services as $service)
                        <div class="card tw-p-6 tw-min-w-[280px] tw-m-3 tw-flex tw-flex-col">
                            <div class="tw-flex tw-items-center tw-mb-4">
                                <div class="tw-rounded-full tw-bg-primary-50 tw-w-10 tw-h-10 tw-flex tw-items-center tw-justify-center tw-mr-3">
                                    <i class="fab fa-{{ strtolower($service['platform']) }} tw-text-primary"></i>
                                </div>
                                <div>
                                    <h3 class="tw-text-lg tw-font-semibold">{{ $service['platform'] }}</h3>
                                    <p class="tw-text-sm tw-text-gray-500">{{ $service['service'] }}</p>
                                </div>
                            </div>
                            <div class="tw-mb-4 tw-flex-grow">
                                <div class="tw-flex tw-justify-between tw-mb-2">
                                    <span class="tw-text-gray-600">Quantity:</span>
                                    <span class="tw-font-medium">{{ $service['quantity'] }}</span>
                                </div>
                                <div class="tw-flex tw-justify-between tw-mb-2">
                                    <span class="tw-text-gray-600">Quality:</span>
                                    <span class="tw-font-medium">{{ $service['quality'] }}</span>
                                </div>
                                <div class="tw-flex tw-justify-between">
                                    <span class="tw-text-gray-600">Delivery:</span>
                                    <span class="tw-font-medium">{{ $service['delivery'] }}</span>
                                </div>
                            </div>
                            <div class="tw-flex tw-items-center tw-justify-between tw-mt-4">
                                <span class="tw-text-2xl tw-font-bold tw-text-primary">{{ $service['price'] }}</span>
                                <a href="#" class="btn btn-outline tw-py-2 tw-px-4 tw-h-auto">Order Now</a>
                            </div>
                        </div>
                        @endforeach
                        
                        <!-- Duplicate the services for infinite carousel effect -->
                        @foreach($services as $service)
                        <div class="card tw-p-6 tw-min-w-[280px] tw-m-3 tw-flex tw-flex-col">
                            <div class="tw-flex tw-items-center tw-mb-4">
                                <div class="tw-rounded-full tw-bg-primary-50 tw-w-10 tw-h-10 tw-flex tw-items-center tw-justify-center tw-mr-3">
                                    <i class="fab fa-{{ strtolower($service['platform']) }} tw-text-primary"></i>
                                </div>
                                <div>
                                    <h3 class="tw-text-lg tw-font-semibold">{{ $service['platform'] }}</h3>
                                    <p class="tw-text-sm tw-text-gray-500">{{ $service['service'] }}</p>
                                </div>
                            </div>
                            <div class="tw-mb-4 tw-flex-grow">
                                <div class="tw-flex tw-justify-between tw-mb-2">
                                    <span class="tw-text-gray-600">Quantity:</span>
                                    <span class="tw-font-medium">{{ $service['quantity'] }}</span>
                                </div>
                                <div class="tw-flex tw-justify-between tw-mb-2">
                                    <span class="tw-text-gray-600">Quality:</span>
                                    <span class="tw-font-medium">{{ $service['quality'] }}</span>
                                </div>
                                <div class="tw-flex tw-justify-between">
                                    <span class="tw-text-gray-600">Delivery:</span>
                                    <span class="tw-font-medium">{{ $service['delivery'] }}</span>
                                </div>
                            </div>
                            <div class="tw-flex tw-items-center tw-justify-between tw-mt-4">
                                <span class="tw-text-2xl tw-font-bold tw-text-primary">{{ $service['price'] }}</span>
                                <a href="#" class="btn btn-outline tw-py-2 tw-px-4 tw-h-auto">Order Now</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="tw-mt-16 tw-text-center">
                    <a href="#" class="btn btn-primary">
                        View All Services
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m8 4 8 8-8 8"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="tw-py-24 tw-bg-gray-50">
            <div class="tw-container tw-mx-auto tw-px-4">
                <div class="tw-text-center tw-mb-16">
                    <h2 class="tw-text-3xl md:tw-text-4xl tw-font-bold tw-mb-4">Why Choose <span class="tw-text-primary">Tinped SMM</span></h2>
                    <p class="tw-text-gray-600 tw-max-w-3xl tw-mx-auto">
                        We provide the highest quality social media marketing services with features designed to help you grow your online presence effectively.
                    </p>
                </div>
                
                <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 lg:tw-grid-cols-3 tw-gap-8">
                    @php
                    $features = [
                        [
                            'title' => 'High Quality',
                            'description' => 'We provide only high-quality, real-looking engagement that helps boost your social media presence',
                            'icon' => 'award'
                        ],
                        [
                            'title' => 'Fast Delivery',
                            'description' => 'Our services begin processing immediately after your order with most completed within 24-48 hours',
                            'icon' => 'zap'
                        ],
                        [
                            'title' => '24/7 Support',
                            'description' => 'Our customer support team is available 24/7 to assist you with any questions or issues',
                            'icon' => 'headphones'
                        ],
                        [
                            'title' => 'Affordable Prices',
                            'description' => 'We offer competitive pricing on all our services to ensure you get the best value',
                            'icon' => 'dollar-sign'
                        ],
                        [
                            'title' => 'Secure Payments',
                            'description' => 'All transactions are processed securely with multiple payment options available',
                            'icon' => 'shield'
                        ],
                        [
                            'title' => 'No Password Required',
                            'description' => 'We never ask for your social media passwords, ensuring your account security',
                            'icon' => 'lock'
                        ]
                    ];
                    @endphp
                    
                    @foreach($features as $feature)
                    <div class="card card-with-glow tw-p-6 tw-h-full tw-flex tw-flex-col tw-animate-fade-in">
                        <div class="tw-rounded-full tw-bg-primary-50 tw-w-14 tw-h-14 tw-flex tw-items-center tw-justify-center tw-mb-4">
                            <i data-feather="{{ $feature['icon'] }}" class="tw-text-primary"></i>
                        </div>
                        <h3 class="tw-text-xl tw-font-semibold tw-mb-3">{{ $feature['title'] }}</h3>
                        <p class="tw-text-gray-600">{{ $feature['description'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Difference Section -->
        <section class="tw-py-24 tw-bg-white">
            <div class="tw-container tw-mx-auto tw-px-4">
                <div class="tw-text-center tw-mb-16">
                    <h2 class="tw-text-3xl md:tw-text-4xl tw-font-bold tw-mb-4">What Makes Us <span class="tw-text-primary">Different</span></h2>
                    <p class="tw-text-gray-600 tw-max-w-3xl tw-mx-auto">
                        See how Tinped SMM compares to other social media marketing services in the market and why we're the preferred choice.
                    </p>
                </div>
                
                <div class="comparison-table tw-overflow-x-auto">
                    <table class="tw-w-full tw-border-collapse">
                        <thead>
                            <tr class="tw-bg-gray-50">
                                <th class="tw-p-4 tw-text-left tw-font-semibold tw-border-b">Features</th>
                                <th class="tw-p-4 tw-text-center tw-font-semibold tw-border-b tw-bg-primary-50 tw-text-primary">Tinped SMM</th>
                                <th class="tw-p-4 tw-text-center tw-font-semibold tw-border-b">Other Services</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $comparisons = [
                                [
                                    'feature' => 'Quality of Engagement',
                                    'tinped' => 'High-quality, real-looking engagement',
                                    'others' => 'Often low-quality, bot-like engagement'
                                ],
                                [
                                    'feature' => 'Delivery Speed',
                                    'tinped' => 'Fast delivery, most orders completed within 24-48 hours',
                                    'others' => 'Variable delivery times, often delayed'
                                ],
                                [
                                    'feature' => 'Customer Support',
                                    'tinped' => '24/7 dedicated support team',
                                    'others' => 'Limited support hours or slow response times'
                                ],
                                [
                                    'feature' => 'Refill Guarantee',
                                    'tinped' => 'Free refills for any drops within 30 days',
                                    'others' => 'No refill guarantee or paid refills only'
                                ],
                                [
                                    'feature' => 'Account Security',
                                    'tinped' => 'No password required, 100% safe',
                                    'others' => 'May require account passwords or access'
                                ],
                                [
                                    'feature' => 'Pricing',
                                    'tinped' => 'Competitive prices with bulk discounts',
                                    'others' => 'Often overpriced with hidden fees'
                                ]
                            ];
                            @endphp
                            
                            @foreach($comparisons as $comparison)
                            <tr class="tw-border-b hover:tw-bg-gray-50 tw-transition-colors">
                                <td class="tw-p-4 tw-font-medium">{{ $comparison['feature'] }}</td>
                                <td class="tw-p-4 tw-text-center tw-bg-primary-50/30">
                                    <div class="tw-flex tw-items-center tw-justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="tw-text-primary tw-mr-2">
                                            <path d="M20 6L9 17l-5-5"></path>
                                        </svg>
                                        <span>{{ $comparison['tinped'] }}</span>
                                    </div>
                                </td>
                                <td class="tw-p-4 tw-text-center tw-text-gray-600">{{ $comparison['others'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="tw-py-24 tw-bg-gray-50">
            <div class="tw-container tw-mx-auto tw-px-4">
                <div class="tw-text-center tw-mb-16">
                    <h2 class="tw-text-3xl md:tw-text-4xl tw-font-bold tw-mb-4">What Our <span class="tw-text-primary">Clients Say</span></h2>
                    <p class="tw-text-gray-600 tw-max-w-3xl tw-mx-auto">
                        Hear from our satisfied clients about their experience with Tinped SMM and how our services have helped them grow their social media presence.
                    </p>
                </div>
                
                <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 lg:tw-grid-cols-3 tw-gap-8">
                    @php
                    $testimonials = [
                        [
                            'name' => 'Sarah Johnson',
                            'role' => 'Instagram Influencer',
                            'content' => 'Tinped SMM has been a game-changer for my Instagram growth. The followers I received are high-quality and engage with my content regularly. Their customer service is also top-notch!',
                            'avatar' => 'https://randomuser.me/api/portraits/women/44.jpg',
                            'rating' => 5
                        ],
                        [
                            'name' => 'Michael Rodriguez',
                            'role' => 'TikTok Creator',
                            'content' => 'I\'ve tried many SMM services, but Tinped stands out with their fast delivery and quality. My TikTok views and followers increased significantly, helping me land brand deals.',
                            'avatar' => 'https://randomuser.me/api/portraits/men/32.jpg',
                            'rating' => 5
                        ],
                        [
                            'name' => 'Emma Williams',
                            'role' => 'Small Business Owner',
                            'content' => 'As a small business owner, I needed to boost my social media presence quickly. Tinped SMM delivered high-quality engagement that helped my brand gain visibility. Highly recommended!',
                            'avatar' => 'https://randomuser.me/api/portraits/women/67.jpg',
                            'rating' => 4
                        ],
                        [
                            'name' => 'David Chen',
                            'role' => 'YouTuber',
                            'content' => 'The YouTube subscribers and views I got from Tinped SMM helped my channel reach the monetization threshold faster than expected. Great service with consistent results.',
                            'avatar' => 'https://randomuser.me/api/portraits/men/75.jpg',
                            'rating' => 5
                        ],
                        [
                            'name' => 'Sophia Martinez',
                            'role' => 'Digital Marketer',
                            'content' => 'I manage social media for multiple clients, and Tinped SMM has become my go-to service for boosting engagement. Their reliability and quality are unmatched in the industry.',
                            'avatar' => 'https://randomuser.me/api/portraits/women/90.jpg',
                            'rating' => 5
                        ],
                        [
                            'name' => 'James Wilson',
                            'role' => 'Entrepreneur',
                            'content' => 'Tinped SMM helped me establish a strong social media presence for my startup. Their services are affordable yet high-quality, and their support team is always helpful.',
                            'avatar' => 'https://randomuser.me/api/portraits/men/41.jpg',
                            'rating' => 4
                        ]
                    ];
                    @endphp
                    
                    @foreach($testimonials as $testimonial)
                    <div class="card tw-p-6 tw-h-full tw-flex tw-flex-col tw-animate-fade-in">
                        <div class="tw-flex tw-items-center tw-mb-4">
                            <img src="{{ $testimonial['avatar'] }}" alt="{{ $testimonial['name'] }}" class="tw-w-12 tw-h-12 tw-rounded-full tw-mr-4" />
                            <div>
                                <h3 class="tw-font-semibold">{{ $testimonial['name'] }}</h3>
                                <p class="tw-text-sm tw-text-gray-500">{{ $testimonial['role'] }}</p>
                            </div>
                        </div>
                        <div class="tw-mb-4 tw-flex-grow">
                            <p class="tw-text-gray-600">{{ $testimonial['content'] }}</p>
                        </div>
                        <div class="tw-flex tw-items-center tw-mt-auto">
                            @for($i = 0; $i < $testimonial['rating']; $i++)
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#7367f0" stroke="#7367f0" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="tw-mr-1">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                            @endfor
                            @for($i = 0; $i < 5 - $testimonial['rating']; $i++)
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#7367f0" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="tw-mr-1">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                            @endfor
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Payment Methods Section -->
        <section class="tw-py-20 tw-bg-white">
            <div class="tw-container tw-mx-auto tw-px-4">
                <div class="tw-text-center tw-mb-12">
                    <h2 class="tw-text-3xl md:tw-text-4xl tw-font-bold tw-mb-4">Payment <span class="tw-text-primary">Methods</span></h2>
                    <p class="tw-text-gray-600 tw-max-w-3xl tw-mx-auto">
                        We accept various payment methods to make it convenient for you to purchase our services.
                    </p>
                </div>
                
                <div class="tw-grid tw-grid-cols-2 sm:tw-grid-cols-3 md:tw-grid-cols-4 lg:tw-grid-cols-6 tw-gap-6 tw-justify-items-center">
                    @php
                    $paymentMethods = [
                        ['name' => 'Visa', 'image' => 'visa.png'],
                        ['name' => 'Mastercard', 'image' => 'mastercard.png'],
                        ['name' => 'PayPal', 'image' => 'paypal.png'],
                        ['name' => 'Bitcoin', 'image' => 'bitcoin.png'],
                        ['name' => 'Ethereum', 'image' => 'ethereum.png'],
                        ['name' => 'Apple Pay', 'image' => 'apple-pay.png'],
                        ['name' => 'Google Pay', 'image' => 'google-pay.png'],
                        ['name' => 'Stripe', 'image' => 'stripe.png'],
                        ['name' => 'Bank Transfer', 'image' => 'bank-transfer.png'],
                        ['name' => 'Alipay', 'image' => 'alipay.png'],
                        ['name' => 'Perfect Money', 'image' => 'perfect-money.png'],
                        ['name' => 'WebMoney', 'image' => 'webmoney.png']
                    ];
                    @endphp
                    
                    @foreach($paymentMethods as $payment)
                    <div class="tw-flex tw-items-center tw-justify-center tw-p-4 tw-bg-gray-50 tw-rounded-lg tw-h-24 tw-w-full">
                        <img src="{{ asset('images/payments/' . $payment['image']) }}" alt="{{ $payment['name'] }}" class="tw-max-h-12 tw-max-w-full" />
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section id="faq" class="tw-py-20 tw-px-6 lg:tw-px-12 tw-relative tw-overflow-hidden tw-bg-gray-50/80">
            <!-- Background Elements -->
            <div class="tw-absolute tw-inset-0 tw-bg-grid-pattern tw-bg-[size:40px_40px] tw-opacity-30 tw-z-0"></div>
            <div class="tw-absolute tw-top-40 -tw-left-20 tw-w-60 tw-h-60 tw-bg-primary-100 tw-rounded-full tw-filter tw-blur-[100px] tw-opacity-40 tw-animate-float"></div>
            
            <div class="tw-max-w-7xl tw-mx-auto tw-relative tw-z-10">
                <div class="tw-flex tw-flex-col tw-items-center tw-mb-14">
                    <!-- Section Badge -->
                    <div class="tw-bg-primary tw-bg-opacity-10 tw-backdrop-blur-sm tw-rounded-full tw-px-4 tw-py-1.5 tw-flex tw-items-center tw-justify-center tw-mb-4 tw-border tw-border-primary-200">
                        <span class="tw-text-primary tw-font-semibold tw-text-sm">Unlocking Answers →</span>
                    </div>
                    
                    <!-- Heading -->
                    <h2 class="tw-text-3xl md:tw-text-4xl tw-font-bold tw-text-center tw-text-gray-900 tw-mb-4">
                        Your Top <span class="tw-text-primary">Questions</span> Answered
                    </h2>
                    
                    <!-- Subheading -->
                    <p class="tw-text-lg tw-text-gray-600 tw-text-center tw-max-w-2xl">
                        Everything you need to know about TINPED SMM services
                    </p>
                </div>
                
                <!-- FAQ Accordion - Two-column layout -->
                <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-6">
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
                    <div class="tw-bg-white tw-rounded-xl tw-shadow-lg hover:tw-shadow-glow-primary tw-border tw-border-primary-100 tw-overflow-hidden tw-transition-all tw-duration-300">
                        <div class="tw-w-full">
                            @foreach($firstHalf as $index => $item)
                            <div class="tw-accordion-item tw-border-b tw-border-primary-100 tw-overflow-hidden hover:tw-bg-primary-50/30 tw-transition-colors tw-duration-300 {{ $index === 0 ? 'tw-active' : '' }}">
                                <div class="tw-accordion-trigger tw-px-6 tw-py-5 tw-text-left tw-text-gray-800 tw-font-semibold tw-group tw-flex tw-items-center tw-justify-between tw-cursor-pointer">
                                    <span class="tw-group-hover:tw-text-primary tw-transition-colors tw-duration-300">{{ $item['question'] }}</span>
                                    <span class="tw-plus {{ $index === 0 ? 'tw-hidden' : '' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-5 tw-w-5 tw-shrink-0 tw-text-primary-400 tw-transition-transform tw-duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                    </span>
                                    <span class="tw-minus {{ $index === 0 ? '' : 'tw-hidden' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-5 tw-w-5 tw-shrink-0 tw-text-primary-500 tw-transition-transform tw-duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                    </span>
                                </div>
                                <div class="tw-accordion-content tw-overflow-hidden tw-transition-all tw-duration-300 tw-max-h-0 {{ $index === 0 ? 'tw-max-h-[500px]' : '' }}">
                                    <div class="tw-px-6 tw-pb-5 tw-text-gray-600 tw-font-light">
                                        {{ $item['answer'] }}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Second column -->
                    <div class="tw-bg-white tw-rounded-xl tw-shadow-lg hover:tw-shadow-glow-primary tw-border tw-border-primary-100 tw-overflow-hidden tw-transition-all tw-duration-300">
                        <div class="tw-w-full">
                            @foreach($secondHalf as $index => $item)
                            <div class="tw-accordion-item tw-border-b tw-border-primary-100 tw-overflow-hidden hover:tw-bg-primary-50/30 tw-transition-colors tw-duration-300 {{ $index === 0 ? 'tw-active' : '' }}">
                                <div class="tw-accordion-trigger tw-px-6 tw-py-5 tw-text-left tw-text-gray-800 tw-font-semibold tw-group tw-flex tw-items-center tw-justify-between tw-cursor-pointer">
                                    <span class="tw-group-hover:tw-text-primary tw-transition-colors tw-duration-300">{{ $item['question'] }}</span>
                                    <span class="tw-plus {{ $index === 0 ? 'tw-hidden' : '' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-5 tw-w-5 tw-shrink-0 tw-text-primary-400 tw-transition-transform tw-duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                    </span>
                                    <span class="tw-minus {{ $index === 0 ? '' : 'tw-hidden' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-5 tw-w-5 tw-shrink-0 tw-text-primary-500 tw-transition-transform tw-duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                    </span>
                                </div>
                                <div class="tw-accordion-content tw-overflow-hidden tw-transition-all tw-duration-300 tw-max-h-0 {{ $index === 0 ? 'tw-max-h-[500px]' : '' }}">
                                    <div class="tw-px-6 tw-pb-5 tw-text-gray-600 tw-font-light">
                                        {{ $item['answer'] }}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <!-- FAQ Additional Help Section -->
                <div class="tw-mt-16 tw-text-center">
                    <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-gap-4">
                        <div class="tw-inline-flex tw-items-center tw-justify-center tw-w-16 tw-h-16 tw-rounded-full tw-bg-primary-50 tw-border tw-border-primary-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="tw-text-primary">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                                <line x1="12" y1="17" x2="12.01" y2="17"></line>
                            </svg>
                        </div>
                        <p class="tw-text-lg tw-text-gray-600 tw-mb-4">Still have questions? Our support team is here to help!</p>
                        <a href="#" class="tw-inline-flex tw-items-center tw-justify-center tw-gap-2 tw-whitespace-nowrap tw-rounded-md tw-bg-primary tw-text-primary-foreground hover:tw-bg-primary/90 tw-h-10 tw-px-8 tw-py-2 tw-text-sm tw-font-medium tw-transition-all tw-duration-300 hover:tw-scale-[1.02] active:tw-scale-[0.98]">
                            Contact Support
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="tw-bg-gray-800 tw-text-white tw-py-12">
            <div class="tw-container tw-mx-auto tw-px-4">
                <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 lg:tw-grid-cols-4 tw-gap-8">
                    <div>
                        <h3 class="tw-text-xl tw-font-bold tw-mb-4">TINPED<span class="tw-text-primary">SMM</span></h3>
                        <p class="tw-text-gray-400 tw-mb-4">
                            Premium social media marketing services to boost your online presence and engagement.
                        </p>
                        <div class="social-icons">
                            <a href="#" class="social-icon">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="tw-text-lg tw-font-semibold tw-mb-4">Services</h3>
                        <ul class="tw-space-y-2">
                            <li><a href="#" class="tw-text-gray-400 hover:tw-text-primary tw-transition-colors">Instagram Services</a></li>
                            <li><a href="#" class="tw-text-gray-400 hover:tw-text-primary tw-transition-colors">TikTok Services</a></li>
                            <li><a href="#" class="tw-text-gray-400 hover:tw-text-primary tw-transition-colors">YouTube Services</a></li>
                            <li><a href="#" class="tw-text-gray-400 hover:tw-text-primary tw-transition-colors">Facebook Services</a></li>
                            <li><a href="#" class="tw-text-gray-400 hover:tw-text-primary tw-transition-colors">Twitter Services</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h3 class="tw-text-lg tw-font-semibold tw-mb-4">Company</h3>
                        <ul class="tw-space-y-2">
                            <li><a href="#" class="tw-text-gray-400 hover:tw-text-primary tw-transition-colors">About Us</a></li>
                            <li><a href="#" class="tw-text-gray-400 hover:tw-text-primary tw-transition-colors">Terms of Service</a></li>
                            <li><a href="#" class="tw-text-gray-400 hover:tw-text-primary tw-transition-colors">Privacy Policy</a></li>
                            <li><a href="#" class="tw-text-gray-400 hover:tw-text-primary tw-transition-colors">Refund Policy</a></li>
                            <li><a href="#" class="tw-text-gray-400 hover:tw-text-primary tw-transition-colors">Contact Us</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h3 class="tw-text-lg tw-font-semibold tw-mb-4">Contact</h3>
                        <ul class="tw-space-y-2">
                            <li class="tw-flex tw-items-center tw-text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="tw-mr-2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                123 Main Street, City, Country
                            </li>
                            <li class="tw-flex tw-items-center tw-text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="tw-mr-2">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                                +1 234 567 890
                            </li>
                            <li class="tw-flex tw-items-center tw-text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="tw-mr-2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                                support@tinpedsmm.com
                            </li>
                            <li class="tw-flex tw-items-center tw-text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="tw-mr-2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                24/7 Customer Support
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="tw-mt-12 tw-pt-6 tw-border-t tw-border-gray-700">
                    <div class="tw-flex tw-flex-col md:tw-flex-row tw-justify-between tw-items-center">
                        <p class="tw-text-gray-400 tw-mb-4 md:tw-mb-0">
                            &copy; {{ date('Y') }} TINPED SMM. All rights reserved.
                        </p>
                        <div class="tw-flex tw-space-x-4">
                            <a href="#" class="tw-text-gray-400 hover:tw-text-primary tw-transition-colors">Terms</a>
                            <a href="#" class="tw-text-gray-400 hover:tw-text-primary tw-transition-colors">Privacy</a>
                            <a href="#" class="tw-text-gray-400 hover:tw-text-primary tw-transition-colors">Cookies</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </main>

    <!-- FontAwesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    
    <script>
        // Initialize Feather Icons
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
            
            // Mobile menu toggle
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('tw-hidden');
                });
            }
            
            // FAQ accordions functionality
            const accordionItems = document.querySelectorAll('.tw-accordion-item');
            
            accordionItems.forEach(item => {
                const trigger = item.querySelector('.tw-accordion-trigger');
                const content = item.querySelector('.tw-accordion-content');
                const plusIcon = item.querySelector('.tw-plus');
                const minusIcon = item.querySelector('.tw-minus');
                
                trigger.addEventListener('click', () => {
                    // Check if current item is active
                    const isActive = item.classList.contains('tw-active');
                    
                    // Close all accordions
                    accordionItems.forEach(otherItem => {
                        otherItem.classList.remove('tw-active');
                        const otherContent = otherItem.querySelector('.tw-accordion-content');
                        const otherPlusIcon = otherItem.querySelector('.tw-plus');
                        const otherMinusIcon = otherItem.querySelector('.tw-minus');
                        
                        otherContent.classList.remove('tw-max-h-[500px]');
                        otherContent.classList.add('tw-max-h-0');
                        
                        otherPlusIcon.classList.remove('tw-hidden');
                        otherMinusIcon.classList.add('tw-hidden');
                    });
                    
                    // If current was not active, make it active
                    if (!isActive) {
                        item.classList.add('tw-active');
                        content.classList.add('tw-max-h-[500px]');
                        content.classList.remove('tw-max-h-0');
                        
                        plusIcon.classList.add('tw-hidden');
                        minusIcon.classList.remove('tw-hidden');
                    }
                });
            });
        });
    </script>
</body>
</html>