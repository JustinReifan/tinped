<div>
    <style>
        .w-75 {
            width: 75px;
        }
    </style>
    <div class="card">
        <div class="card-body py-0">
            <ul class="nav nav-tabs profile-tabs mb-3" id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link {{ $tab == 'provider' ? 'active' : '' }}"
                        wire:click="$set('tab','provider')" id="provider-tab" data-bs-toggle="tab" href="#provider"
                        role="tab" aria-selected="true"><i class="fas fa-fire me-2"></i>Provider</a>
                </li>
                <li class="nav-item"><a class="nav-link {{ $tab == 'addprovider' ? 'active' : '' }}"
                        wire:click="$set('tab','addprovider')" id="addprovider-tab" data-bs-toggle="tab"
                        href="#addprovider" role="tab" aria-selected="true"><i
                            class="fas fa-plus-square me-2"></i>Tambah Provider</a>
                </li>
                <li class="nav-item"><a class="nav-link {{ $tab == 'konfigdatabase' ? 'active' : '' }}"
                        wire:click="$set('tab','konfigdatabase')" id="konfigdatabase-tab" data-bs-toggle="tab"
                        href="#konfigdatabase" role="tab" aria-selected="true"><i
                            class="ti ti-database me-2"></i>Konfigurasi Database</a>
                </li>
                <li class="nav-item"><a class="nav-link {{ $tab == 'replace' ? 'active' : '' }}"
                        wire:click="$set('tab','replace')" id="replace-tab" data-bs-toggle="tab" href="#replace"
                        role="tab" aria-selected="true"><i class="ti ti-exchange me-2"></i>Replace Text</a>
                </li>
                <li class="nav-item"><a class="nav-link {{ $tab == 'custom_packages' ? 'active' : '' }}"
                        wire:click="$set('tab','custom_packages')" id="custom_packages-tab" data-bs-toggle="tab"
                        href="#custom_packages" role="tab" aria-selected="true"><i
                            class="ti ti-exchange me-2"></i>Custom packages</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane show {{ $tab == 'provider' ? 'active' : '' }}" id="provider" role="tabpanel"
                    aria-labelledby="provider-tab">
                    <div class="table-responsive mt-3">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NAMA</th>
                                    <th>TAX</th>
                                    <th>Profit</th>
                                    <th>Sisa saldo</th>
                                    <th>Replace Text</th>
                                    <th>Auto delete / Update </th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>

                            </thead>
                            <tbody>
                                @forelse ($providers as $row)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $row->nama }}</td>
                                        <td>
                                            <div class="kotak">
                                                <div class="label">CURRENCY</div>
                                                <div
                                                    class="value fw-bold text-uppercase {{ $row->currency == 'idr' ? 'text-success' : 'text-success' }}">
                                                    {{ $row->currency }}</div>
                                                <div class="label">
                                                    RATE</div>
                                                <div class="value text-danger">Rp
                                                    {{ number_format($row->rate, 0, ',', '.') }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-primary"
                                                onclick="setting_profit('{{ $row->id }}')" data-bs-toggle="modal"
                                                data-bs-target="#modals">Manage profit</button>
                                        </td>
                                        <td>
                                            @if ($row->currency == 'usd')
                                                ${{ number_format($row->balance, 2, ',', '.') }}
                                            @else
                                                Rp {{ number_format($row->balance * $row->rate, 0, ',', '.') }}
                                            @endif
                                        </td>
                                        <td class="text-nowrap fw-bold">
                                            @if ($row->replace_text)
                                                @php
                                                    $replace = json_decode($row->replace_text, true); // Decode data JSON
                                                @endphp

                                                @if (is_array($replace))
                                                    @forelse ($replace as $rp)
                                                        <span class="text-info">>=</span> {{ $rp['text'] }} <span
                                                            class="text-primary">=></span> {{ $rp['replace'] }}<br>
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
                                        @if (Illuminate\Support\Facades\Schema::hasColumn('providers', 'auto_delete'))
                                            <td>
                                                <div class="btn-group-dropdown">
                                                    <button type="button"
                                                        class="btn btn-outline-{{ $row->auto_delete == '1' ? 'success' : 'warning' }} btn-sm dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        {{ ucfirst($row->auto_delete == '1' ? 'Aktif' : 'Nonaktif') }}
                                                    </button>
                                                    <ul class="dropdown-menu" style="cursor:pointer">
                                                        <li>
                                                            <a class="dropdown-item @if ($row->status == '1') d-none @endif"
                                                                href="javascript:void(0)"
                                                                onclick="ubahAutoDelete('1','{{ $row->id }}')">Aktif</a>
                                                        </li>
                                                        <li><a class="dropdown-item @if ($row->status == '0') d-none @endif"
                                                                href="javascript:void(0)"
                                                                onclick="ubahAutoDelete('0','{{ $row->id }}')">Nonaktif</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        @endif
                                        <td>
                                            <div class="btn-group-dropdown">
                                                <button type="button"
                                                    class="btn btn-outline-{{ $row->status == 'aktif' ? 'success' : 'danger' }} btn-sm dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    {{ ucfirst($row->status) }}
                                                </button>
                                                <ul class="dropdown-menu" style="cursor:pointer">
                                                    <li>
                                                        <a class="dropdown-item @if ($row->status == 'aktif') d-none @endif"
                                                            href="javascript:void(0)"
                                                            onclick="ubahStatus('aktif','{{ $row->id }}')">Aktif</a>
                                                    </li>
                                                    <li><a class="dropdown-item @if ($row->status == 'nonaktif') d-none @endif"
                                                            href="javascript:void(0)"
                                                            onclick="ubahStatus('nonaktif','{{ $row->id }}')">Nonaktif</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td class="text-center ">
                                            <button class="btn btn-sm btn-success bg-gradient  mb-1 text-nowrap"
                                                onclick="CekSaldo('{{ $row->id }}')"><i
                                                    class="fas fa-credit-card me-2"></i>Cek saldo</button>
                                            <button class="btn btn-sm btn-warning bg-gradient  mb-1 text-nowrap"
                                                data-bs-toggle="modal" data-bs-target="#modals"
                                                onclick="edit('{{ $row->id }}')"><i
                                                    class="fa-solid fa-pen-to-square me-2"></i>Edit</button>
                                            <button class="btn btn-sm btn-danger bg-gradient  mb-1 text-nowrap"
                                                onclick="deleteProvider('{{ $row->id }}')"><i
                                                    class="fa-solid fa-trash-can me-1"></i>Hapus</button>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Data tidak ditemukan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane show {{ $tab == 'addprovider' ? 'active' : '' }}" id="addprovider"
                    role="tabpanel" aria-labelledby="addprovider-tab">
                    <form id="addProvider">
                        <label class="fw-bold">Proses Manual?</label>
                        <div class="form-check mb-3">
                            <input class="form-check-input input-primary" type="checkbox" id="ProsesManual"
                                name="manual">
                            <label class="form-check-label " for="ProsesManual">Manual</label>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md">
                                <label for="" class="form-label">Nama Provider</label>
                                <input type="text" class="form-control" placeholder="Masukkan nama provider"
                                    id="nama_provider">
                            </div>
                            <div class="col-md" wire:ignore>
                                <label for="" class="form-label">Mata Uang</label>
                                <select class="form-select select2" style="width:100%" id="mata_uang">
                                    <option value="">Pilih mata uang</option>
                                    <option value="idr">IDR</option>
                                    <option value="usd">USD</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md">
                                <label for="" class="form-label">Rate</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                    <input type="text" class="form-control" placeholder="Masukkan rate"
                                        value="1" id="rate">
                                </div>
                            </div>
                            <div class="col-md">
                                <label for="" class="form-label">Sisa Saldo</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                    <input type="text" class="form-control" placeholder="Masukkan sisa saldo"
                                        value="0" id="sisa_saldo">
                                </div>
                            </div>
                            <div class="col-md" wire:ignore>
                                <div>
                                    <label for="" class="form-label">Status</label>
                                    <select class="form-select select2" style="width:100%" id="stat">
                                        <option value="">Pilih status</option>
                                        <option value="aktif">Aktif</option>
                                        <option value="nonaktif">Nonaktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="float-end mb-3 mt-3">
                            <button class="btn btn-primary" type="button" id="btnsave">Simpan</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane show {{ $tab == 'konfigdatabase' ? 'active' : '' }}" id="konfigdatabase"
                    role="tabpanel" aria-labelledby="konfigdatabase-tab">
                    <div class="mb-3" wire:ignore>
                        <label for="" class="form-label">Provider</label>
                        <select class="form-select select2" style="width:100%" id="selectprovider"
                            name="selectprovider">
                            <option value="">Pilih provider</option>
                            @forelse ($providers as $row)
                                <option value="{{ $row->id }}">{{ $row->nama }}</option>
                            @empty
                                <option value="">Data tidak ditemukan</option>
                            @endforelse
                        </select>
                    </div>
                    <div id="setting">

                        <div class="alert alert-danger" role="alert">
                            <div class="alert-body text-center">
                                <i class="fa-solid fa-exclamation-triangle me-1"></i> Pilih provider terlebih
                                dahulu
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane show {{ $tab == 'replace' ? 'active' : '' }}" id="replace" role="tabpanel"
                    aria-labelledby="replace-tab">
                    <div class="mb-3" wire:ignore>
                        <label for="" class="form-label">Provider</label>
                        <select class="form-select select2" style="width:100%" id="exchangeprovider"
                            name="exchangeprovider">
                            <option value="">Pilih provider</option>
                            @forelse ($providers as $row)
                                <option value="{{ $row->id }}">{{ $row->nama }}</option>
                            @empty
                                <option value="">Data tidak ditemukan</option>
                            @endforelse
                        </select>
                    </div>
                    @if (!$provider_exchange)
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
                                        <th>Original text</th>
                                        <th>Replace text</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $provider = App\Models\Provider::find($provider_exchange);
                                        if ($provider) {
                                            $replace = json_decode($provider->replace_text, true); // Decode data JSON
                                        } else {
                                            $replace = null;
                                        }
                                    @endphp
                                    @if (is_array($replace))
                                        @forelse ($replace as $key => $rp)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $rp['text'] }}</td>
                                                <td>{{ $rp['replace'] }} </td>
                                                <td class="text-center">
                                                    <div class="text-danger"><i class="fa-solid fa-xmark"
                                                            title="Delete"
                                                            onclick="deleteReplace('{{ $key }}')"
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
                        <form wire:submit.prevent="addReplace">
                            <div class="row mb-3">
                                <div class="col-md">
                                    <label for="" class="form-label">Original text</label>
                                    <input type="text" class="form-control" wire:model.lazy="original_text"
                                        name="original_text" id="original_text" placeholder="Minimal deposit">
                                </div>
                                <div class="col-md">
                                    <label for="" class="form-label">Replace Text</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" wire:model.lazy="replace_text"
                                            name="replace_text" id="replace_text" placeholder="Replace Text">
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
            </div>
        </div>
    </div>
    <div id="triggerdelete"></div>
    <div id="triggerStatus"></div>
    <div id="triggerAutoDelete"></div>
    <div id="triggerSaldo"></div>
    <div id="triggerdeleteExchange"></div>
</div>
<script>
    window.addEventListener('swal:modal', event => {
        let detail = event.detail[0];
        Swal.fire({
            title: detail.title,
            text: detail.text,
            icon: detail.type,
        });
        if (detail.reset) {
            $('#addProvider').trigger('reset');
        }
    });

    function deleteReplace(key) {
        $('#triggerdeleteExchange').data('key', key);
        $('#triggerdeleteExchange').click();
    }

    function ubahStatus(status, id) {
        Swal.fire({
            title: 'Loading',
            html: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading()
            },
        });
        $('#triggerStatus').data('status', status);
        $('#triggerStatus').data('id', id);
        $('#triggerStatus').click();
    }

    function ubahAutoDelete(status, id) {
        Swal.fire({
            title: 'Loading',
            html: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading()
            },
        });
        $('#triggerAutoDelete').data('status', status);
        $('#triggerAutoDelete').data('id', id);
        $('#triggerAutoDelete').click();
    }

    function CekSaldo(id) {
        Swal.fire({
            title: 'Loading',
            html: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading()
            },
        });
        $('#triggerSaldo').data('id', id);
        $('#triggerSaldo').click();
    }

    function deleteProvider(id) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: 'Data yang dihapus tidak dapat dikembalikan',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#triggerdelete').data('id', id);
                $('#triggerdelete').click();
            }
        });

    }
</script>
<script>
    function edit(id) {
        $.ajax({
            url: "{{ url('admin/konfigurasi/edit-provider') }}",
            dataType: "json",
            type: "POST",
            data: {
                id: id,
                _token: "{{ csrf_token() }}"
            },
            success: function(data) {
                if (data.status) {
                    $('#title').html('Edit Provider');
                    $('#content').html(data.html);
                } else {
                    $('#modals').modal('hide');
                    Swal.fire({
                        title: "Gagal",
                        text: "Gagal mengambil data",
                        icon: "error"
                    });
                }
            },
            error: function() {
                $('#modals').modal('hide');
                Swal.fire({
                    title: "Gagal",
                    text: "Gagal mengambil data",
                    icon: "error"
                });
            }
        });
    }

    function setting_profit(id) {
        $.ajax({
            url: "{{ url('admin/konfigurasi/setting-profit') }}",
            dataType: "json",
            type: "POST",
            data: {
                id: id,
                _token: "{{ csrf_token() }}"
            },
            success: function(data) {
                if (data.status) {
                    $('#title').html('Edit Profit');
                    $('#content').html(data.html);
                } else {
                    $('#modals').modal('hide');
                    Swal.fire({
                        title: "Gagal",
                        text: "Gagal mengambil data",
                        icon: "error"
                    });
                }
            },
            error: function() {
                $('#modals').modal('hide');
                Swal.fire({
                    title: "Gagal",
                    text: "Gagal mengambil data",
                    icon: "error"
                });
            }
        });
    }
</script>
@script
    <script>
        $('#btnsave').click(function() {
            let manual = $('#ProsesManual').is(':checked') ? '1' : '0';
            let nama_provider = $('#nama_provider').val();
            let mata_uang = $('#mata_uang').val();
            let rate = $('#rate').val();
            let sisa_saldo = $('#sisa_saldo').val();
            let stat = $('#stat').val();
            $wire.addProvider(manual, nama_provider, mata_uang, rate, sisa_saldo, stat);
        });
        $('#triggerdelete').click(function() {
            let id = $(this).data('id');
            $wire.deleteProvider(id);
        });
        $('#triggerStatus').click(function() {
            let id = $(this).data('id');
            let status = $(this).data('status');
            $wire.ubahStatus(id, status);
        });
        $('#triggerSaldo').click(function() {
            let id = $(this).data('id');
            $wire.cekSaldo(id);
        });
        $('#triggerAutoDelete').click(function() {
            let id = $(this).data('id');
            let status = $(this).data('status');
            $wire.ubahAutoDelete(status, id);
        });
        $('#selectprovider').change(function() {
            $.ajax({
                url: "{{ url('admin/konfigurasi/get-setting') }}",
                dataType: "json",
                type: "POST",
                data: {
                    id: $(this).val(),
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    if (data.status) {
                        $('#setting').html(data.html);
                    } else {
                        $('#setting').html(
                            '<div class="alert alert-danger" role="alert"><div class="alert-body text-center"><i class="fa-solid fa-exclamation-triangle me-1"></i> Data tidak ditemukan</div></div>'
                        );
                    }
                },
                error: function() {
                    $('#setting').html(
                        '<div class="alert alert-danger" role="alert"><div class="alert-body text-center"><i class="fa-solid fa-exclamation-triangle me-1"></i> Data tidak ditemukan</div></div>'
                    );
                }
            })
        });

        $('#triggerdeleteExchange').click(function() {
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
                    $wire.deleteReplace(key);
                }
            });
        });
        $('#exchangeprovider').change(function() {
            $wire.set('provider_exchange', $(this).val());
        });
    </script>
@endscript
