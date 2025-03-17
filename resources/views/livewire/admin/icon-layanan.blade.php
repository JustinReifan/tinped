<div>
    <div class="card">
        <div class="card-header fw-bold p-3 text-xss">Icon Layanan</h5>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md"></div>
                    <div class="col-md">
                        <div class="text-right">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modals">Tambah
                                Icon</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="text-uppercase">
                                <th class="text-center" rowspan="2" style="vertical-align:middle">Icon</th>
                                <th class="text-center" rowspan="2" style="vertical-align:middle; width:200px;">
                                    Keyword
                                </th>
                                <th class="text-center" rowspan="2" style="vertical-align:middle"
                                    style="width:200px;">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($all as $row)
                                <tr>
                                    <td class="text-center">
                                        {!! $row->icon !!}
                                    </td>
                                    <td>
                                        <input type="text" name="keyword" readonly value="{{ $row->keyword }}"
                                            id="keyword" class="form-control form-control-sm" style="width:200px;">
                                    </td>
                                    <td style="width:200px;">
                                        <button class="btn btn-danger btn-sm"
                                            wire:click.prevent="deleteIcon({{ $row->id }})">Delete</button>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                            wire:click.prevent="editIcon({{ $row->id }})"
                                            data-bs-target="#modal">Edit</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modals" wire:ignore tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Icon</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form wire:submit.prevent="addIcon">
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-box">
                                    <tbody>
                                        <tr>
                                            <th>CODE ICON FONTAWESOME</th>
                                            <td>
                                                <input type="text" class="form-control" wire:model="icon">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>KEYWORD</th>
                                            <td>
                                                <input type="text" class="form-control" wire:model="keyword">
                                                <small class="text-danger">*Apabila ingin lebih dari 1 keyword, gunakan
                                                    tanda koma contoh (instagram,facebook,telegram)</small>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">Save
                                changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal" wire:ignore tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Icon</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form wire:submit.prevent="editIcons">
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-box">
                                    <tbody>
                                        <tr>
                                            <th>CODE ICON FONTAWESOME</th>
                                            <td>
                                                <input type="text" class="form-control" wire:model="icon">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>KEYWORD</th>
                                            <td>
                                                <input type="text" class="form-control" wire:model.change="keyword">
                                                <small class="text-danger">*Apabila ingin lebih dari 1 keyword, gunakan
                                                    tanda koma contoh (instagram,facebook,telegram)</small>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">Save
                                changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('swal:modal', event => {
            Swal.fire({
                title: event.detail[0].title,
                text: event.detail[0].text,
                icon: event.detail[0].type,
            });
            $('#modal').modal('hide');
            $('#modals').modal('hide');
        });
        window.addEventListener('confirm-delete', event => {
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
                    Livewire.emit('deleteIcon', event.detail[0].id);
                }
            })
        });
    </script>
