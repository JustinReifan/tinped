<!DOCTYPE html>
<html lang="en">
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
    <meta name="author" content="akiraxcode"><!-- Jangan di ganti bos -->
    {!! $config->meta_website !!}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}/">
    <meta property="og:title" content="{{ $config->name_panel }} - Masuk">
    <meta property="og:description" content="{{ $config->description_website }}">
    <meta property="og:image" content="{{ url('assets') }}/images/ogimage-41d.png">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/') }}/">
    <meta property="twitter:title" content="{{ $config->name_panel }} - Masuk">
    <meta property="twitter:description" content="{{ $config->description_website }}">
    <meta property="twitter:image" content="{{ url('assets') }}/images/ogimage-41d.png">
    <meta name="google-site-verification" content="jfjb8sVDsGLlNdmQp3Q3QJm6SAekUjZrtsDjFm2k_5Q" />

    <link rel="icon" href="{{ url($config->favicon) }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ url('assets') }}/fonts/inter/inter.css" id="main-font-link" />

    <link rel="stylesheet" href="{{ url('assets') }}/fonts/tabler-icons.min.css" />

    <link rel="stylesheet" href="{{ url('assets') }}/fonts/feather.css" />

    <link rel="stylesheet" href="{{ url('assets') }}/fonts/fontawesome.css" />

    <link rel="stylesheet" href="{{ url('assets') }}/fonts/material.css" />

    <link rel="stylesheet" href="{{ url('assets') }}/css/plugins/holdon.min.css">

    <link rel="stylesheet" href="{{ url('assets') }}/css/style.css" id="main-style-link" />
    <link rel="stylesheet" href="{{ url('assets') }}/css/style-preset.css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.8/sweetalert2.all.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link rel="stylesheet" href="{{ url('assets') }}/css/custom.css" />
    <script src="{{ url('assets') }}/js/plugins/holdon.min.js"></script>
    <style>
        body {
            overflow: auto;
        }

        :root {
            --color-default: {{ $config->color_default }};
            --rgba-default: {{ $rgb }};
            --color-hover: {{ $hover }};
            --rgb-hover: {{ $rgb_hover }};
        }
    </style>
</head>


<body data-pc-theme_contrast="true" data-pc-sidebar-caption="true" data-pc-preset="preset-1" data-pc-direction="ltr"
    data-pc-theme="light">

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

    <div class="auth-main">
        <div class="auth-wrapper v1">
            <div class="auth-form">
                <div class="card my-5">
                    <div class="card-body">

                        <div style="text-align: center;">
                            <img src="{{ asset('assets/images/logonew1.png') }}" alt="Logo"
                                style="height: auto; max-width: 70%;" />
                        </div>
                        <div class="my-3 text-center">
                            <p class="text-muted"><em><b>Authenticator Two-Factor Aktif</b></em><br>Untuk melanjutkan,
                                silakan masukkan kode autentikasi dari aplikasi <em><b>Two-Factor Authenticator</b></em>
                                Anda.</p>
                        </div>
                        <div class="saprator my-2">
                        </div>
                        <form action="{{ url('proses/authenticator') }}" method="POST" autocomplete="off">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="" class="form-label">Code Authenticator <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="code" placeholder="code">
                            </div>
                            @if (env('CLOUDFLARE_SITEKEY') != null)
                                <div class="mt-3">
                                    <div class="cf-turnstile" style="margin: 0 auto;display: table"
                                        data-sitekey="{{ env('CLOUDFLARE_SITEKEY') }}" data-size="normal"></div>
                                </div>
                            @endif
                            <div class="d-grid mt-3">
                                <button type="submit" class="btn btn-primary">Verify</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ url('assets') }}/js/plugins/popper.min.js"></script>
    <script src="{{ url('assets') }}/js/plugins/simplebar.min.js"></script>
    <script src="{{ url('assets') }}/js/plugins/bootstrap.min.js"></script>
    <script src="{{ url('assets') }}/js/fonts/custom-font.js"></script>

    <script type="text/javascript">
        'use strict';
        var theme_contrast = 'true'; // [ false , true ]
        var caption_show = 'true'; // [ false , true ]
        var preset_theme = 'preset-1'; // [ preset-1 to preset-10 ]
        var dark_layout = 'false'; // [ false , true , default ]
        var rtl_layout = 'false'; // [ false , true ]
        var box_container = 'false'; // [ false , true ]
        var version = 'v9.0';
    </script>
    <script src="{{ url('assets') }}/js/pcoded.js"></script>
    <script src="{{ url('assets') }}/js/plugins/feather.min.js"></script>
    <script src="//challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    <script type="text/javascript">
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        });

        $('.select2').select2();

        $('form').on('submit', function() {
            $.blockUI({
                message: '',
                baseZ: 10000,
                css: {
                    backgroundColor: 'transparent',
                    border: '0'
                },
                overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.8
                }
            });
        });


        $(document).ready(function() {
            var uri = window.location.toString();
            if (uri.indexOf("#") > 0) {
                var clean_uri = uri.substring(0, uri.indexOf("#"));
                window.history.replaceState({}, document.title, clean_uri);
            }
        });
        var x = setInterval(() => {
            if (document.readyState === 'complete') {
                $('.loader-bg').fadeOut();
                clearInterval(x);
            }
        }, 600);
        $('form').submit(function(e) {
            e.preventDefault();
            Block();
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    unblock();
                    if (response.status) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                        });
                        setInterval(() => {
                            window.location.reload();
                        }, 600);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: response.message,
                        });
                    }
                },
                error: function(err) {
                    unblock();
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Terjadi kesalahan, silahkan coba lagi!',
                    });
                }
            });
        });

        function Block() {

            $.blockUI({
                message: '',
                baseZ: 10000,
                css: {
                    backgroundColor: 'transparent',
                    border: '0'
                },
                overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.8
                }
            });
        }

        function unblock() {
            $.unblockUI();
        }

        @if (session()->has('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
                setInterval(() => {
                    window.location.reload();
                }, 2000);
            });
        @endif
        @if (session()->has('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
            });
        @endif

        function goAuth(provider) {
            window.location.href = '{{ url('auth') }}/' + provider + '/redirect/login';
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
</body>

</html>
