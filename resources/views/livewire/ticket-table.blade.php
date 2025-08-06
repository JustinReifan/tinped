@php

@endphp
<div class="row">
    <div id="title-page" data-value="Riwayat Tiket" style="margin-top:24px" data-value2="Tiket"></div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="btn-group flex-wrap">
                    <button wire:click="changeStatus('all')"
                        class="btn btn-outline-primary mt-2 me-1 @if ($status == false) active @endif mt-2">Semua</button>
                    <button wire:click="changeStatus('open')"
                        class="btn btn-outline-primary mt-2 me-1 @if ($status == 'open') active @endif mt-2 ">Open</button>
                    <button wire:click="changeStatus('closed')"
                        class="btn btn-outline-primary mt-2 me-1 @if ($status == 'closed') active @endif mt-2 ">Closed</button>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header fw-bold p-3 text-xss"><i class="mdi mdi-refill me-1"></i>Riwayat Tiket</div>
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
                                        <td>{{ tanggal(date('Y-m-d', strtotime($row['created_at']))) .
                                            ' ' .
                                            date('H:i', strtotime($row['created_at'])) .
                                            '' }}
                                        </td>
                                        <td>{{ ucfirst($row->type_ticket) }}</td>
                                        <td>{{ $row->subject }}</td>
                                        <td><button
                                                class="btn btn-outline-{{ $status }} btn-sm font-size-13">{{ $text }}</button>
                                        </td>
                                        <td class="text-nowrap"><a href="{{ url('ticket/chat/' . $row->ticket_id) }}"
                                                class="btn btn-outline-primary btn-sm waves-effect waves-light"><i
                                                    class="ti ti-mail-opened me-1"></i>Buka Tiket</a></td>

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
<script></script>
