<div>
    <div class="card">
        <div class="card-header fw-bold p-3 text-xss"> <i class="mdi mdi-barcode-scan me-1"></i>Rekomendasi layanan</h5>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md"></div>
                    <div class="col-md">
                        <div class="text-right">
                            <button class="btn btn-primary" onclick="modalAdd()">Tambah
                                layanan</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Layanan</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $s = $info->service;
                                $explode = explode(',', $s);
                                // dd($explode);
                            @endphp
                            @forelse ($explode as $row)
                                @if ($row)
                                    @php
                                        $service = App\Models\Smm::where('service', $row)->first();
                                    @endphp
                                    @if ($service)
                                        <tr>
                                            <th>{{ $service->name }}</th>
                                            <th>
                                                <button class="btn btn-sm btn-danger"
                                                    wire:click="delete({{ $row }})">Delete</button>
                                                <button class="btn btn-sm btn-info"
                                                    onclick="showAlert('{{ $row }}')">Edit</button>
                                            </th>
                                        </tr>
                                    @else
                                        @php
                                            $info = App\Models\DetailInformation::first();
                                            $info->service = str_replace($row . ',', '', $info->service);
                                            $info->save();
                                            $info->service = str_replace(',' . $row, '', $info->service);
                                            $info->save();
                                            $info->service = str_replace($row, '', $info->service);
                                            $info->save();
                                        @endphp
                                        <tr>
                                            <th colspan="2" class="text-center">Tidak ada data</th>
                                        </tr>
                                    @endif
                                @endif
                            @empty
                                <tr>
                                    <th colspan="2" class="text-center">Tidak ada data</th>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        function showAlert(id) {
            Swal.fire({
                title: 'Masukkan ID layanan yang baru',
                input: 'text',
                inputPlaceholder: 'Type something',
                showCancelButton: true,
                confirmButtonText: 'Submit',
                cancelButtonText: 'Cancel',
                preConfirm: (value) => {
                    if (!value) {
                        Swal.showValidationMessage('Please enter something');
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('edit', id, result.value);
                }
            });
        }

        function modalAdd() {
            Swal.fire({
                title: 'Masukkan ID layanan',
                input: 'text',
                inputPlaceholder: 'Type something',
                showCancelButton: true,
                confirmButtonText: 'Submit',
                cancelButtonText: 'Cancel',
                preConfirm: (value) => {
                    if (!value) {
                        Swal.showValidationMessage('Please enter something');
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('add', result.value);
                }
            });

        }
        window.addEventListener('swal:modal', event => {
            Swal.fire({
                icon: event.detail[0].type,
                title: event.detail[0].title,
                text: event.detail[0].text,
            });
        });
        window.addEventListener('swal:confirm', event => {
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('delete', event.detail[0].id)
                }
            })
        });
    </script>
