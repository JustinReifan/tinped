@php

    if ($history->status == 'done') {
        $tk = 'fas fa-check-circle text-success mr-1';
        $status = 'success';
    } elseif ($history->status == 'pending') {
        $tk = 'fas fa-circle-notch fa-spin text-warning mr-1';
        $status = 'warning';
    } elseif ($history->status == 'process') {
        $tk = 'fas fa-spinner fa-spin text-info mr-1';
        $status = 'info';
    } elseif ($history->status == 'error') {
        $tk = 'far fa-times-circle text-danger';
        $status = 'danger';
    } elseif ($history->status == 'partial') {
        $tk = 'fas fa-exclamation-circle text-primary mr-1';
        $status = 'primary';
    } elseif ($history->status == 'refund') {
        $tk = 'fas fa-undo text-danger mr-1';
        $status = 'danger';
    } else {
        $tk = 'fas fa-question-circle text-secondary mr-1';
    }

@endphp
<div class="table-responsive">
    <table class="table table-striped table-bordered table-box">
        <tbody>
            @if (Auth::user()->role == 'admin')
                <tr>
                    <th>Provider</th>
                    <td class="fw-bold">{{ $history->provider }}</td>
                </tr>
            @endif
            <tr>
                <th>TrxID</th>
                <td class="text-primary fw-bold">#{{ $history->trxid }}</td>

            </tr>
            <tr>
                <th>Layanan</th>
                <td>
                    {!! $history->layanan !!}
                </td>
            </tr>
            @php
                $explode = explode('||', $history->target);
            @endphp
            @if (isset($explode[1]))
                <tr>
                    <th>Target</th>
                    <td>
                        {{ $explode[0] }}
                    </td>
                </tr>
                <tr>
                    <th>Custom comments</th>
                    <td>
                        <textarea name="custom_comments" id="custom_comments" class="form-control" readonly>{{ $explode[1] }}</textarea>
                    </td>
                </tr>
            @else
                <tr>
                    <th>Target</th>
                    <td>
                        {{ $history->target }}
                    </td>
                </tr>
            @endif

            <tr>
                <th>Price</th>
                <td>Rp
                    {{ number_format($history->price, 0, ',', '.') }}
                </td>
            </tr>
            @if (Auth::user()->role == 'admin')
                <tr>
                    <th>Jumlah</th>
                    <td>
                        <div class="input-group" style="min-width: 150px">
                            <input class="form-control form-control-sm text-nowrap" value="{{ $history->quantity }}"
                                id="quantity">
                            <button type="button" onclick="changes('{{ $history->id }}','quantity')"
                                class="btn btn-sm copy btn-primary bg-gradient">
                                <i class="fas fa-save fa-fw"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Jumlah Awal</th>
                    <td>
                        <div class="input-group" style="min-width: 150px">
                            <input class="form-control form-control-sm text-nowrap" id="start_count"
                                value="{{ $history->start_count }}">
                            <button type="button" onclick="changes('{{ $history->id }}','start_count')"
                                class="btn btn-sm copy btn-primary bg-gradient">
                                <i class="fas fa-save fa-fw"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Jumlah Kurang</th>
                    <td>
                        <div class="input-group" style="min-width: 150px">
                            <input class="form-control form-control-sm text-nowrap" id="remains"
                                value="{{ $history->remains }}">
                            <button type="button" class="btn btn-sm copy btn-primary bg-gradient"
                                onclick="changes('{{ $history->id }}','remains')">
                                <i class="fas fa-save fa-fw"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @else
                <tr>
                    <th>Jumlah</th>
                    <td>{{ number_format($history->quantity, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Jumlah Awal</th>
                    <td>{{ number_format($history->start_count, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Jumlah Kurang</th>
                    <td>{{ number_format($history->remains, 0, ',', '.') }}</td>
                </tr>
            @endif
            <tr>
                <th>Status</th>
                <td><i class="<?= $tk ?>"></i>&nbsp;
                    <span class="text-<?= $status ?>"><?= Str::ucfirst($history->status) ?></span>
                </td>
            </tr>
            <tr>
                <th>Order Date</th>
                <td>
                    <?= tanggal(date('Y-m-d', strtotime($history['created_at']))) . ' ' . date('H:i', strtotime($history['created_at'])) . '' ?>
                </td>
            </tr>
            @if ($history->custom_comments)
                <tr>
                    <th>Custom Comments</th>
                    <td>
                        <textarea class="form-control">{{ $history->custom_comments }}</textarea>
                    </td>
                </tr>
            @endif
            @if ($history->custom_link)
                <tr>
                    <th>Custom Link</th>
                    <td>
                        <textarea class="form-control">{{ $history->custom_link }}</textarea>
                    </td>
                </tr>
            @endif
            <tr>
                <th>Updated Date</th>
                <td>
                    <?= tanggal(date('Y-m-d', strtotime($history['updated_at']))) . ' ' . date('H:i', strtotime($history['updated_at'])) . '' ?>
                </td>
            </tr>
            <?php
            $diff = $history->created_at->diffForHumans($history->updated_at);
            $remove = ['sebelumnya', 'setelahnya'];
            $replace = str_replace($remove, '', $diff);
            ?>
            <?php
            if ($history->status == 'done') {
            ?>
            <tr>
                <th>Waktu Proses</th>
                <td style="color: green;">
                    <?= $replace ?>
                </td>
            </tr>
            <?php
            }
            ?>
            @if ($history->type == 'custom_comments')
                <tr>
                    <th>Custom Comments</th>
                    <td>
                        <textarea class="form-control">{{ $history->custom_comments }}</textarea>
                    </td>
                </tr>
            @elseif ($history->type == 'custom_link')
                <tr>
                    <th>Custom Link</th>
                    <td>
                        <textarea class="form-control">{{ $history->custom_link }}</textarea>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
    @if ($history->cancel && in_array($history->status, ['process', 'pending']))
    <button class="btn btn-danger btn-sm rounded-1" 
            onclick="cancel('{{ $history->trxid }}')" 
            alt="Cancel" 
            title="Cancel">Request Cancel</button>
    @endif
</div>
<script>
    function changes(id, type) {
        $.ajax({
            url: "{{ route('update.pesanan') }}",
            type: "POST",
            data: {
                id: id,
                type: type,
                value: $('#' + type).val(),
                _token: "{{ csrf_token() }}",
            },
            success: function(data) {
                if (data.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: data.message,
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: data.message,
                    });
                }
            },
            error: function(err) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Terjadi kesalahan saat mengirim data',
                });
            }
        });
    }
    function cancel(id) {
            Swal.fire({
                title: 'Konfirmasi',
                text: "Apakah Anda yakin ingin cancel pesanan ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('cancel') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id
                        },
                        success: function(response) {
                            if (response.status == true) {
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: response.message,
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                })
                            } else {
                                Swal.fire({
                                    title: 'Gagal',
                                    text: response.message,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK'
                                })
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            Swal.fire({
                                title: 'Gagal',
                                text: 'Terjadi kesalahan, silahkan coba lagi.',
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            })
                        }
                    });
                }
            })
        }
</script>
