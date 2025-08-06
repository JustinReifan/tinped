<div>
    <div class="card">
        <div class="card-body">
            <div class="btn-group flex-wrap">
                <button wire:click="changeStatus('all')"
                    class="btn btn-outline-primary me-2 @if ($status == false) active @endif mt-2">Semua</button>
                <button wire:click="changeStatus('pending')"
                    class="btn btn-outline-primary me-2 @if ($status == 'pending') active @endif mt-2 ">Pending</button>
                <button wire:click="changeStatus('processing')"
                    class="btn btn-outline-primary me-2 @if ($status == 'processing') active @endif mt-2 ">Processing</button>

                <button class="btn btn-outline-primary me-2 @if ($status == 'done') active @endif mt-2 "
                    wire:click="changeStatus('done')">Done</button>
                <button class="btn btn-outline-primary me-2 @if ($status == 'error') active @endif mt-2 "
                    wire:click="changeStatus('error')">Error</button>
                <button class="btn btn-outline-primary me-2 @if ($status == 'partial') active @endif mt-2 "
                    wire:click="changeStatus('partial')">Partial</button>
                <button class="btn btn-outline-primary me-2 @if ($status == 'refund') active @endif mt-2 "
                    wire:click="changeStatus('refund')">Refund</button>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header fw-bold p-3 text-xss"><i class="fas fa-repeat me-2"></i>Riwayat Pesanan</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Tampilkan</span>
                        </div>
                        <select wire:model.change="perPage" class="form-control" name="row" id="table-row">
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
                <div class="col-md-6">
                </div>
                <div class="col-md-3">
                    <div class="input-group mb-3">
                        <input type="text" wire:model.live.debounce.300ms="search" class="form-control"
                            name="search" id="table-search" value="" placeholder="Cari...">
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="text-uppercase">
                            <th class="text-center">ID</th>
                            <th>Provider</th>
                            <th>Layanan</th>
                            <th>Target</th>
                            <th>Refill</th>
                            <th>Status</th>
                            <th>Status Pembayaran</th>
                            <th>Tgl. Pesanan</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($history->count() > 0)
                            @foreach ($history as $row)
                                @php
                                    if ($row->status == 'pending') {
                                        $status = 'warning';
                                        $text = 'Pending';
                                    } elseif ($row->status == 'process') {
                                        $status = 'info';
                                        $text = 'Proses';
                                    } elseif ($row->status == 'done') {
                                        $status = 'success';
                                        $text = 'Selesai';
                                    } elseif ($row->status == 'error') {
                                        $status = 'danger';
                                        $text = 'Error';
                                    } elseif ($row->status == 'partial') {
                                        $status = 'primary';
                                        $text = 'Partial';
                                    } else {
                                        $status = 'secondary';
                                        $text = 'Refund';
                                    }
                                    if ($row->status_payment == 'pending') {
                                        $status_payment = 'warning';
                                        $text = 'Pending';
                                    } elseif ($row->status_payment == 'canceled') {
                                        $status_payment = 'danger';
                                        $text = 'Canceled';
                                    } elseif ($row->status_payment == 'done') {
                                        $status_payment = 'success';
                                        $text = 'Selesai';
                                    } else {
                                        $status_payment = 'danger';
                                        $text = 'Error';
                                    }
                                    if ($row->refill == '0') {
                                        $refill = '<span class="badge bg-danger" style="font-size:15px;"><i
                                                class="ti ti-circle-x"></i></span>';
                                    } elseif ($row->refill == '1') {
                                        $refill = '<span class="badge bg-success" style="font-size:15px;"><i
                                                class="ti ti-checkbox"></i></span>';
                                    } else {
                                        $refill = '<span class="badge bg-danger" style="font-size:15px;"><i
                                                class="ti ti-circle-x"></i></span>';
                                    }
                                    $strlen = strlen($row->target);
                                @endphp
                                <tr>
                                    <td>
                                        <div class="kotak">
                                            <div class="label">TRXID</div>
                                            <div class="value text-primary"><a
                                                    href="{{ url('invoice/' . $row->trxid) }}">{{ $row->trxid }}</a>
                                            </div>
                                            <div class="label">OrderID</div>
                                            <div class="value text-primary">{{ $row->order_id }}</div>
                                        </div>
                                    </td>
                                    <td>{{ $row->provider }}</td>
                                    <td>{{ $row->layanan }}</td>
                                    <td>
                                        <span class="form-control form-control-sm">{{ $row->target }}</span>
                                    </td>
                                    <td class="text-center">{!! $refill !!}</td>
                                    <td>
                                        <div class="btn-group-dropdown">
                                            <button type="button"
                                                class="btn btn-outline-{{ $status }} btn-sm dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ ucfirst($row->status) }}
                                            </button>
                                            <ul class="dropdown-menu" style="cursor:pointer">
                                                <li>
                                                    <a class="dropdown-item @if ($row->status == 'done') d-none @endif"
                                                        href="javascript:void(0)"
                                                        wire:click="ubahStatus('done', '{{ $row->id }}')">Sukses</a>
                                                </li>
                                                <li><a class="dropdown-item @if ($row->status == 'partial') d-none @endif"
                                                        href="javascript:void(0)"
                                                        wire:click="ubahStatus('partial', '{{ $row->id }}')">Partial</a>
                                                </li>
                                                <li><a class="dropdown-item @if ($row->status == 'processing') d-none @endif"
                                                        href="javascript:void(0)"
                                                        wire:click="ubahStatus('processing', '{{ $row->id }}')">Processing</a>
                                                </li>
                                                <li><a class="dropdown-item @if ($row->status == 'Refund') d-none @endif"
                                                        href="javascript:void(0)"
                                                        wire:click="ubahStatus('Refund', '{{ $row->id }}')">Refund</a>
                                                </li>
                                                <li><a class="dropdown-item @if ($row->status == 'error') d-none @endif"
                                                        href="javascript:void(0)"
                                                        wire:click="ubahStatus('error', '{{ $row->id }}')">Error</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group-dropdown">
                                            <button type="button"
                                                class="btn btn-outline-{{ $status_payment }} btn-sm dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ ucfirst($row->status_payment) }}
                                            </button>
                                            <ul class="dropdown-menu" style="cursor:pointer">
                                                <li>
                                                    <a class="dropdown-item @if ($row->status_payment == 'done') d-none @endif"
                                                        href="javascript:void(0)"
                                                        wire:click="ubahStatusPembayaran('done', '{{ $row->id }}')">Sukses</a>
                                                </li>
                                                <li><a class="dropdown-item @if ($row->status_payment == 'canceled') d-none @endif"
                                                        href="javascript:void(0)"
                                                        wire:click="ubahStatusPembayaran('canceled', '{{ $row->id }}')">Canceled</a>
                                                </li>
                                                <li><a class="dropdown-item @if ($row->status_payment == 'pending') d-none @endif"
                                                        href="javascript:void(0)"
                                                        wire:click="ubahStatusPembayaran('pending', '{{ $row->id }}')">pending</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </td>

                                    <td>{{ tanggal(date('Y-m-d', strtotime($row['created_at']))) .
                                        ' ' .
                                        date('H:i', strtotime($row['created_at'])) .
                                        '' }}
                                    </td>
                                    <td style="display:flex;"><button class="btn btn-outline-primary btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#modals"
                                            onclick="detail('{{ $row->trxid }}')">Detail</button>
                                        @if ($row->refill == '1')
                                            <button class="btn btn-outline-success btn-sm" style="margin-left:5px;"
                                                onclick="refill('{{ $row->trxid }}')" alt="Refill"
                                                title="Refill">♻️</button>
                                        @else
                                            <button class="btn btn-outline-secondary btn-sm" style="margin-left:5px;"
                                                alt="Refill" title="Refill" disabled>♻️</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center">Data Not Found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {!! $history->links() !!}
            </div>
        </div>
    </div>
</div>

<script>
    function refill(id) {
        Swal.fire({
            title: 'Konfirmasi',
            text: "Apakah Anda yakin ingin refill pesanan ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, refill!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('refill') }}",
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

    function detail(id) {
        $.ajax({
            url: "{{ route('history.detail.order') }}",
            type: "POST",
            data: {
                id: id,
                _token: "{{ csrf_token() }}"
            },
            success: function(data) {
                $('#content').html(data);
                $('#title').html('Detail Pesanan');
            },
            error: function(data) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
                $('#modals').modal('hide');
            }
        });
    }
</script>
