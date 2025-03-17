<div>
    <style>
        .text-right {
            text-align: right;
        }
    </style>
    <div class="card">
        <div class="card-header fw-bold p-3 text-xss"><i class="fas fa-envelope me-2"></i> Kelola berita</div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md"></div>
                <div class="col-md">
                    <div class="text-right">
                        <a class="btn btn-primary " href="{{ url('admin/tambah-berita') }}">
                            <i class="fas fa-plus me-2"></i> Tambah berita
                        </a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordere">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th>Type</th>
                            <th>Message</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($berita as $row)
                            <tr>
                                <td class="text-center">
                                    {{ ($berita->currentPage() - 1) * $berita->perPage() + $loop->iteration }}</td>
                                <td>
                                    {{ strtoupper($row->type) }}
                                </td>
                                <td>
                                    @php
                                        // maksimal 100 karakter dan tambahkan tanda titik-titik
                                        $row->message = Str::limit($row->message, 100, '...');
                                    @endphp
                                    {!! $row->message !!}
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-sm" onclick="deleteBerita('{{ $row->id }}')">
                                        <i class="fas fa-trash me-2"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Data tidak ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $berita->links() }}
        </div>
    </div>
    <div id="triggerDelete"></div>
    <script>
        function deleteBerita(id) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
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
        $('#triggerDelete').on('click', function() {
            $wire.deleteBerita($(this).data('id'));
        });
    </script>
@endscript
