@php

@endphp

<div class="row">
    <div class="col-md-12">
        <div class="btn-group flex-wrap mb-3">
            <button wire:click="all" class="btn btn-primary active">Semua</button>
            <button wire:click="status('pending')" class="btn btn-primary ">Pending</button>
            <button wire:click="status('processing')" class="btn btn-primary ">Processing</button>
            <button class="btn btn-primary " wire:click="status('success')">Success</button>
            <button class="btn btn-primary " wire:click="status('error')">Error</button>
            <button class="btn btn-primary " wire:click="status('partial')">Partial</button>
            <button class="btn btn-primary " wire:click="status('refund')">Refund</button>
        </div>
        <div class="card">
            <div class="card-header fw-bold p-3 text-xss"><i class="mdi mdi-history me-1"></i>Riwayat Pesanan</h5>
                <div class="card-body">
                    <form method="get" class="row">
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
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="text-uppercase">
                                    <th>ID</th>
                                    <th>Order ID</th>
                                    <th>Layanan</th>
                                    <th>Target</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                    <th>Refill</th>
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
                                            } elseif ($row->status == 'processing') {
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
                                            } elseif ($row->status == 'refund') {
                                                $status = 'danger';
                                                $text = 'Refund';
                                            }
                                            if ($row->refill == '0') {
                                                $refill = '<span class="badge bg-danger" style="font-size:15px;"><i
                                    class="mdi mdi-close"></i></span>';
                                            } elseif ($row->refill == '1') {
                                                $refill = '<span class="badge bg-success" style="font-size:15px;"><i
                                    class="mdi mdi-check"></i></span>';
                                            } else {
                                                $refill = '<span class="badge bg-danger" style="font-size:15px;"><i
                                                class="ti ti-circle-x"></i></span>';
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->trxid }}</td>
                                            <td>{{ $row->layanan }}</td>
                                            <td>{{ $row->target }}</td>
                                            <td>Rp {{ number_format($row->price, 0, ',', '.') }}</td>
                                            <td>{{ $row->quantity }}</td>
                                            <td><span
                                                    class="btn btn-soft-{{ $status }} btn-sm font-size-13">{{ $text }}</span>
                                            </td>
                                            <td class="text-center">{!! $refill !!}</td>
                                            <td>{{ tanggal(date('Y-m-d', strtotime($row['created_at']))) .
                                                ' ' .
                                                date('H:i', strtotime($row['created_at'])) .
                                                '' }}
                                            </td>
                                            <td class="text-nowrap"><button class="btn btn-info btn-sm"
                                                    data-bs-toggle="modal" data-bs-target="#modals"
                                                    onclick="detail('{{ $row->trxid }}')"><i
                                                        class="mdi mdi-adjust"></i></button>
                                                @if ($row->status != 'done')
                                                    <button class="btn btn-success btn-sm"
                                                        wire:click.prevent="konfirmasi({{ $row->id }})">Konfirmasi</button>
                                                @else
                                                    <button class="btn btn-danger btn-sm"
                                                        wire:click.prevent="refund({{ $row->id }})">Refund</button>
                                                @endif
                                                @if ($row->refill == '1')
                                                    <button class="btn btn-success btn-sm" style="margin-left:5px;"
                                                        onclick="refill('{{ $row->trxid }}')" alt="Refill"
                                                        title="Refill">♻️</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10" class="text-center">Data Not Found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {!! $history->links() !!}
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('show-confirmation', event => {
            Swal.fire({
                title: 'Konfirmasi',
                text: event.detail[0].text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, konfirmasi!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('confirm', event.detail[0].id);
                }
            })
        });
        window.addEventListener('show-confirmations', event => {
            Swal.fire({
                title: 'Konfirmasi',
                text: event.detail[0].text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, konfirmasi!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('refunds', event.detail[0].id);
                }
            })
        });
        window.addEventListener('success', event => {
            Swal.fire(
                'Berhasil!',
                event.detail[0].message,
                'success'
            )
        });
        window.addEventListener('failed', event => {
            Swal.fire(
                'Gagal!',
                event.detail[0].message,
                'error'
            )
        });

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
                url: "{{ route('history.detail') }}",
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
