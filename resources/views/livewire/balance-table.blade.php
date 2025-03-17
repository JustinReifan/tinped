<div class="row">
    <div id="title-page" data-value="Riwayat Mutasi" data-value2="Log"></div>
    <div class="col-md-12">
        <div class="btn-group flex-wrap mb-2">
            <button wire:click="changeKategori('all')"
                class="btn btn-outline-primary mt-2 me-1 @if ($kategori == false) active @endif mt-2  ">Semua</button>
            <button wire:click="changeKategori('pesanan')"
                class="btn btn-outline-primary mt-2 me-1 @if ($kategori == 'pesanan') active @endif mt-2  ">Pemesanan</button>
            <button wire:click="changeKategori('deposit')"
                class="btn btn-outline-primary mt-2 me-1 @if ($kategori == 'deposit') active @endif mt-2  ">Deposit</button>
            <button wire:click="changeKategori('refund')"
                class="btn btn-outline-primary mt-2 me-1 @if ($kategori == 'refund') active @endif mt-2  ">Refund</button>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header fw-bold p-3 text-xss"><i class="mdi mdi-account-convert me-1"></i>Log Saldo</div>
            <div class="card-body">
                <form method="get" class="row">
                    <div class="col-md">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Tampilkan</span>
                            </div>
                            <select class="form-control" name="row" id="table-row" wire:model.change="perPage">>
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
                    <div class="col-md">
                        <div class="input-group mb-3">
                            <input type="text" wire:model.live.debounce.300ms="search" class="form-control"
                                name="search" id="table-search" value="" placeholder="Cari...">
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-uppercase">
                                <th>ID</th>
                                <th>Tgl. Dibuat</th>
                                <th>Kategori</th>
                                <th>Keterangan</th>
                                <th>Jumlah</th>
                                <th>Saldo Sebelum</th>
                                <th>Saldo Akhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($log as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ date('d M Y H:i:s', strtotime($row->created_at)) }}
                                    </td>
                                    <td>
                                        @if ($row->kategori == 'pesanan')
                                            <span
                                                class="btn btn-light-success btn-sm font-size-13">{{ Str::upper($row->kategori) }}</span>
                                        @elseif($row->kategori == 'deposit')
                                            <span
                                                class="btn btn-light-info btn-sm font-size-13">{{ Str::upper($row->kategori) }}</span>
                                        @else
                                            <span
                                                class="btn btn-light-primary btn-sm font-size-13">{{ Str::upper($row->kategori) }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $row->description }}</td>
                                    @php
                                        if ($row->kategori == 'refund' or $row->kategori == 'deposit') {
                                            $s = '+';
                                        } else {
                                            $s = '-';
                                        }
                                    @endphp
                                    <td>{{ $s }} Rp {{ number_format($row->jumlah, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($row->before_balance, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($row->after_balance, 0, ',', '.') }}</td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="8" align="center">Data not found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $log->links() }}
            </div>
        </div>
    </div>
</div>
<script>
    // if btn-primary clicked
    document.querySelectorAll('.btn-primary').forEach(function(el) {
        el.addEventListener('click', function(e) {
            // remove btn-primary class
            document.querySelectorAll('.btn-primary').forEach(function(el) {
                el.classList.remove('btn-primary');
            });
            // add btn-primary class
            e.target.classList.add('btn-primary active');
        });
    });
</script>
