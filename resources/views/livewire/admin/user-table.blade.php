@php

@endphp

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="btn-group flex-wrap">
                    <button wire:click="all" class="btn btn-primary">Semua</button>
                    <button wire:click="active" class="btn btn-primary ">Verify</button>
                    <button wire:click="notverify" class="btn btn-primary ">Not Verify</button>
                    <button wire:click="banned" class="btn btn-primary ">Banned</button>
                </div>

            </div>
        </div>

        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {!! session()->get('success') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ session()->get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-header fw-bold p-3 text-xss"><i class="mdi mdi-history me-1"></i>Riwayat Pesanan</h5>
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
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Balance</th>
                                    <th>Omzet</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($users->count() > 0)
                                    @foreach ($users as $row)
                                        @php
                                            if ($row->status == 'notverify') {
                                                $status =
                                                    '<button class="btn btn-soft-danger btn-sm font-size-13">Not Verify</button>';
                                            } elseif ($row->status == 'banned') {
                                                $status =
                                                    '<button class="btn btn-soft-danger btn-sm font-size-13">Banned</button>';
                                            } else {
                                                $status =
                                                    '<button class="btn btn-soft-success btn-sm font-size-13">Verify</button>';
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->username }}</td>
                                            <td>{{ $row->email }}</td>
                                            <td>Rp {{ number_format($row->balance, 0, ',', '.') }}</td>
                                            <td>Rp {{ number_format($row->omzet, 0, ',', '.') }}</td>
                                            <td>{{ Str::ucfirst($row->role) }}</td>
                                            <td>{!! $status !!}</td>
                                            <td>
                                                @if ($row->status == 'notverify')
                                                    <button class="btn btn-info">Verify</button>
                                                @elseif($row->status == 'active')
                                                    <button class="btn btn-danger btn-sm"
                                                        wire:click.prevent='bannedUser({{ $row->id }})'>Banned</button>
                                                @else
                                                    <button class="btn btn-success btn-sm"
                                                        wire:click.prevent='unbannedUser({{ $row->id }})'>UnBanned</button>
                                                @endif
                                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#UpdateUser" onclick="modal('{{ $row->id }}')"
                                                    type="button">Edit</button>
                                                <button class="btn btn-danger btn-sm"
                                                    wire:click.prevent='deleteConfirmation({{ $row->id }})'
                                                    type="button">Delete</button>
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
                        {!! $users->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="UpdateUser" tabindex="-1" aria-labelledby="modalsLabel" aria-hidden="true">
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
    <script>
        function modal(id) {
            $.ajax({
                url: "{{ url('admin/user/edit') }}/" + id,
                type: "GET",
                dataType: "html",
                success: function(data) {
                    $('#title').html('Edit User');
                    $('#content').html(data);
                },
                error: function(xhr, status, error) {
                    Swal.fire('Error', 'Terjadi Kesalahan', 'error');
                    $('#UpdateUser').modal('hide');
                }
            });
        }
        window.addEventListener('show-banned-confirmation', event => {
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Anda akan mem-banned user ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Banned!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('bannedUser')
                }
            })
        });
        window.addEventListener('bannedUsers', event => {
            Swal.fire(
                'Terhapus!',
                'User berhasil dibanned.',
                'success'
            )
        });
        window.addEventListener('failedBanned', event => {
            Swal.fire(
                'Gagal!',
                'Data gagal diubah.',
                'error'
            )
        });

        window.addEventListener('show-unbanned-confirmation', event => {
            Livewire.emit('unbannedUser')
        });
        window.addEventListener('unbannedUsers', event => {
            Swal.fire(
                'Terhapus!',
                'User berhasil di unbanned.',
                'success'
            )
        });
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
                    Livewire.emit('deleteConfirmation')
                }
            })
        })
        window.addEventListener('userDeleted', event => {
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
