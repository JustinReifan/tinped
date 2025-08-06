<div>
    <div class="card">
        <div class="card-body py-0">
            <ul class="nav nav-tabs profile-tabs " id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link {{ $tab == 'database' ? 'active' : '' }}" id="database-tab"
                        data-bs-toggle="tab" wire:click="$set('tab','database')"href="#database" role="tab"
                        aria-selected="true"><i class="ti ti-database me-2"></i>Database</a>
                </li>
                <li class="nav-item"><a class="nav-link {{ $tab == 'add-category' ? 'active' : '' }}"
                        id="add-category-tab" data-bs-toggle="tab"
                        wire:click="$set('tab','add-category')"href="#add-category" role="tab"
                        aria-selected="true"><i class="ti ti-plus me-2"></i>Add Category</a>
                </li>
            </ul>

            <div class="tab-content mt-3">
                <div class="tab-pane show {{ $tab == 'database' ? 'active' : '' }}" id="database" role="tabpanel"
                    aria-labelledby="database-tab">
                    <div class="row">
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
                        <div class="col-md-6"></div>
                        <div class="col-md">
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
                                    <th>SID</th>
                                    <th>Provider</th>
                                    <th>Kategori</th>
                                    <th>Nologin</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kategori as $row)
                                    <tr>
                                        <td>{{ $row->sid }}</td>
                                        <td>{{ $row->provider }}</td>
                                        <td>{{ $row->kategori }}</td>
                                        <td>
                                            <div class="btn-group-dropdown">
                                                <button type="button"
                                                    class="btn btn-outline-{{ $row->nologin == '1' ? 'success' : 'danger' }} btn-sm dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    {{ $row->nologin == '1' ? 'Ya' : 'Tidak' }}
                                                </button>
                                                <ul class="dropdown-menu" style="cursor:pointer">
                                                    @if ($row->nologin == '1')
                                                        <li><a class="dropdown-item  " href="javascript:void(0)"
                                                                wire:click="ubahStatusLogin('0', '{{ $row->id }}')">Tidak</a>
                                                        </li>
                                                    @else
                                                        <li><a class="dropdown-item  " href="javascript:void(0)"
                                                                wire:click="ubahStatusLogin('1', '{{ $row->id }}')">Ya</a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group-dropdown">
                                                <button type="button"
                                                    class="btn btn-outline-{{ $row->status == 'aktif' ? 'success' : 'danger' }} btn-sm dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    {{ $row->status == 'aktif' ? 'Aktif' : 'Nonaktif' }}
                                                </button>
                                                <ul class="dropdown-menu" style="cursor:pointer">
                                                    @if ($row->status == 'aktif')
                                                        <li><a class="dropdown-item  " href="javascript:void(0)"
                                                                wire:click="ubahStatus('nonaktif', '{{ $row->id }}')">Tidak</a>
                                                        </li>
                                                    @else
                                                        <li><a class="dropdown-item  " href="javascript:void(0)"
                                                                wire:click="ubahStatus('aktif', '{{ $row->id }}')">Ya</a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modal" wire:click="edit('{{ $row->id }}')"><i
                                                    class="fas fa-edit me-2"></i>Edit
                                            </div>

                                            <div class="btn btn-danger btn-sm"
                                                onclick="deleteCategory('{{ $row->id }}')"><i
                                                    class="fas fa-trash me-2"></i>Delete</div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No Data Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $kategori->links() }}
                </div>
                <div class="tab-pane show {{ $tab == 'add-category' ? 'active' : '' }}" id="add-category"
                    role="tabpanel" aria-labelledby="add-category-tab">
                    <div class="row mb-2">
                        <div class="col-md" wire:ignore>
                            <label for="" class="form-label">Provider</label>
                            <select class="select2 form-control" style="width: 100%;" name="provider" id="provider">
                                <option value="">Pilih Provider</option>
                                @php
                                    $provider = App\Models\Provider::where('status', 'aktif')->get();
                                @endphp
                                @forelse ($provider as $row)
                                    <option value="{{ $row->nama }}">{{ $row->nama }}</option>
                                @empty
                                    <option value="0">Tidak ada provider</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-md">
                            <label for="" class="form-label">Service ID</label>
                            <input type="number" name="service_id_add" placeholder="Masukkan Service ID"
                                id="service_id_add" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md">
                            <label for="" class="form-label">Kategori</label>
                            <input type="text" name="categorys" id="categorys" class="form-control">
                        </div>
                        <div class="col-md">
                            <label for="" class="form-label">No login</label>
                            <select name="nologin" id="nologin" class="form-control">
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                        </div>
                    </div>
                    <div class="float-end mb-3">
                        <button class="btn btn-primary" id="addCategory">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal" wire:ignore.self tabindex="-1" aria-labelledby="modalsLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="SaveEdit">
                    <div class="modal-body" id="content">
                        <div class="row">
                            <div class="col-md">
                                <label for="" class="form-label">Provider</label>
                                <select class="form-control" name="provider" id="provider"
                                    wire:model.lazy="provider">
                                    <option value="">Pilih Provider</option>
                                    @php
                                        $provider = App\Models\Provider::where('status', 'aktif')->get();
                                    @endphp
                                    @forelse ($provider as $row)
                                        <option value="{{ $row->nama }}">{{ $row->nama }}</option>
                                    @empty
                                        <option value="0">Tidak ada provider</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-md">
                                <label for="" class="form-label">Service ID</label>
                                <input type="number" name="service_id" placeholder="Masukkan Service ID"
                                    id="service_id" class="form-control" wire:model.lazy="service_id">
                            </div>
                            <div class="col-md">
                                <label for="" class="form-label">Kategori</label>
                                <input type="text" name="kategori" id="kategori" class="form-control"
                                    wire:model.lazy="category">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md">
                                <label for="" class="form-label">No login</label>
                                <select name="nologin" id="nologin" class="form-control"
                                    wire:model.change="nologin">
                                    <option value="0">Tidak</option>
                                    <option value="1">Ya</option>
                                </select>
                            </div>
                            <div class="col-md">
                                <label for="" class="form-label">Status</label>
                                <select name="stat" id="stat" class="form-control"
                                    wire:model.change="status">
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Nonaktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="triggerDelete"></div>
    <script>
        function deleteCategory(id) {
            Swal.fire({
                title: 'Apakah anda yakin?',
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
</div>
@script
    <script>
        $('#addCategory').on('click', function() {
            var provider = $('#provider').val();
            var service_id = $('#service_id_add').val();
            var category = $('#categorys').val();
            var nologin = $('#nologin').val();
            if (provider == '') {
                toastr.error('Provider tidak boleh kosong');
                return false;
            }
            if (category == '') {
                toastr.error('Kategori tidak boleh kosong');
                return false;
            }
            if (nologin == '') {
                toastr.error('No login tidak boleh kosong');
                return false;
            }
            $wire.addCategory(provider, service_id, category, nologin);
        });
        $('#triggerDelete').click(function() {
            var id = $(this).data('id');
            $wire.deleteCategory(id);
        });
    </script>
@endscript
