<div>
    <style>
        .form-check-input {
            cursor: pointer;
        }
    </style>
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
            <a href="javascript:;" class="btn btn-primary mb-4" onclick="copy_id();"><i
                    class="fas fa-copy fs-6 me-2"></i>Salin <b><em>ID Pesanan</em></b></a>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="text-uppercase">
                            <th class="text-center align-middle px-2">
                                <input type="checkbox" id="checkAll" class="form-check-input cursor-pointer" />
                            </th>
                            <th class="text-center">ID</th>
                            <th>USERNAME</th>
                            <th>Layanan</th>
                            <th>TARGET</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Refill</th>
                            <th>Status</th>
                            <th>Tgl. Pesanan</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($history as $row)
                            @if ($row->providers->proses_manual == '1')
                                <tr>
                                    <td class="align-middle px-2">
                                        <input type="checkbox" name="tableItem[]" class="form-check-input tableCheckbox"
                                            value="{{ $row->trxid }}" />
                                    </td>
                                    <td class="text-center"><span class="badge bg-primary">#{{ $row->trxid }}</span>
                                    </td>
                                    <td class="text-nowrap text-primary">
                                        <span
                                            class="form-control form-control-sm text-nowrap">{{ $row->user->username }}</span>
                                    </td>
                                    <td>{{ $row->layanan }}</td>
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
                                    <td>Rp {{ number_format($row->price, 0, ',', '.') }}</td>
                                    <td class="text-center">{{ number_format($row->quantity, 0, ',', '.') }}</td>
                                    <td class="text-center">{!! $row->refillStatus !!}</td>
                                    <td>
                                        <div class="btn-group-dropdown">
                                            <button type="button"
                                                class="btn btn-outline-{{ $row->statusData['class'] }} btn-sm dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ $row->statusData['text'] }}
                                            </button>
                                            <ul class="dropdown-menu" style="cursor:pointer">
                                                @foreach (['done', 'pending', 'partial', 'process', 'Refund', 'error'] as $statusOption)
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
                                    <td>{{ $row->formattedDate }}</td>
                                    <td style="display:flex;">
                                        <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#modals" onclick="detail('{{ $row->trxid }}')">
                                            Detail
                                        </button>
                                        <button
                                            class="btn btn-outline-{{ $row->refill == '1' ? 'success' : 'secondary' }} btn-sm"
                                            style="margin-left:5px;"
                                            onclick="{{ $row->refill == '1' ? "refill('{$row->trxid}')" : '' }}"
                                            alt="Refill" title="Refill" {{ $row->refill == '0' ? 'disabled' : '' }}>
                                            ♻️
                                        </button>
                                    </td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">Data Not Found</td>
                            </tr>
                        @endforelse
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
