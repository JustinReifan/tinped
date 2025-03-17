@php

    use Carbon\Carbon;

@endphp

<div class="row">
    <div id="title-page" data-value="Deposit" data-value2="Riwayat"></div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="btn-group flex-wrap">
                    <button wire:click="changeStatus('all')"
                        class="btn btn-outline-primary  mt-2  {{ $status == false ? 'active' : '' }} me-1">Semua</button>
                    <button wire:click="changeStatus('pending')"
                        class="btn btn-outline-primary  mt-2  {{ $status == 'pending' ? 'active' : '' }} me-1">Pending</button>
                    <button class="btn btn-outline-primary  mt-2  {{ $status == 'done' ? 'active' : '' }} me-1"
                        wire:click="changeStatus('done')">Success</button>
                    <button class="btn btn-outline-primary  mt-2  me-1 {{ $status == 'canceled' ? 'active' : '' }}"
                        wire:click="changeStatus('canceled')">Cancel</button>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header fw-bold p-3 text-xss"><i class="mdi mdi-credit-card me-2"></i>Riwayat Deposit</div>
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
                                <th>Pembayaran</th>
                                <th>Metode</th>
                                <th>Jumlah Transfer</th>
                                <th>Saldo Diterima</th>
                                <th>Status</th>
                                <th>Tgl. Deposit</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($history->count() > 0)
                                @foreach ($history as $row)
                                    <tr>
                                        <td>
                                            <a class="badge bg-primary"
                                                href="{{ url('deposit/invoice/' . $row->trxid) }}">#{{ $row->trxid }}</a>
                                        </td>
                                        <td>
                                            <div class="kotak">
                                                <div class="label">Jenis</div>
                                                <div class="value text-danger">
                                                    {{ $row->code != null ? str_replace('TRANSFER', '', $row->code) : 'Not found' }}
                                                </div>
                                                <div class="label">Payment</div>
                                                <div class="value text-success">{{ $row->name_payment }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($row->process == 'auto')
                                                OTOMATIS
                                            @else
                                                MANUAL
                                            @endif
                                        </td>
                                        <td>Rp {{ number_format($row->amount, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($row->amount, 0, ',', '.') }}</td>
                                        <td class="text-nowrap">
                                            @if ($row->status == 'pending')
                                                <span
                                                    class="btn btn-outline-warning btn-sm btn-rounded font-size-13">Menunggu
                                                    Pembayaran</span>
                                            @elseif ($row->status == 'canceled')
                                                <span
                                                    class="btn btn-outline-danger btn-sm btn-rounded font-size-13">Cancel</span>
                                            @elseif($row->status == 'done')
                                                <span
                                                    class="btn btn-outline-success btn-sm btn-rounded font-size-13">Berhasil</span>
                                            @endif
                                        </td>
                                        <td>{{ tanggal(Carbon::parse($row->created_at)->format('Y-m-d')) }}
                                            {{ Carbon::parse($row->created_at)->format('H:i:s') }}</td>
                                        <td class="text-nowrap">
                                            @if ($row->status == 'pending')
                                                <button href="javascript:;"
                                                    wire:click.prevent='dibatalkan({{ $row->id }})'
                                                    class="btn btn-outline-danger btn-sm btn-rounded font-size-13"><i
                                                        class="mdi mdi-close-circle-outline me-1"></i>Batalkan</button>
                                            @else
                                                <button href="javascript:;"
                                                    class="btn btn-outline-danger btn-sm btn-rounded font-size-13"
                                                    disabled><i
                                                        class="mdi mdi-close-circle-outline me-1"></i>Batalkan</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9" class="text-center">Data Not Found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {!! $history->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@script
    <script>
        window.addEventListener('show-delete-confirmation', event => {
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Anda akan membatalkan deposit!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Batalkan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $wire.batalDeposit();
                }
            })
        })
        window.addEventListener('layananDeleted', event => {
            Swal.fire(
                'Terhapus!',
                'Deposit berhasil dibatalkan.',
                'success'
            )
        });
        window.addEventListener('failedDeleted', event => {
            Swal.fire(
                'Gagal!',
                'Data gagal dihapus.',
                'error'
            )
        });
    </script>
@endscript
