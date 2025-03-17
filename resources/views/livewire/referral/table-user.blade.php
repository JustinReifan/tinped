<div>
    <div class="table-responsive">
        <table class="table table-bordered mb-0">
            <thead>
                <tr class="text-uppercase">
                    <th>Username</th>
                    <th>Tgl. Terdaftar</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($user as $users)
                    <tr>
                        <td>
                            {{ Str::mask($users->username, '*', 3) }}
                        </td>
                        <td>
                            {{ tanggal(Carbon\Carbon::parse($users->created_at)->format('Y-m-d')) }}
                            {{ Carbon\Carbon::parse($users->created_at)->format('H:i:s') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $user->links() }}
</div>
