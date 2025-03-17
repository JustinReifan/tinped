<div class="row">
    <div id="title-page" data-value="Layanan Favorit" data-value2="Layanan"></div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header fw-bold p-3 text-xss"><i class="mdi mdi-history me-1"></i>Layanan Favorit</div>
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
                                <th>Service ID</th>
                                <th>Category</th>
                                <th>Layanan</th>
                                <th>Harga/1000</th>
                                <th>Min</th>
                                <th>Max</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($history->count() > 0)
                                @foreach ($history as $row)
                                    @php
                                        $service = App\Models\Smm::where([
                                            ['service', $row->service_id],
                                            ['category', $row->category],
                                            ['name', $row->layanan],
                                        ])->first();
                                    @endphp
                                    @if ($service)
                                        <tr>
                                            <td>{{ $row->service_id }}</td>
                                            <td>{{ $row->category }}</td>
                                            <td>{{ $row->layanan }}</td>
                                            <td>Rp {{ number_format($row->price, 0, ',', '.') }}</td>
                                            <td>{{ number_format($service->min) }}</td>
                                            <td>{{ number_format($service->max) }}</td>
                                            <td class="text-nowrap">
                                                <a href="javascript:;"
                                                    wire:click.prevent='deleteConfirmation({{ $row->id }})'
                                                    class="btn btn-outline-danger btn-sm btn-rounded font-size-13"><i
                                                        class="fas fa-trash-alt me-1"></i>Hapus</a>
                                            </td>
                                        </tr>
                                    @else
                                    @endif
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
        window.addEventListener('show-delete-confirmation', event => {
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $wire.deleteLayanan();
                }
            })
        })
        window.addEventListener('layananDeleted', event => {
            Swal.fire(
                'Terhapus!',
                'Data berhasil dihapus.',
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
