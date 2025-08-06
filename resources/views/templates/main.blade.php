<!doctype html>
<html lang="en"><!-- [Head] start -->
@php

    $color = $config->color_default;

    // Hapus tanda '#' jika ada
    $color = ltrim($color, '#');

    // Pisahkan komponen warna
    $r = hexdec(substr($color, 0, 2));
    $g = hexdec(substr($color, 2, 2));
    $b = hexdec(substr($color, 4, 2));
    $rgb = $r . ',' . $g . ',' . $b;
    // kalkulasikan saya ingin warna lebih gelap
    $r = $r - 40 < 0 ? 0 : $r - 40;
    $g = $g - 40 < 0 ? 0 : $g - 40;
    $b = $b - 40 < 0 ? 0 : $b - 40;
    // konversi kembali ke hex
    $hover = sprintf('#%02x%02x%02x', $r, $g, $b);
    [$r, $g, $b] = sscanf($hover, '#%02x%02x%02x');
    $rgb_hover = "$r, $g, $b";
@endphp

<head>
    <title>{{ $config->name_panel }}</title><!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="{{ $config->description_website }}">
    <meta name="keywords" content="{{ $config->keyword_website }}">
    <meta name="author" content="Justin dev"><!-- Jangan di ganti bos -->
    {!! $config->meta_website !!}
    <link rel="icon" href="{{ url($config->favicon) }}" type="image/x-icon">
<!-- [Page specific CSS] start -->

    {{-- tailwind css --}}
    @vite(['resources/views/landing/css/landing.css', 'resources/js/app.js'])
    <!-- [Page specific CSS] end --><!-- [Font] Family -->
    <link rel="stylesheet" href="{{ url('assets') }}/fonts/inter/inter.css" id="main-font-link">
    <link rel="shortcut icon" href="{{ url($config->favicon) }}">
    <!-- [phosphor Icons] https://phosphoricons.com/ -->
    <link rel="stylesheet" href="{{ url('assets') }}/fonts/phosphor/duotone/style.css">
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ url('assets') }}/fonts/tabler-icons.min.css">
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{ url('assets') }}/fonts/feather.css">
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ url('assets') }}/fonts/material.css"><!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ url('assets') }}/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="{{ url('assets') }}/css/style-preset.css">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/holdon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.rateyo.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />

    <link rel="canonical" href="https://tinped.com" />

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.rateyo.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/holdon.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --color-default: {{ $config->color_default }};
            --rgba-default: {{ $rgb }};
            --color-hover: {{ $hover }};
            --rgb-hover: {{ $rgb_hover }};
        }

        .spinner-border {
            width: 1rem;
            height: 1rem;
        }

        button {
            border-radius: 4px !important;
        }

        .text-xss {
            font-size: 1.1rem;

        }

        [data-pc-direction=ltr] .fw-bold {
            font-weight: 600 !important;
        }

        [data-pc-layout=color-header] .pc-header {
            position: fixed;
            background: 0 0;
        }

        .datatable-table td,
        .datatable-table th,
        .table td,
        .table th {
            white-space: normal;
        }

        .avatar-xs {
            height: 2rem;
            width: 2rem;
        }

        .btn-group-sm>.btn,
        .btn-sm,
        .introjs-tooltip .btn-group-sm>.introjs-button {
            border-radius: 5px;
        }

        .btn,
        .introjs-tooltip .introjs-button {
            border-radius: 5px;
        }

        .kotak {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 5px;
        }

        .label {
            font-weight: bold;
        }

        .value {
            margin-left: 5px;
            font-weight: 600;
        }

        .nav-link {
            color: #000;
        }
    </style>

</head>

<body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-layout="color-header" data-pc-direction="ltr"
    data-pc-theme_contrast="" data-pc-theme="light">

    <div class="loader-bg">
        <div class="loadingio-spinner-typing-xprgxbsyl4">
            <div class="ldio-b5rzs5omc1l">
                <div style="left:30.150000000000002px;background:#ffffff;animation-delay:-0.37499999999999994s;"></div>
                <div style="left:50.25px;background:#ffffff;animation-delay:-0.28124999999999994s;"></div>
                <div style="left:70.35000000000001px;background:#ffffff;animation-delay:-0.18749999999999997s;"></div>
                <div style="left:90.45px;background:#ffffff;animation-delay:-0.09374999999999999s;"></div>
            </div>
        </div>
    </div>
    <nav class="pc-sidebar">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="{{ route('order.single') }}" class="b-brand" style="color: var(--pc-heading-color)">
                    <!-- ========   Change your logo from here   ============ -->
                    <span class="fs-3 fw-bold">{{ $config->name_panel }}</span>
                </a>
            </div>
            <div class="navbar-content">
                <div class="card pc-user-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            @auth
                                <div class="flex-shrink-0"><img
                                        src="{{ url(Auth::user()->image ?? $config->default_image) }}" alt="user-image"
                                        class="user-avtar wid-45 rounded-circle"></div>
                                <div class="flex-grow-1 ms-3 me-2">
                                    <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                    @if(strtolower(Auth::user()->role) == 'admin')
                                    <small>{{ strtoupper(Auth::user()->role) }}</small>
                                   @else
                                   <small>{{ strtoupper(Auth::user()->level) }}</small>
                                    @endif
                                </div>
                            @endauth
                            @guest
                                <div class="flex-shrink-0"><img src="{{ url($config->default_image) }}" alt="user-image"
                                        class="user-avtar wid-45 rounded-circle"></div>
                                <div class="flex-grow-1 ms-3 me-2">
                                    <h6 class="mb-0">Guest 🖖</h6>
                                    <small>Unknown user</small>
                                </div>
                            @endguest
                        </div>
                    </div>
                </div>
                <ul class="pc-navbar">
                    @auth

                        {{-- <li class="pc-item pc-caption"><label>Home</label></li>
                        <li class="pc-item"><a href="{{ url('dashboard') }}" class="pc-link">
                            <span class="pc-micon">
                                <i class="fas fa-house-chimney-user"></i>
                            </span>
                            <span class="pc-mtext">Dashboard</span>
                        </a>
                    </li> --}}
                    @if (Auth::user()->role == 'admin')
                        <li class="pc-item pc-caption"><label>Admin</label></li>
                            <li class="pc-item"><a href="{{ url('admin') }}" class="pc-link">
                                    <span class="pc-micon">
                                        <i class="fas fa-user-tie"></i>
                                    </span>
                                    <span class="pc-mtext">Admin</span>
                                </a>
                            </li>
                        @endif
                        <li class="pc-item pc-caption"><label>PEMESANAN</label></li>
                        <li class="pc-item ">
                            <a href="{{ url('order/single') }}" class="pc-link">
                                <span class="pc-micon">
                                    <i class="fas fa-cart-plus"></i>
                                </span>
                                <span class="pc-mtext">Pesanan Baru</span>
                            </a>
                        </li>
                        <li class="pc-item ">
                            <a href="{{ url('order/massal') }}" class="pc-link">
                                <span class="pc-micon">
                                    <i class="fas fa-cart-plus"></i>
                                </span>
                                <span class="pc-mtext">Pesanan Massal</span>
                            </a>
                        </li>
                        <li class="pc-item ">
                            <a href="{{ url('order/history') }}" class="pc-link">
                                <span class="pc-micon">
                                    <i class="fas fa-history"></i>
                                </span>
                                <span class="pc-mtext">Riwayat Pesanan</span>
                            </a>
                        </li>
                        <li class="pc-item ">
                            <a href="{{ url('history/refill') }}" class="pc-link">
                                <span class="pc-micon">
                                    <i class="fas fa-recycle"></i>
                                </span>
                                <span class="pc-mtext">Riwayat Refill</span>
                            </a>
                        </li>
                        <li class="pc-item pc-caption"><label>DEPOSIT</label></li>
                        <li class="pc-item">
                            <a href="{{ url('deposit/new') }}" class="pc-link">
                                <span class="pc-micon">
                                    <i class="fas fa-money-bill-transfer"></i>
                                </span>
                                <span class="pc-mtext">Deposit Baru</span>
                            </a>
                        </li>
                        <li class="pc-item">
                            <a href="{{ url('deposit/history') }}" class="pc-link">
                                <span class="pc-micon">
                                    <i class="fas fa-history"></i>
                                </span>
                                <span class="pc-mtext">Riwayat Deposit</span>
                            </a>
                        </li>
                        <li class="pc-item pc-caption"><label>Referral</label></li>

                        <li class="pc-item">
                            <a href="{{ url('referral') }}" class="pc-link">
                                <span class="pc-micon"><i class="fa-sharp fa-solid fa-link"></i>
                                </span>
                                <span class="pc-mtext">Referral</span>
                            </a>
                        </li>
                        <li class="pc-item pc-caption"><label>LAYANAN</label></li>
                        <li class="pc-item">
                            <a href="{{ url('list/layanan') }}" class="pc-link">
                                <span class="pc-micon">
                                    <i class="fas fa-tags"></i>
                                </span>
                                <span class="pc-mtext">Daftar Layanan</span>
                            </a>
                        </li>
                        <li class="pc-item">
                            <a href="{{ url('layanan/favorit') }}" class="pc-link">
                                <span class="pc-micon">
                                    <i class="far fa-star"></i>
                                </span>
                                <span class="pc-mtext">Layanan Favorit</span>
                            </a>
                        </li>
                        <li class="pc-item pc-caption"><label>TIKET</label></li>
                        <li class="pc-item">
                            <a href="{{ url('ticket/new') }}" class="pc-link">
                                <span class="pc-micon"><i class="fas fa-comment-medical"></i>
                                </span>
                                <span class="pc-mtext">Buat Tiket</span>
                            </a>
                        </li>
                        <li class="pc-item">
                            <a href="{{ url('ticket/list') }}"
                                class="pc-link d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="pc-micon"><i class="fas fa-headset"></i></span>
                                    <span class="pc-mtext">Data Tiket</span>
                                </div>
                                {{-- @php
                                    $tiket = App\Models\Ticket::where('user_id', auth()->id())
                                        ->where('status', 'open')
                                        ->count();
                                @endphp
                                @if ($tiket > 0)
                                    <span class="badge bg-primary rounded-circle">{{ $tiket }}</span>
                                @endif --}}
                            </a>
                        </li>
                        <li class="pc-item pc-caption"><label>PAGE</label></li>

                        <li class="pc-item"><a href="{{ url('news/berita') }}" class="pc-link"><span class="pc-micon">
                                    <i class="fas fa-bullhorn"></i>
                                    </svg> </span><span class="pc-mtext">Informasi</span></a>
                        </li>
                        <li class="pc-item"><a href="{{ url('dokumentasi-api') }}" class="pc-link"><span
                                    class="pc-micon">
                                    <i class="fas fa-code"></i>
                                    </svg> </span><span class="pc-mtext">Dokumentasi API</span></a>
                        </li>
                        <li class="pc-item pc-caption"><label>Log</label></li>

                        <li class="pc-item">
                            <a href="{{ url('page/log-login') }}" class="pc-link">
                                <span class="pc-micon"><i class="fas fa-users"></i>
                                </span>
                                <span class="pc-mtext">Riwayat Masuk</span>
                            </a>
                        </li>
                        <li class="pc-item">
                            <a href="{{ url('page/log-balance') }}" class="pc-link">
                                <span class="pc-micon"><i class="fas fa-comment-dollar"></i>
                                </span>
                                <span class="pc-mtext">Mutasi saldo</span>
                            </a>
                        </li>
                    @endauth
                    @guest
                        <li class="pc-item">
                            <a href="{{ url('/') }}/auth/login" class="pc-link">
                                <span class="pc-micon">
                                    <i class="fas fa-right-to-bracket"></i>
                                </span>
                                <span class="pc-mtext">Masuk</span>
                            </a>
                        </li>
                        <li class="pc-item">
                            <a href="{{ url('/') }}/auth/register" class="pc-link">
                                <span class="pc-micon">
                                    <i class="fas fa-user-plus fs-5"></i>
                                </span>
                                <span class="pc-mtext">Daftar</span>
                            </a>
                        </li>
                        <li class="pc-item">
                            <a href="{{ url('/') }}/list-layanan" class="pc-link">
                                <span class="pc-micon">
                                    <i class="fas fa-tags"></i>
                                </span>
                                <span class="pc-mtext">Layanan</span>
                            </a>
                        </li>
                    @endguest
                    <li class="pc-item pc-caption"><label>SITEMAP</label></li>
                    <li class="pc-item ">
                        <a href="{{ url('sitemap/kontak') }}" class="pc-link">
                            <span class="pc-micon">
                                <i class="fas fa-sitemap"></i>
                            </span>
                            <span class="pc-mtext">Kontak</span>
                        </a>
                    </li>
                    <li class="pc-item ">
                        <a href="{{ url('sitemap/ketentuan-layanan') }}" class="pc-link">
                            <span class="pc-micon">
                                <i class="fas fa-sitemap"></i>
                            </span>
                            <span class="pc-mtext">Ketentuan Layanan</span>
                        </a>
                    </li>
                    <li class="pc-item ">
                        <a href="{{ url('sitemap/contoh-pesanan') }}" class="pc-link">
                            <span class="pc-micon">
                                <i class="fas fa-sitemap"></i>
                            </span>
                            <span class="pc-mtext">Contoh pesanan</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <header class="pc-header">
        <div class="header-wrapper">
            <div class="me-auto pc-mob-drp">
                <ul class="list-unstyled"><!-- ======= Menu collapse Icon ===== -->
                    <li class="pc-h-item pc-sidebar-collapse"><a href="javascript:void(0)" class="pc-head-link ms-0"
                            id="sidebar-hide"><i class="ti ti-menu-2"></i></a></li>
                    <li class="pc-h-item pc-sidebar-popup"><a href="javascript:void(0)" class="pc-head-link ms-0"
                            id="mobile-collapse"><i class="ti ti-menu-2"></i></a></li>
                </ul>
            </div><!-- [Mobile Media Block end] -->
            <div class="ms-auto">
                <ul class="list-unstyled">
                    @auth
                        <li class="pc-h-item">
                            <button type="button" class="btn btn-sm btn-primary me-1"
                                onclick="window.location.href='{{ url('deposit/new') }}'">Rp
                                {{ number_format(Auth::user()->balance, 0, ',', '.') }}</button>
                        </li>

                    @endauth
                    <li class="dropdown pc-h-item"><a class="pc-head-link dropdown-toggle arrow-none me-0"
                            data-bs-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="false"
                            aria-expanded="false"><svg class="pc-icon">
                                <use xlink:href="#custom-sun-1"></use>
                            </svg></a>
                        <div class="dropdown-menu dropdown-menu-end pc-h-dropdown"><a href=javascript:void(0)
                                class="dropdown-item" onclick="ganti_layout('dark')"><svg class="pc-icon">
                                    <use xlink:href="#custom-moon"></use>
                                </svg> <span>Dark</span> </a><a href=javascript:void(0) class="dropdown-item"
                                onclick="ganti_layout('light')"><svg class="pc-icon">
                                    <use xlink:href="#custom-sun-1"></use>
                                </svg> <span>Light</span> </a><a href=javascript:void(0) class="dropdown-item"
                                onclick="layout_change_default()"><svg class="pc-icon">
                                    <use xlink:href="#custom-setting-2"></use>
                                </svg> <span>Default</span></a></div>
                    </li>
                    <li class="dropdown pc-h-item header-user-profile"><a
                            class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown"
                            href="javascript:void(0)" role="button" aria-haspopup="false"
                            data-bs-auto-close="outside" aria-expanded="false"><img
                                src="{{ url(Auth::user()->image ?? $config->default_image) }}" alt="user-image"
                                class="user-avtar"></a>
                        <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header d-flex align-items-center justify-content-between">
                                <h5 class="m-0">Profile</h5>
                            </div>
                            <div class="dropdown-body">
                                <div class="profile-notification-scroll position-relative"
                                    style="max-height: calc(100vh - 225px)" data-simplebar="init">
                                    <div class="simplebar-wrapper" style="margin: 0px;">
                                        <div class="simplebar-height-auto-observer-wrapper">
                                            <div class="simplebar-height-auto-observer"></div>
                                        </div>
                                        <div class="simplebar-mask">
                                            <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                                <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                                    aria-label="scrollable content"
                                                    style="height: auto; overflow: hidden;">
                                                    <div class="simplebar-content" style="padding: 0px;">

                                                        <div class="mb-1 d-flex">
                                                            @auth
                                                                <div class="d-flex align-items-center">
                                                                    <div class="flex-shrink-0">
                                                                        <img src="{{ url(Auth::user()->image ?? $config->default_image) }}"
                                                                            alt="user-image" class="user-avtar wid-35">
                                                                    </div>
                                                                    <div class="flex-grow-1 ms-3">
                                                                        <h6 class="mb-1">{{ Auth::user()->name }} 🖖
                                                                        </h6>
                                                                        <span
                                                                            class="fw-bold text-
                                                                            @if (strtolower(Auth::user()->level) == 'basic')primary
                                                                            @elseif(strtolower(Auth::user()->level) == 'premium')success
                                                                            @elseif(strtolower(Auth::user()->level) == 'ruby')secondary @endif">
                                                                            @if(strtolower(Auth::user()->role) == 'admin')
                                                                            {{ strtoupper(Auth::user()->role) }}
                                                                            @else
                                                                            {{ strtoupper(Auth::user()->level) }}
                                                                            @endif
                                                                        </span><br>
                                                                        <span>{{ Auth::user()->email }}</span>
                                                                    </div>
                                                                </div>


                                                            @endauth
                                                            @guest
                                                                <div class="flex-shrink-0"><img
                                                                        src="{{ url($config->default_image) }}"
                                                                        alt="user-image" class="user-avtar wid-35"></div>
                                                                <div class="flex-grow-1 ms-3">
                                                                    <h6 class="mb-1">Guest🖖</h6>
                                                                    <span>Unknown user</span>
                                                                </div>

                                                            @endguest
                                                        </div>
                                                        <p class="mt-3 text-span">Manage</p>
                                                        <a href="{{ url('account/pengaturan') }}"
                                                            class="dropdown-item">
                                                            <span>
                                                                <i
                                                                    class="align-middle fas fa-user-edit text-muted me-3"></i>
                                                                <span>Pengaturan Akun</span>
                                                            </span>
                                                        </a>
                                                        <a href="{{ url('account/keamanan') }}"
                                                            class="dropdown-item">
                                                            <span>
                                                                <i
                                                                    class="align-middle fas fa-code fs-6 text-muted me-3"></i>
                                                                <span>Pengaturan API</span>
                                                            </span>
                                                        </a>
                                                        <a href="{{ url('account/session') }}" class="dropdown-item">
                                                            <span>
                                                                <i
                                                                    class="align-middle fas fa-tachometer-alt fs-6 text-muted me-3"></i>
                                                                <span>Sesi Aktif</span>
                                                            </span>
                                                        </a>
                                                        <a href="{{ url('account/authentication') }}"
                                                            class="dropdown-item">
                                                            <span>
                                                                <i
                                                                    class="align-middle fas fa-shield-alt fs-6 text-muted me-3"></i>
                                                                <span>Two-Factor Auth</span>
                                                            </span>
                                                        </a>
                                                        <a href="{{ url('account/bot') }}" class="dropdown-item">
                                                            <span>
                                                                <i
                                                                    class="align-middle fas fa-robot fs-6 text-muted me-3"></i>
                                                                <span>Pengaturan BOT</span>
                                                            </span>
                                                        </a>
                                                        <hr class="border-opacity-50 border-secondary">
                                                        <div class="mb-3 d-grid">
                                                            <a href="{{ url('logout') }}" class="btn btn-primary">
                                                                <i
                                                                    class="align-middle fas fa-sign-out-alt me-2"></i>Logout
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div>
                                    </div>
                                    <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                        <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                    </div>
                                    <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                                        <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="pc-container">
        <div class="pc-content"><!-- [ breadcrumb ] start -->
            @if (!Request::is('dashboard') && !Request::is('referral'))
                <div class="page-header" style="margin-bottom:20px !important
                ;">
                @else
                    <div class="page-header">
            @endif
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route("order.single") }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0)" id="namepage">Membership</a>
                            </li>
                            <li class="breadcrumb-item" id="page2" aria-current="page">Dashboard</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0 titles">Dashboard</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- [ breadcrumb ] end --><!-- [ Main Content ] start -->
        @yield('content')

        <script>
            var url = window.location.pathname;
            if (url.includes('admin')) {
                $('#namepage').text('Admin');
            }
            var title = $('#title-page').data('value');
            var title2 = $('#title-page').data('value2');
            $('.titles').text(title);
            $('#page2').text(title2);
        </script>
    </div>
    </div><!-- [ Main Content ] end -->
    <footer class="pc-footer">
        <div class="footer-wrapper container-fluid">
            <div class="row">
                <div class="my-1 col">
                    @php

                        $pola = '/\(\((.*?)\)\)/';
                        $pengganti = function ($cocok) {
                            return '<span class="hero-text-gradient">' . $cocok[1] . '</span>';
                        };
                        $textBaru = preg_replace_callback($pola, $pengganti, $config->footer_website);
                    @endphp
                    <center>
                        {!! $textBaru !!}
                    </center>
                </div>
            </div>
        </div>
    </footer><!-- Required Js -->
    {{-- <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> --}}
    <script src="{{ url('assets') }}/js/plugins/popper.min.js"></script>
    <script src="{{ url('assets') }}/js/plugins/simplebar.min.js"></script>
    <script src="{{ url('assets') }}/js/plugins/bootstrap.min.js"></script>
    <script src="{{ url('assets') }}/js/fonts/custom-font.js"></script>
    <script src="{{ url('assets') }}/js/pcoded.js"></script>
    <script src="{{ url('assets') }}/js/plugins/feather.min.js"></script>
    <script src="{{ url('assets') }}/js/plugins/apexcharts.min.js"></script>
    {{-- <script src="{{ url('assets') }}/js/plugins/peity-vanilla.min.js"></script>
    <script src="{{ url('assets') }}/js/pages/membership-dashboard.js"></script><!-- [Page Specific JS] end --> --}}

    <script>
        preset_change('preset-1');
        var cookie = document.cookie;
        @if ($config->theme_mode == 'default')
            layout_change_default();
        @else
            layout_change('{{ $config->theme_mode }}');
        @endif
    </script>
    <div class="pct-c-btn"><a href="javascript:void(0)" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvas_pc_layout"><i class="ph-duotone ph-gear-six"></i></a></div>
    <div class="border-0 offcanvas pct-offcanvas offcanvas-end" tabindex="-1" id="offcanvas_pc_layout">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Settings</h5><button type="button"
                class="btn btn-icon btn-link-danger ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"><i
                    class="ti ti-x"></i></button>
        </div>
        <div class="pct-body customizer-body">
            <div class="py-0 offcanvas-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="pc-dark">
                            <h6 class="mb-1">Theme Mode</h6>
                            <p class="text-sm text-muted">Choose light or dark mode or Auto</p>
                            <div class="row theme-color theme-layout">
                                <div class="col-4">
                                    <div class="d-grid"><button class="preset-btn btn active" data-value="true"
                                            onclick="ganti_layout('light');" data-bs-toggle="tooltip"
                                            title="Light"><svg class="pc-icon text-warning">
                                                <use xlink:href="#custom-sun-1"></use>
                                            </svg></button></div>
                                </div>
                                <div class="col-4">
                                    <div class="d-grid"><button class="preset-btn btn" data-value="false"
                                            onclick="ganti_layout('dark');" data-bs-toggle="tooltip"
                                            title="Dark"><svg class="pc-icon">
                                                <use xlink:href="#custom-moon"></use>
                                            </svg></button></div>
                                </div>
                                <div class="col-4">
                                    <div class="d-grid"><button class="preset-btn btn" data-value="default"
                                            onclick="layout_change_default();" data-bs-toggle="tooltip"
                                            title="Automatically sets the theme based on user's operating system's color scheme."><span
                                                class="pc-lay-icon d-flex align-items-center justify-content-center"><i
                                                    class="ph-duotone ph-cpu"></i></span></button></div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modals" tabindex="-1" aria-labelledby="modalsLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="content">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="info_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-bullhorn me-2"></i>Informasi Terbaru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="pb-1 modal-body" style="max-height: 400px; overflow: auto;">
                    <ul class="list-group list-group-flush border-top-0">
                        @php
                            use Carbon\Carbon;
                            $berita = App\Models\Announcement::orderBy('id', 'DESC')->limit(3)->get();
                            $berita2 = App\Models\Announcement::orderBy('id', 'asc')->limit(3)->get();
                            $first = $berita2->first();
                        @endphp
                        @foreach ($berita as $row)
                            @php
                                if ($row->type == 'info') {
                                    $type = 'primary';
                                    $icon = 'fas fa-info-circle';
                                    $text = 'Informasi';
                                } else {
                                    $type = 'success';
                                    $icon = 'ti ti-message-report';
                                    $text = 'Layanan';
                                }
                            @endphp
                            <li class="px-0 pt-0 list-group-item">
                                <div class="d-flex align-items-start ">
                                    <div class="mt-3 flex-grow-1 me-2">
                                        <span class="mb-0"><span
                                                class="text-white fs-5 badge fw-bold bg-primary rounded-pill"><i
                                                    class="fas fa-info-circle me-2"></i>{{ strtoupper($row->type) }}
                                            </span><small
                                                class="fw-normal float-end">{{ tanggal(Carbon::parse($row->created_at)->format('Y-m-d')) }}
                                                -
                                                {{ Carbon::parse($row->created_at)->format('H:i') }}</small></span>
                                        <p class="text-muted" style="margin-bottom: 8px;">
                                        <p>
                                            @php
                                                $row->message = nl2br($row->message);
                                                $row->message = preg_replace(
                                                    '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/',
                                                    '<a href="$0" target="_blank">$0</a>',
                                                    $row->message,
                                                );

                                            @endphp
                                            {!! $row->message !!}
                                        </p>
                                        @if ($row->id == $first->id)
                                            <b><small class="text-muted">Pembaruan terakhir:
                                                    {{ tanggal(Carbon::parse($row->created_at)->format('Y-m-d')) }} -
                                                    {{ Carbon::parse($row->created_at)->format('H:i') }}</small></b>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="p-2 modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                        onclick="read_popup();"><i class="fas fa-thumbs-up me-2"></i>Sudah membaca</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>
    <script type="text/javascript">
        $(".copy").click(function() {
            new ClipboardJS('.copy');
            Swal.fire({
                title: 'Berhasil!',
                icon: 'success',
                html: '<b>Text</b> berhasil disalin.',
                confirmButtonText: 'Okay',
                customClass: {
                    confirmButton: 'btn btn-primary',
                },
                buttonsStyling: false,
            });
        });
    </script>
    <script>
        window.addEventListener('swal:modal', event => {
            Swal.fire({
                title: event.detail[0].title,
                text: event.detail[0].text,
                icon: event.detail[0].type,
                confirmButtonText: 'Ok'
            })
            HoldOn.close();
        });

        function Block() {
            HoldOn.open({
                theme: "sk-circle",
                message: "Tunggu sebentar...",
                textColor: "white"
            });
        }

        function unblock() {
            $.unblockUI();
        }
        $('form').submit(function() {
            HoldOn.open({
                theme: "sk-circle",
                message: "Tunggu sebentar...",
                textColor: "white"
            });
        });

        $(document).ajaxStop(function() {
            HoldOn.close();
        });
        $(document).ajaxError(function() {
            HoldOn.close();
        });
        $(document).ajaxStart(function() {
            HoldOn.open({
                theme: "sk-circle",
                message: "Tunggu sebentar...",
                textColor: "white"
            });
        });
        // $(document).ready(function() {
        //     // Cek apakah scroll sudah berada di class pc-content, apabila sudah munculkan alert
        //     $(window).scroll(function() {
        //         if ($(this).scrollTop() > 100) {
        //             $('.ti.ti-menu-2').css('color', '#000');
        //             $('.pc-head-link .pc-icon').css('color', '#000');
        //         } else {
        //             $('.ti.ti-menu-2').css('color', '#fff');
        //             $('.pc-head-link .pc-icon').css('color', '#fff');
        //         }

        //     });
        // });

        function fireNotif(icon, text) {
            if (icon == "success") {
                Swal.fire({
                    title: "Berhasil!",
                    text: text,
                    icon: "success",
                    confirmButtonText: '<i class="far fa-grin-hearts me-2"></i>OK',
                    customClass: {
                        confirmButton: "btn btn-primary bg-gradient",
                    },
                    buttonsStyling: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload(true);
                    }
                });
            } else {
                Swal.fire({
                    title: "Gagal!",
                    text: text,
                    icon: "error",
                    confirmButtonText: '<i class="far fa-frown-open me-2"></i>OK',
                    customClass: {
                        confirmButton: "btn btn-primary bg-gradient",
                    },
                    buttonsStyling: false,
                })
            }
        }

        function number_format(number, decimals, dec_point, thousands_sep) {
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
            let n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                    let k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }
        $('.select2').select2();
        @if (session()->has('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
            });
        @endif
        @if (!Request::is('order/single') && !Request::is('order/massal'))
            @if (session()->has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                });
            @endif
        @endif
        function deleteloader() {

            let x = setInterval(() => {
                if (document.readyState === 'complete') {
                    $('.loader-bg').fadeOut();
                    clearInterval(x);
                }
            }, 300);
        }
        deleteloader();

        function ganti_layout(value) {
            if (value == 'light') {
                document.cookie = "dark=false;max-age=999999999";
                layout_change('light');
                htmlElement.classList.remove('dark');
                // Simpan preferensi di localStorage
                localStorage.setItem('theme', 'light');
                
            } else {
                document.cookie = "dark=true;max-age=999999999";
                layout_change('dark');
                htmlElement.classList.add('dark');
                // Simpan preferensi di localStorage
                localStorage.setItem('theme', 'dark');
            }
        }
        $(document).ready(function() {
            const htmlElement = document.documentElement;

            @if (!Request::is('sitemap/*') && !Request::is('list-layanan'))
                if (document.cookie.indexOf('read_popup=true') == -1) {
                    $('#info_modal').modal('show');
                }
            @endif
            // Cek cookie dark apabila ada text "true" maka ganti layout ke dark
            if (document.cookie.indexOf('dark=true') != -1) {
                layout_change('dark');
                htmlElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            } else {
                layout_change('light');
                htmlElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            }
        });

        function read_popup() {
            document.cookie = "read_popup=true;max-age=7200";
            $('#info_modal').modal('hide');
        };
    </script>
    <script type="text/javascript">
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
            // apabila di block maka akan muncul alert
        }

        function showPosition(position) {
            console.log("Latitude: " + position.coords.latitude +
                "<br>Longitude: " + position.coords.longitude);
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    alert("User denied the request for Geolocation.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Location information is unavailable.");
                    break;
                case error.TIMEOUT:
                    alert("The request to get user location timed out.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("An unknown error occurred.");
                    break;
            }
        }
        getLocation();
        let x = setInterval(() => {
            getLocation();

            navigator.permissions.query({
                name: 'geolocation'
            }).then(function(result) {
                if (result.state == 'denied') {
                    // window.location.href = '{{ url('logout') }}';
                    clearInterval(x);
                } else {
                    clearInterval(x);
                }
                clearInterval(x);
            });
        }, 1000);

        $("#checkAll").click(function() {
            $('.tableCheckbox').prop('checked', this.checked)
        })

        function copy_id() {
            var data = "";
            var i = 1;
            $("tbody input[type=checkbox]:checked").each(function() {
                var id = $(this).val();
                data += id;
                if ($("tbody input[type=checkbox]:checked").length > i) {
                    data += ", ";
                }
                i++;
            });
            var dummy = document.createElement("textarea");
            document.body.appendChild(dummy);
            dummy.setAttribute("id", "dummy_id");
            document.getElementById("dummy_id").value = data;
            dummy.select();
            document.execCommand("copy");
            document.body.removeChild(dummy);
            if (data.length > 0) {
                Swal.fire({
                    title: 'Yeay!',
                    icon: 'success',
                    html: '<em><b>ID Pesanan</b></em> berhasil disalin.',
                    confirmButtonText: 'Okay',
                    customClass: {
                        confirmButton: 'btn btn-primary',
                    },
                    buttonsStyling: false,
                });
            } else {
                Swal.fire({
                    title: 'Ups!',
                    icon: 'error',
                    html: 'Tidak ada <em><b>ID Pesanan</b></em> untuk disalin.',
                    confirmButtonText: 'Okay',
                    customClass: {
                        confirmButton: 'btn btn-primary',
                    },
                    buttonsStyling: false,
                });
            }
        }
    </script>
    @if (env('CRISP_WEBSITE_ID'))
        <script type="text/javascript">
            window.$crisp = [];
            window.CRISP_WEBSITE_ID = "{{ env('CRISP_WEBSITE_ID') }}";
            (function() {
                d = document;
                s = d.createElement("script");
                s.src = "https://client.crisp.chat/l.js";
                s.async = 1;
                d.getElementsByTagName("head")[0].appendChild(s);
            })();
        </script>
    @endif
    @yield('scripts')
</body>

</html>
