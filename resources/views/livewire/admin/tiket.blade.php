<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="btn-group flex-wrap">
                    <button wire:click="changeStatus('all')"
                        class="btn btn-outline-primary me-2 @if ($status == false) active @endif mt-2 ">
                        Semua</button>
                    <button wire:click="changeStatus('open')"
                        class="btn btn-outline-primary me-2 @if ($status == 'open') active @endif mt-2  ">Open</button>
                    <button wire:click="changeStatus('closed')"
                        class="btn btn-outline-primary me-2 @if ($status == 'closed') active @endif mt-2  ">Closed</button>
                </div>

            </div>
        </div>
        <div class="card">
            <h5 class="card-header"><i class="mdi mdi-ticket me-1"></i>Tickets</h5>
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
                                <th>INFORMASI</th>
                                <th>Tipe</th>
                                <th>Subjek</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($history->count() > 0)
                                @foreach ($history as $row)
                                    @php
                                        if ($row->status == 'closed') {
                                            $status = 'danger';
                                            $text = 'Close';
                                        } elseif ($row->status == 'open') {
                                            $status = 'success';
                                            $text = 'Open';
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-nowrap">
                                            <div class="kotak">
                                                <div class="label">TIKET ID</div>
                                                <div class="value text-primary">{{ $row->ticket_id }}</div>
                                                <div class="label">USER</div>
                                                <div class="value text-danger">{{ $row->user->name }}</div>
                                                <div class="label">Date</div>
                                                <div class="value text-success">
                                                    {{ tanggal(date('Y-m-d', strtotime($row['created_at']))) .
                                                        ' ' .
                                                        date('H:i', strtotime($row['created_at'])) .
                                                        '' }}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <button
                                                class="btn btn-sm btn-outline-primary">{{ Str::ucfirst($row->type_ticket) }}</button>
                                        </td>
                                        <td>
                                            <input type="text" name="subjek" id="subjek"
                                                value="{{ $row->subject }}" class="form-control-sm form-control"
                                                disabled>
                                        </td>
                                        <td><span
                                                class="btn btn-outline-{{ $status }} btn-sm ">{{ $text }}</span>
                                        </td>
                                        <td><a href="{{ url('admin/tiket/chat/' . $row->ticket_id) }}"
                                                class="btn btn-outline-primary btn-sm "><i
                                                    class="ti ti-mail-opened me-1"></i>Buka Tiket</a>
                                            @if ($row->status == 'open')
                                                <button href="javascript:;"
                                                    wire:click.prevent='closeTicket({{ $row->id }})'
                                                    class="btn btn-outline-danger btn-sm btn-rounded font-size-13"><i
                                                        class="mdi mdi-close-circle-outline me-1"></i>Closed</button>
                                            @else
                                                <button href="javascript:;"
                                                    class="btn btn-outline-danger btn-sm btn-rounded font-size-13"
                                                    disabled><i
                                                        class="mdi mdi-close-circle-outline me-1"></i>Closed</button>
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
</div>
@script
    <script>
        window.addEventListener('show-closed-confirmation', event => {
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Anda akan menutup ticket ini",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Tutup!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $wire.closeTickets();
                }
            })
        })
        window.addEventListener('closeTickets', event => {
            Swal.fire(
                'Terhapus!',
                'Ticket berhasil ditutup.',
                'success'
            )
        });
        window.addEventListener('failedClosed', event => {
            Swal.fire(
                'Gagal!',
                'Data gagal dihapus.',
                'error'
            )
        });
    </script>
@endscript
