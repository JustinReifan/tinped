@php
    $kategori = null;
    if (count($request->sid[0]) > 1) {
        $sids = $request->sid[0];
        foreach ($sids as $row) {
            $category = App\Models\Category::where('sid', $row)->first();
            if ($category) {
                $kategori .= $category->kategori;

                // Data terakhir
                if ($row != end($sids)) {
                    // Use the copied array for comparison
                    $kategori .= ', ';
                }
            }
        }
    } else {
        foreach ($request->sid as $row) {
            $category = App\Models\Category::where('sid', $row)->first();
            if ($category) {
                $kategori .= $category->kategori;
            }
        }
    }
@endphp
<div class="mb-3">
    <label for="" class="form-label">Kategori</label>
    <input type="text" name="kategori" value="{{ $kategori }}" id="kategori" class="form-control" readonly>
</div>
<div class="mb-3">
    <label for="" class="form-label">Filter Icon</label>
    <div class="input-group">
        <input type="text" name="icon" id="icon" placeholder="Masukkan nama brand / icon"
            class="form-control">
        <button class="btn btn-primary" type="button" id="search-icon">Search</button>
    </div>
</div>
<div id="icon-table"></div>
<script>
    $('#search-icon').click(function() {
        var icon = $('#icon').val();
        let sid = {!! json_encode($request->sid) !!};
        $.ajax({
            url: "{{ url('admin/layanan/search-icon') }}",
            type: "POST",
            data: {
                icon: icon,
                sid: sid,
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
