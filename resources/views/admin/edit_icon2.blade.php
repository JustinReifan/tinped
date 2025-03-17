<div class="mb-3">
    <label for="" class="form-label">Kategori</label>
    <input type="text" name="kategori" value="{{ $kategori }}" id="kategori" class="form-control" readonly>
</div>
<div class="mb-3">
    <label for="" class="form-label">Filter Icon</label>
    <div class="input-group">
        <input type="text" name="icon" id="icon" placeholder="Masukkan nama brand / icon"
            class="form-control" value="{{ $icon->name ?? null }}">
        <button class="btn btn-primary" type="button" id="search-icon">Search</button>
    </div>
</div>

<div id="icon-table"></div>
<script>
    $('#search-icon').click(function() {
        var icon = $('#icon').val();
        var kategori = $('#kategori').val();
        $.ajax({
            url: "{{ url('admin/layanan/search-icon') }}",
            type: "POST",
            data: {
                icon: icon,
                kategori: kategori,
                keyword: "{{ $katakunci }}",
                checkAll: {{ $request->checkAll }},
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
</script>
