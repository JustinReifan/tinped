<div>
    <div id="title-page" data-value="Manage users" data-value2="Manage"></div>
    <div class="card">
        <div class="card-header fw-bold p-3 text-xss"><i class="fa-solid fa-users-viewfinder me-2"></i>Kelola users</div>
        <div class="card-body">
            <div class="row">

                <div class="col-md-3">
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
                <div class="col-md-6" wire:ignore>
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
                            <th class="text-center">ID</th>
                            <th>Nama</th>
                            <th>Login</th>
                            <th>Whatsapp</th>
                            <th>Balance</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($user as $row)
                            <tr>
                                <td class="text-center">
                                    {{ ($user->currentPage() - 1) * $user->perPage() + $loop->iteration }}</td>
                                <td>{{ $row->name }}</td>
                                <td>
                                    <div class="kotak">
                                        <div class="label">Email</div>
                                        <div class="value text-success">{{ $row->email }}</div>
                                        <div class="label">Username</div>
                                        <div class="value text-success">{{ $row->username }}</div>
                                    </div>
                                </td>
                                <td>{{ $row->whatsapp }}</td>
                                <td>
                                    <div class="kotak">
                                        <div class="label">Balance</div>
                                        <div class="value text-primary">Rp
                                            {{ number_format($row->balance, 0, ',', '.') }}</div>
                                        <div class="label">Omzet</div>
                                        <div class="value text-primary">Rp
                                            {{ number_format($row->omzet, 0, ',', '.') }}</div>
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm" wire:click="edit('{{ $row->id }}')"><i
                                            class="fas fa-edit me-2"></i>Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteUser('{{ $row->id }}')"><i
                                            class="fas fa-trash me-2"></i>Delete</button>
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
            {{ $user->links() }}
        </div>
    </div>
    <div id="triggerDelete"></div>
    <script>
        function deleteUser(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
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
    <div class="modal fade" id="EditUser" tabindex="-1" aria-labelledby="modalsLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="content">
                </div>
            </div>
        </div>
    </div>
</div>
@script
    <script>
        $('#triggerDelete').click(function() {
            var id = $(this).data('id');
            $wire.deleteUser(id);
        });
    </script>
@endscript
