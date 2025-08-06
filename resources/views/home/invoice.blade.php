<!DOCTYPE html>
<html lang="en">


@php
    $landing = App\Models\Landing::first();
@endphp
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title>{{ $config->name_panel }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="{{ $config->description_website }}">
    <meta name="keywords" content="{{ $config->keyword_website }}">
    <meta name="author" content="akiraxcode"><!-- Jangan di ganti bos -->
    {!! $config->meta_website !!}
    <!-- [Favicon] icon -->
    <link rel="icon" href="{{ url($config->favicon) }}" type="image/x-icon">
    <!-- [Page specific CSS] start -->
    <link href="{{ url('landing') }}/assets/main/assets/css/plugins/animate.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        rel="stylesheet" />
    <!-- [Page specific CSS] end -->
    <!-- [Font] Family -->
    <link rel="stylesheet" href="{{ url('landing') }}/assets/fonts/inter/inter.css" id="main-font-link" />
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ url('landing') }}/assets/fonts/tabler-icons.min.css">
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{ url('landing') }}/assets/fonts/feather.css">
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{ url('landing') }}/assets/fonts/fontawesome.css">
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ url('landing') }}/assets/fonts/material.css">
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ url('landing') }}/assets/main/assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="{{ url('landing') }}/assets/main/assets/css/style-preset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/holdon.min.css') }}">
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/jquery.rateyo.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-14K1GBX9FG"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="{{ url('/') }}/assets/js/jquery.rateyo.min.js"></script>
    <script src="{{ asset('assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/holdon.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
    <style>
        :root {
            --color-default: {{ $config->color_default }};
            --rgba-default: {{ $rgb }};
            --color-hover: {{ $hover }};
            --rgb-hover: {{ $rgb_hover }};
        }
    </style>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-14K1GBX9FG');
    </script>
    <style>
        .ms-auto {
            margin-left: auto !important;
        }

        .invoice-total {
            width: 100%;
            max-width: 400px;
        }
    </style>
    <!-- Microsoft clarity -->
    <script type="text/javascript">
        (function(c, l, a, r, i, t, y) {
            c[a] =
                c[a] ||
                function() {
                    (c[a].q = c[a].q || []).push(arguments);
                };
            t = l.createElement(r);
            t.async = 1;
            t.src = 'https://www.clarity.ms/tag/' + i;
            y = l.getElementsByTagName(r)[0];
            y.parentNode.insertBefore(t, y);
        })(window, document, 'clarity', 'script', 'gkn6wuhrtb');
    </script>
    <script src="{{ url('landing') }}/assets/main/assets/js/tech-stack.js"></script>
    <link rel="stylesheet" href="{{ url('landing') }}/assets/main/assets/css/landing.css" />
    <style>
        header {
            overflow: hidden;
            position: relative;
            padding: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 0px !important;
            background-size: cover;
            flex-direction: column;
        }

        @media (max-width: 767.98px) {
            header {
                text-align: start;
                padding: 0px 0;
            }
        }

        /* Small devices (landscape phones, 576px and below) */
        @media (max-width: 576px) {
            .container {
                width: 400px;
            }
        }
    </style>
</head>

<body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme_contrast=""
    data-pc-theme="light" class="landing-page">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <!-- [ Header ] start -->
    <header id="home" style="background-image: url({{ url('landing/assets/images/landing/img-headerbg.jpg') }})">
        <nav class="navbar navbar-expand-md navbar-light default">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}/">
                    <img src="{{ asset($config->url_logo) }}" alt="logo" height="60" width="60" />
                </a>
                <button class="navbar-toggler rounded" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                        <li class="nav-item px-1">
                            <a class="nav-link" href="{{ url('/') }}/">Beranda</a>
                        </li>
                        <li class="nav-item px-1">
                            <a class="nav-link" href="{{ url('list-layanan') }}">Daftar Layanan</a>
                        </li>
                        <li class="nav-item dropdown px-1">
                            <a class="nav-link dropdown-toggle" href="{{ url('landing') }}/javascript:;"
                                data-bs-toggle="dropdown">Tentang
                                Layanan</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ url('sitemap/ketentuan-layanan') }}">Ketentuan
                                        Layanan</a></li>
                                <li><a class="dropdown-item" href="{{ url('sitemap/kontak') }}">Hubungi Kami</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ url('sitemap/contoh-pesanan') }}">Contoh URL
                                        Target Pesanan</a></li>
                            </ul>
                        </li>
                        <li class="nav-item px-1 me-2 mb-2 mb-md-0">
                            <a class="btn btn-icon btn-light-dark" target="_blank" href="{{ url('pemesanan') }}"><i
                                    class="ti ti-shopping-cart"></i></a>
                        </li>

                        <li class="nav-item">
                            <a class="btn btn btn-primary" target="_blank" href="{{ url('auth/register') }}"><i
                                    class="ti ti-users"></i> Daftar Sekarang</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <section style="padding-top:50px">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="row align-items-center g-3">
                                            <div class="col-sm-6">
                                                <div class="d-flex align-items-center mb-2"><img
                                                        src="{{ url($config->url_logo) }}" class="img-fluid"
                                                        width="70" height="150" alt="images">
                                                </div>
                                                <p class="mb-0">INV - {{ $invoice->trxid }}</p>
                                            </div>
                                            <div class="col-sm-6 text-sm-end">
                                                <h6>Date <span
                                                        class="text-muted f-w-400">{{ \Carbon\Carbon::parse($invoice->created_at)->format('d/m/Y H:i:s') }}</span>
                                                </h6>
                                                <h6>Due Date <span class="text-muted f-w-400">
                                                        {{ \Carbon\Carbon::parse($invoice->expired_at)->format('d/m/Y H:i:s') }}</span>
                                                </h6>
                                                <h6>Status Pesanan
                                                    @if ($invoice->status == 'pending')
                                                        <span
                                                            class="badge bg-light-primary rounded-pill ms-2">Pending</span>
                                                    @elseif($invoice->status == 'done')
                                                        <span
                                                            class="badge bg-light-success rounded-pill ms-2">Success</span>
                                                    @elseif($invoice->status == 'error')
                                                        <span
                                                            class="badge bg-light-danger rounded-pill ms-2">Failed</span>
                                                    @elseif($invoice->status == 'processing')
                                                        <span
                                                            class="badge bg-light-info rounded-pill ms-2">Processing</span>
                                                    @elseif($invoice->status == 'partial')
                                                        <span
                                                            class="badge bg-light-primary rounded-pill ms-2">Partial</span>
                                                    @endif
                                                </h6>
                                                <h6>Status Pembayaran
                                                    @if ($invoice->status_payment == 'done')
                                                        <span
                                                            class="badge bg-light-success rounded-pill ms-2">Success</span>
                                                    @elseif($invoice->status_payment == 'pending')
                                                        <span
                                                            class="badge bg-light-primary rounded-pill ms-2">Pending</span>
                                                    @elseif($invoice->status_payment == 'canceled')
                                                        <span
                                                            class="badge bg-light-danger rounded-pill ms-2">Canceled</span>
                                                    @endif
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Layanan</th>
                                                        <th>Target</th>
                                                        <th class="text-end">Qty</th>
                                                        <th class="text-end">Pembayaran</th>
                                                        <th class="text-end">Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>{{ $invoice->layanan }}</td>
                                                        <td>{{ $invoice->target }}</td>
                                                        <td class="text-end">
                                                            {{ number_format($invoice->quantity, 0, ',', '.') }}</td>
                                                        <td class="text-end">{{ $invoice->payment->name }}</td>
                                                        <td class="text-end">Rp
                                                            {{ number_format($invoice->price, 0, ',', '.') }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="text-start">
                                            <hr class="mb-2 mt-1 border-secondary border-opacity-50">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="invoice-total ms-auto">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p class="text-muted mb-1 text-start">Sub Total :</p>
                                                </div>
                                                @php

                                                    if ($invoice->payment->rate_type == 'fixed') {
                                                        $fee = $invoice->payment->rate;
                                                        $price = $invoice->price - $fee;
                                                    } else {
                                                        $fee = ($invoice->price / 100) * $invoice->payment->rate;
                                                        $price = $invoice->price - $fee;
                                                    }
                                                @endphp
                                                <div class="col-6">
                                                    <p class="mb-1 text-end">Rp
                                                        {{ number_format($price, 0, ',', '.') }}</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="text-muted mb-1 text-start">Taxex :</p>
                                                </div>
                                                <div class="col-6">
                                                    @if ($invoice->payment->rate_type == 'fixed')
                                                        <p class="mb-1 text-end">Rp
                                                            {{ number_format($invoice->payment->rate, 0, ',', '.') }}
                                                        </p>
                                                    @else
                                                        <p class="mb-1 text-end">{{ $invoice->payment->rate }}%</p>
                                                    @endif
                                                </div>
                                                <div class="col-6">
                                                    <p class="f-w-600 mb-1 text-start">Grand Total :</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="f-w-600 mb-1 text-end">Rp
                                                        {{ number_format($invoice->price, 0, ',', '.') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12"><label class="form-label">Note</label>
                                        <p class="mb-0">Terima kasih sudah membuat pesanan, jangan lupa transfer atau
                                            lakukan
                                            pembayaran sesuai nominal yang tertera di invocie</p>
                                    </div>
                                    <div class="col-12 text-end d-print-none">
                                        @if ($invoice->status_payment == 'pending' && $invoice->status == 'pending')
                                            <a href="{{ $invoice->payment_url }}"
                                                class="btn btn-outline-success">Lanjutkan
                                                pembayaran</a>
                                        @endif
                                        <button class="btn btn-outline-secondary btn-print-invoice"><i
                                                class="fas fa-print me-2"></i>Print</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </header>
    <footer class="footer">
        <div class="border-top border-bottom footer-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 wow fadeInUp" data-wow-delay="0.2s">
                        <img src="{{ asset($config->url_logo) }}" alt="image" height="60" width="60"
                            class="img-fluid mb-3" />
                        <p class="mb-4">
                            {!! $landing->footer !!}
                        </p>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-sm-4 wow fadeInUp" data-wow-delay="0.6s">
                            </div>
                            <div class="col-sm-4 wow fadeInUp" data-wow-delay="0.8s">
                                <h5 class="mb-4">Bantuan</h5>
                                <ul class="list-unstyled footer-link">
                                    <li>
                                        <a href="{{ url('sitemap/contoh-pesanan') }}" target="_blank">Contoh URL
                                            Pesanan</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('sitemap/ketentuan-layanan') }}" target="_blank">Ketentuan
                                            Layanan</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('sitemap/kontak') }}" target="_blank">Hubungi Kami</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-4 wow fadeInUp" data-wow-delay="1s">
                                <h5 class="mb-4">Pintasan</h5>
                                <ul class="list-unstyled footer-link">
                                    <li>
                                        <a href="{{ url('auth/login') }}" target="_blank">Masuk Akun</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('auth/register') }}" target="_blank">Daftar Akun</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('auth/forgot') }}" target="_blank">Lupa Password</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col my-1 wow fadeInUp" data-wow-delay="0.4s">
                    <p class="mb-0">
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
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- [ footer apps ] End -->

    <!-- [ Main Content ] end -->
    <!-- Required Js -->
    <script src="{{ url('landing') }}/assets/main/assets/js/plugins/popper.min.js"></script>
    <script src="{{ url('landing') }}/assets/main/assets/js/plugins/simplebar.min.js"></script>
    <script src="{{ url('landing') }}/assets/main/assets/js/plugins/bootstrap.min.js"></script>
    <script src="{{ url('landing') }}/assets/main/assets/js/fonts/custom-font.js"></script>
    <script src="{{ url('landing') }}/assets/main/assets/js/pcoded.js"></script>
    <script src="{{ url('landing') }}/assets/main/assets/js/plugins/feather.min.js"></script>
    <script>
        layout_change('light');
    </script>
    <script>
        layout_theme_contrast_change('false');
    </script>
    <script>
        change_box_container('false');
    </script>
    <script>
        layout_caption_change('true');
    </script>
    <script>
        layout_rtl_change('false');
    </script>
    <script>
        preset_change("preset-1");
    </script>
    <!-- [Page Specific JS] start -->
    <script src="{{ url('landing') }}/assets/main/assets/js/plugins/wow.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.marquee/1.4.0/jquery.marquee.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{ url('landing') }}/assets/main/assets/js/plugins/Jarallax.js"></script>
    <script>
        document.querySelector('.btn-print-invoice').addEventListener('click', function() {
            var link2 = document.createElement('link');
            link2.innerHTML =
                '<style>@media print{*,::after,::before{text-shadow:none!important;box-shadow:none!important}a:not(.btn){text-decoration:none}abbr[title]::after{content:" ("attr(title) ")"}pre{white-space:pre-wrap!important}blockquote,pre{border:1px solid #adb5bd;page-break-inside:avoid}thead{display:table-header-group}img,tr{page-break-inside:avoid}h2,h3,p{orphans:3;widows:3}h2,h3{page-break-after:avoid}@page{size:a3}body{min-width:992px!important}.container{min-width:992px!important}.page-header,.pc-sidebar,.pc-mob-header,.pc-header,.pct-customizer,.modal,.navbar{display:none}.pc-container{top:0;}.invoice-contact{padding-top:0;}@page,.card-body,.card-header,body,.pcoded-content{padding:0;margin:0}.badge{border:1px solid #000}.table{border-collapse:collapse!important}.table td,.table th{background-color:#fff!important}.table-bordered td,.table-bordered th{border:1px solid #dee2e6!important}.table-dark{color:inherit}.table-dark tbody+tbody,.table-dark td,.table-dark th,.table-dark thead th{border-color:#dee2e6}.table .thead-dark th{color:inherit;border-color:#dee2e6}}</style>';
            document.getElementsByTagName('head')[0].appendChild(link2);
            window.print();
        });
        // Start [ Menu hide/show on scroll ]
        let ost = 0;
        document.addEventListener('scroll', function() {
            let cOst = document.documentElement.scrollTop;
            if (cOst == 0) {
                document.querySelector('.navbar').classList.add('top-nav-collapse');
            } else if (cOst > ost) {
                document.querySelector('.navbar').classList.add('top-nav-collapse');
                document.querySelector('.navbar').classList.remove('default');
            } else {
                document.querySelector('.navbar').classList.add('default');
                document.querySelector('.navbar').classList.remove('top-nav-collapse');
            }
            ost = cOst;
        });
        // End [ Menu hide/show on scroll ]
        var wow = new WOW({
            animateClass: 'animated'
        });
        wow.init();

        // slider start
        $('.screen-slide').owlCarousel({
            loop: true,
            margin: 30,
            center: true,
            nav: false,
            dotsContainer: '.app_dotsContainer',
            URLhashListener: true,
            items: 1
        });
        $('.workspace-slider').owlCarousel({
            loop: true,
            margin: 30,
            center: true,
            nav: false,
            dotsContainer: '.workspace-card-block',
            URLhashListener: true,
            items: 1.5
        });
        // slider end
        // marquee start
        $('.marquee').marquee({
            duration: 500000,
            pauseOnHover: true,
            startVisible: true,
            duplicated: true
        });
        $('.marquee-1').marquee({
            duration: 500000,
            pauseOnHover: true,
            startVisible: true,
            duplicated: true,
            direction: 'right'
        });
        // marquee end
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
        $('#metode').change(function() {

            let value = $(this).val();
            if (value) {
                $.ajax({
                    type: "POST",
                    url: "{{ url('ambil/metode') }}",
                    dataType: 'json',
                    data: {
                        id: value,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        if (data.status) {
                            $('#metod').html(data.html);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.message
                            });
                        }
                    },
                    error: function() {
                        Swal.fire("Failed!", "Terjadi kesalahan, mohon refresh halaman ini", "error");
                    }
                });
            }
        })
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
            });
        @endif
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil...',
                text: '{{ session('success') }}',
            });
        @endif
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
</body>

</html>
