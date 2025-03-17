<div>
    <div class="card">
        <div class="card-header fw-bold p-3 text-xss">Tambah berita</div>
        <div class="card-body">
            <label for="" class="form-label">Type</label>
            <select name="type" id="type" class="form-control">
                <option value="info">Info</option>
                <option value="service">Service</option>
            </select>
            <label for="" class="form-label mt-3">Message</label>
            <textarea name="message" id="classic-editor" class="form-control"></textarea>
            <div class="d-grid mt-3">
                <button class="btn btn-outline-primary" id="save">Simpan</button>
            </div>
        </div>
    </div>
</div>
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
</script>
@script
    <script>
        $('#save').on('click', function() {
            let type = $('#type').val();
            let message = window.editor.getData();
            if (message.length < 1) {
                alert('Message tidak boleh kosong');
                return;
            } else {
                $wire.addBerita(type, message);
            }
        });
    </script>
@endscript
