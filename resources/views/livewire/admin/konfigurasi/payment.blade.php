<div>
    <style>
        .text-right {
            text-align: right;
        }

        .profile-tabs {
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 7px;
        }
    </style>
    @if ($errors->any())
        <div class="alert alert-danger">
            <div class="alert-body ">
                <i class="fas fa-times-circle me-2"></i>
                @foreach ($errors->all() as $error)
                    {{ $error }} <br>
                @endforeach
            </div>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger">
            <div class="alert-body ">
                <i class="fas fa-times-circle me-2"></i>
                {{ session('error') }}
            </div>
        </div>
    @endif
    @if (session()->has('success'))
        <div class="alert alert-success">
            <div class="alert-body ">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        </div>
    @endif
    <div class="card">
        <div class="card-body py-0">
            <ul class="nav nav-tabs profile-tabs " id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link {{ $tab == 'database' ? 'active' : '' }}"
                        wire:click="$set('tab','database')" id="database-tab" data-bs-toggle="tab" href="#database"
                        role="tab" aria-selected="true"><i class="fas fa-database me-2"></i>Database</a>
                </li>
                <li class="nav-item"><a class="nav-link {{ $tab == 'payment' ? 'active' : '' }}"
                        wire:click="$set('tab','payment')" id="payment-tab" data-bs-toggle="tab" href="#payment"
                        role="tab" aria-selected="true"><i class="fas fa-plus-square me-2"></i>Tambah metode</a>
                </li>
                <li class="nav-item"><a class="nav-link {{ $tab == 'bonus' ? 'active' : '' }}"
                        wire:click="$set('tab','bonus')" id="bonus-tab" data-bs-toggle="tab" href="#bonus"
                        role="tab" aria-selected="true"><i class="fas fa-plus me-2"></i>Tambah bonus</a>
                </li>
                <li class="nav-item"><a class="nav-link {{ $tab == 'provider' ? 'active' : '' }}"
                        wire:click="$set('tab','provider')" id="provider-tab" data-bs-toggle="tab" href="#provider"
                        role="tab" aria-selected="true"><i class="ti ti-barcode me-2"></i>Manage Provider</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane show {{ $tab == 'database' ? 'active' : '' }}" id="database" role="tabpanel"
                    aria-labelledby="database-tab">
                    <div class="row mt-3">
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
                        <div class="col-md-3" wire:ignore>
                            <select name="provider" id="provider" class="form-control select2" style="width:100%">
                                @php
                                    $provider = App\Models\MetodePembayaran::distinct()
                                        ->orderBy('provider', 'asc')
                                        ->get('provider');
                                @endphp
                                <option value="">Select Provider</option>
                                @foreach ($provider as $row)
                                    <option value="{{ $row->provider }}">{{ ucfirst($row->provider) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3" wire:ignore>
                            <select name="type" id="type" class="form-control select2" style="width:100%">
                                @php
                                    $type_payment = App\Models\MetodePembayaran::distinct()
                                        ->orderBy('type_payment', 'asc')
                                        ->get('type_payment');
                                @endphp
                                <option value="">Select Type</option>
                                @foreach ($type_payment as $row)
                                    <option value="{{ $row->type_payment }}">{{ ucfirst($row->type_payment) }}
                                    </option>
                                @endforeach
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
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>ID</th>
                                    <th>Provider</th>
                                    <th>Name METODE</th>
                                    <th>bonus deposit</th>
                                    <th>Rate</th>
                                    <th>Nonlogin</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($metode as $row)
                                    <tr>
                                        <td class="text-nowrap">{{ $loop->iteration }}</td>
                                        <td class="text-nowrap">
                                            <div class="kotak">
                                                <div class="label">Provider</div>
                                                <div class="value text-uppercase fw-bold text-info">
                                                    {{ ucfirst($row->provider) }}</div>
                                                <div class="label">Type Payment</div>
                                                <div class="value text-danger">{{ $row->type_payment }}</div>
                                                <div class="label">Type Proses</div>
                                                <div class="value text-secondary">{{ strtoupper($row->type_proses) }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-nowrap">
                                            {{ strtoupper($row->name) }}
                                        </td>
                                        <td class="text-nowrap">
                                            @if ($row->bonus)
                                                @php
                                                    $bonus = json_decode($row->bonus, true); // Decode data JSON
                                                @endphp

                                                @if (is_array($bonus))
                                                    @forelse ($bonus as $bon)
                                                        <span class="text-info">>=</span> Rp
                                                        {{ number_format($bon['min_nominal'], 0, ',', '.') }} (Bonus
                                                        {{ $bon['nominal'] }}%)
                                                        <br>
                                                    @empty
                                                        <span class="text-danger">No data</span>
                                                    @endforelse
                                                @else
                                                    <span class="text-danger">No data</span>
                                                @endif
                                            @else
                                                <span class="text-danger">No data</span>
                                            @endif
                                        </td>
                                        <td class="text-nowrap">
                                            <div class="kotak">
                                                <div class="label">Type</div>
                                                <div class="value text-primary">{{ strtoupper($row->rate_type) }}
                                                </div>
                                                <div class="label">Rate</div>
                                                <div class="value text-success">
                                                    @if ($row->rate_type == 'percent')
                                                        {{ $row->rate }}%
                                                    @else
                                                        Rp {{ number_format($row->rate, 0, ',', '.') }}
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            {!! $row->nologin == 1 ? '<span class="text-success">Ya</span>' : '<span class="text-danger">Tidak</span>' !!}
                                        </td>
                                        <td class="text-nowrap">
                                            <button class="btn btn-primary btn-sm"
                                                wire:click.prevent="edit('{{ $row->id }}')"
                                                data-bs-toggle="modal" data-bs-target="#modal"><i
                                                    class="ti ti-pencil me-1"></i>Edit</button>
                                            <button class="btn btn-danger btn-sm"
                                                onclick="deletePayment('{{ $row->id }}')"><i
                                                    class="ti ti-trash me-1"></i>Delete</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Data tidak ditemukan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $metode->links() }}
                </div>
                <div class="tab-pane show {{ $tab == 'payment' ? 'active' : '' }}" id="payment" role="tabpanel">
                    <form id="formadd">
                        <div class="row">
                            <div class="col-md">
                                <label class="form-label">Provider <span class="text-danger">*</span></label>
                                <input type="text" name="provider2" placeholder="Masukkan provider"
                                    id="provider2" class="form-control">
                                <small class="text-danger">Jika payment tanpa pihak ke 3, input
                                    *private*</small>
                            </div>
                            <div class="col-md">
                                <label class="form-label">Type <span class="text-danger">*</span></label>
                                <input type="text" name="type_payment" placeholder="Masukkan type"
                                    id="type_payment" class="form-control">
                            </div>
                            <div class="col-md">
                                <label class="form-label">Code Payment <span class="text-danger">*</span></label>
                                <input type="text" name="code" placeholder="Masukkan code payment"
                                    id="code" class="form-control">
                            </div>
                            <div class="col-md">
                                <label for="" class="form-label">Name Payment <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="name" placeholder="Masukkan nama payment"
                                    id="name" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-2 mb-3">
                            <div class="col-md">
                                <label for="" class="form-label">Rate Type<span
                                        class="text-danger">*</span></label>
                                <select class="form-control " id="rate_type">
                                    <option value="">Pilih Rate Type</option>
                                    <option value="percent">Persen</option>
                                    <option value="fixed">Fixed</option>
                                </select>
                            </div>
                            <div class="col-md">
                                <label for="" class="form-label">Rate<span
                                        class="text-danger">*</span></label>
                                <input type="number" name="rate" id="rate" placeholder="Masukkan rate"
                                    class="form-control">
                            </div>
                            <div class="col-md">
                                <label for="" class="form-label">Name Account<span
                                        class="text-danger">*</span></label>
                                <input type="text" name="account_name" id="account_name"
                                    placeholder="Masukkan Name Account" class="form-control">
                            </div>
                            <div class="col-md">
                                <label for="" class="form-label">Number Account<span
                                        class="text-danger">*</span></label>
                                <input type="text" name="account_number" id="account_number"
                                    placeholder="Masukkan Number Account" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <label for="" class="form-label">Type Proses<span
                                        class="text-danger">*</span></label>
                                <select class="form-control " id="type_proses">
                                    <option value="">Pilih Type Proses</option>
                                    <option value="otomatis">Otomatis</option>
                                    <option value="manual">Manual</option>
                                </select>
                            </div>
                            <div class="col-md">
                                <div class="mb-3">
                                    <label for="" class="form-label">Image</label>
                                    <div class="input-group mb-3"><input type="file" class="form-control"
                                            id="image_metode" wire:model="image_metode" name="image_metode"
                                            accept="image/png, image/jpg, image/webp, image/jpeg">
                                        <button class="btn btn-danger"
                                            onclick="resetInput('image_metode')">Reset</button>
                                    </div>
                                    @if ($image_metode)
                                        <img width="150" height="150" src="{{ $image_metode->temporaryUrl() }}"
                                            alt="Image" class="img-fluid">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="mb-3">
                                    <label for="" class="form-label">Min Deposit</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" name="min_deposit" id="min_deposit"
                                            placeholder="Masukkan Min Deposit" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="mb-3">
                                    <label for="" class="form-label">Max Deposit</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" name="max_deposit" id="max_deposit"
                                            placeholder="Masukkan Max Deposit" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="float-end mb-3">
                            <button class="btn btn-danger" type="reset">Reset</button>
                            <button class="btn btn-primary" type="button" id="addMetode">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane show {{ $tab == 'bonus' ? 'active' : '' }}" id="bonus" role="tabpanel"
                    aria-labelledby="bonus-tab">
                    <div class="mb-3" wire:ignore>
                        <label for="" class="form-label">Metode</label>
                        <select name="metode" id="metode" style="width:100%" class="form-control select2"
                            style="width:100%">
                            <option value="">Select metode</option>
                            @php
                                $metodePembayaran = App\Models\MetodePembayaran::distinct()
                                    ->orderBy('name', 'asc')
                                    ->get(); // Ambil semua kolom dari tabel metode_pembayaran
                            @endphp

                            @forelse ($metodePembayaran as $metode)
                                <option value="{{ $metode->id }}">{{ $metode->name }}</option>
                            @empty
                                <option value="">No data</option>
                            @endforelse
                        </select>
                    </div>
                    @if (!$metod)
                        <div class="alert alert-primary">
                            <div class="alert-body text-center">
                                <i class="fas fa-info-circle me-2"></i>
                                Pilih metode terlebih dahulu
                            </div>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th>Min nominal</th>
                                        <th>Bonus</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $metods = App\Models\MetodePembayaran::find($metod);
                                        if ($metods) {
                                            $bonus = json_decode($metods->bonus, true); // Decode data JSON
                                        } else {
                                            $bonus = null;
                                        }
                                    @endphp
                                    @if (is_array($bonus))
                                        @forelse ($bonus as $key => $bon)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>Rp {{ number_format($bon['min_nominal'], 0, ',', '.') }}</td>
                                                <td>{{ $bon['nominal'] }}% </td>
                                                <td class="text-center">
                                                    <div class="text-danger"><i class="fa-solid fa-xmark"
                                                            title="Delete"
                                                            onclick="deleteBonus('{{ $key }}')"
                                                            style="cursor: pointer"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Data tidak ditemukan</td>
                                            </tr>
                                        @endforelse
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center">Data tidak ditemukan</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <form wire:submit.prevent="addbonus">
                            <div class="row mb-3">
                                <div class="col-md">
                                    <label for="" class="form-label">Minimal deposit</label>
                                    <input type="number" class="form-control" wire:model.lazy="min_nominal"
                                        name="min_nominal" id="min_nominal" placeholder="Minimal deposit">
                                </div>
                                <div class="col-md">
                                    <label for="" class="form-label">Bonus</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" wire:model.lazy="bonus"
                                            name="bonus" id="bonus" placeholder="Bonus">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 float-end">
                                <button type="submit" class="btn btn-primary float-end">Tambah data</button>
                            </div>
                        </form>
                    @endif
                </div>
                <div class="tab-pane show {{ $tab == 'provider' ? 'active' : '' }}" id="provider" role="tabpanel">
                    <div class="mb-3" wire:ignore>
                        <label for="" class="form-label">Provider</label>
                        <select name="provider_payment" id="provider_payment" class="form-control select2"
                            style="width: 100% !important">
                            @php
                                $decode = json_decode($config->provider_payment);
                            @endphp
                            <option value="">Select Provider</option>
                            @foreach ($decode as $key => $value)
                                <option value="{{ $key }}">{{ ucfirst($key) }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if (!$provider_payment)
                        <div class="alert alert-danger">
                            <div class="alert-body text-center">
                                <i class="fas fa-info-circle me-2"></i>
                                Pilih provider terlebih dahulu
                            </div>
                        </div>
                    @endif
                    <div class="row mb-3 {{ $provider_payment == null ? 'd-none' : '' }}">
                        @if (isset($decode->$provider_payment))
                            @foreach ($decode->$provider_payment as $key => $value)
                                @php
                                    $replace = str_replace('_', ' ', $key);
                                @endphp
                                <div class="col-md">
                                    <label for="" class="form-label">{{ ucfirst($replace) }}</label>
                                    <input type="text" name="{{ $key }}" id="{{ $key }}"
                                        value="{{ $value }}" class="form-control">
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="float-end mb-3">
                        <button id="clickProvider" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="idbonus"></div>
    <div id="triggerDelete"></div>
    <script>
        function deleteBonus(key) {
            $('#idbonus').data('key', key);
            $('#idbonus').click();
        }

        function deletePayment(id) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#triggerDelete').data('id', id);
                    $('#triggerDelete').click();
                }
            })
        }
    </script>
</div>
@script
    <script>
        $('#provider_payment').change(function() {
            let value = $(this).val();
            $wire.set('provider_payment', value);
        });
        $('#clickProvider').click(function() {
            let api_key = $('#api_key').val();
            let api_id = $('#api_id').val();
            let merchant_id = $('#merchant_id').val();
            let private_key = $('#private_key').val();
            let merchant_code = $('#merchant_code').val();
            $wire.saveProvider(api_key, private_key, api_id, merchant_id, merchant_code);
        });

        $('#metode').change(function() {
            let value = $(this).val();
            $wire.set('metod', value);
        });
        $('#resetimage').click(function() {
            $('#image_metode').val('');
            $wire.set('image_metode', null);
        });
        $('#triggerDelete').click(function() {
            let id = $(this).data('id');
            $wire.delete(id);
        });
        $('#addMetode').click(function() {
            let provider = $('#provider2').val();
            let code = $('#code').val();
            let type_payment = $('#type_payment').val();
            let name = $('#name').val();
            let rate_type = $('#rate_type').val();
            let rate = $('#rate').val();
            let account_name = $('#account_name').val();
            let account_number = $('#account_number').val();
            let type_proses = $('#type_proses').val();
            let min_deposit = $('#min_deposit').val();
            let max_deposit = $('#max_deposit').val();
            if (!provider || !code || !type_payment || !name || !rate_type || !rate || !account_name || !
                account_number || !min_deposit || !max_deposit || !type_proses) {
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Semua kolom harus diisi',
                    icon: 'error',
                });
                return;
            }
            $wire.addMetode(provider, type_payment, code, name, rate_type, rate, account_name,
                account_number, min_deposit,
                max_deposit, type_proses);
        });
        $('#provider').change(function() {
            let value = $(this).val();
            $wire.set('provider', value);
        });

        $('#type').change(function() {
            let value = $(this).val();
            $wire.set('type_payment', value);
        });
        $('#idbonus').click(function() {
            let key = $(this).data('key');

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $wire.deleteBonus(key);
                }
            });
        });
        window.addEventListener('swal:modal', event => {
            $('.modal').modal('hide');
            Swal.fire({
                title: event.detail[0].title,
                text: event.detail[0].text,
                icon: event.detail[0].type,
            });
        });
        window.addEventListener('resetform', event => {
            $('#formadd').trigger('reset');
        });
        $('#btnEdit').click(function() {
            $wire.SaveEdit();
        });
    </script>
@endscript
