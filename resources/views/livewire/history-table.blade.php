<div>
    <style>
        .form-check-input {
            cursor: pointer;
        }
    </style>
    <div id="title-page" data-value="Riwayat Pesanan" data-value2="History"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="btn-group flex-wrap ">
                        <button wire:click="changeStatus('all')"
                            class="btn btn-outline-primary mt-2 {{ $status == false ? 'active' : '' }} me-1">Semua</button>
                        <button wire:click="changeStatus('pending')"
                            class="btn btn-outline-primary mt-2 {{ $status == 'pending' ? 'active' : '' }} me-1">Pending</button>
                        <button wire:click="changeStatus('processing')"
                            class="btn btn-outline-primary mt-2 {{ $status == 'processing' ? 'active' : '' }} me-1">Processing</button>
                        <button class="btn btn-outline-primary mt-2 {{ $status == 'success' ? 'active' : '' }} me-1"
                            wire:click="changeStatus('success')">Success</button>
                        <button class="btn btn-outline-primary mt-2 me-1 {{ $status == 'error' ? 'active' : '' }}"
                            wire:click="changeStatus('error')">Error</button>
                        <button class="btn btn-outline-primary mt-2 me-1 {{ $status == 'partial' ? 'active' : '' }}"
                            wire:click="changeStatus('partial')">Partial</button>
                        <button class="btn btn-outline-primary mt-2 me-1 {{ $status == 'refund' ? 'active' : '' }}"
                            wire:click="changeStatus('refund')">Refund</button>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header fw-bold p-3 text-xss"><i class="fas fa-repeat me-1"></i>Riwayat Pesanan</div>
                <div class="card-body">
                    <a href="javascript:;" class="btn btn-primary mb-4" onclick="copy_id();"><i
                            class="fas fa-copy fs-6 me-2"></i>Salin <b><em>ID Pesanan</em></b></a>
                    <div class="row mb-2">
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
                                    <th class="text-center align-middle px-2">
                                        <input type="checkbox" id="checkAll" class="form-check-input cursor-pointer" />
                                    </th>
                                    <th class="text-center">ID</th>
                                    <th>Layanan</th>
                                    <th>Target</th>
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
                                            $status = 'danger';
                                            $text = 'Refund';
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
                                        $explode = explode('||', $row->target);
                                        if (isset($explode[1])) {
                                            $target = $explode[0];
                                        } else {
                                            $target = $row->target;
                                        }
                                    @endphp
                                    <tr>
                                        <td class="align-middle px-2">
                                            <input type="checkbox" name="tableItem[]"
                                                class="form-check-input tableCheckbox" value="{{ $row->trxid }}" />
                                        </td>
                                        <td class="text-center"><span
                                                class="badge bg-primary">#{{ $row->trxid }}</span></td>
                                        <td>{{ $row->layanan }}</td>
                                        <td>
                                            <div class="input-group" style="min-width: 150px">
                                                <span
                                                    class="form-control  form-control-sm text-nowrap">{{ $target }}</span>
                                                <button type="button" data-clipboard-text="{{ $target }}"
                                                    class="btn btn-sm copy btn-primary bg-gradient"><i
                                                        class="fas fa-copy fa-fw"></i></button>
                                            </div>
                                        </td>
                                        <td>Rp {{ number_format($row->price, 0, ',', '.') }}</td>
                                        <td class="text-center">{{ $row->quantity }}</td>
                                        <td class="text-center">{!! $refill !!}</td>
                                        <td><span
                                                class="btn btn-{{ $status }} btn-sm font-size-13">{{ $text }}</span>
                                        </td>

                                        <td>{{ tanggal(date('Y-m-d', strtotime($row['created_at']))) .
                                            ' ' .
                                            date('H:i', strtotime($row['created_at'])) .
                                            '' }}
                                        </td>
                                        <td style="display:flex;"><button class="btn btn-outline-primary btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#modals"
                                                onclick="detail('{{ $row->trxid }}')"><i
                                                    class="fas fa-align-justify"></i></button>
                                            @if ($row->refill == '1')
                                                <button class="btn btn-outline-success btn-sm" style="margin-left:5px;"
                                                    onclick="refill('{{ $row->trxid }}')" alt="Refill"
                                                    title="Refill">♻️</button>
                                            @else
                                                <button class="btn btn-outline-secondary btn-sm"
                                                    style="margin-left:5px;" alt="Refill" title="Refill"
                                                    disabled>♻️</button>
                                            @endif
                                            {{-- @if ($row->cancel == '1')
                                                <button class="btn btn-danger btn-sm" style="margin-left:5px;"
                                                    onclick="refill('{{ $row->trxid }}')" alt="Cancel"
                                                    title="Cancel">Cancel</button>
                                            @else
                                                <button class="btn btn-outline-danger btn-sm"
                                                    style="margin-left:5px;" alt="Cancel" title="Cancel"
                                                    disabled>Cancel</button>
                                            @endif --}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {!! $history->links() !!}
                    </div>
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
</div>
