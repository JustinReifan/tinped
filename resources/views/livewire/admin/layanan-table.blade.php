<div>
    <div class="row">
        <div class="col-md-!2">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {!! session()->get('success') !!}
                    <button type="button" class="btn-close" wire:click="RemoveSession" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ session()->get('error') }}
                    <button type="button" wire:click="RemoveSession" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            @endif
            @if ($errors->all())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }} </li>
                    @endforeach
                    <button type="button" class="btn-close" wire:click="RemoveSession" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            @endif
            <div class="card">
                <div class="card-header fw-bold p-3 text-xss"><i class="mdi mdi-message-draw"></i>Tambah Layanan
                    <div class="float-end" style="cursor: pointer;">
                        <i class="mdi mdi-arrow-down"></i>
                    </div>
                    </h5>
                    <div class="card-body" id="card-toggle">
                        <form wire:submit.prevent="savednews">
                            <div class="row">
                                <div class="col-md">
                                    <label class="form-label">Provider<span class="text-danger">*</span></label>
                                    <input type="text" name="service_id" placeholder="Masukkan Provider"
                                        wire:model.lazy="provider" id="provider" class="form-control">
                                    @error('provider')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md">
                                    <label class="form-label">Service ID<span class="text-danger">*</span></label>
                                    <input type="text" name="service_id" placeholder="Masukkan Service ID"
                                        wire:model.lazy="service_id" id="service_id" class="form-control">
                                    @error('service_id')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md">
                                    <label class="form-label">Category<span class="text-danger">*</span></label>
                                    <input type="text" name="category" placeholder="Masukkan code payment"
                                        wire:model.lazy="category" id="category" class="form-control">
                                    @error('category')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md">
                                    <label class="form-label">Nama Layanan <span class="text-danger">*</span></label>
                                    <input type="text" name="name" placeholder="Masukkan name layanan"
                                        wire:model.lazy="name" id="name" class="form-control">
                                    @error('name')
                                        <span class="error">{{ $message }}</span>
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
                                        <span class="error">{{ $message }}</span>
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
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md">
                                    <label for="" class="form-label">Min<span
                                            class="text-danger">*</span></label>
                                    <input type="number" name="min" id="min" wire:model.lazy="min"
                                        placeholder="Masukkan min transaksi" class="form-control">
                                    @error('min')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md">
                                    <label for="" class="form-label">Max<span
                                            class="text-danger">*</span></label>
                                    <input type="number" name="max" id="max" wire:model.lazy="max"
                                        placeholder="Masukkan max transaksi" class="form-control">
                                    @error('max')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <label for="" class="form-label mt-2">Description<span
                                    class="text-danger">*</span></label>
                            <textarea name="description" placeholder="Masukkan deskripsi" id="description" wire:model.lazy="description"
                                class="form-control" cols="30" rows="2"></textarea>
                            @error('description')
                                <span class="error">{{ $message }}</span>
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
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="btn-group flex-wrap">
                            <button wire:click="all" class="btn btn-primary" id="filter">Semua</button>
                            <button wire:click="refill" class="btn btn-primary " id="filter">Refill</button>
                            <button wire:click="custom_comments" class="btn btn-primary " id="filter">Custom
                                Comments</button>
                            <button wire:click="custom_link" class="btn btn-primary " id="filter">Custom
                                Link</button>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header fw-bold p-3 text-xss"><i class="mdi mdi-history me-1"></i>All Layanan</h5>
                        <div class="card-body">
                            <form method="get" class="row">
                                <div class="col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Tampilkan</span>
                                        </div>
                                        <select wire:model.change="perPage" class="form-control" name="row"
                                            id="table-row">
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
                                        <input type="text" wire:model.live.debounce.300ms="search"
                                            class="form-control" name="search" id="table-search" value=""
                                            placeholder="Cari...">
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr class="text-uppercase">
                                            <th class="text-center" rowspan="2" style="vertical-align:middle">
                                                Provider
                                            </th>
                                            <th class="text-center" rowspan="2" style="vertical-align:middle">SID
                                            </th>
                                            <th class="text-center" rowspan="2" style="vertical-align:middle">
                                                Category
                                            </th>
                                            <th class="text-center" rowspan="2" style="vertical-align:middle">Nama
                                                Layanan
                                            </th>
                                            <th class="text-center" rowspan="2" style="vertical-align:middle">
                                                Description
                                            </th>
                                            <th class="text-center" rowspan="2" style="vertical-align:middle">Type
                                            </th>
                                            <th class="text-center" colspan="3" style="vertical-align:middle">
                                                Detail
                                            </th>
                                            <th class="text-center" rowspan="2" style="vertical-align:middle">Aksi
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">HARGA/1000</th>
                                            <th class="text-center">Min</th>
                                            <th class="text-center">Max</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($layanan->count() > 0)
                                            @foreach ($layanan as $row)
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
                                                    <td>{{ Str::ucfirst($row->provider) }}</td>
                                                    <td>{{ $row->service }}</td>
                                                    <td>{{ $row->category }}</td>
                                                    <td>{{ $row->name }}</td>
                                                    <td>
                                                        <textarea rows="3" class="form-control" readonly>{{ trim($row->description) }}</textarea>
                                                    </td>
                                                    <td>{{ $row->type }}</td>
                                                    <td>{{ number_format($row->price, 0, ',', '.') }}</td>
                                                    <td>{{ number_format($row->min, 0, ',', '.') }}</td>
                                                    <td>{{ number_format($row->max, 0, ',', '.') }}</td>
                                                    <td class="text-nowrap">
                                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#modal"
                                                            wire:click="editProduct('{{ $row->id }}')">Edit</button>
                                                        <button class="btn btn-danger btn-sm"
                                                            wire:click.prevent="deleteLayanan({{ $row->service }})">Delete</button>
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
                                {!! $layanan->links() !!}
                            </div>
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form wire:submit.prevent="editProducts">
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-box">
                                        <tbody>
                                            <tr>
                                                <th>Provider</th>
                                                <td>
                                                    <input type="text" class="form-control"
                                                        wire:model="providerd">
                                                </td>

                                            </tr>
                                            <tr>
                                                <th>ServiceID</th>
                                                <td>
                                                    <input type="text" class="form-control"
                                                        wire:model="service_idd">
                                                </td>

                                            </tr>
                                            <tr>
                                                <th>Category</th>
                                                <td>
                                                    <input type="text" class="form-control"
                                                        wire:model="categoryd">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Type</th>
                                                <td>

                                                    <input type="text" list="typex" name="min"
                                                        id="min" wire:model.lazy="typed"
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
                                                        <span class="error">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Name</th>
                                                <td>
                                                    <input type="text" class="form-control" wire:model="named">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Description</th>
                                                <td>
                                                    <textarea name="desk" id="desk" wire:model="descriptiond" class="form-control" cols="1"
                                                        rows="3"></textarea>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">Save
                                    changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
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
                        Livewire.emit('deleteLayanan')
                    }
                })
            });
            window.addEventListener('deleted', event => {
                Swal.fire(
                    'Gagal!',
                    'Data Berhasil Dihapus',
                    'success'
                )
            });
            window.addEventListener('success', event => {
                $('#modal').modal('hide');
                Swal.fire(
                    'Berhasil!',
                    event.detail[0].message,
                    'success'
                )
            });
            window.addEventListener('failed', event => {
                Swal.fire(
                    'Gagal!',
                    event.detail[0].message,
                    'error'
                )
            });
        </script>
