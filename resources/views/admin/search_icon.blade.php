<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th class="text-center">Icon</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($icon as $row)
                <tr class="fw-bold">
                    <td class="text-center">
                        <i class="{!! $row->icon !!}"></i>
                    </td>
                    <td>{{ $row->name }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary" onclick="selectIcon('{{ $row->icon }}',this)">Gunakan
                        </button>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="3" class="text-center">Data not found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
