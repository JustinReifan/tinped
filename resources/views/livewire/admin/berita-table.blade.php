<div>
    @php
        $last = App\Models\Announcement::orderBy('id', 'desc')->first();
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header fw-bold p-3 text-xss"><i class="mdi mdi-email me-2"></i>Kelola Berita</h5>
                    <div class="card-body">
                        <div class="float-right">
                            <button class="btn btn-primary" id="tambah_berita" data-id="{{ $last->id }}"> Tambah Berita
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Tampilkan</span>
                                    </div>
                                    <select wire:model.change="perPage" class="form-control" name="row"
                                        id="table-row">
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
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Type</th>
                                        <th>Message</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($berita as $row)
                                        @php
                                            // loop iteration descending
                                            $loop->iteration = $loop->count - $loop->index;
                                        @endphp
                                        <tr>
                                            <td class="d-none">{{ $row->id }}</td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->type }}</td>
                                            <td>
                                                <textarea cols="15" rows="10" class="form-control" readonly>{{ trim($row->message) }}</textarea>
                                            </td>
                                            <td class="text-nowrap">
                                                <button class="btn btn-sm btn-primary" id="edit">
                                                    Edit </button>
                                                <button class="btn btn-sm btn-danger" id="delete"
                                                    wire:click="deleteConfirm({{ $row->id }})">
                                                    Delete </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).on('click', '#edit', function() {
            var tr = $(this).closest('tr');
            var id = tr.find('td:eq(0)').text();
            var type = tr.find('td:eq(2)').text();
            var message = tr.find('td:eq(3)').text();
            let res = message.trim();
            // add input
            tr.find('td:eq(2)').html('<select type="text" id="type" value="' + type +
                '" class="form-control form-control-sm"><option value="info">Info</option><option value="service">Service</option></select>'
            );
            tr.find('td:eq(3)').html('<textarea cols="15" rows="10" class="form-control">' + res +
                '</textarea>');
            tr.find('td:eq(4)').html('<button class="btn btn-success btn-sm" id="save">Save</button>');
            $(this).remove();
        });
        // if button save clicked

        $(document).on('click', '#save', function() {
            var tr = $(this).closest('tr');
            var id = tr.find('td:eq(0)').text();
            var type = tr.find('td:eq(2)').find('select').val();
            var message = tr.find('td:eq(3)').find('textarea').val();
            // add input
            tr.find('td:eq(2)').html(type);
            tr.find('td:eq(3)').html('<textarea cols="15" rows="10" class="form-control" readonly>' + message +
                '</textarea>');
            tr.find('td:eq(4)').html('<button class="btn btn-primary btn-sm" id="edit">Edit</button>');
            $(
                this).remove();

            // If the number of edit buttons exceeds then it is reduced until the number matches the amount of existing data
            Livewire.emit('update', id, type, message);
            // delete button edit if count button edit > count data in database
            var count = $('#edit').length;
            var countData = $('table').val();
            if (count > countData) {
                $('#edit').last().remove();
            }
        });
        window.addEventListener('success', event => {
            Swal.fire(
                'Berhasil!',
                event.detail[0].message,
                'success'
            )
        });
        window.addEventListener('failed', event => {
            Swal.fire(
                'Gagal!',
                event.detail[0].message,
                'error'
            )
        });
        window.addEventListener('delete-confirm', event => {
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
                    Livewire.emit('deleteConfirm', event.detail[0].id);
                }
            })
        })
        // if button tambah_berita clicked add new row in table
        $(document).on('click', '#tambah_berita', function() {
            // add new data in table
            var table = $('table').find('tbody');
            $id = $(this).data('id');
            var count_table_tbody_tr = table.find('tr').length + 1;
            var row = '<tr>';
            row += '<td class="d-none">' + $id + '</td>';
            row += '<td>' + count_table_tbody_tr + '</td>';
            row +=
                '<td><select type="text" id="type" value="" class="form-control form-control-sm"><option value="info">Info</option><option value="service">Service</option></select></td>';
            row += '<td><textarea cols="15" rows="10" class="form-control"></textarea></td>';
            row += '<td><button class="btn btn-success btn-sm" id="saved_new">Save</button></td>';
            row += '</tr>';
            table.prepend(row);
            // $(this).remove();
        });
        // if button save clicked
        $(document).on('click', '#saved_new', function() {
            var tr = $(this).closest('tr');
            var type = tr.find('td:eq(2)').find('select').val();
            var message = tr.find('td:eq(3)').find('textarea').val();
            // add input
            tr.find('td:eq(2)').html(type);
            tr.find('td:eq(3)').html('<textarea cols="15" rows="10" class="form-control" readonly>' + message +
                '</textarea>');
            tr.find('td:eq(4)').html('<button class="btn btn-primary btn-sm" id="edit">Edit</button>');
            $(this).remove();
            Livewire.emit('save', type, message);
        });
    </script>
