@extends('templates.main')
@section('content')
    @php
        $decodes = json_decode($config->konfigurasi_kategori);
    @endphp
    <div id="title-page" data-value="Single" data-value2="Pesanan Baru"></div>
    <div id="category_path" value="{{ $ct }}"></div>
    <div id="service_path" value="{{ $id }}"></div>
    <div class="row" id="catGroup">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body border-bottom" style="padding-bottom:.5rem;">
                    <div class="row">
                        @if (collect($decodes->list_kategori)->count() == 0)
                            <div class="alert alert-danger">
                                <div class="text-center alert-body">
                                    <i class="fas fa-exclamation-triangle fs-4"></i>
                                    <h6 class="mt-3">Tidak ada kategori yang tersedia.</h6>
                                </div>
                            </div>
                        @else
                            <div class="col-6 col-lg-4 col-xl-3 d-grid">
                                <button type="button" class="mb-2 btn btn-primary btn-md d-block btn-category"
                                    id="btn-Semua"onclick="filterCategory('Semua');"><span
                                        class="d-flex align-items-center"><i class="fas fa-adjust fs-4"></i><span
                                            style="margin-left:8px; margin-top:1px;">Semua</span></span></button>
                            </div>
                            @foreach (collect($decodes->list_kategori)->sortBy('key') as $nama => $iconClass)
                                <div class="col-6 col-lg-4 col-xl-3 d-grid">
                                    <button type="button" class="mb-2 btn btn-outline-primary btn-md d-block btn-category"
                                        id="btn-{{ $nama }}" onclick="filterCategory('{{ $nama }}');"><span
                                            class="d-flex align-items-center"><i class="{!! $iconClass !!}"></i><span
                                                style="margin-left:8px; margin-top:1px;">{{ ucfirst($nama) }}</span></span></button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quick Start Guide for New Users -->
    @if (Auth::user()->balance == 0 && !session()->has('hide_guide'))
        <div class="mb-3 row">
            <div class="col-12">
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="mb-1">🎉 Selamat datang! Mari mulai dengan langkah mudah:</h6>
                            <ol class="mb-0 small">
                                <li><strong>Pilih layanan:</strong> Mulai dengan tab "Rekomendasi" untuk layanan terbaik
                                </li>
                                <li><strong>Top up saldo:</strong> Klik tombol "Top Up" di samping saldo untuk mengisi saldo
                                </li>
                                <li><strong>Lakukan pemesanan:</strong> Masukkan target dan jumlah, lalu klik "Pesan"</li>
                            </ol>
                            <div class="mt-2">
                                <a href="{{ route('deposit') }}" class="btn btn-sm btn-success me-2">
                                    <i class="fas fa-wallet me-1"></i>Top Up Sekarang
                                </a>
                                <small class="text-muted">Minimal Deposit Rp 1.000</small>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                        onclick="hideGuide()"></button>
                </div>
            </div>
        </div>
    @endif


    <div class="row">
        <div class="col-md-8">

            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {!! session()->get('success') !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {!! session()->get('error') !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($errors->all())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }} </li>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card">
                <div class="p-3 card-header fw-bold text-xss">
                    <div class="row">
                        <div class="col-md">
                            <i class="fas fa-cart-plus me-2"></i>Pesanan baru
                        </div>
                        {{-- <div class="col-md">
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-sm btn-primary" onclick="toggleCategory()">Kategori</button>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="card-body" id="ajax-result">
                    @csrf
                    <ul class="mb-2 nav nav-pills" role="tablist" style="margin-bottom:13px;">
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link active" data-bs-toggle="tab" href="#recommended" id="btn-recommended"
                                onclick="closeCategory()" role="tab" style="padding:0.785rem 1rem !important;">
                                <i class="align-middle fa-regular fa-thumbs-up me-1"></i> <span
                                    class="d-md-inline-block">Rekomendasi</span>
                            </a>
                        </li>

                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-bs-toggle="tab" href="#general" id="btn-general" role="tab"
                                onclick="toggleCategory()" style="padding:0.785rem 1rem !important;">
                                <i class="align-middle fas fa-adjust me-1"></i> <span class="d-md-inline-block">Umum</span>
                            </a>
                        </li>

                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-bs-toggle="tab" href="#favorite" id="btn-favorite" role="tab"
                                style="padding:0.785rem 1rem !important;">
                                <i class="align-middle far fa-star me-1"></i> <span
                                    class="d-md-inline-block">Favorit</span>
                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-bs-toggle="tab" href="#cariID" id="btn-cariID" role="tab"
                                style="padding:0.785rem 1rem !important;">
                                <i class="align-middle fas fa-search me-1"></i> <span class="d-md-inline-block">Cari
                                    ID</span>
                            </a>
                        </li>
                    </ul>
                    <form action="{{ url('order/single-proses') }}" method="POST">
                        <div class="tab-content">
                            @csrf
                            <div class="tab-pane active" id="recommended" role="tabpanel">
                                <div class="mb-3">

                                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                    <select class="select2 form-control" style="width:100%" name="recommended_category"
                                        id="recommended_category">
                                        <option value="0">Pilih...</option>
                                        @forelse ($KategoriLayananRekomendasi as $row)
                                            <option value="{{ $row->id }}"
                                                data-icon="<i class='{!! $row->icon ?? null !!}'></i>">
                                                {{ $row->kategori ?? null }}
                                            </option>

                                        @empty
                                            <option data-icon="" value="0">Tidak ada kategori</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Layanan <span class="text-danger">*</span></label>
                                    <select class="select2 form-control" style="width:100%" name="layanan3"
                                        id="layanan3">
                                        <option value="0">Pilih Kategori Dahulu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="tab-pane" id="general" role="tabpanel">
                                <div class="mb-3">
                                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                    <select class="select2 form-control" id="category">
                                        <option value="0">Pilih...</option>
                                        @forelse ($kategori as $row)
                                            @php
                                                $id = optional($row->smm->first())->id; // Menggunakan eager loading
                                            @endphp

                                            @if ($id)
                                                <option value="{{ $id }}"
                                                    @if ($id == $ct) selected @endif
                                                    data-icon="<i class='{!! $row->icon ?? null !!}'></i>">
                                                    {!! $row->kategori ?? null !!}
                                                </option>
                                            @else
                                                <option data-icon="" value="0">Tidak ada kategori</option>
                                            @endif
                                        @empty
                                            <option data-icon="" value="0">Tidak ada kategori</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between" bis_skin_checked="1">
                                        <label class="form-label">Layanan <span class="text-danger">*</span> <span
                                                id="fav_service" style="cursor:pointer;"></span></label>
                                        <div class="mt-1 fw-bolder text-secondary small">

                                            <span class="mx-2" id="is_refill"><i class="fas fa-question-circle"></i>
                                                Refill</span>
                                            <span class="" id="is_cancel"><i class="fas fa-question-circle"></i>
                                                Cancel</span>
                                        </div>
                                    </div>
                                    <select class="select2 form-control" style="width:100%" name="layanan"
                                        id="layanan">
                                        <option value="0">Pilih Kategori Dahulu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="tab-pane" id="favorite" role="tabpanel">
                                <div class="mb-3">
                                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                    <select class="select2 form-control" style="width:100%" name="category_fav"
                                        id="category_fav">
                                        <option value="0">Pilih...</option>
                                        @forelse ($favoritCategory as $row)
                                            @php
                                                $category = App\Models\Category::where(
                                                    'kategori',
                                                    $row->category,
                                                )->first();
                                            @endphp
                                            @if ($category)
                                                <option value="{{ $row->category }}"
                                                    data-icon="<i class='{!! $category->icon ?? null !!}'></i>">
                                                    {!! $row->category !!}</option>
                                            @endif
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Layanan <span class="text-danger">*</span></label>
                                    <select class="select2 form-control" style="width:100%" name="layanan2"
                                        id="layanan2">
                                        <option value="0">Pilih Kategori Dahulu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="tab-pane" id="cariID" role="tabpanel">
                                <div class="form-group">
                                    <label class="form-label">ID Layanan <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="service-id">
                                        <a href="javascript:;" class="btn btn-primary" id="btnSearch"
                                            style="padding-top: 0.8rem;">Cari</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="form-services"></div>
                        <div class="mb-3" id="deskripsi_umum">
                            <label class="form-label">Detail layanan <span class="text-danger">*</span></label>
                            <div class="p-3 mb-3 border rounded border-primary text-secondary" id="infoDesc">Deskripsi
                                layanan.
                            </div>
                        </div>
                        <div class="mb-3 form-group">
                            <label>Link/Target <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Masukkan target" name="target"
                                id="target">
                        </div>
                        <div class="mb-3 d-none">
                            <label class="form-label">Daftar Komentar (1 per baris)</label>
                            <textarea name="comments" id="inputComments" class="form-control" rows="5" onkeyup="changes()"></textarea>
                        </div>
                        <div class="mb-3 d-none">
                            <label class="form-label">Daftar Username (1 per baris)</label>
                            <textarea name="usernames" id="inputUsernames" onkeyup="changes()" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="mb-3 d-none">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" id="inputUsername" class="form-control">
                        </div>
                        <div class="mb-3 d-none">
                            <label class="form-label">Hashtag</label>
                            <input type="text" name="hashtag" id="inputHashtag" class="form-control">
                        </div>
                        <div class="mb-3 d-none">
                            <label class="form-label">Media</label>
                            <input type="text" name="media" id="inputMedia" class="form-control">
                        </div>
                        <div class="mb-3 d-none">
                            <label class="form-label">Nomor Jawaban</label>
                            <input type="text" name="answer_number" id="inputPoll" class="form-control">
                        </div>
                        <div class="row">
                            <div class="form-group col-md" id="quan">
                                <label>Jumlah Pesan</label>
                                <input type="number" class="form-control" placeholder="Masukkan jumlah pesanan"
                                    name="quantity" onkeyup="totalCharge()" id="quantity">
                                <div class="mt-2">
                                    <span id="infoMin" class="text-primary">Min 0</span> - <span id="infoMax"
                                        class="text-primary">Max 0</span>
                                </div>
                            </div>
                            <div class="form-group col-md">
                                <label>Total Harga <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input class="form-control" readonly id="total-price">
                                </div>
                            </div>
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
            <div class="mb-3 row">
                <div class="col-12">
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <small class="mb-1 fw-medium">Pastikan akun target tidak private & jangan mengubah username
                                    agar pesanan dapat masuk.. Khusus layanan Instagram laporan
                                    tinjau wajib
                                    dinonaktifkan</small>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                            onclick="hideGuide()"></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md">
            <!-- User Balance Card -->
            <div class="mb-3 card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar bg-light-primary"><i class="fas fa-wallet f-18"></i></div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="mb-1">Saldo Anda</p>
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">Rp {{ number_format(Auth::user()->balance, 0, ',', '.') }}</h4>
                                <a href="{{ route('deposit') }}" class="btn btn-sm btn-success">
                                    <i class="fas fa-plus me-1"></i>Top Up
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="mb-3 row">
                <div class="col-6">
                    <div class="card">
                        <div class="p-2 text-center card-body">
                            <div class="mx-auto mb-1 avtar bg-light-success"><i class="fas fa-check-circle f-16"></i>
                            </div>
                            <p class="mb-1 small">Pesanan Selesai</p>
                            <h6 class="mb-0">Rp {{ number_format($userStats['completed_orders'], 0, ',', '.') }}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="p-2 text-center card-body">
                            <div class="mx-auto mb-1 avtar bg-light-info"><i class="fas fa-money-bill-transfer f-16"></i>
                            </div>
                            <p class="mb-1 small">Deposit Selesai</p>
                            <h6 class="mb-0">Rp {{ number_format($userStats['completed_deposits'], 0, ',', '.') }}</h6>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recommended Services Card -->
            <div class="mb-3 card">
                <div class="p-3 card-header fw-bold text-xss">
                    <i class="fas fa-star me-2"></i>Layanan Rekomendasi
                </div>
                <div class="card-body">
                    <div style="max-height: 300px; overflow-y: auto;">
                        @php $hasValidService = false; @endphp
                        @foreach ($layananRekomendasi as $service)
                            @if ($service->smm()->first())
                                @php
                                    $hasValidService = true;
                                    $text = $service->service . '||' . $service->provider;
                                    $encrypt = App\Helpers\Encryption::encrypt($text);
                                @endphp
                                <div class="p-2 mb-2 border rounded d-flex align-items-center justify-content-between">
                                    <div class="flex-grow-1">
                                        <small
                                            class="fw-medium">{{ Str::limit($service->smm()->first()->name, 40) }}</small>
                                        <br><span class="text-muted small">Rp
                                            {{ number_format($service->smm()->first()->price, 0, ',', '.') }}/K</span>
                                    </div>
                                    <a href="{{ url('order/single?id=' . $encrypt) }}" class="btn btn-sm btn-primary">
                                        <i class="ti ti-shopping-cart"></i>
                                    </a>
                                </div>
                            @endif
                        @endforeach

                        @if (!$hasValidService)
                            <p class="text-center text-muted">Layanan rekomendasi kosong</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Latest News -->
            <div class="card">
                <div class="p-3 card-header fw-bold text-xss">
                    <i class="fas fa-bullhorn me-2"></i>Informasi Terbaru
                </div>
                <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                    @forelse ($berita as $row)
                        <div class="pb-2 mb-3 border-bottom">
                            <div class="d-flex align-items-start">
                                <div class="flex-grow-1">
                                    <span class="mb-1 badge bg-primary">{{ strtoupper($row->type) }}</span>
                                    <small
                                        class="text-muted float-end">{{ \Carbon\Carbon::parse($row->created_at)->format('d/m H:i') }}</small>
                                    <p class="mb-0 small">
                                        @php
                                            $message = Str::limit(strip_tags($row->message), 100);
                                            $message = preg_replace(
                                                '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/',
                                                '<a href="$0" target="_blank">$0</a>',
                                                $message,
                                            );
                                        @endphp
                                        {!! $message !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-muted">Tidak ada informasi terbaru</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <script>
        @if ($decodes->kategori_hidden == true)
            $('#catGroup').hide();
        @endif
        $(document).ready(function() {

            function iformat(icon) {
                var originalOption = icon.element;
                if ($(originalOption).index() == 0) {
                    var ic = '';
                } else {
                    var ic = $(originalOption).data('icon');
                }
                return $('<span>' + ic + ' ' + icon.text + '</span>');
            }
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
            $('#recommended_category').select2({
                width: "100%",
                templateSelection: iformat,
                templateResult: iformat,
                allowHtml: true
            });
            $('#layanan').select2({
                width: "100%",
            });
        });

        function toggleCategory() {
            $('#catGroup').slideToggle();
        }

        function closeCategory() {
            $('#catGroup').slideUp();
        }
    </script>

    <script>
        let priceLayanan = 0;
        let min = 0;
        let max = 0;
        $('#category').change(function() {
            var value = $(this).val();
            var path = $('#category_path').attr('value');
            if (path == value) {
                var srv = $('#service_path').attr('value');
            } else {
                var srv = null;
            }
            $.ajax({
                url: "{{ route('get.layanan') }}",
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
        $('#category_fav').change(function() {
            var value = $(this).val();
            $.ajax({
                url: "{{ route('get.layanan.favorite') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: $(this).val()
                },
                dataType: "html",
                success: function(response) {
                    $('#layanan2').html(response);
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
        $('#recommended_category').change(function() {
            var value = $(this).val();

            $.ajax({
                url: "{{ route('get.layanan.recommended') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: value,
                },
                dataType: "html",
                success: function(response) {
                    $('#layanan3').html(response);

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
        $('#layanan,#layanan2,#layanan3').change(function() {
            var value = $(this).val();
            $.ajax({
                url: "{{ route('get.detail.layanan') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: $(this).val(),
                },
                dataType: "json",
                success: function(result) {
                    console.log(result);
                    if (result.status == false) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: result.message,
                        });
                    } else {
                        if (result.refill == 1) {
                            $('#is_refill').addClass('text-success');
                            $('#is_refill').removeClass('text-danger');
                            $('#is_refill').html(
                                '<i class="fas fa-check-circle"></i> Refill');
                        } else {
                            $('#is_refill').addClass('text-danger');
                            $('#is_refill').removeClass('text-success');
                            $('#is_refill').html(
                                '<i class="fas fa-times-circle"></i> Refill');
                        }
                        if (result.cancel == 1) {
                            $('#is_cancel').addClass('text-success');
                            $('#is_cancel').removeClass('text-danger');
                            $('#is_cancel').html(
                                '<i class="fas fa-check-circle"></i> Cancel');
                        } else {
                            $('#is_cancel').addClass('text-danger');
                            $('#is_cancel').removeClass('text-success');
                            $('#is_cancel').html(
                                '<i class="fas fa-times-circle"></i> Cancel');
                        }
                        $('#deskripsi_umum').removeClass('d-none');
                        $('#infoDesc').html(result.deskripsi);
                        $('#inputPoll').parent().addClass('d-none')
                        $('#inputUsername').parent().addClass('d-none')
                        $('#inputHashtag').parent().addClass('d-none')
                        $('#inputMedia').parent().addClass('d-none')
                        priceLayanan = result.price;
                        min = result.min;
                        max = result.max;
                        $('#quantity').attr('readonly', false)
                        $('#inputUsernames').parent().addClass('d-none')
                        $('#inputComments').parent().addClass('d-none')
                        $('#infoMin').html('Min ' + result.min);
                        $('#infoMax').html('Max ' + result.max);
                        if (result.type == "poll") {
                            $('#inputPoll').parent().removeClass('d-none')
                        }
                        if (result.type == "mention_follower" || result.type == "comment_reply") {
                            $('#inputUsername').parent().removeClass('d-none')
                        }
                        if (result.type == "package") {
                            $('#quan').addClass('d-none');
                            $('#total-price').val(result.price);
                        }
                        if (result.type == "mention_hastag") {
                            $('#inputHashtag').parent().removeClass('d-none')
                        }
                        if (result.type == "mention_media") {
                            $('#inputMedia').parent().removeClass('d-none')
                        }
                        if (result.type == "mention_list") {
                            $('#quantity').attr('readonly', true)
                            $('#inputUsernames').parent().removeClass('d-none')
                        }
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
        $('#layanan_fav').change(function() {
            var value = $(this).val();
        });
        $('#btnSearch').click(function() {
            let value = $('#service-id').val();
            $.ajax({
                url: "{{ route('search-id') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: value,
                    type: "single",
                },
                dataType: "json",
                success: function(result) {
                    if (result.status) {
                        $('#form-services').html(result.html);
                        $('#deskripsi_umum').removeClass('d-none');
                        $('#infoDesc').html(result.deskripsi);
                        $('#inputPoll').parent().addClass('d-none')
                        $('#inputUsername').parent().addClass('d-none')
                        $('#inputHashtag').parent().addClass('d-none')
                        $('#inputMedia').parent().addClass('d-none')
                        priceLayanan = result.price;
                        min = result.min;
                        max = result.max;
                        $('#quantity').attr('readonly', false)
                        $('#inputUsernames').parent().addClass('d-none')
                        $('#inputComments').parent().addClass('d-none')
                        $('#infoMin').html('Min ' + result.min);
                        $('#infoMax').html('Max ' + result.max);
                        if (result.type == "poll") {
                            $('#inputPoll').parent().removeClass('d-none')
                        }
                        if (result.type == "mention_follower" || result.type == "comment_reply") {
                            $('#inputUsername').parent().removeClass('d-none')
                        }
                        if (result.type == "package") {
                            $('#quan').addClass('d-none');
                            $('#total-price').val(result.price);
                        }
                        if (result.type == "mention_hastag") {
                            $('#inputHashtag').parent().removeClass('d-none')
                        }
                        if (result.type == "mention_media") {
                            $('#inputMedia').parent().removeClass('d-none')
                        }
                        if (result.type == "mention_list") {
                            $('#quantity').attr('readonly', true)
                            $('#inputUsernames').parent().removeClass('d-none')
                        }
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
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: result.message,
                        });
                        $('#form-services').html('');
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    });
                    $('#form-services').html('');
                }
            });
        });
        window.addEventListener('swal:modal', event => {
            Swal.fire({
                icon: event.detail[0].type,
                title: event.detail[0].title,
                text: event.detail[0].text,
            });
        });
        $('button[type=reset]').click(function() {
            // hapus disabled button submit
            $('button[type=submit]').removeAttr('disabled');
        });

        function filterCategory(category) {
            $(".btn-category").addClass('btn-outline-primary').removeClass('btn-primary');
            $("#btn-" + category).addClass('btn-primary').removeClass('btn-outline-primary');
            $.ajax({
                type: "POST",
                url: "{{ route('filterCategory') }}",
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


        function totalCharge() {
            var price = priceLayanan / 1000
            var qty = Number($('#quantity').val().replace(/\./g, ''))
            let math = Math.ceil(qty * price)
            math = number_format(math, 0, ',', '.')
            $('#total-price').val(math).trigger('onkeyup')
            validateQuan();
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

        function changes() {
            var service = $('#service').val();
            var quantity = $('#inputComments').val().split("\n").length;
            $('#quantity').val(quantity);
            $('#quantity').trigger('keyup');
        }

        $("form").on("submit", function() {
            $("button[type=submit]").attr('disabled', 'true')
        });

        // Hide guide function
        function hideGuide() {
            fetch('/api/hide-guide', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            });
        }

        // Enhanced UX: Auto-focus first available input in active tab
        $('.nav-link').on('shown.bs.tab', function(e) {
            setTimeout(function() {
                $(e.target.getAttribute('href')).find('select:first').focus();
            }, 100);
        });

        // Enhanced UX: Show loading states
        $('form').on('submit', function() {
            $(this).find('button[type=submit]').html('<i class="fas fa-spinner fa-spin me-2"></i>Memproses...');
        });

        // Auto-trigger recommended services on page load for better UX
        $(document).ready(function() {
            // Focus on the first recommended category option if available
            if ($('#recommended_category option').length > 1) {
                setTimeout(function() {
                    $('#recommended_category').focus();
                }, 500);
            }
        });
    </script>
    <script>
        let service_path = $('#service_path').attr('value');
        if (service_path !== '') {
            $('#category').trigger('change');
            //cari di category dengan value service_path dan trigger change
            // $('#category').val(service_path).trigger('change');
        }
    </script>
@endsection
