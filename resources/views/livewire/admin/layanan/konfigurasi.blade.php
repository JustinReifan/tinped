<div>
    <div class="card">
        <div class="card-body">

            <div class="btn-group flex-wrap">
                @php
                    $distinct = Cache::remember('distinct_smm_types', 30, function () {
                        return App\Models\Smm::distinct()->get('type');
                    });
                @endphp

                <button wire:click="changeType('all')"
                    class="btn btn-outline-primary me-2 {{ $custom == false ? 'active' : '' }} ">Semua</button>

                @foreach ($distinct as $row)
                    <button wire:click="changeType('{{ $row->type }}')"
                        class="btn btn-outline-primary me-2 mt-2 {{ $custom == $row->type ? 'active' : '' }}">
                        {{ ucfirst(str_replace('_', ' ', $row->type)) }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body py-0">
            <ul class="nav nav-tabs profile-tabs " id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link {{ $tab == 'database' ? 'active' : '' }}" id="database-tab"
                        data-bs-toggle="tab" wire:click="$set('tab','database')"href="#database" role="tab"
                        aria-selected="true"><i class="ti ti-database me-2"></i>Database</a>
                </li>
                <li class="nav-item"><a class="nav-link {{ $tab == 'add-layanan' ? 'active' : '' }}"
                        id="add-layanan-tab" data-bs-toggle="tab"
                        wire:click="$set('tab','add-layanan')"href="#add-layanan" role="tab" aria-selected="true"><i
                            class="ti ti-plus me-2"></i>Add layanan</a>
                </li>
            </ul>
            <div class="tab-content mt-3">
                <div class="tab-pane show {{ $tab == 'database' ? 'active' : '' }}" id="database" role="tabpanel"
                    aria-labelledby="database-tab">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Tampilkan</span>
                                </div>
                                <select class="form-control" name="row" id="table-row" wire:model.change="perPage">
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
                            <select class="select2 form-control" style="width:100%" name="category" id="category">
                                <option value="">Semua Kategori</option>

                                @forelse ($kategori as $row)
                                    @php
                                        $id = App\Models\Smm::where('category', $row->kategori)->first();
                                        $icon = App\Models\IconLayanan::where(
                                            'kategori',
                                            'like',
                                            '%' . $row . '%',
                                        )->first();
                                    @endphp
                                    @if ($id)
                                        <option value="{{ $id->id }}"
                                            data-icon="<i class='{!! $icon->icon ?? null !!}'></i>">
                                            {!! $row->kategori !!}</option>
                                    @endif
                                @empty
                                    <option data-icon="<i class='fab fa-facebook-square'></i>" value="0">Tidak
                                        ada kategori</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group mb-3">
                                <input type="text" wire:model.live.debounce.300ms="search" class="form-control"
                                    name="search" id="table-search" value="" placeholder="Cari...">
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                @if ($category)
                                    <tr class="table-primary">
                                        <th colspan="8" class="text-start text-lg-center">
                                            {{ $category }}</th>
                                    </tr>
                                @endif
                                <tr class="text-uppercase">
                                    <th class="text-center" rowspan="2" style="vertical-align:middle">SID</th>
                                    <th class="text-center" rowspan="2" style="vertical-align:middle">Provider
                                    </th>
                                    <th class="text-center" rowspan="2" style="vertical-align:middle">Nama Layanan
                                    </th>
                                    <th class="text-center" rowspan="2" style="vertical-align:middle">Type</th>
                                    <th class="text-center" colspan="3" style="vertical-align:middle">Detail
                                    </th>
                                    <th class="text-center" rowspan="2" style="vertical-align:middle">Aksi</th>
                                </tr>
                                <tr>
                                    <th class="text-center">HARGA/1000</th>
                                    <th class="text-center">Min</th>
                                    <th class="text-center">Max</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($layanan as $row)
                                    @php
                                        $favorit = App\Models\Favorit::where('user_id', Auth::user()->id)
                                            ->where([
                                                ['service_id', $row->service],
                                                ['category', $row->category],
                                                ['layanan', $row->name],
                                            ])
                                            ->first();
                                    @endphp
                                    <tr>
                                        <td>{{ $row->service }}</td>
                                        <td>{{ Str::ucfirst($row->provider) }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ ucfirst(str_replace('_', ' ', $row->type)) }}</td>
                                        <td>Rp {{ number_format($row->price, 0, ',', '.') }}</td>
                                        <td>{{ number_format($row->min, 0, ',', '.') }}</td>
                                        <td>{{ number_format($row->max, 0, ',', '.') }}</td>
                                        <td class="text-nowrap">
                                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modal"
                                                wire:click="editProduct('{{ $row->id }}')">
                                                <i class="fas fa-edit me-1"></i> Edit
                                            </button>
                                            <button class="btn btn-danger btn-sm"
                                                onclick="DeleteLayanan('{{ $row->id }}')"><i
                                                    class="fas fa-trash me-1"></i>Delete</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {!! $layanan->links() !!}
                    </div>
                </div>
                <div class="tab-pane show {{ $tab == 'add-layanan' ? 'active' : '' }}" id="add-layanan"
                    role="tabpanel" aria-labelledby="add-layanan-tab">

                    <form wire:submit.prevent="savednews">
                        <div class="row">
                            <div class="col-md">
                                <label class="form-label">Provider<span class="text-danger">*</span></label>
                                <input type="text" name="service_id" placeholder="Masukkan Provider"
                                    wire:model.lazy="provider" id="provider" class="form-control">
                                @error('provider')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md">
                                <label class="form-label">Service ID<span class="text-danger">*</span></label>
                                <input type="text" name="service_id" placeholder="Masukkan Service ID"
                                    wire:model.lazy="service_id" id="service_id" class="form-control">
                                @error('service_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md">
                                <label class="form-label">Category<span class="text-danger">*</span></label>
                                <select wire:model.change="category2" name="category" id="category2"
                                    class="form-control">
                                    <option value="">Pilih Category</option>
                                    @forelse ($kategori as $row)
                                        <option value="{{ $row->kategori }}">{{ $row->kategori }}</option>
                                    @empty
                                        <option value="0">Tidak ada category</option>
                                    @endforelse
                                </select>
                                @error('category2')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md">
                                <label class="form-label">Nama Layanan <span class="text-danger">*</span></label>
                                <input type="text" name="name" placeholder="Masukkan name layanan"
                                    wire:model.lazy="name" id="name" class="form-control">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md">
                                <label for="" class="form-label">Type<span
                                        class="text-danger">*</span></label>
                                <input type="text" list="types" name="min" id="min"
                                    wire:model.lazy="type"
                                    placeholder="Masukkan Type Product | Primary,Custom Comments ..dll"
                                    class="form-control">
                                <datalist id="types">
                                    @php
                                        $distinct = App\Models\Smm::distinct()->get('type');
                                    @endphp
                                    @foreach ($distinct as $row)
                                        <option value="{{ $row->type }}">
                                    @endforeach
                                </datalist>
                                @error('min')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md">
                                <label for="" class="form-label">Harga / 1000<span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-text">Rp</div>
                                    <input type="number" class="form-control" wire:model.lazy="price"
                                        placeholder="Masukkan harga produk" name="harga" id="harga">
                                </div>
                                @error('harga')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md">
                                <label for="" class="form-label">Min<span
                                        class="text-danger">*</span></label>
                                <input type="number" name="min" id="min" wire:model.lazy="min"
                                    placeholder="Masukkan min transaksi" class="form-control">
                                @error('min')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md">
                                <label for="" class="form-label">Max<span
                                        class="text-danger">*</span></label>
                                <input type="number" name="max" id="max" wire:model.lazy="max"
                                    placeholder="Masukkan max transaksi" class="form-control">
                                @error('max')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md">
                                <label for="" class="form-label">Refill<span
                                        class="text-danger">*</span></label>
                                <select name="refill" id="refill" wire:model.change="refill"
                                    class="form-control">
                                    <option value="">Pilih..</option>
                                    <option value="0">Tidak</option>
                                    <option value="1">Ya</option>
                                </select>
                                @error('refill')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md">
                                <label for="" class="form-label">Average Time</label>
                                <input type="text" name="average_time" id="average_time"
                                    wire:model.lazy="average_time" class="form-control">
                            </div>
                        </div>
                        <label for="" class="form-label mt-2">Description<span
                                class="text-danger">*</span></label>
                        <textarea name="description" placeholder="Masukkan deskripsi" id="description" wire:model.lazy="description"
                            class="form-control" cols="30" rows="2"></textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="float-end mt-2">
                            <button class="btn btn-danger" type="reset">Reset</button>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal" wire:ignore tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Products</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="editProducts">
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-box">
                                <tbody>
                                    <tr>
                                        <th>Provider</th>
                                        <td>
                                            <input type="text" class="form-control" wire:model.lazy="provider">
                                        </td>

                                    </tr>
                                    <tr>
                                        <th>ServiceID</th>
                                        <td>
                                            <input type="text" class="form-control" wire:model.lazy="service_id">
                                        </td>

                                    </tr>
                                    <tr>
                                        <th>Category</th>
                                        <td>
                                            <input type="text" class="form-control" wire:model.lazy="category2">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Type</th>
                                        <td>

                                            <input type="text" list="typex" name="min" id="min"
                                                wire:model.lazy="type"
                                                placeholder="Masukkan Type Product | Primary,Custom Comments ..dll"
                                                class="form-control">
                                            <datalist id="typex">
                                                @php
                                                    $distinct = App\Models\Smm::distinct()->get('type');
                                                @endphp
                                                @foreach ($distinct as $row)
                                                    <option value="{{ $row->type }}">
                                                @endforeach
                                            </datalist>
                                            @error('min')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Name</th>
                                        <td>
                                            <input type="text" class="form-control" wire:model.lazy="name">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Harga/K</th>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp</span>
                                                </div>
                                                <input type="number" class="form-control" wire:model.lazy="price">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Min & Max</th>
                                        <td>
                                            <div class="row">
                                                <div class="col-md mt-2">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Min</span>
                                                        </div>
                                                        <input type="number" class="form-control"
                                                            wire:model.lazy="min">
                                                    </div>
                                                </div>
                                                <div class="col-md mt-2">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Max</span>
                                                        </div>
                                                        <input type="number" class="form-control"
                                                            wire:model.lazy="max">
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Description</th>
                                        <td>
                                            <textarea name="desk" id="desk" wire:model.lazy="description" class="form-control" cols="1"
                                                rows="3"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Average Time</th>
                                        <td>
                                            <input name="average_time" id="average_time"
                                                wire:model.lazy="average_time" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            <select wire:model.lazy="status" class="form-control">
                                                <option disabled>Pilih...</option>
                                                <option value="aktif">Aktif</option>
                                                <option value="nonaktif">Non aktif</option>
                                            </select>
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
    <div id="triggerdelete"></div>
</div>
<script>
    function DeleteLayanan(id) {
        // Swal confirm
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                $('#triggerdelete').data('id', id);
                $('#triggerdelete').click();
            }
        });
    }
</script>
@script
    <script>
        $('#category').change(function() {
            let value = $(this).val();
            $wire.set('category', value);
        });
        $('#triggerdelete').click(function() {
            let id = $(this).data('id');
            $wire.deleteLayanan(id);
        });
        $(document).ready(function() {
            function iformat(icon) {
                var originalOption = icon.element;
                // if (icon.text == 'Pilih...')
                // apabila option pertama maka jangan tampilakn icon.text
                if ($(originalOption).index() == 0) {
                    var ic = '';
                } else {
                    var ic = $(originalOption).data('icon');
                }
                return $('<span>' + ic + ' ' + icon.text + '</span>');
            }
            $('#category').select2({
                width: "100%",
                templateSelection: iformat,
                templateResult: iformat,
                allowHtml: true
            });
        });
        $('#addCategory').click(function() {
            let providers = $('#providers').val();
            let categorys = $('#categorys').val();
            let service_id_add = $('#service_id_add').val();
            let nologin = $('#nologin').val();
            $wire.addCategory(providers, categorys, service_id_add, nologin);
        });
        window.addEventListener('closeModal', event => {
            $('#modal').modal('hide');
        });
    </script>
@endscript
