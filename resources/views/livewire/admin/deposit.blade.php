<div>
    @php
        use Carbon\Carbon;
    @endphp
    <div class="card">
        <div class="card-header fw-bold p-3 text-xss"><i class="fas fa-money-check me-2"></i>Kelola Deposit</div>
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
                            <th>#</th>
                            <th>INFORMASI</th>
                            <th>User</th>
                            <th>Jumlah Transfer</th>
                            <th>Saldo Diterima</th>
                            <th>Status</th>
                            <th>Tgl. Deposit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($history as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-nowrap">
                                    <div class="kotak">
                                        <div class="label">ID</div>
                                        <a
                                            href="{{ url('deposit/invoice/' . $row->trxid) }}"class="value text-primary">#{{ $row->trxid }}</a>
                                        <div class="label">CODE</div>
                                        <div class="value text-danger">{{ $row->code }}</div>
                                        <div class="label">Payment</div>
                                        <div class="value text-success">{{ $row->name_payment }}</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="kotak">
                                        <div class="label">Name</div>
                                        <div class="value text-primary">{{ $row->user->name }}</div>
                                        <div class="label">Email</div>
                                        <div class="value text-success">{{ $row->user->email }}</div>
                                        <div class="label">METODE</div>
                                        <div class="value text-secondary">
                                            @if ($row->process == 'auto')
                                                OTOMATIS
                                            @else
                                                MANUAL
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td> Rp {{ number_format($row->amount, 0, ',', '.') }}</td>
                                </td>
                                <td>
                                    Rp {{ number_format($row->diterima, 0, ',', '.') }}
                                </td>
                                <td class="text-nowrap">
                                    @if ($row->status == 'pending')
                                        <div class="btn-group-dropdown">
                                            <button type="button"
                                                class="btn btn-outline-warning btn-sm dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Pending
                                            </button>
                                            <ul class="dropdown-menu" style="cursor:pointer">
                                                <li><a class="dropdown-item" href="javascript:void(0)"
                                                        wire:click="ubahStatus('done', '{{ $row->id }}')">Sukses</a>
                                                </li>
                                                <li><a class="dropdown-item" href="javascript:void(0)"
                                                        wire:click="ubahStatus('canceled', '{{ $row->id }}')">Cancel</a>
                                                </li>
                                            </ul>
                                        </div>
                                    @elseif ($row->status == 'canceled')
                                        <div class="btn-group-dropdown">
                                            <button type="button" class="btn btn-outline-danger btn-sm dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Cancel
                                            </button>
                                            <ul class="dropdown-menu" style="cursor:pointer">
                                                <li><a class="dropdown-item" href="javascript:void(0)"
                                                        wire:click="ubahStatus('done', '{{ $row->id }}')">Sukses</a>
                                                </li>
                                                <li><a class="dropdown-item" href="javascript:void(0)"
                                                        wire:click="ubahStatus('pending', '{{ $row->id }}')">Pending</a>
                                                </li>
                                            </ul>
                                        </div>
                                    @elseif($row->status == 'done')
                                        <div class="btn-group-dropdown">
                                            <button type="button"
                                                class="btn btn-outline-success btn-sm dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Sukses
                                            </button>
                                            <ul class="dropdown-menu" style="cursor:pointer">
                                                <li><a class="dropdown-item"
                                                        wire:click="ubahStatus('pending', '{{ $row->id }}')">Pending</a>
                                                </li>
                                                <li><a class="dropdown-item"
                                                        wire:click="ubahStatus('canceled', '{{ $row->id }}')">Cancel</a>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif
                                </td>
                                <td>{{ tanggal(Carbon::parse($row->created_at)->format('Y-m-d')) }}
                                    {{ Carbon::parse($row->created_at)->format('H:i:s') }}</td>
                                <td x-data="{ depositId: {{ $row->id }}, toggleEdit: false }">
                                    <button class="btn btn-sm btn-success bg-gradient w-100 mb-1"
                                        onclick="konfirmasi('{{ $row->id }}')"
                                        @if ($row->status == 'done') disabled @endif>Konfirmasi</button>
                                    <button class="btn btn-primary bg-gradient btn-sm w-100 mb-1"
                                        wire:click="EditDeposit('{{ $row->id }}')">Edit</button>
                                    <button type="button" @if ($row->status == 'canceled') disabled @endif
                                        onclick="batalkan('{{ $row->id }}')"
                                        class="btn btn-danger bg-gradient btn-sm w-100 mb-1">
                                        Batalkan</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center">Data Not Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $history->links() }}
        </div>
    </div>
    <div id="triggerkonfirmasi"></div>
    <div id="triggerBatal"></div>
    <div id="triggerUpdate"></div>
    <script>
        function konfirmasi(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Anda akan konfirmasi deposit ini! saldo akan ditambahkan ke user.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Ubah status!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#triggerkonfirmasi').data('id', id);
                    $('#triggerkonfirmasi').click();
                }
            });
        }

        function batalkan(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Anda akan membatalkan deposit ini! saldo tidak akan ditambahkan ke user.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Ubah status!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#triggerBatal').data('id', id);
                    $('#triggerBatal').click();

                }
            });
        }
    </script>
</div>
@script
    <script>
        window.addEventListener('swal:modal', event => {
            let detail = event.detail[0];
            Swal.fire({
                title: detail.title,
                text: detail.text,
                icon: detail.type,
            });
        });
        window.addEventListener('swal:confirm', event => {
            let detail = event.detail[0];
            Swal.fire({
                title: detail.title,
                text: detail.text,
                icon: detail.type,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Ubah status!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $wire[detail.array](detail.status, detail.id);
                }
            });
        });
        $('#triggerkonfirmasi').click(function() {
            let id = $(this).data('id');
            $wire.konfirmasi(id);
        });
        $('#triggerBatal').click(function() {
            let id = $(this).data('id');
            $wire.batalkan(id);
        });
        $('#saveAmount').click(function() {
            let id = $(this).data('id');
            let amount = $('#amount').val();
            amount = amount.replace(/\./g, '');
            $wire.saveAmount('amount', id, amount);
        });
        $('#saveDiterima').click(function() {
            let id = $(this).data('id');
            let diterima = $('#diterima').val();
            diterima = diterima.replace(/\./g, '');
            $wire.saveAmount('diterima', id, diterima);
        });
    </script>
@endscript
