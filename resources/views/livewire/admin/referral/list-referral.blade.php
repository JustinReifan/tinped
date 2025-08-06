<div>
    <div class="card">
        <div class="card-header fw-bold p-3 text-xss">List Referral</div>
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
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Code</th>
                            <th>Level</th>
                            <th>Other</th>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($referral as $row)
                            <tr>
                                <td>{{ ($referral->currentPage() - 1) * $referral->perPage() + $loop->iteration }}</td>
                                <td>
                                    <div class="kotak">
                                        <div class="label">Nama</div>
                                        <div class="value text-primary">{{ $row->user->name }}</div>
                                        <div class="label">Email</div>
                                        <div class="value text-success">{{ $row->user->email }}</div>
                                    </div>
                                </td>
                                <td>
                                    <input type="text" name="code" id="code" value="{{ $row->code }}"
                                        class="form-control form-control-sm" disabled>
                                </td>
                                <td>
                                    <input type="text" name="level" id="level"
                                        value="{{ ucfirst($row->level) }}" disabled
                                        class="form-control form-control-sm">
                                </td>
                                <td>
                                    <div class="kotak">
                                        <div class="label">Komisi</div>
                                        <div class="value text-primary">Rp
                                            {{ number_format($row->komisi, 0, ',', '.') }}</div>
                                        <div class="label">Visitors</div>
                                        <div class="value text-success">{{ $row->visitors }}</div>
                                        <div class="label">Registered</div>
                                        <div class="value text-success">{{ $row->registered }}</div>
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modal" wire:click="editUser('{{ $row->id }}')"><i
                                            class="fas fa-edit me-2"></i>Edit</button>
                                    <button onclick="deleteReferral({{ $row->id }})"
                                        class="btn btn-sm btn-danger"><i class="fas fa-trash me-2"></i>Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Data tidak ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal" wire:ignore tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Edit Referral</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="editUsers">
                    <div class="modal-body">
                        <label for="" class="form-label">User</label>
                        <input type="text" name="user" id="user" wire:model.lazy="user"
                            class="form-control mb-2" readonly>
                        <div class="row">
                            <div class="col-md">
                                <label for="" class="form-label">Code</label>
                                <input type="text" name="code" id="code" wire:model.lazy="code"
                                    class="form-control ">
                            </div>
                            <div class="col-md">
                                <label for="" class="form-label">Level</label>
                                <select name="level" id="level" wire:model.change="level" class="form-control">
                                    @php
                                        $config = App\Models\ConfigReferral::all();
                                    @endphp
                                    @foreach ($config as $level)
                                        <option value="{{ $level->level }}">{{ ucfirst($level->level) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md">
                                <label for="" class="form-label">Komisi</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="text" name="komisi" id="komisi" wire:model.lazy="komisi"
                                        class="form-control ">
                                </div>
                            </div>
                            <div class="col-md">
                                <label for="" class="form-label">Visitors</label>
                                <input type="text" name="visitors" id="visitors" wire:model.lazy="visitors"
                                    class="form-control">
                            </div>
                            <div class="col-md">
                                <label for="" class="form-label">Registered</label>
                                <input type="text" name="registered" id="registered" wire:model.lazy="registered"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal"
                            wire:loading.attr="disabled"><i class="fas fa-save me-2"></i>Save
                            changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="triggerDelete"></div>
    <script>
        function deleteReferral(id) {
            // Swal fire confirm
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#triggerDelete').data('id', id);
                    $('#triggerDelete').click();
                }
            });
        }
    </script>
</div>
@script
    <script>
        $('#triggerDelete').on('click', function() {
            $wire.deleteUser($(this).data('id'));
        });
    </script>
@endscript
