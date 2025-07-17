<div>
    <style>
        .text-right {
            text-align: right;
        }
    </style>
    <div class="card">
        <div class="p-3 card-header fw-bold text-xss"><i class="ti ti-shopping-cart me-2"></i>Rekomendasi layanan</div>
        <div class="card-body">
            <div class="mb-3 row">
                <div class="col-md-8">
                    <div class="mb-2">
                        <div class="form-group">
                            <label class="form-label">ID Layanan <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="service-id">
                                <a href="javascript:;" class="btn btn-primary" id="btnSearch"
                                    style="padding-top: 0.8rem;">Cari</a>
                            </div>
                        </div>

                        <div id="form-services"></div>

                        <div id="form-kategori">
                            <label class="form-label">Kategori</label>
                            <select class="select2 form-control" id="category">
                                <option value="">Pilih kategori..</option>
                                @forelse ($kategori as $row)
                                    @php
                                        $id = optional($row->smm->first())->id; // Menggunakan eager loading
                                    @endphp

                                    @if ($id)
                                        <option value="{{ $id }}"
                                            data-icon="<i class='{!! $row->icon ?? null !!}'></i>">
                                            {!! $row->kategori ?? null !!}
                                        </option>
                                    @else
                                        <option data-icon="" value="">Tidak ada kategori</option>
                                    @endif
                                @empty
                                    <option data-icon="" value="">Tidak ada kategori</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div id="form-layanan" class="mb-2">
                        <label class="form-label">Layanan </label>
                        <select class="select2 form-control" style="width:100%" name="layanan" id="layanan">
                            <option value="">Pilih Kategori Dahulu</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Tambah ke dalam kategori</label>
                        <select class="select2 form-control" style="width:100%" name="kategori_rekomendasi"
                            id="kategori_rekomendasi">
                            <option value="">Pilih Kategori Dahulu</option>
                            @forelse ($kategori_layanan_rekomendasi as $row)
                                <option value="{{ $row->id }}" data-icon="<i class='{!! $row->icon ?? null !!}'></i>">
                                    {{ $row->kategori }}
                                </option>
                            @empty
                                <option data-icon="" value="">Tidak ada kategori</option>
                            @endforelse
                        </select>
                    </div>
                </div>

            </div>
            <div class="mb-2 row">
                <div class="col-md">
                    <div class="text-left">
                        <button class="btn btn-primary" id="tambah"><i class="fas fa-plus me-2"></i>Tambah
                            rekomendasi</button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th>Nama Layanan</th>
                            <th>Provider</th>
                            <th>Kategori Rekomendasi</th>
                            <th>Aksi</th>
                        </tr>

                    </thead>
                    <tbody>

                        @foreach ($layanan_rekomendasi as $row)
                            @if (!$row)
                                <tr>
                                    <td colspan="3" class="text-center">Data tidak ditemukan</td>
                                </tr>
                            @else
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="kotak">
                                            <div class="label">Service ID</div>
                                            <div class="value text-success">{{ $row->smm()->first()->service }}</div>
                                            <div class="label">Kategori</div>
                                            <div class="value text-success">{{ $row->smm()->first()->category }}</div>
                                            <div class="label">Layanan</div>
                                            <div class="value text-primary">{{ $row->smm()->first()->name }}</div>
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $row->provider }}</td>
                                    <td class="text-center">{{ $row->kategori()->first()->kategori }}</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm"
                                            onclick="removeData('{{ $row->id }}')">Hapus</button>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="triggerDelete"></div>
    <script>
        function removeData(id) {
            Swal.fire({
                title: 'Hapus layanan ini?',
                text: "Layanan yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#triggerDelete').data('id', id);
                    $('#triggerDelete').click();
                }
            });
        }
    </script>
</div>
@script
    <script>
        $('#triggerDelete').on('click', function() {
            let id = $(this).data('id');
            $wire.deleteRekomendasi(id);
        });
        $('#tambah').click(function() {

            const idLayanan = $('#layanan').val() || false;
            const idKategori = $('#category').val() || false;
            const idKategoriRekomendasi = $('#kategori_rekomendasi').val() || false;
            console.log(idLayanan, idKategori, idKategoriRekomendasi);


            if (!idLayanan || !idKategori || !idKategoriRekomendasi) {
                Swal.fire("Error", "You need to fill all fields!", "error");
            } else {
                $wire.tambah(idLayanan,
                    idKategoriRekomendasi);
            }

        });
        $('#category').change(function() {
            $.ajax({
                url: "{{ route('get.layanan') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: $(this).val(),
                    service_path: null,
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

        $('#category').select2({
            width: "100%",
            allowHtml: true
        });

        $('#layanan').change(function() {
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
                        $('#form-layanan,#form-kategori').addClass('d-none');

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
    </script>
@endscript
