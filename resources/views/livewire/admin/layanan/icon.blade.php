<div>
    <div class="card">
        <div class="card-header fw-bold p-3 text-xss">Setting icon</div>
        <div class="card-body py-0">
            <div class="row mt-3">
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
            </div>
            <div>
                @php
                    $count = count($checkbox);
                @endphp
                <button class="btn btn-outline-primary mb-2 {{ $count > 0 ? '' : 'd-none' }}" id="setIcon">Set
                    Icon</button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">
                                <input type="checkbox" name="checkall" id="checkall">
                            </th>
                            <th class="text-center">SID</th>
                            <th>Kategori</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kategori as $row)
                            @php
                                $service = App\Models\Smm::where('category', $row->kategori)->first();
                                $isChecked = in_array($row->sid, $checkbox) ? 'checked' : '';
                            @endphp
                            <tr class="fw-bold">
                                <td class="text-center">
                                    <input type="checkbox" wire:model.change="checkbox" value="{{ $row->sid }}"
                                        name="check-{{ $row->sid }}" id="check-{{ $row->sid }}"
                                        {{ $isChecked }}>
                                </td>
                                <td class="text-center">{{ $row->sid }}</td>
                                <td>
                                    <i class="{{ $row->icon }}"></i>
                                    {{ $row->kategori }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Data tidak ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $kategori->links() }}
        </div>
    </div>
    <div class="modal fade" wire:ignore id="edit" tabindex="-1" aria-labelledby="modalsLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="table-icons"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="triggerSave"></div>
</div>
<script>
    let array;
    $('#setIcon').click(function() {
        $.ajax({
            url: "{{ route('edit.icon') }}",
            type: 'POST',
            dataType: "JSON",
            data: {
                _token: "{{ csrf_token() }}",
                sid: array,
            },
            success: function(data) {
                if (data.status) {
                    $('#modals').modal('show');
                    $('#title').html('Edit Icon');
                    $('#content').html(data.html);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Kategori tidak ditemukan!',
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan!',
                });
            }
        })
    });
    window.addEventListener('setArray', event => {
        array = event.detail;
    });

    function selectIcon(icon) {
        $('#triggerSave').data('icon', icon);
        $('#triggerSave').click();
    }
</script>
@script
    <script>
        $('#triggerSave').click(function() {
            let icon = $(this).data('icon');
            $('#modals').modal('hide');
            $wire.addIcon(icon, array);
        });
        $('#checkall').click(function() {
            let checked = $(this).prop('checked');
            $wire.checkedAll(checked);
        });
    </script>
@endscript
