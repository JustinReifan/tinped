<div>
    <style>
        .text-right {
            text-align: right;
        }
    </style>
    <div class="card">
        <div class="card-header fw-bold p-3 text-xss"><i class="ti ti-shopping-cart me-2"></i>Rekomendasi layanan</div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md"></div>
                <div class="col-md">
                    <div class="text-right">
                        <button class="btn btn-primary " id="tambah"><i class="fas fa-plus me-2"></i>Tambah
                            rekomendasi</button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th>Nama Layanan</th>
                            <th>Aksi</th>
                        </tr>

                    </thead>
                    <tbody>@php
                        $explode = explode(',', $config->layanan_rekomendasi);
                    @endphp

                        @foreach ($explode as $row)
                            @php
                                $explode = explode('||', $row);
                                if (isset($explode[1])) {
                                    $explode[1] = $explode[1];
                                } else {
                                    $explode[1] = '';
                                }

                                $smm = App\Models\Smm::where([
                                    ['service', $explode[0]],
                                    ['provider', $explode[1]],
                                ])->first();

                                // Jika data tidak ditemukan, hapus dari $config->layanan_rekomendasi
                                if (!$smm) {
                                    $explodeLayanan = explode(',', $config->layanan_rekomendasi);
                                    $indexToDelete = array_search($row, $explodeLayanan);
                                    if ($indexToDelete !== false) {
                                        unset($explodeLayanan[$indexToDelete]);
                                        $config->layanan_rekomendasi = implode(',', $explodeLayanan);
                                        $config->save();
                                    }
                                }
                            @endphp

                            @if ($smm)
                                <tr>
                                    <td class="text-center">{{ $explode[0] }}</td>
                                    <td>
                                        <div class="kotak">
                                            <div class="label">Provider</div>
                                            <div class="value text-success">{{ $explode[1] }}</div>
                                            <div class="label">Layanan</div>
                                            <div class="value text-primary">{{ $smm->name }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger btn-sm"
                                            onclick="removeData('{{ $explode[0] }}','{{ $explode[1] }}')">Hapus</button>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="triggerDelete"></div>
    <script>
        function removeData(id, provider) {
            Swal.fire({
                title: 'Hapus layanan ini?',
                text: "Layanan yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#triggerDelete').data('id', id);
                    $('#triggerDelete').data('provider', provider);
                    $('#triggerDelete').click();
                }
            });
        }
    </script>
</div>
@script
    <script>
        $('#triggerDelete').on('click', function() {
            let id = $(this).data('id');
            let provider = $(this).data('provider');
            $wire.deleteRekomendasi(id, provider);
        });
        $('#tambah').click(function() {
            Swal.fire({
                title: "Enter ID Layanan dan Provider",
                html: '<input id="swal-input1" class="swal2-input" placeholder="ID Layanan">' +
                    '<input id="swal-input2" class="swal2-input" placeholder="Provider">',
                focusConfirm: false,
                preConfirm: () => {
                    return [
                        document.getElementById('swal-input1').value,
                        document.getElementById('swal-input2').value
                    ]
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const idLayanan = result.value[0];
                    const provider = result.value[1];

                    if (!idLayanan || !provider) {
                        Swal.fire("Error", "You need to fill both fields!", "error");
                    } else {
                        $wire.tambah(idLayanan,
                            provider);
                    }
                }
            });
        });
    </script>
@endscript
