<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header fw-bold p-3 text-xss"><i class="mdi mdi-account-convert me-1"></i>Log Masuk</h5>
                <div class="card-body">
                    <form method="get" class="row">
                        <div class="col-md-6">
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
                                    <th>Name</th>
                                    <th>Tgl. Masuk</th>
                                    <th>IP Address</th>
                                    <th>User Agent</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($log as $login)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $login->users->name }}</td>
                                        <td>{{ $login->created_at }}</td>
                                        <td>{{ $login->ip }}</td>
                                        <td>{{ $login->user_agent }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {!! $log->links() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
