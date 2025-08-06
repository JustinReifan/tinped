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
    <link href="landing/assets/main/assets/css/plugins/animate.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        rel="stylesheet" />
    <!-- [Page specific CSS] end -->
    <!-- [Font] Family -->
    <link rel="stylesheet" href="landing/assets/fonts/inter/inter.css" id="main-font-link" />
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="landing/assets/fonts/tabler-icons.min.css">
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="landing/assets/fonts/feather.css">
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="landing/assets/fonts/fontawesome.css">
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="landing/assets/fonts/material.css">
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="landing/assets/main/assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="landing/assets/main/assets/css/style-preset.css">
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
    <script src="{{ url('landing/assets') }}/main/assets/js/tech-stack.js"></script>
    <link rel="stylesheet" href="landing/assets/main/assets/css/landing.css" />
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
    <header id="home" style="background-image: url(landing/assets/images/landing/img-headerbg.jpg)">
        <nav class="navbar navbar-expand-md navbar-light default">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}/">
                    <img src="{{ asset($config->url_logo) }}" alt="logo" height="24px" width="24px" />
                </a>
                <button class="rounded navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <ul class="mb-2 navbar-nav ms-auto mb-lg-0 align-items-center">
                        <li class="px-1 nav-item">
                            <a class="nav-link" href="{{ url('/') }}/">Beranda</a>
                        </li>
                        <li class="px-1 nav-item">
                            <a class="nav-link" href="{{ url('list-layanan') }}">Daftar Layanan</a>
                        </li>
                        <li class="px-1 nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="landing/javascript:;"
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
                        <li class="px-1 mb-2 nav-item me-2 mb-md-0">
                            <a class="btn btn-icon btn-light-dark" target="_blank" href="{{ url('pemesanan') }}"><i
                                    class="ti ti-shopping-cart"></i></a>
                        </li>

                        <li class="nav-item">
                            <a class="btn btn-primary" target="_blank" href="{{ url('auth/register') }}"><i
                                    class="ti ti-users"></i> Daftar Sekarang</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <section style="padding-top:80px;">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="p-2 card-body" style="margin-bottom: -4px;">
                            <div class="row gx-1">

                                @php
                                    $decodes = json_decode($config->konfigurasi_kategori);
                                @endphp
                                @if (collect($decodes->list_kategori)->count() == 0)
                                    <div class="alert alert-danger">
                                        <div class="text-center alert-body">
                                            <i class="fas fa-exclamation-triangle fs-4"></i>
                                            <h6 class="mt-3">Tidak ada kategori yang tersedia.</h6>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-6 col-lg-4 col-xl-3 d-grid">
                                        <button type="button"
                                            class="mb-2 btn btn-primary btn-md d-block btn-category"
                                            id="btn-Semua"onclick="filterCategory('Semua');"><span
                                                class="d-flex align-items-center"><i
                                                    class="fas fa-adjust fs-4"></i><span
                                                    style="margin-left:8px; margin-top:1px;">Semua</span></span></button>
                                    </div>
                                    @foreach (collect($decodes->list_kategori)->sortBy('key') as $nama => $iconClass)
                                        <div class="col-6 col-lg-4 col-xl-3 d-grid">
                                            <button type="button"
                                                class="mb-2 btn btn-outline-primary btn-md d-block btn-category"
                                                id="btn-{{ $nama }}"
                                                onclick="filterCategory('{{ $nama }}');"><span
                                                    class="d-flex align-items-center"><i
                                                        class="{!! $iconClass !!}"></i><span
                                                        style="margin-left:8px; margin-top:1px;">{{ ucfirst($nama) }}</span></span></button>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0"><i class="fas fa-cart-plus me-2"></i>Pesanan Baru (Single)</h4>
                        </div>
                        <div class="pb-3 card-body">
                            <form action="{{ url('proses-order') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                    <select class="select2 form-control" id="category">
                                        <option value="0">Pilih...</option>
                                        @php
                                            $kategori = App\Models\Category::where('nologin', '1')->get();
                                        @endphp
                                        @forelse ($kategori as $row)
                                            @php
                                                $id = App\Models\Smm::where('category', $row->kategori)->first();
                                            @endphp
                                            @if ($id)
                                                <option value="{{ $id->id }}"
                                                    data-icon="<i class='{!! $row->icon ?? null !!}'></i>">
                                                    {!! $row->kategori ?? null !!}</option>
                                            @endif
                                        @empty
                                            <option data-icon="" value="0">Tidak
                                                ada kategori</option>
                                        @endforelse
                                    </select>
                                    @error('category')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Layanan <span class="text-danger">*</span></label>
                                    <select class="select2 form-control" style="width:100%" name="layanan"
                                        id="layanan">
                                        <option value="0">Pilih Kategori Dahulu</option>
                                    </select>
                                    @error('layanan')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="mb-3" id="deskripsi_umum">
                                    <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                    <div class="p-3 mb-3 border rounded border-primary" id="infoDesc">Deskripsi
                                        layanan.
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md">
                                        <div class="mb-3 form-group">
                                            <label>Link/Target <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="Masukkan target"
                                                name="target" id="target">
                                            @error('target')
                                                <small class="text-danger">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <label>Jumlah Pesan</label>
                                        <span class="badge bg-primary" id="infoMin">Min: 0</span>
                                        <span class="badge bg-primary" id="infoMax">Max: 0</span></label>
                                        <div class="mb-3 input-group">
                                            <input type="number" class="form-control" id="quantity"
                                                name="quantity" onkeyup="totalCharge()" onblur="validateQuan()">
                                        </div>
                                        @error('quantity')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 form-group">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" placeholder="Masukkan email"
                                        name="email" id="email">
                                    @error('email')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="">
                                    <label for="">Jenis Pembayaran <span class="text-danger">*</span></label>
                                    <select name="metode" id="metode" class="form-control select2"
                                        style="width:100%">
                                        <option value="">-- Pilih metode pembayaran --</option>
                                        @php
                                            $distinct = App\Models\MetodePembayaran::distinct()
                                                ->where('nologin', '1')
                                                ->get('type_payment');
                                        @endphp
                                        @forelse ($distinct as $row)
                                            <option value="{{ $row->type_payment }}">
                                                {{ $row->type_payment }}
                                            </option>
                                        @empty
                                            <option value="0">Tidak ada metode pembayaran</option>
                                        @endforelse
                                    </select>
                                    @error('metode')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>
                                <div id="metod"></div>
                                <label>Total Harga <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input class="form-control" readonly id="total-price">
                                </div>
                                <div class="mt-3 mb-0 float-end">
                                    <button type="submit" class="btn btn-primary float-end"><i
                                            class="fas fa-cart-plus fs-6 me-2"></i>Pesan</button>
                                    <button type="reset" class="btn btn-danger float-end me-2"><i
                                            class="fas fa-sync fs-6 me-2"></i>Ulangi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi</h4>
                        </div>
                        <div class="pb-3 card-body">
                            {!! json_decode($config->info_text)->order !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <footer class="footer">
        <div class="border-top border-bottom footer-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 wow fadeInUp" data-wow-delay="0.2s">
                        <img src="{{ asset($config->url_logo) }}" alt="image" height="60" width="60"
                            class="mb-3 img-fluid" />
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
                <div class="my-1 col wow fadeInUp" data-wow-delay="0.4s">
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
    <script src="{{ url('landing/assets') }}/main/assets/js/plugins/popper.min.js"></script>
    <script src="{{ url('landing/assets') }}/main/assets/js/plugins/simplebar.min.js"></script>
    <script src="{{ url('landing/assets') }}/main/assets/js/plugins/bootstrap.min.js"></script>
    <script src="{{ url('landing/assets') }}/main/assets/js/fonts/custom-font.js"></script>
    <script src="{{ url('landing/assets') }}/main/assets/js/pcoded.js"></script>
    <script src="{{ url('landing/assets') }}/main/assets/js/plugins/feather.min.js"></script>
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
    <script src="{{ url('landing/assets') }}/main/assets/js/plugins/wow.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.marquee/1.4.0/jquery.marquee.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{ url('landing/assets') }}/main/assets/js/plugins/Jarallax.js"></script>
    <script>
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
        let priceLayanan = 0;
        let min = 0;
        let max = 0;
        let rates, type, metodeId;


        function iformat(icon) {
            var originalOption = icon.element;
            if ($(originalOption).index() == 0) {
                var ic = '';
            } else {
                var ic = $(originalOption).data('icon');
            }
            return $('<span>' + ic + ' ' + icon.text + '</span>');
        }

        function filterCategory(category) {
            $(".btn-category").addClass('btn-outline-primary').removeClass('btn-primary');
            $("#btn-" + category).addClass('btn-primary').removeClass('btn-outline-primary');
            $.ajax({
                type: "POST",
                url: "{{ route('filter') }}",
                dataType: "html",
                data: "category=" + category + "&_token={{ csrf_token() }}",
                success: function(data) {
                    $('#category').html(data);
                    $('#total-price').val(0);
                },
                error: function() {
                    $('#ajax-result').html(
                        '<font color="red">Terjadi kesalahan! Silahkan refresh halaman.</font>');
                }
            });
        }
        $(document).ready(function() {
            $('#metode').val($('#metode option:eq(1)').val()).trigger('change');
            $('#category').select2({
                width: "100%",
                templateSelection: iformat,
                templateResult: iformat,
                allowHtml: true
            });
            $('#category_fav').select2({
                width: "100%",
                templateSelection: iformat,
                templateResult: iformat,
                allowHtml: true
            });
            $('#layanan').select2({
                width: "100%",
            });
        });


        $('#category').change(function() {
            var value = $(this).val();
            var path = $('#category_path').attr('value');
            if (path == value) {
                var srv = $('#service_path').attr('value');
            } else {
                var srv = null;
            }
            $.ajax({
                url: "{{ route('ambil.layanan') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: $(this).val(),
                    service_path: srv,
                },
                dataType: "html",
                success: function(response) {
                    $('#layanan').html(response);
                    if (srv !== null) {
                        $('#layanan').trigger('change');
                    }
                    // $('#layanan').trigger('change');
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    });
                }
            });
        });
        $('#layanan').change(function() {
            var value = $(this).val();
            $.ajax({
                url: "{{ route('ambil.detail.layanan') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: $(this).val(),
                },
                dataType: "json",
                success: function(result) {
                    if (result.status == false) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: result.message,
                        });
                    } else {
                        $('#deskripsi_umum').removeClass('d-none');
                        $('#infoDesc').html(result.deskripsi);
                        priceLayanan = result.price;
                        min = result.min;
                        max = result.max;
                        $('#quantity').attr('readonly', false)
                        $('#inputUsernames').parent().addClass('d-none')
                        $('#inputComments').parent().addClass('d-none')
                        $('#infoMin').html('Min: ' + result.min);
                        $('#infoMax').html('Max: ' + result.max);
                        if (result.type == "custom_comments" || result.type == "custom_comment" ||
                            result.type == "comment_reply") {
                            $('#quantity').attr('readonly', true)
                            $('#inputComments').parent().removeClass('d-none')
                            $('#quantity').prop('readonly', true);
                        } else {
                            $('#quantity').prop('readonly', false);
                        }
                        if (result.type == "package") {
                            $('#quantity').val("1")
                            $('#quantity').attr('readonly', true)
                        }
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    });
                }
            });
        });

        function totalCharge() {
            if (metodeId) {
                var price = priceLayanan / 1000
                var qty = Number($('#quantity').val().replace(/\./g, ''))
                let math = Math.ceil(qty * price)
                validateQuan();
                inputmetode(metodeId, rates, type);
            } else {
                $('#total-price').val(0)
            }
        }

        function inputmetode(id, rate, type) {
            metodeId = id;
            rates = rate;
            type = type;
            let price = priceLayanan / 1000
            let qty = Number($('#quantity').val().replace(/\./g, ''))
            let math = Math.ceil(qty * price)
            if (!isNaN(rate)) {
                if (type == "percent") {
                    rate = (math / 100) * rate;
                    rate = math + rate;
                } else {
                    rate = parseInt(rate);
                    rate = rate + math;
                }
                rate = number_format(rate, 0, ',', '.');
                $('#total-price').val(rate).trigger('input');
            } else {
                console.error("Invalid rate:", rate);
            }
        }

        function validateQuan() {
            let quan = $('#quantity').val();
            let quantity = quan.replace(/\./g, '');
            if (!$('#quantity').prop('readonly')) {
                if (min > 0) {
                    if (quantity < min) {
                        $('#quantity').addClass('is-invalid');
                    } else if (quantity > max) {
                        $('#quantity').addClass('is-invalid');
                    } else {
                        $('#quantity').removeClass('is-invalid');
                    }
                }
                if (quantity == null) {
                    $('#quantity').removeClass('is-invalid');
                }
            }
        }
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
