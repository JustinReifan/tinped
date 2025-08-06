<div>
    <div class="card">
        <div class="card-body py-0">
            <ul class="nav nav-tabs profile-tabs " id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link {{ $tab == 'kontak' ? 'active' : '' }}"
                        wire:click="$set('tab','kontak')" id="kontak-tab" data-bs-toggle="tab" href="#kontak"
                        role="tab" aria-selected="true"><i class="fa-solid fa-square-phone me-2"></i>Kontak</a>
                </li>
                <li class="nav-item"><a class="nav-link {{ $tab == 'contoh' ? 'active' : '' }}"
                        wire:click="$set('tab','contoh')" id="contoh-tab" data-bs-toggle="tab" href="#contoh"
                        role="tab" aria-selected="true"><i class="ti ti-shopping-cart me-2"></i>Contoh</a>
                </li>
                <li class="nav-item"><a class="nav-link {{ $tab == 'tos' ? 'active' : '' }}" id="tos-tab"
                        wire:click="$set('tab','tos')" data-bs-toggle="tab" href="#tos" role="tab"
                        aria-selected="true"><i class="ti ti-alert-octagon me-2"></i>Terms Of Service</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="tab-content mt-3">
        <div class="tab-pane show {{ $tab == 'kontak' ? 'active' : '' }}" id="kontak" role="tabpanel"
            aria-labelledby="kontak-tab">
            <div class="card">
                <div class="card-header fw-bold p-3 text-xss"><i class="fa-solid fa-square-phone me-2"></i>Kontak</div>
                <div class="card-body" wire:ignore>
                    <textarea id="kontak-editor" wire:ignore>{!! json_decode($config->sitemap, true)['kontak'] !!}</textarea>
                    <div class="d-grid">
                        <button class="btn btn-primary" id="saveKontak">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane show {{ $tab == 'contoh' ? 'active' : '' }}" id="contoh" role="tabpanel"
            aria-labelledby="contoh-tab">
            <div class="card">
                <div class="card-header fw-bold p-3 text-xss"><i class="ti ti-shopping-cart me-2"></i>Contoh
                    Pesanan</div>
                <div class="card-body" wire:ignore>
                    <textarea id="contoh-editor" wire:ignore>{!! json_decode($config->sitemap, true)['contoh_pesanan'] !!}</textarea>
                    <div class="d-grid">
                        <button class="btn btn-primary" id="saveContoh">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane show {{ $tab == 'tos' ? 'active' : '' }}" id="tos" role="tabpanel"
            aria-labelledby="tos-tab">
            <div class="card">
                <div class="card-header fw-bold p-3 text-xss"><i class="ti ti-shopping-cart me-2"></i>Terms of service
                </div>
                <div class="card-body" wire:ignore>
                    <textarea id="tos-editor" wire:ignore>{!! json_decode($config->sitemap, true)['tos'] !!}</textarea>
                    <div class="d-grid">
                        <button class="btn btn-primary" id="saveTos">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    (function() {
        ClassicEditor
            .create(document.querySelector('#kontak-editor'))
            .then(editor => {
                window.editor = editor; // Simpan instance editor
            })
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#contoh-editor'))
            .then(editor => {
                window.editor2 = editor; // Simpan instance editor
            })
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#tos-editor'))
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
        $('#saveKontak').click(function() {
            var kontak = window.editor.getData();
            $wire.saveKontak(kontak);
        });
        $('#saveContoh').click(function() {
            var contoh = window.editor2.getData();
            $wire.saveContoh(contoh);
        });
        $('#saveTos').click(function() {
            var tos = window.editor3.getData();
            $wire.saveTos(tos);
        });
    </script>
@endscript
