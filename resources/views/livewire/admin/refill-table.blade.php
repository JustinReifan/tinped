@php

@endphp
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="btn-group flex-wrap">
                    <button wire:click="all" class="btn btn-primary">Semua</button>
                    <button wire:click="pending" class="btn btn-primary ">Pending</button>
                    <button wire:click="processing" class="btn btn-primary ">Processing</button>
                    <button class="btn btn-primary " wire:click="success">Success</button>
                    <button class="btn btn-primary " wire:click="error">Error</button>
                </div>

            </div>
        </div>
        <div class="card">
            <div class="card-header fw-bold p-3 text-xss"><i class="mdi mdi-history me-1"></i>Riwayat Refill</h5>
                <div class="card-body">
                    <div class="alert alert-warning">
                        <span class="font-size-16 fw-bold mb-0">Informasi Untuk Layanan Refill</span>
                        <ul class="mb-0">
                            <li>Tombol Refill hanya dapat digunakan untuk layanan yang memiliki label ♻️ pada nama
                                layanannya.</li>
                            <li>Gunakan tombol Refill ini hanya ketika pesanan Anda mengalami drop.</li>
                            <li>Proses Refill mungkin membutuhkan waktu -+24 jam.</li>
                            <li>Anda dapat menggunakan tombol Refill kembali setelah 24 jam dari terakhir kali Anda
                                menggunakannya.</li>
                            <li>Jika saat klik tombol refill, responnya adalah "Refill not allowed" artinya tombol
                                refill
                                belum bisa digunakan dan Anda bisa coba klik tombol refill kembali secara berkala.</li>
                            <li>Anda harus menunggu maksimal selama 3 hari setelah pesanan Anda Success / Selesai untuk
                                dapat menggunakan tombol Refill.</li>
                        </ul>
                    </div>
                    <form method="get" class="row">
                        <div class="col-md-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Tampilkan</span>
                                </div>
                                <select wire:model.change="perPage" class="form-control" name="row" id="table-row">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                <div class="input-group-append">
                                    <span class="input-group-text">baris.</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-3">
                            <div class="input-group mb-3">
                                <input type="text" wire:model.live.debounce.300ms="search" class="form-control"
                                    name="search" id="table-search" value="" placeholder="Cari...">
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="text-uppercase">
                                    <th>ID</th>
                                    <th>Layanan</th>
                                    <th>Target</th>
                                    <th>Status</th>
                                    <th>Tgl. Pesanan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($refill->count() > 0)
                                    @foreach ($refill as $row)
                                        @php
                                            if ($row->status == 'pending') {
                                                $status = 'warning';
                                                $text = 'Pending';
                                            } elseif ($row->status == 'proses') {
                                                $status = 'info';
                                                $text = 'Proses';
                                            } elseif ($row->status == 'done') {
                                                $status = 'success';
                                                $text = 'Selesai';
                                            } elseif ($row->status == 'error') {
                                                $status = 'danger';
                                                $text = 'Error';
                                            } elseif ($row->status == 'partial') {
                                                $status = 'primary';
                                                $text = 'Partial';
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{ $row->id }}</td>
                                            <td>{{ $row->layanan }}</td>
                                            <td>{{ $row->target }}</td>
                                            <td><span
                                                    class="btn btn-soft-{{ $status }} btn-sm font-size-13">{{ $text }}</span>
                                            </td>
                                            <td>{{ tanggal(date('Y-m-d', strtotime($row['created_at']))) .
                                                ' ' .
                                                date('H:i', strtotime($row['created_at'])) .
                                                '' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" class="text-center">Data Not Found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        {!! $refill->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function refill(id) {
            Swal.fire({
                title: 'Konfirmasi',
                text: "Apakah Anda yakin ingin refill pesanan ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, refill!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('refill') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id
                        },
                        success: function(response) {
                            if (response.status == true) {
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: response.message,
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                })
                            } else {
                                Swal.fire({
                                    title: 'Gagal',
                                    text: response.message,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK'
                                })
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            Swal.fire({
                                title: 'Gagal',
                                text: 'Terjadi kesalahan, silahkan coba lagi.',
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            })
                        }
                    });
                }
            })
        }

        function detail(id) {
            $.ajax({
                url: "{{ route('refill.detail') }}",
                type: "POST",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    $('#content').html(data);
                    $('#title').html('Detail Pesanan');
                },
                error: function(data) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    });
                    $('#modals').modal('hide');
                }
            });
        }
    </script>
