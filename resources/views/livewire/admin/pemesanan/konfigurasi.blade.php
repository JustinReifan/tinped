<div>
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/bootstrap-switch-button.min.css') }}">
    <!-- [Page specific CSS] end -->
    <div class="card">
        <div class="card-body py-0">
            <ul class="nav nav-tabs profile-tabs " id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link {{ $tab == 'info' ? 'active' : '' }}" id="info-tab"
                        data-bs-toggle="tab" wire:click="$set('tab','info')"href="#info" role="tab"
                        aria-selected="true"><i class="ti ti-list me-2"></i>Information
                        order</a>
                </li>
                <li class="nav-item"><a class="nav-link {{ $tab == 'kategori' ? 'active' : '' }}" id="kategori-tab"
                        data-bs-toggle="tab" wire:click="$set('tab','kategori')"href="#kategori" role="tab"
                        aria-selected="true"><i class="ti ti-tag me-2"></i>Kategori</a>
                </li>
                <li class="nav-item"><a class="nav-link {{ $tab == 'order' ? 'active' : '' }}" id="order-tab"
                        data-bs-toggle="tab" wire:click="$set('tab','order')"href="#order" role="tab"
                        aria-selected="true"><i class="ti ti-shopping-cart me-2"></i>Order non login</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane show {{ $tab == 'info' ? 'active' : '' }}" id="info" role="tabpanel"
            aria-labelledby="info-tab">
            @php
                $decode = json_decode($config->info_text);
            @endphp
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header fw-bold p-3 text-xss">Single</div>
                        <div class="card-body" wire:ignore>
                            <textarea id="classic-editor">
                                {!! $decode->single !!}
                            </textarea>
                            <div class="row mt-3">
                                <div class="col-12 d-grid">
                                    <button type="button" id="saveSingle"
                                        class="btn btn-outline-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header fw-bold p-3 text-xss">Massal</div>
                        <div class="card-body" wire:ignore>
                            <textarea id="classic-editor2" wire:ignore>
                                {!! isset($decode->massal) ? $decode->massal : '' !!}
                            </textarea>
                            <div class="row mt-3">
                                <div class="col-12 d-grid">
                                    <button type="button" id="saveMassal"
                                        class="btn btn-outline-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .form-check {
                padding-left: 0.8em;
            }
        </style>
        <div class="tab-pane show {{ $tab == 'kategori' ? 'active' : '' }}" id="kategori" role="tabpanel"
            aria-labelledby="kategori-tab">
            <div class="card">
                <div class="card-header fw-bold p-3 text-xss"><i class="ti ti-tag    me-2"></i>Kelola kategori</div>
                <div class="card-body">
                    @php
                        $decode = json_decode($config->konfigurasi_kategori);
                    @endphp
                    <label for="" class="form-label">Auto hide kategori</label>
                    <div class="mb-3" style="display:flex">
                        <div class="form-check">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="hidden"
                                    wire:click="setHidden('auto')" id="otomatis"
                                    @if ($decode->kategori_hidden) checked @endif>
                                <label class="form-check-label" for="otomatis">Otomatis</label>
                            </div>
                        </div>
                        <div class="form-check">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" wire:click="setHidden('manual')"
                                    name="hidden" id="manual" value="manual"
                                    @if ($decode->kategori_hidden == false) checked @endif>
                                <label class="form-check-label" for="manual">Manual</label>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th>Nama</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (collect($decode->list_kategori)->count() == 0)
                                    <tr>
                                        <td colspan="3" class="text-center">Tidak ada data</td>
                                    </tr>
                                @else
                                    @foreach (collect($decode->list_kategori)->sortBy('key') as $nama => $iconClass)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="fw-bold text-primary"><i
                                                    class="{{ $iconClass }} me-2"></i>{{ ucfirst($nama) }}</td>
                                            <td>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="deleteItem('{{ $nama }}')">Hapus</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md">
                            <label for="" class="form-label">Nama</label>
                            <input type="text" name="nama" id="nama" placeholder="Masukkan nama"
                                class="form-control">
                        </div>
                        <div class="col-md" wire:ignore>

                            <div class="mb-3">
                                <label for="" class="form-label">Filter Icon</label>
                                <div class="input-group">
                                    <input type="text" name="icon" id="icon"
                                        placeholder="Masukkan nama brand / icon" class="form-control">
                                    <button class="btn btn-primary" type="button" id="search-icon">Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="icon-table"></div>
                    <div class="float-end">
                        <button class="btn btn-outline-primary" id="tambah">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane show {{ $tab == 'order' ? 'active' : '' }}" id="order" role="tabpanel"
            aria-labelledby="order-tab">
            @php
                $decode = json_decode($config->info_text);
            @endphp
            <div class="card">
                <div class="card-header fw-bold p-3 text-xss">Order non login</div>
                <div class="card-body" wire:ignore>
                    <textarea id="order-editor">
                                {!! $decode->order !!}
                            </textarea>
                    <div class="row mt-3">
                        <div class="col-12 d-grid">
                            <button type="button" id="saveOrder" class="btn btn-outline-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="triggerDelete"></div>
</div>
<script src="{{ asset('assets/js/plugins/bootstrap-switch-button.min.js') }}"></script>
<script>
    $('#search-icon').click(function() {
        let icon = $('#icon').val();
        $.ajax({
            url: "{{ url('admin/layanan/search-icon') }}",
            type: "POST",
            data: {
                icon: icon,
                _token: "{{ csrf_token() }}",
            },
            success: function(data) {
                $('#icon-table').html(data.html);
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
            }
        });
    });

    function selectIcon(icon, $this) {
        localStorage.setItem('icon', icon);
        $($this).attr('disabled', true);
        $($this).removeClass('btn-primary').addClass('btn-success');
        $($this).text('Selected');
        $($this).parent().parent().siblings().find('button').removeClass('btn-success').addClass('btn-primary');
        $($this).parent().parent().siblings().find('button').text('Gunakan');
        $($this).parent().parent().siblings().find('button').attr('disabled', false);
    }
</script>
<script>
    function deleteItem(nama) {
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
                $('#triggerDelete').data('nama', nama);
                $('#triggerDelete').click();
            }
        });
    }
    (function() {
        ClassicEditor
            .create(document.querySelector('#classic-editor'))
            .then(editor => {
                window.editor = editor; // Simpan instance editor
            })
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#classic-editor2'))
            .then(editor => {
                window.editor2 = editor; // Simpan instance editor
            })
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#order-editor'))
            .then(editor => {
                window.editor3 = editor; // Simpan instance editor
            })
            .catch(error => {
                console.error(error);
            });
    })();
</script>
@script
    <script>
        $('#saveSingle').click(function() {
            let editorData = window.editor.getData();
            $wire.saveInfo('single', editorData);

        });
        $('#saveMassal').click(function() {
            let editorData = window.editor2.getData();
            $wire.saveInfo('massal', editorData);
        });
        $('#saveOrder').click(function() {
            let editorData = window.editor3.getData();
            $wire.saveInfo('order', editorData);
        });
        $('#tambah').click(function() {
            let nama = $('#nama').val();
            let icon = localStorage.getItem('icon');
            $wire.addKategori(nama, icon);
        });
        $('#triggerDelete').click(function() {
            let nama = $(this).data('nama');
            $wire.deleteItem(nama);
        });
    </script>
@endscript
