<div>
    <div class="row" id="catGroup">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body border-bottom" style="padding-bottom:.5rem;">
                    <div class="row" wire:ignore>
                        <div class="col-6 col-lg-4 col-xl-3 d-grid">
                            <button type="button" class="btn btn-outline-primary btn-md d-block mb-2 btn-category"
                                id="btn-Semua"onclick="filterCategory('Semua');"><span
                                    class="d-flex align-items-center"><i class="fas fa-adjust fs-4"></i><span
                                        style="margin-left:8px; margin-top:1px;">Semua</span></span></button>
                        </div>
                        <div class="col-6 col-lg-4 col-xl-3 d-grid">
                            <button type="button" class="btn btn-outline-primary btn-md d-block mb-2 btn-category"
                                id="btn-Instagram"onclick="filterCategory('Instagram');"><span
                                    class="d-flex align-items-center"><i class="fab fa-instagram fs-4"></i><span
                                        style="margin-left:8px; margin-top:1px;">Instagram</span></span></button>
                        </div>
                        <div class="col-6 col-lg-4 col-xl-3 d-grid">
                            <button type="button" class="btn btn-outline-primary btn-md d-block mb-2 btn-category"
                                id="btn-Facebook"onclick="filterCategory('Facebook');"><span
                                    class="d-flex align-items-center"><i class="fab fa-facebook fs-4"></i><span
                                        style="margin-left:8px; margin-top:1px;">Facebook</span></span></button>
                        </div>
                        <div class="col-6 col-lg-4 col-xl-3 d-grid">
                            <button type="button" class="btn btn-outline-primary btn-md d-block mb-2 btn-category"
                                id="btn-Youtube"onclick="filterCategory('Youtube');"><span
                                    class="d-flex align-items-center"><i class="fab fa-youtube fs-4"></i><span
                                        style="margin-left:8px; margin-top:1px;">Youtube</span></span></button>
                        </div>
                        <div class="col-6 col-lg-4 col-xl-3 d-grid">
                            <button type="button" class="btn btn-outline-primary btn-md d-block mb-2 btn-category"
                                id="btn-Twitter"onclick="filterCategory('Twitter');"><span
                                    class="d-flex align-items-center"><i class="fab fa-twitter fs-4"></i><span
                                        style="margin-left:8px; margin-top:1px;">Twitter</span></span></button>
                        </div>
                        <div class="col-6 col-lg-4 col-xl-3 d-grid">
                            <button type="button" class="btn btn-outline-primary btn-md d-block mb-2 btn-category"
                                id="btn-Spotify"onclick="filterCategory('Spotify');"><span
                                    class="d-flex align-items-center"><i class="fab fa-spotify fs-4"></i><span
                                        style="margin-left:8px; margin-top:1px;"> Spotify</span></span></button>
                        </div>
                        <div class="col-6 col-lg-4 col-xl-3 d-grid">
                            <button type="button" class="btn btn-outline-primary btn-md d-block mb-2 btn-category"
                                id="btn-Tiktok"onclick="filterCategory('Tiktok');"><span
                                    class="d-flex align-items-center"><i class="fa fa-music fs-4"></i><span
                                        style="margin-left:8px; margin-top:1px;"> Tiktok</span></span></button>
                        </div>
                        <div class="col-6 col-lg-4 col-xl-3 d-grid">
                            <button type="button" class="btn btn-outline-primary btn-md d-block mb-2 btn-category"
                                id="btn-Twitch"onclick="filterCategory('Twitch');"><span
                                    class="d-flex align-items-center"><i class="fab fa-linkedin fs-4"></i><span
                                        style="margin-left:8px; margin-top:1px;"> Linkedin</span></span></button>
                        </div>
                        <div class="col-6 col-lg-4 col-xl-3 d-grid">
                            <button type="button" class="btn btn-outline-primary btn-md d-block mb-2 btn-category"
                                id="btn-Google"onclick="filterCategory('Google');"><span
                                    class="d-flex align-items-center"><i class="fab fa-google fs-4"></i><span
                                        style="margin-left:8px; margin-top:1px;"> Google</span></span></button>
                        </div>
                        <div class="col-6 col-lg-4 col-xl-3 d-grid">
                            <button type="button" class="btn btn-outline-primary btn-md d-block mb-2 btn-category"
                                id="btn-Telegram"onclick="filterCategory('Telegram');"><span
                                    class="d-flex align-items-center"><i class="fab fa-telegram fs-4"></i><span
                                        style="margin-left:8px; margin-top:1px;"> Telegram</span></span></button>
                        </div>
                        <div class="col-6 col-lg-4 col-xl-3 d-grid">
                            <button type="button" class="btn btn-outline-primary btn-md d-block mb-2 btn-category"
                                id="btn-Website"onclick="filterCategory('Website');"><span
                                    class="d-flex align-items-center"><i class="fa fa-globe fs-4"></i><span
                                        style="margin-left:8px; margin-top:1px;"> Web Traffic</span></span></button>
                        </div>
                        <div class="col-6 col-lg-4 col-xl-3 d-grid">
                            <button type="button" class="btn btn-outline-primary btn-md d-block mb-2 btn-category"
                                id="btn-Discord"onclick="filterCategory('Discord');"><span
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
        <div class="col-md-7">
            <div class="card">
                {{-- <div class="card-header fw-bold p-3 text-xss"><i class="mdi mdi-cart-arrow-up me-1"></i>Pesanan Baru</h5> --}}
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title m-0"><i class="mdi mdi-cart-plus me-1"></i> Buat Pesanan</h4>
                    <a href="javascript:;" onclick="toggleCard('#catGroup')"
                        class="btn btn-sm btn-primary bg-gradient">
                        <i class="fas fa-fw fa-tags me-1"></i> Kategori
                    </a>
                </div>
                <div class="card-body" id="ajax-result">
                    @csrf
                    <ul class="nav nav-pills mb-2" role="tablist" wire:ignore style="margin-bottom:13px;">
                        <li class="nav-item waves-effect waves-light"wire:click="activated('Umum')">
                            <a class="nav-link active" data-bs-toggle="tab" href="#general" id="btn-general"
                                role="tab" style="padding:0.785rem 1rem !important;">
                                <i class="fas fa-adjust me-1 align-middle"></i> <span
                                    class="d-md-inline-block">Umum</span>
                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light" wire:click="activated('Favorit')">
                            <a class="nav-link" data-bs-toggle="tab" href="#favorite" id="btn-favorite"
                                role="tab" style="padding:0.785rem 1rem !important;">
                                <i class="far fa-star me-1 align-middle"></i> <span
                                    class="d-md-inline-block">Favorit</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane @if ($tab == 'Umum') active @endif" id="general"
                            role="tabpanel">
                            <form wire:submit.prevent="order">
                                <div class="mb-3" wire:ignore>
                                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                    <select class="select2 form-control" style="width:100%" name="category"
                                        id="category">
                                        <option value="0">Pilih...</option>
                                        @foreach ($kategori as $row)
                                            @php
                                                $id = App\Models\Smm::where('category', $row->category)->first();
                                            @endphp
                                            <option value="{{ $id->id }}"
                                                data-icon="<i class='fas fa-asterisk'></i>">{!! $row->category !!}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3" wire:ignore>
                                    <label class="form-label">Layanan <span class="text-danger">*</span></label>
                                    <select class="select2 form-control" style="width:100%" id="layanan">
                                        <option value="0">Pilih Kategori Dahulu</option>
                                    </select>
                                </div>
                                {{-- <div class="row">
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
                                        <input type="text" class="form-control" wire:model="min" value="0"
                                            id="min-amount" readonly>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Max</label>
                                        <input type="text" class="form-control" wire:model="max" value="0"
                                            id="max-amount" readonly>
                                    </div>
                                </div> --}}
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                    {{-- <textarea class="form-control" id="description" wire:model="deskripsi" style="height: 100px" readonly>Deskripsi layanan.</textarea> --}}
                                    @if ($layanan)
                                        @php
                                            $src = App\Models\Smm::where('service', $layanan)->first();
                                        @endphp
                                        <div class="border border-primary rounded p-3 mb-3" id="infoDesc">
                                            <p class="fw-medium mb-0">{{ $src->name }}</p>
                                            <p class="mb-3 fw-bold">Harga: Rp 3.071.600/K</p>
                                            <p class="border-top small fw-bold mb-1 pt-1">Deskripsi:</p>Discord 1K
                                            Members
                                            (Organic Crypto-NFT Members)<p class="border-top small fw-bold mb-1 pt-1">
                                                Waktu
                                                Rata-Rata:</p>
                                            <p class="mb-1">Belum ada data.</p>
                                            <p class="border-top small fw-bold mb-1 pt-1">Rating:</p><i
                                                class="fa fa-fw fa-star text-secondary"></i><i
                                                class="fa fa-fw fa-star text-secondary"></i><i
                                                class="fa fa-fw fa-star text-secondary"></i><i
                                                class="fa fa-fw fa-star text-secondary"></i><i
                                                class="fa fa-fw fa-star text-secondary"></i>
                                            <p class="small fw-medium mb-0">(0 rating dari 0 penilaian.)</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label>Average Time <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" wire:model.lazy="average_time"
                                        disabled placeholder="Average Time">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Target <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" wire:model.lazy="target"
                                        placeholder="Masukkan target" name="target" id="target">
                                </div>
                                @if ($type == 'custom_comments')
                                    <div class="mb-3" id="input_custom_comments"wire:ignore>
                                        <label class="form-label">Komentar <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="custom_comments" id="custom_comments" wire:model.lazy="custom_comments"
                                            onchange="changes()" placeholder="*Pisahkan komentar dengan Enter."></textarea><small class="text-danger"></small>
                                    </div>
                                @endif
                                @if ($type == 'custom_link')
                                    <div class="mb-3 d-none" id="input_custom_link">
                                        <label class="form-label">Link Post <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model.lazy="link_post"
                                            name="custom_link" id="custom_link">
                                    </div>
                                @endif
                                <div class="row">
                                    @if ($type == 'custom_comments')
                                        <div class="form-group col-md">
                                            <label>Jumlah Pesan <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control"
                                                wire:model.lazy="jumlah_pesanan" disabled placeholder="Jumlah Pesanan"
                                                name="quantity" id="quantity">
                                        </div>
                                    @else
                                        <div class="form-group col-md">
                                            <label>Jumlah Pesan <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control"
                                                wire:model.lazy="jumlah_pesanan" placeholder="Masukkan jumlah pesanan"
                                                name="quantity" id="quantity">
                                        </div>
                                    @endif
                                    <div class="form-group col-md">
                                        <label>Total Harga <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input wire:model="total_harga"class="form-control" value="0"
                                                id="total-price"></input>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-0 mt-3 float-end">
                                    <button type="reset" class="btn btn-danger waves-effect waves-light"
                                        wire:click="refresh"><i class="mdi mdi-refresh me-1"></i>Ulangi</button>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light"><i
                                            class="mdi mdi-cart-arrow-up me-1"></i>Pesan</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane @if ($tab == 'Favorit') active @endif" id="favorite"
                            role="tabpanel">
                            <form wire:submit.prevent="orderFavorit">
                                <div class="mb-3" wire:ignore>
                                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                    <select class="select2 form-control" style="width:100%" name="category_fav"
                                        id="category_fav">
                                        <option value="0">Pilih...</option>
                                        @foreach ($favoritCategory as $row)
                                            @php
                                                $service = App\Models\Smm::where('category', $row->category)->first();
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
                                <div class="form-group mb-3">
                                    <label>Target <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" wire:model.lazy="target_fav"
                                        placeholder="Masukkan jumlah pesanan" name="target" id="target">
                                </div>
                                @if ($type == 'custom_comments')
                                    <div class="mb-3" id="input_custom_comments"wire:ignore>
                                        <label class="form-label">Komentar <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="custom_comments_fav" id="custom_comments_fav"
                                            wire:model.lazy="custom_comments_fav" onchange="changes()" placeholder="*Pisahkan komentar dengan Enter."></textarea><small class="text-danger"></small>
                                    </div>
                                @endif
                                @if ($type == 'custom_link')
                                    <div class="mb-3 d-none" id="input_custom_link">
                                        <label class="form-label">Link Post <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model.lazy="link_post_fav"
                                            name="custom_link" id="custom_link">
                                    </div>
                                @endif
                                <div class="row">
                                    @if ($type == 'custom_comments')
                                        <div class="form-group col-md">
                                            <label>Jumlah Pesan <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control"
                                                wire:model.lazy="jumlah_pesanan_fav" disabled
                                                placeholder="Jumlah Pesanan" name="quantity" id="quantity">
                                        </div>
                                    @else
                                        <div class="form-group col-md">
                                            <label>Jumlah Pesan <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control"
                                                wire:model.lazy="jumlah_pesanan_fav"
                                                placeholder="Masukkan jumlah pesanan" name="quantity" id="quantity">
                                        </div>
                                    @endif
                                    <div class="form-group col-md">
                                        <label>Total Harga <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input wire:model="total_harga_fav"class="form-control" value="0"
                                                id="total-price"></input>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-0 mt-3 float-end">
                                    <button type="reset" class="btn btn-danger waves-effect waves-light"
                                        wire:click="refresh"><i class="mdi mdi-refresh me-1"></i>Ulangi</button>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light"><i
                                            class="mdi mdi-cart-arrow-up me-1"></i>Pesan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg">
            <div class="card">
                <div class="card-header fw-bold p-3 text-xss"><i
                        class="mdi mdi-information-outline me-1"></i>Informasi
                    <div class="float-end" style="cursor: pointer;">
                        <i class="mdi mdi-arrow-down"></i>
                    </div>
                    </h5>
                    <div class="card-body" id="card-toggle">
                        <p>
                            <b>Langkah-langkah membuat pesanan baru:</b>
                        <ul>
                            <li>Pilih salah satu Kategori.</li>
                            <li>Pilih salah satu Layanan yang ingin dipesan.</li>
                            <li>Masukkan Target pesanan sesuai ketentuan yang diberikan layanan tersebut.</li>
                            <li>Masukkan Jumlah Pesanan yang diinginkan.</li>
                            <li>Klik Submit untuk membuat pesanan baru</li>
                        </ul>
                        <b>Ketentuan membuat pesanan baru:</b>
                        <ul>
                            <li>Silahkan membuat pesanan sesuai langkah-langkah diatas.</li>
                            <li>Jika ingin membuat pesanan dengan
                                Target yang sama dengan pesanan yang sudah pernah dipesan sebelumnya, mohon menunggu
                                sampai
                                pesanan sebelumnya selesai diproses.
                                Jika terjadi kesalahan / mendapatkan pesan gagal yang kurang jelas, silahkan hubungi
                                Admin
                                untuk
                                informasi lebih lanjut.</li>
                            <li>Jangan memasukkan orderan yang sama jika orderan sebelumnya belum selesai. </li>
                            <li>Jangan memasukkan orderan yang sama di panel lain jika orderan di
                                <b>{{ env('TEXT_SMALL') }}</b>
                                belum
                                selesai.
                            </li>
                            <li>Jangan mengganti username atau menghapus link target saat sudah order. </li>
                            <li>Orderan yang sudah masuk tidak dapat di cancel / refund manual, seluruh proses orderan
                                dikerjakan secara otomatis oleh server. </li>
                            <li>Jika Anda memasukkan orderan di <b>{{ env('TEXT_SMALL') }}</b>berarti Anda sudah
                                mengerti
                                aturan
                                MedanPedia dan
                                jangan lupa baca menu F.A.Q serta Terms </li>
                            <ul>
                                </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#category').change(function() {
            var value = $(this).val();
            @this.set('kategoris', value)
            $.ajax({
                url: "{{ route('get.layanan') }}",
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
        window.addEventListener('swal:modal', event => {
            Swal.fire({
                icon: event.detail[0].type,
                title: event.detail[0].title,
                text: event.detail[0].text,
            });
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
                    $('#layanan').html('<option value="0">Pilih Kategori...</option>');
                    $('#quantity').attr('readonly', false);
                    $('#input_custom_link').addClass('d-none');
                    $('#custom_link').removeAttr('name');
                    $('#custom_link').val('');
                    $('#description').html('-');
                    $('#average_time').val('-');
                    $('#is_refill').html('<i class="fas fa-question-circle"></i> Refill Button');
                    $('#is_refill').removeAttr('class').addClass('fw-bolder text-secondary small');
                    $('#min-amount').val(0);
                    $('#max-amount').val(0);
                    $('#price').val(0);
                    $('#target').val('');
                    $('#total-price').val(0);
                },
                error: function() {
                    $('#ajax-result').html(
                        '<font color="red">Terjadi kesalahan! Silahkan refresh halaman.</font>');
                }
            });
        }

        function changes() {
            var service = $('#service').val();
            var quantity = $('#custom_comments').val().split("\n").length;
            @this.set('jumlah_pesanan', quantity);
            @this.call('setPriceKoment', quantity);
        }
    </script>
