<div>
    <style>
        .ck-content {
            max-height: 450px;
            /* Atur tinggi maksimum sesuai kebutuhan */
            overflow-y: auto;
            /* Aktifkan scrollbar vertikal jika konten melebihi tinggi maksimum */
        }
    </style>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header fw-bold p-3 text-xss">
                    <i class="fas fa-exclamation-circle me-1"></i>Terms Of Service Referral
                </div>
                <div class="card-body" wire:ignore>
                    <textarea id="classic-editor">
                                {!! isset($config->tos_referral) ? $config->tos_referral : '' !!}
                            </textarea>
                    <div class="d-grid">
                        <button id="btnTos"class="btn btn-primary mt-3"><i class="fas fa-save me-2"></i>Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card">
                <div class="card-header fw-bold p-3 text-xss"><i class="fas fa-cogs me-2"></i>Konfigurasi</div>
                <div class="card-body">
                    <label for="" class="form-label">Rate Withdraw</label>
                    <div class="input-group mb-3">
                        <input type="text" name="rate_withdraw" value="{{ $config->rate_withdraw }}"
                            id="rate_withdraw" class="form-control">
                        <button onclick="setrate()" class="btn btn-primary"><i
                                class="fas fa-save me-2"></i>Simpan</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Level</th>
                                    <th>Type Komisi</th>
                                    <th>Nominal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($konfigurasi as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="fw-bold">{{ strtoupper($row->level) }}</td>
                                        <td class="fw-bold">{{ ucfirst($row->type_komisi) }}</td>
                                        <td>{{ $row->value }}</td>
                                        <td>
                                            <button onclick="deleteConfig('{{ $row->id }}')"
                                                class="btn btn-sm btn-danger"><i
                                                    class="fas fa-trash me-2"></i>Delete</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Data tidak ditemukan
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $konfigurasi->links() }}
                    <div class="row mt-3">
                        <div class="col-md">
                            <label for="" class="form-label">Level</label>
                            <input type="text" name="level" wire:model.lazy="level"
                                placeholder="Masukkan level referral" id="level" class="form-control">
                        </div>
                        <div class="col-md">
                            <label for="" class="form-label">Type komisi</label>
                            <select name="type_komisi" wire:model.change="type_komisi" id="type_komisi"
                                class="form-select">
                                <option value="">Pilih type komisi</option>
                                <option value="percent">Persen</option>
                                <option value="fixed">Fixed</option>
                            </select>
                        </div>
                        <div class="col-md">
                            <label for="" class="form-label">Nominal / Value</label>
                            <input type="text" name="value" wire:model.lazy="value"
                                placeholder="Masukkan nominal komisi" id="value" class="form-control">
                        </div>
                    </div>
                    <div class="float-end">
                        <button wire:click="store" class="btn btn-primary mt-3"><i
                                class="fas fa-save me-2"></i>Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="triggerdelete"></div>
    <div id="ratetrigger"></div>
    <script>
        (function() {
            ClassicEditor
                .create(document.querySelector('#classic-editor'))
                .then(editor => {
                    window.editor = editor; // Simpan instance editor
                })
                .catch(error => {
                    console.error(error);
                });
        })();

        function deleteConfig(id) {
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
                    $('#triggerdelete').data('id', id);
                    $('#triggerdelete').click();
                }
            });
        }

        function setrate() {
            $('#ratetrigger').data('rate', $('#rate_withdraw').val());
            $('#ratetrigger').click();
        }
    </script>
</div>
@script
    <script>
        $('#triggerdelete').on('click', function() {
            let id = $(this).data('id');
            $wire.deleteConfig(id);
        });
        $('#ratetrigger').on('click', function() {
            let rate = $(this).data('rate');
            $wire.setRate(rate);
        });
        $('#btnTos').click(function() {
            let tos = window.editor.getData();
            $wire.setTos(tos);
        });
    </script>
@endscript
