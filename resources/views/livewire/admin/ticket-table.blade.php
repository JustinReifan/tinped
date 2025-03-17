@php

@endphp
<div class="row">
    <div class="col-md-12">
        <div class="btn-group flex-wrap mb-3">
            <button wire:click="all" class="btn btn-primary">Semua</button>
            <button wire:click="open" class="btn btn-primary ">Open</button>
            <button wire:click="closed" class="btn btn-primary ">Closed</button>
        </div>
        <div class="card">
            <div class="card-header fw-bold p-3 text-xss"><i class="mdi mdi-ticket me-1"></i>Tickets</h5>
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
                                    <th>User</th>
                                    <th>Tgl.Dibuat</th>
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
                                            <td>{{ $row->user->email }}</td>
                                            <td>{{ tanggal(date('Y-m-d', strtotime($row['created_at']))) .
                                                ' ' .
                                                date('H:i', strtotime($row['created_at'])) .
                                                '' }}
                                            </td>
                                            <td>{{ Str::ucfirst($row->type_ticket) }}</td>
                                            <td>{{ $row->subject }}</td>
                                            <td><span
                                                    class="btn btn-soft-{{ $status }} btn-sm ">{{ $text }}</span>
                                            </td>
                                            <td><a href="{{ url('admin/ticket/chat/' . $row->ticket_id) }}"
                                                    class="btn btn-primary btn-sm "><i
                                                        class="mdi mdi-email-open-outline me-1"></i>Buka Tiket</a>
                                                @if ($row->status == 'open')
                                                    <button href="javascript:;"
                                                        wire:click.prevent='closeTicket({{ $row->id }})'
                                                        class="btn btn-soft-danger btn-sm btn-rounded font-size-13"><i
                                                            class="mdi mdi-close-circle-outline me-1"></i>Closed</button>
                                                @else
                                                    <button href="javascript:;"
                                                        class="btn btn-soft-danger btn-sm btn-rounded font-size-13"
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
                    Livewire.emit('closeTicket')
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
