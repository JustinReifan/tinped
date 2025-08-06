<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body border-bottom" style="padding-bottom: 3rem;">
                    <div class="row">
                        <div class="col-6 col-lg-4 col-xl-3 d-grid">
                            <button type="button" class="btn btn-outline-primary btn-md d-block mb-2 btn-category"
                                id="btn-Semua" onclick="filterCategory('Semua');"><span
                                    class="d-flex align-items-center"><i class="fas fa-adjust fs-4"></i><span
                                        style="margin-left:8px; margin-top:1px;">Semua</span></span></button>
                        </div>
                        <div class="col-6 col-lg-4 col-xl-3 d-grid">
                            <button type="button" class="btn btn-outline-primary btn-md d-block mb-2 btn-category"
                                id="btn-Instagram" onclick="filterCategory('Instagram');"><span
                                    class="d-flex align-items-center"><i class="fab fa-instagram fs-4"></i><span
                                        style="margin-left:8px; margin-top:1px;">Instagram</span></span></button>
                        </div>
                        <div class="col-6 col-lg-4 col-xl-3 d-grid">
                            <button type="button" class="btn btn-outline-primary btn-md d-block mb-2 btn-category"
                                id="btn-Facebook" onclick="filterCategory('Facebook');"><span
                                    class="d-flex align-items-center"><i class="fab fa-facebook fs-4"></i><span
                                        style="margin-left:8px; margin-top:1px;">Facebook</span></span></button>
                        </div>
                        <div class="col-6 col-lg-4 col-xl-3 d-grid">
                            <button type="button" class="btn btn-outline-primary btn-md d-block mb-2 btn-category"
                                id="btn-Youtube" onclick="filterCategory('Youtube');"><span
                                    class="d-flex align-items-center"><i class="fab fa-youtube fs-4"></i><span
                                        style="margin-left:8px; margin-top:1px;">Youtube</span></span></button>
                        </div>
                        <div class="col-6 col-lg-4 col-xl-3 d-grid">
                            <button type="button" class="btn btn-outline-primary btn-md d-block mb-2 btn-category"
                                id="btn-Twitter" onclick="filterCategory('Twitter');"><span
                                    class="d-flex align-items-center"><i class="fab fa-twitter fs-4"></i><span
                                        style="margin-left:8px; margin-top:1px;">Twitter</span></span></button>
                        </div>
                        <div class="col-6 col-lg-4 col-xl-3 d-grid">
                            <button type="button" class="btn btn-outline-primary btn-md d-block mb-2 btn-category"
                                id="btn-Spotify" onclick="filterCategory('Spotify');"><span
                                    class="d-flex align-items-center"><i class="fab fa-spotify fs-4"></i><span
                                        style="margin-left:8px; margin-top:1px;"> Spotify</span></span></button>
                        </div>
                        <div class="col-6 col-lg-4 col-xl-3 d-grid">
                            <button type="button" class="btn btn-outline-primary btn-md d-block mb-2 btn-category"
                                id="btn-Tiktok" onclick="filterCategory('Tiktok');"><span
                                    class="d-flex align-items-center"><i class="fa fa-music fs-4"></i><span
                                        style="margin-left:8px; margin-top:1px;"> Tiktok</span></span></button>
                        </div>
                        <div class="col-6 col-lg-4 col-xl-3 d-grid">
                            <button type="button" class="btn btn-outline-primary btn-md d-block mb-2 btn-category"
                                id="btn-Twitch" onclick="filterCategory('Twitch');"><span
                                    class="d-flex align-items-center"><i class="fab fa-linkedin fs-4"></i><span
                                        style="margin-left:8px; margin-top:1px;"> Linkedin</span></span></button>
                        </div>
                        <div class="col-6 col-lg-4 col-xl-3 d-grid">
                            <button type="button" class="btn btn-outline-primary btn-md d-block mb-2 btn-category"
                                id="btn-Google" onclick="filterCategory('Google');"><span
                                    class="d-flex align-items-center"><i class="fab fa-google fs-4"></i><span
                                        style="margin-left:8px; margin-top:1px;"> Google</span></span></button>
                        </div>
                        <div class="col-6 col-lg-4 col-xl-3 d-grid">
                            <button type="button" class="btn btn-outline-primary btn-md d-block mb-2 btn-category"
                                id="btn-Telegram" onclick="filterCategory('Telegram');"><span
                                    class="d-flex align-items-center"><i class="fab fa-telegram fs-4"></i><span
                                        style="margin-left:8px; margin-top:1px;"> Telegram</span></span></button>
                        </div>
                        <div class="col-6 col-lg-4 col-xl-3 d-grid">
                            <button type="button" class="btn btn-outline-primary btn-md d-block mb-2 btn-category"
                                id="btn-Website" onclick="filterCategory('Website');"><span
                                    class="d-flex align-items-center"><i class="fa fa-globe fs-4"></i><span
                                        style="margin-left:8px; margin-top:1px;"> Web Traffic</span></span></button>
                        </div>
                        <div class="col-6 col-lg-4 col-xl-3 d-grid">
                            <button type="button" class="btn btn-outline-primary btn-md d-block mb-2 btn-category"
                                id="btn-Discord" onclick="filterCategory('Discord');"><span
                                    class="d-flex align-items-center"><i class="fab fa-discord fs-4"></i><span
                                        style="margin-left:8px; margin-top:1px;"> Discord</span></span></button>
                        </div>
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header fw-bold p-3 text-xss"><i class="mdi mdi-cart-arrow-up me-1"></i>Pesanan Baru
                    </h5>
                    <div class="card-body" id="ajax-result">
                        @csrf
                        <ul class="nav nav-pills mb-2" role="tablist" wire:ignore style="margin-bottom:13px;">
                            <li class="nav-item waves-effect waves-light"wire:click="activated('Umum')">
                                <a class="nav-link @if ($tab == 'Umum') active @endif"
                                    data-bs-toggle="tab" href="#general" id="btn-general" role="tab"
                                    style="padding:0.785rem 1rem !important;">
                                    <i class="fas fa-adjust me-1 align-middle"></i> <span
                                        class="d-md-inline-block">Umum</span>
                                </a>
                            </li>
                            <li class="nav-item waves-effect waves-light" wire:click="activated('Favorit')">
                                <a class="nav-link @if ($tab == 'Favorit') active @endif"
                                    data-bs-toggle="tab" href="#favorite" id="btn-favorite" role="tab"
                                    style="padding:0.785rem 1rem !important;">
                                    <i class="far fa-star me-1 align-middle"></i> <span
                                        class="d-md-inline-block">Favorit</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane  @if ($tab == 'Umum') active @endif" id="general"
                                role="tabpanel">
                                <form wire:submit.prevent="order">
                                    <div class="mb-3" wire:ignore>
                                        <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                        <select class="select2 form-control" style="width:100%" name="category"
                                            id="category">
                                            <option value="0">Pilih...</option>
                                            @foreach ($kategori as $row)
                                                @php
                                                    $id = App\Models\Smm::where([
                                                        ['category', $row->category],
                                                        ['type', 'primary'],
                                                    ])
                                                        ->orWhere([['category', $row->category], ['type', 'Default']])
                                                        ->first();
                                                @endphp
                                                @if ($id)
                                                    <option value="{{ $id->id }}">{{ $row->category }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3" wire:ignore>
                                        <label class="form-label">Layanan <span class="text-danger">*</span></label>
                                        <select class="tab_favorit form-control" style="width:100%" name="layanan"
                                            id="layanan">
                                            <option value="0">Pilih Kategori Dahulu</option>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Harga / 1000</label>
                                            <div class="input-group">
                                                <div class="input-group-text">Rp</div>
                                                <input type="text" class="form-control" wire:model="harga"
                                                    value="0" name="price" id="price" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Min</label>
                                            <input type="text" class="form-control" wire:model="min"
                                                value="0" id="min-amount" readonly>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Max</label>
                                            <input type="text" class="form-control" wire:model="max"
                                                value="0" id="max-amount" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="description" wire:model="deskripsi" style="height: 100px" readonly>Deskripsi layanan.</textarea>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Average Time <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model.lazy="average_time"
                                            disabled placeholder="Average Time">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label>Target <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="target" wire:model.lazy="target" id="target" rows="10"
                                            placeholder="target|jumlah 
target|jumlah"></textarea>
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
                                                <input wire:model="total_harga"class="form-control" id="total-price">
                                            </div>
                                        </div>
                                        <div class="mb-0 mt-3 float-end">
                                            <button type="reset" class="btn btn-danger waves-effect waves-light"><i
                                                    class="mdi mdi-refresh me-1"></i>Ulangi</button>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light"><i
                                                    class="mdi mdi-cart-arrow-up me-1"></i>Pesan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane  @if ($tab == 'Favorit') active @endif" id="favorite"
                                role="tabpanel">
                                <form wire:submit.prevent="order_fav">
                                    <div class="mb-3" wire:ignore>
                                        @php
                                            $kategori = App\Models\Favorit::distinct()
                                                ->where('user_id', Auth::user()->id)
                                                ->orderBy('category', 'asc')
                                                ->get(['category']);
                                        @endphp
                                        <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                        <select class="select2 form-control" style="width:100%" name="category_fav"
                                            id="category_fav">
                                            <option value="0">Pilih...</option>
                                            @foreach ($kategori as $row)
                                                @php
                                                    $service = App\Models\Smm::where(
                                                        'category',
                                                        $row->category,
                                                    )->first();
                                                    if ($service) {
                                                        $delete = false;
                                                    } else {
                                                        $delete = App\Models\Favorit::where(
                                                            'category',
                                                            $row->category,
                                                        )->delete();
                                                    }
                                                @endphp
                                                <option value="{{ $row->category }}">{{ $row->category }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3" wire:ignore>
                                        <label class="form-label">Layanan <span class="text-danger">*</span></label>
                                        <select class="select2 form-control" style="width:100%" name="layanan_fav"
                                            id="layanan_fav">
                                            <option value="0">Pilih Kategori Dahulu</option>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Harga / 1000</label>
                                            <div class="input-group">
                                                <div class="input-group-text">Rp</div>
                                                <input type="text" class="form-control" wire:model="harga_fav"
                                                    value="0" name="price" id="price" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Min</label>
                                            <input type="text" class="form-control" wire:model="min_fav"
                                                value="0" id="min-amount" readonly>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Max</label>
                                            <input type="text" class="form-control" wire:model="max_fav"
                                                value="0" id="max-amount" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="description" wire:model="deskripsi_fav" style="height: 100px" readonly>Deskripsi layanan.</textarea>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Average Time <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model.lazy="average_time_fav"
                                            disabled placeholder="Average Time">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label>Target <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="target" wire:model.lazy="target_fav" id="target" rows="10"
                                            placeholder="target|jumlah 
target|jumlah"></textarea>
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
                                                <input wire:model="total_harga_fav"class="form-control"
                                                    id="total-price">
                                            </div>
                                        </div>
                                        <div class="mb-0 mt-3 float-end">
                                            <button type="reset" class="btn btn-danger waves-effect waves-light"
                                                wire:click="refresh_fav"><i
                                                    class="mdi mdi-refresh me-1"></i>Ulangi</button>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light"><i
                                                    class="mdi mdi-cart-arrow-up me-1"></i>Pesan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function filterCategory(category) {
            $(".btn-category").addClass('btn-outline-primary').removeClass('btn-primary');
            $("#btn-" + category).addClass('btn-primary').removeClass('btn-outline-primary');
            @this.set('tab', 'Umum');
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
                    $('#layanan').trigger('change');
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
            @this.set('kategori_fav', value)
            $.ajax({
                url: "{{ route('get.layanan.favorite') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: $(this).val()
                },
                dataType: "html",
                success: function(response) {
                    $('#layanan_fav').html(response);
                    $('#layanan_fav').trigger('change');
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
            @this.set('layanan', value)
        });
        $('#layanan_fav').change(function() {
            var value = $(this).val();
            @this.set('layanan_fav', value)
        });
        // Ketika button type submit di klik, scroolTop ke paling atas
        $(document).on('click', 'button[type="submit"]', function() {
            $('html, body').animate({
                scrollTop: 0
            }, 500);
        });
    </script>
</div>
