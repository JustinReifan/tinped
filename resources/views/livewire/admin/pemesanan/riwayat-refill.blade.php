<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="btn-group flex-wrap">
                    <button wire:click="changeStatus('all')"
                        class="btn btn-outline-primary @if ($status == false) active @endif mt-2 me-1">Semua</button>
                    <button wire:click="changeStatus('pending')"
                        class="btn btn-outline-primary @if ($status == 'pending') active @endif mt-2 me-1">Pending</button>
                    <button wire:click="changeStatus('processing')"
                        class="btn btn-outline-primary @if ($status == 'processing') active @endif mt-2 me-1">Processing</button>
                    <button class="btn btn-outline-primary @if ($status == 'success') active @endif mt-2 me-1"
                        wire:click="changeStatus('success')">Success</button>
                    <button class="btn btn-outline-primary @if ($status == 'error') active @endif mt-2 me-1"
                        wire:click="changeStatus('error')">Error</button>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header fw-bold p-3 text-xss"><i class="fas fa-history me-1"></i>Riwayat Refill</div>
            <div class="card-body">
                <div method="get" class="row">
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
                                <th>Layanan</th>
                                <th>Target</th>
                                <th>Status</th>
                                <th>Tgl. Pesanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($refill as $row)
                                @php

                                @endphp
                                @php
                                    $row->statusData = [
                                        'class' => match ($row->status) {
                                            'pending' => 'warning',
                                            'process' => 'info',
                                            'done' => 'success',
                                            'failed' => 'danger',
                                            default => 'secondary',
                                        },
                                        'text' => ucfirst($row->status),
                                    ];

                                    // Refill Status
                                    $row->refillStatus =
                                        $row->refill == '1'
                                            ? '<span class="badge bg-success" style="font-size:15px;"><i class="ti ti-checkbox"></i></span>'
                                            : '<span class="badge bg-danger" style="font-size:15px;"><i class="ti ti-circle-x"></i></span>';

                                    // Target Processing
                                    $explode = explode('||', $row->target);
                                    $row->displayTarget = $explode[1] ?? $row->target;

                                    // Formatted Date
                                    $row->formattedDate =
                                        tanggal(date('Y-m-d', strtotime($row->created_at))) .
                                        ' ' .
                                        date('H:i', strtotime($row->created_at));
                                @endphp
                                <tr>
                                    <td class="text-center"><span class="badge bg-primary">#{{ $row->refill_id }}</span>
                                    </td>
                                    <td>
                                        <div class="kotak">
                                            <div class="label">Username</div>
                                            <div class="value text-danger">{{ $row->user->username }}</div>
                                            <div class="label">Provider</div>
                                            <div class="value text-primary">{{ $row->provider }}</div>
                                            <div class="label">Layanan</div>
                                            <div class="value text-info">{{ $row->layanan }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group" style="min-width: 150px">
                                            <span
                                                class="form-control form-control-sm text-nowrap">{{ $row->displayTarget }}</span>
                                            <button type="button" data-clipboard-text="{{ $row->displayTarget }}"
                                                class="btn btn-sm copy btn-primary bg-gradient">
                                                <i class="fas fa-copy fa-fw"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group-dropdown">
                                            <button type="button"
                                                class="btn btn-outline-{{ $row->statusData['class'] }} btn-sm dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ $row->statusData['text'] }}
                                            </button>
                                            <ul class="dropdown-menu" style="cursor:pointer">
                                                @foreach (['done', 'pending', 'process', 'failed'] as $statusOption)
                                                    @if ($row->status != $statusOption)
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0)"
                                                                wire:click="ubahStatus('{{ $statusOption }}', '{{ $row->id }}')">
                                                                {{ ucfirst($statusOption) }}
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </td>
                                    <td>{{ tanggal(date('Y-m-d', strtotime($row['created_at']))) .
                                        ' ' .
                                        date('H:i', strtotime($row['created_at'])) .
                                        '' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $refill->links() }}
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
            url: "{{ route('refill.detail') }}",
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
