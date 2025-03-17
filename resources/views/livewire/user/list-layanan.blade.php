<div>
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
                <div class="card-header fw-bold p-3 text-xss"><i class="fas fa-tags me-2"></i> Daftar layanan</div>
                <div class="card-body">
                    <form method="get" class="row">
                        <div class="col-md-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Tampilkan</span>
                                </div>
                                <select class="form-control" name="row" id="table-row" wire:model.change="perPage">>
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
                                @if ($kate)
                                    <option value="{{ $kate }}">Kategori {{ $kate }}</option>
                                @else
                                    <option value="">Semua Kategori</option>
                                @endif
                                @forelse ($kategori as $row)
                                    @php
                                        $id = App\Models\Smm::where('category', $row->kategori)->first();
                                        $ct = $kategori->first()->id;
                                    @endphp
                                    <option value="{{ $row->kategori }}"
                                        data-icon="<i class='{!! $row->icon ?? null !!}'></i>">
                                        {!! $row->kategori !!}</option>
                                @empty
                                    <option value="">Tidak ada data</option>
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
                                    <tr>
                                        <td>{{ $row->service }}</td>
                                        <td><i class="{{ $row->kategori->icon }} me-2"></i>{!! $row->category !!}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>Rp {{ number_format($row->price, 0, ',', '.') }}</td>
                                        <td>{{ number_format($row->min, 0, ',', '.') }}</td>
                                        <td>{{ number_format($row->max, 0, ',', '.') }}</td>
                                        <td class="col-1 text-nowrap">
                                            <button type="button" class="btn btn-primary bg-gradient btn-sm w-100"
                                                data-bs-toggle="modal" data-bs-target="#details"
                                                onclick="detail('{{ $row->service }}')"><i
                                                    class="fas fa-search fs-6 me-2"></i>Lihat detail</button>
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
                <div class="modal-dialog modal-lg modal-dialog-scrollable modal-lg">
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
