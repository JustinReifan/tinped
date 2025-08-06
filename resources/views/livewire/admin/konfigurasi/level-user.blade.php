<div>
    <style>
        @media (max-width: 768px) {

            /* Atau ukuran layar yang Anda inginkan */
            .input-group {
                flex-wrap: wrap;
            }

            .input-group .form-control,
            .input-group .btn {
                width: 100%;
                margin-bottom: 5px;
            }
        }
    </style>
    <div class="card">
        <div class="card-body py-0">
            <ul class="nav nav-tabs profile-tabs " id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link {{ $tab == 'database' ? 'active' : '' }}"
                        wire:click="$set('tab','database')" id="database-tab" data-bs-toggle="tab" href="#database"
                        role="tab" aria-selected="true"><i class="fas fa-database me-2"></i>Database</a>
                </li>
                <li class="nav-item"><a class="nav-link {{ $tab == 'tambah' ? 'active' : '' }}"
                        wire:click="$set('tab','tambah')" id="tambah-tab" data-bs-toggle="tab" href="#tambah"
                        role="tab" aria-selected="true"><i class="fas fa-plus me-2"></i>Tambah level</a>
                </li>
            </ul>
            <hr>
            <div class="tab-content mb-3">
                <div class="tab-pane show {{ $tab == 'database' ? 'active' : '' }}" id="database" role="tabpanel"
                    aria-labelledby="database-tab">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th>Level</th>
                                    <th>Min Pembelian</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $level = App\Models\LevelUser::all();
                                    $level = $level->sortByDesc(function ($row) {
                                        return $row->default;
                                    });
                                @endphp
                                @forelse ($level as $row)
                                    <tr>
                                        <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                        <td class="text-uppercase fw-bold ">{{ $row->name }} @if ($row->default == '1')
                                                (<span class="text-info">DEFAULT USER</span>)
                                            @endif
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp.</span>
                                                <input type="text" class="form-control "
                                                    value="{{ $row->min_pembelian }}" id="min_{{ $row->id }}"
                                                    aria-label="Amount (to the nearest dollar)">
                                                <button onclick="saveMin('{{ $row->id }}')"
                                                    class="btn btn-sm btn-primary">Save</button>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @if ($row->default == '1')
                                                <button class="btn btn-sm btn-success" disabled>Set Default</button>
                                            @else
                                                <button class="btn btn-sm btn-success"
                                                    wire:click="setDefault('{{ $row->id }}')">Set
                                                    Default</button>
                                            @endif
                                            <button class="btn btn-sm btn-primary"
                                                onclick="edit('{{ $row->id }}')">Edit</button>
                                            <button class="btn btn-sm btn-danger"
                                                onclick="deleteLevel('{{ $row->id }}')">Delete</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Data tidak ditemukan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane show {{ $tab == 'tambah' ? 'active' : '' }}" id="tambah" role="tabpanel"
                    aria-labelledby="tambah-tab">
                    <div class="row mb-2">
                        <div class="col-md">
                            <label for="" class="form-label">Level</label>
                            <input type="text" class="form-control" placeholder="Masukkan level" name="level"
                                id="level">
                        </div>
                        <div class="col-md" wire:ignore>
                            <label for="" class="form-label">Default</label>
                            <select name="default" id="default" style="width:100%" class="form-select select2">
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                        </div>
                        <div class="col-md">
                            <label for="" class="form-label">Min Pembelian</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input type="text" class="form-control" placeholder="Masukkan min pembelian"
                                    name="min_pembelian" id="min_pembelian" aria-label="Amount (to the nearest dollar)">
                            </div>
                        </div>
                    </div>
                    <div class="float-end">
                        <button class="btn btn-primary" id="addlevel">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="triggerEdit"></div>
    <div id="triggerSave"></div>
    <div id="triggerDelete"></div>
    <script>
        function edit(id) {
            $('#triggerEdit').data('id', id);
            $('#triggerEdit').click();
        }

        function saveMin(id) {
            var min = $('#min_' + id).val();
            $('#triggerSave').data('id', id);
            $('#triggerSave').click();
        }

        function deleteLevel(id) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
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
        window.addEventListener('swal:modal', event => {
            let detail = event.detail[0];
            Swal.fire({
                title: detail.title,
                text: detail.text,
                icon: detail.type,
            });
            if (detail.reset) {
                $('#level').val('');
                $('#min_pembelian').val('');
                $('#default').val('0');
            }
        });
        $('#triggerEdit').click(function() {
            var id = $(this).data('id');

            const {
                value: name
            } = Swal.fire({
                title: "Masukkan nama level baru",
                input: "text",
                showCancelButton: true,
                inputValidator: (value) => {
                    if (!value) {
                        return "You need to write something!";
                    } else {
                        $wire.edit(id, value);
                    }
                }
            });
        });
        $('#triggerSave').click(function() {
            var id = $(this).data('id');
            var min = $('#min_' + id).val();
            $wire.saveMin(id, min);
        });
        $('#triggerDelete').click(function() {
            var id = $(this).data('id');
            $wire.deleteLevel(id);
        });
        $('#addlevel').click(function() {
            var level = $('#level').val();
            var default_level = $('#default').val();
            var min_pembelian = $('#min_pembelian').val();
            $wire.addLevel(level, default_level, min_pembelian);
        });
    </script>
@endscript
