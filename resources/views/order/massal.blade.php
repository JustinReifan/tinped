@extends('templates.main')
@section('content')
    @php
        $decodes = json_decode($config->konfigurasi_kategori);
    @endphp
    <div id="title-page" data-value="Massal" data-value2="Pesanan Baru"></div>
    <div class="row" id="catGroup">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body border-bottom" style="padding-bottom:.5rem;">
                    <div class="row">
                        @if (collect($decodes->list_kategori)->count() == 0)
                            <div class="alert alert-danger">
                                <div class="alert-body text-center">
                                    <i class="fas fa-exclamation-triangle fs-4"></i>
                                    <h6 class="mt-3">Tidak ada kategori yang tersedia.</h6>
                                </div>
                            </div>
                        @else
                            <div class="col-6 col-lg-4 col-xl-3 d-grid">
                                <button type="button" class="btn btn-primary btn-md d-block mb-2 btn-category"
                                    id="btn-Semua"onclick="filterCategory('Semua');"><span
                                        class="d-flex align-items-center"><i class="fas fa-adjust fs-4"></i><span
                                            style="margin-left:8px; margin-top:1px;">Semua</span></span></button>
                            </div>
                            @foreach (collect($decodes->list_kategori)->sortBy('key') as $nama => $iconClass)
                                <div class="col-6 col-lg-4 col-xl-3 d-grid">
                                    <button type="button" class="btn btn-outline-primary btn-md d-block mb-2 btn-category"
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
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {!! session()->get('success') !!}
            <button type="button" class="btn-close" wire:click="RemoveSession" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ session()->get('error') }}
            <button type="button" wire:click="RemoveSession" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endif
    @if ($errors->all())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong>
            @foreach ($errors->all() as $error)
                <li>{{ $error }} </li>
            @endforeach
            <button type="button" class="btn-close" wire:click="RemoveSession" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endif
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header fw-bold p-3 text-xss">
                    <div class="row">
                        <div class="col-md">
                            <i class="fas fa-cart-plus me-2"></i>Pesanan baru
                        </div>
                        <div class="col-md">
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-sm btn-primary" onclick="toggleCategory()">Kategori</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body" id="ajax-result">
                    @csrf
                    <ul class="nav nav-pills mb-2" role="tablist" style="margin-bottom:13px;">
                        <li class="nav-item waves-effect waves-light" onclick="resetCategory()">
                            <a class="nav-link active" data-bs-toggle="tab" href="#general" id="btn-general" role="tab"
                                style="padding:0.785rem 1rem !important;">
                                <i class="fas fa-adjust me-1 align-middle"></i> <span class="d-md-inline-block">Umum</span>
                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link " data-bs-toggle="tab" onclick="resetCategory()" href="#favorite"
                                id="btn-favorite" role="tab" style="padding:0.785rem 1rem !important;">
                                <i class="far fa-star me-1 align-middle"></i> <span class="d-md-inline-block">Favorit</span>
                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-bs-toggle="tab" href="#cariID" id="btn-cariID" role="tab"
                                style="padding:0.785rem 1rem !important;">
                                <i class="fas fa-search me-1 align-middle"></i> <span class="d-md-inline-block">Cari
                                    ID</span>
                            </a>
                        </li>
                    </ul>
                    <form action="{{ url('order/massal-proses') }}" method="POST">
                        @csrf
                        <div class="tab-content">
                            <div class="tab-pane active" id="general" role="tabpanel">
                                <div class="mb-3">
                                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                    <select class="select2 form-control" id="category">
                                        <option value="0">Pilih...</option>

                                        @forelse ($kategori as $row)
                                            @if ($row->smm->isNotEmpty())
                                                <option value="{{ $row->smm->first()->id }}"
                                                    data-icon="<i class='{!! $row->icon ?? null !!}'></i>">
                                                    {!! $row->kategori ?? null !!}
                                                </option>
                                            @else
                                            @endif
                                        @empty
                                        @endforelse
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between" bis_skin_checked="1">
                                        <label class="form-label">Layanan <span class="text-danger">*</span> <span
                                                id="fav_service" style="cursor:pointer;"></span></label>
                                        <span class="fw-bolder text-secondary small mt-1" id="is_refill"><i
                                                class="fas fa-question-circle"></i> Refill Button</span>
                                    </div>
                                    <select class="tab_favorit form-control" style="width:100%" name="layanan"
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
                                    <select class="tab_favorit form-control select2" style="width:100%" name="layanan2"
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
                            <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                            <div class="border border-primary rounded p-3 mb-3" id="infoDesc">Deskripsi
                                layanan.
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label>Link/Target </label>
                            <span class="badge bg-primary" id="infoMin">Min: 0</span>
                            <span class="badge bg-primary" id="infoMax">Max: 0</span></label>
                            <textarea class="form-control" name="target" id="target" rows="5" placeholder="target|jumlah"></textarea>
                            <small class="text-danger">*Maksimal 50 baris perintah.(1 Baris 1
                                Pesanan)</small>
                        </div>
                        <div class="row">
                            <div class="form-group col-md">
                                <label>Total Harga <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input readonly class="form-control" value="0" id="total-price">
                                </div>
                            </div>
                        </div>
                        <div class="mb-0 mt-3 float-end">
                            <button type="submit" class="btn btn-primary float-end"><i
                                    class="fas fa-cart-plus fs-6 me-2"></i>Pesan</button>
                            <button type="reset" class="btn btn-danger float-end me-2"><i
                                    class="fas fa-sync fs-6 me-2"></i>Ulangi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card">
                <div class="card-header fw-bold p-3 text-xss"><i class="fas fa-info-circle me-1"></i> Informasi
                </div>
                <div class="card-body">
                    @php
                        $decode = json_decode($config->info_text);
                    @endphp
                    {!! $decode->massal !!}
                </div>
            </div>
        </div>
    </div>

    <script>
        @if ($decodes->kategori_hidden == true)
            $('#catGroup').hide();
        @endif
        function toggleCategory() {
            $('#catGroup').slideToggle();
        }
    </script>
    <script>
        let priceLayanan, min, max;

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
                    $('#layanan').html('<option value="0">Pilih Kategori...</option>');
                },
                error: function() {
                    $('#ajax-result').html(
                        '<font color="red">Terjadi kesalahan! Silahkan refresh halaman.</font>');
                }
            });
        }
        $(document).ready(function() {
            function iformat(icon) {
                var originalOption = icon.element;
                // if (icon.text == 'Pilih...')
                // apabila option pertama maka jangan tampilakn icon.text
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
            $('#layanan').select2();
        })

        function debounce(func, wait, immediate) {
            var timeout;
            return function() {
                var context = this,
                    args = arguments;
                var later = function() {
                    timeout = null;
                    if (!immediate) func.apply(context, args);
                };
                var callNow = immediate && !timeout;
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
                if (callNow) func.apply(context, args);
            };
        };
        $('#category').change(function() {
            $.ajax({
                url: "{{ route('get.layanan.massal') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: $(this).val()
                },
                dataType: "html",
                success: function(response) {
                    $('#layanan').html(response);
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
        $('#layanan,#layanan2').change(function() {
            var value = $(this).val();

            $.ajax({
                url: "{{ route('get.detail.layanan') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: $(this).val()
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
                        $('#infoDesc').html(result.deskripsi);
                        priceLayanan = result.price;
                        min = result.min;
                        max = result.max;
                        $('#infoMin').html('Min: ' + result.min);
                        $('#infoMax').html('Max: ' + result.max);
                        if (result.refill == 1) {
                            $('#is_refill').addClass('text-success');
                            $('#is_refill').removeClass('text-danger');
                            $('#is_refill').html(
                                '<i class="fas fa-check-circle"></i> Refill Button');
                        } else {
                            $('#is_refill').addClass('text-danger');
                            $('#is_refill').removeClass('text-success');
                            $('#is_refill').html(
                                '<i class="fas fa-times-circle"></i> Refill Button');
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
        $('#target').change(function() {
            let target = $(this).val();
            if (target.includes('|')) {
                if (priceLayanan == undefined) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Pilih layanan terlebih dahulu!',
                    });
                    return;
                }
                let harga = priceLayanan;

                let explode = target.split('\n');

                let jumlah = '';
                let sQuantity = false;

                for (let value of explode) {
                    let expl = value.split('|');
                    if (expl.length % 2 === 0) {
                        if (expl[1] < min) {
                            sQuantity = true;
                        } else if (expl[1] > max) {
                            sQuantity = true;
                        } else {
                            jumlah += expl[1] + ',';
                        }
                    }
                }
                explode = jumlah.split(',').filter(value => !isNaN(parseInt(value)));
                let total = 0;

                for (let value of explode) {
                    if (value.trim() !== "" && !isNaN(value)) {
                        total += parseInt(value);
                    }
                }
                let int = (parseInt(harga) / 1000) * total;
                int = Math.ceil(int);
                $('#total-price').val(int);
            }
            if (target == '') {
                $('#total-price').val(0);
            }
        });

        function resetCategory() {

            // $('#category').val(0);
            $('#layanan').html('<option value="0">Pilih Kategori...</option>');
            $('#layanan').html('<option value="0">Pilih Kategori...</option>');
        }
        $('#btnSearch').click(function() {
            let value = $('#service-id').val();
            $.ajax({
                url: "{{ route('search-id') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: value,
                    type: "massal",
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
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    });
                    $('#form-services').html('');
                }
            });
        });
    </script>
@endsection
