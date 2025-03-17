<div>
    <div id="title-page" data-value="Semua Layanan" data-value2="Layanan"></div>
    <link href="//rawgit.com/gjunge/rateit.js/master/scripts/rateit.css" rel="stylesheet" type="text/css">
    <script src="//rawgit.com/gjunge/rateit.js/master/scripts/jquery.rateit.js" type="text/javascript"></script>
    <div class="row">
        <style>
            .rateyo-star {
                background-color: #ff0000;
            }
        </style>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="btn-group flex-wrap">
                        @php
                            $type = App\Models\Smm::distinct()->where('status', 'aktif')->get('type');
                        @endphp
                        <button wire:click="changeCustom('all')"
                            class="btn btn-outline-primary mt-2 me-1 @if ($custom == false && $refill == false) active @endif mt-2">Semua</button>
                        <button wire:click="$set('refill', true)"
                            class="btn btn-outline-primary mt-2 me-1 @if ($refill == true) active @endif mt-2">Refill</button>
                        @foreach ($type as $type)
                            <button wire:click="changeCustom('{{ $type->type }}')"
                                class="btn btn-outline-primary mt-2 me-1 @if ($custom == $type->type) active @endif mt-2">{{ $type->type }}</button>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header fw-bold p-3 text-xss"><i class="mdi mdi-history me-1"></i>All Layanan</div>
                <div class="card-body">
                    <form method="get" class="row">
                        <div class="col-md-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Tampilkan</span>
                                </div>
                                <select class="form-control" wire:model.change="perPage" name="row" id="table-row">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                <div class="input-group-append">
                                    <span class="input-group-text">baris.</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" wire:ignore>
                            <select class="select2 form-control" style="width:100%" name="category" id="category">
                                <option value="">Semua Kategori</option>
                                @forelse ($kategori as $row)
                                    <option value="{{ $row->kategori }}"
                                        data-icon="<i class='{!! $row->icon !!}'></i>">
                                        {!! $row->kategori !!}</option>
                                @empty
                                    <option data-icon="">Tidak ada data</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group mb-3">
                                <input type="text" wire:model.live.debounce.300ms="search" class="form-control"
                                    name="search" id="table-search" value="" placeholder="Cari...">
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                @if ($category)
                                    <tr>
                                        <th colspan="8" class="text-center">{{ $category }}</th>
                                    </tr>
                                @endif
                                <tr class="text-uppercase">
                                    <th>ID</th>
                                    <th>Favorit</th>
                                    <th>Category</th>
                                    <th>Nama Layanan</th>
                                    <th>Harga/ 1000 </th>
                                    <th>Min Pesan</th>
                                    <th>Max Pesan</th>
                                    <th class="text-center">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($layanan as $row)
                                    @php
                                        $favorit = App\Models\Favorit::where('user_id', Auth::user()->id)
                                            ->where([
                                                ['service_id', $row->service],
                                                ['category', $row->category],
                                                ['layanan', $row->name],
                                            ])
                                            ->first();
                                    @endphp
                                    <tr>
                                        <td>{{ $row->service }}</td>
                                        @if ($favorit)
                                            <td class="text-center"><a href="javascript:;"
                                                    onclick="unfav('{{ $row->service }}');"
                                                    id="fs-{{ $row->service }}"><i
                                                        class="fas fa-star text-primary ms-1 font-size-20"></i></a>
                                            </td>
                                        @else
                                            <td class="text-center"><a href="javascript:;"
                                                    onclick="fav('{{ $row->service }}');" id="fs-{{ $row->service }}"><i
                                                        class="fa-regular fa-star text-primary ms-1 font-size-20"></i></a>
                                            </td>
                                        @endif
                                        <td>{!! $row->category !!}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>Rp {{ number_format($row->price, 0, ',', '.') }}</td>
                                        <td>{{ number_format($row->min, 0, ',', '.') }}</td>
                                        <td>{{ number_format($row->max, 0, ',', '.') }}</td>
                                        <td>
                                            @php
                                                $text = $row->service . '||' . $row->provider;
                                                $encrypt = App\Helpers\Encryption::encrypt($text);
                                            @endphp
                                            <button
                                                onclick="window.location.href='{{ url('order/single') }}?id={!! $encrypt !!}'"
                                                class="btn btn-sm btn-success bg-gradient w-100 mb-1"><i
                                                    class="fas fa-shopping-cart fa-fw me-1"></i>Pesan</button>
                                            <button type="button" class="btn btn-warning bg-gradient btn-sm w-100 mb-1"
                                                data-bs-toggle="modal" data-bs-target="#rating"
                                                onclick="rating('{{ $row->service }}')"><i
                                                    class="fa-fw fas fa-star me-1"></i>
                                                Rating</button>
                                            <button type="button" class="btn btn-primary bg-gradient btn-sm w-100"
                                                data-bs-toggle="modal" data-bs-target="#details"
                                                onclick="detail('{{ $row->service }}')"><i
                                                    class="fa-fw fas fa-list me-1"></i>Detail</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {!! $layanan->links() !!}
                    </div>
                </div>
            </div>
            <div class="modal fade" id="rating" tabindex="-1" aria-labelledby="modalsLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="title-rating"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="content-rating">
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="details" tabindex="-1" aria-labelledby="modalsLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="title-detail"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="content-detail">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@script
    <script>
        $('#category').change(function() {
            var category = $(this).val();
            $wire.set('category', category);
        });
    </script>
@endscript
<script>
    function rating(id) {
        $.ajax({
            "type": "POST",
            "url": "{{ url('rating/service') }}",
            "data": "id=" + id + "&_token={{ csrf_token() }}",
            "dataType": "html",
            "success": function(data) {
                $('#content-rating').html(data);
                $('#title-rating').html('Berapa nilai untuk layanan ini?');
            },
            error: function(data) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
                $('#rating').modal('hide');
            },
        });
    }

    function fav(id) {
        $.ajax({
            type: "POST",
            url: "{{ url('favorit/service') }}",
            data: "id=" + id + "&_token={{ csrf_token() }}",
            dataType: "json",
            success: function(data) {
                if (data.status == true) {
                    $('#fs-' + id).html('<i class="fas fa-star text-primary ms-1 font-size-20"></i>');
                    $('#fs-' + id).attr('onclick', 'unfav(\'' + id + '\');');
                    Swal.fire({
                        title: 'Berhasil',
                        icon: 'success',
                        html: data.message,
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'btn btn-primary',
                        },
                        buttonsStyling: false,
                    });
                } else {
                    Swal.fire({
                        title: 'Ups!',
                        icon: 'error',
                        html: data.message,
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'btn btn-primary',
                        },
                        buttonsStyling: false,
                    });
                }
            },
            error: function() {
                Swal.fire({
                    title: 'Ups!',
                    icon: 'error',
                    html: 'Terjadi kesalahan, silahkan coba lagi.',
                    confirmButtonText: 'OK',
                    customClass: {
                        confirmButton: 'btn btn-primary',
                    },
                    buttonsStyling: false,
                });
            },
            beforeSend: function() {}
        });
    }

    function unfav(id) {
        $.ajax({
            type: "POST",
            url: "{{ url('unfav/service') }}",
            data: "id=" + id + "&_token={{ csrf_token() }}",
            dataType: "json",
            success: function(data) {
                if (data.status == true) {
                    $('#fs-' + id).html(
                        '<i class="fa-regular fa-star text-primary ms-1 font-size-20"></i>');
                    $('#fs-' + id).attr('onclick', 'fav(\'' + id + '\');');
                    Swal.fire({
                        title: 'Berhasil!',
                        icon: 'success',
                        html: data.message,
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'btn btn-primary',
                        },
                        buttonsStyling: false,
                    });
                } else {
                    Swal.fire({
                        title: 'Ups!',
                        icon: 'error',
                        html: data.message,
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'btn btn-primary',
                        },
                        buttonsStyling: false,
                    });
                }
            },
            error: function() {
                Swal.fire({
                    title: 'Ups!',
                    icon: 'error',
                    html: 'Terjadi kesalahan, silahkan coba lagi.',
                    confirmButtonText: 'OK',
                    customClass: {
                        confirmButton: 'btn btn-primary',
                    },
                    buttonsStyling: false,
                });
            },
            beforeSend: function() {}
        });
    }

    function detail(id) {
        $.ajax({
            "type": "POST",
            "url": "{{ url('detail/service') }}",
            "data": "id=" + id + "&_token={{ csrf_token() }}",
            "dataType": "html",
            "success": function(data) {
                $('#content-detail').html(data);
                $('#title-detail').html('Detail Layanan #' + id);
            },
            error: function(data) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
                $('#details').modal('hide');
            },
        });
    }

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
    });
</script>
