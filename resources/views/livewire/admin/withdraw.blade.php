<div>
    <div class="card">
        <div class="card-header fw-bold p-3 text-xss"><i class="fas fa-credit-card me-2"></i>Withdraw</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th>User</th>
                            <th>Rate</th>
                            <th>Jumlah</th>
                            <th>Saldo yang didapatkan</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($withdraw as $row)
                            <tr>
                                <td class="text-center">
                                    {{ ($withdraw->currentPage() - 1) * $withdraw->perPage() + $loop->iteration }}</td>
                                <td>
                                    <div class="kotak">
                                        <div class="label">Nama</div>
                                        <div class="value text-primary">{{ $row->user->name }}</div>
                                        <div class="label">Email</div>
                                        <div class="value text-success">{{ $row->user->email }}</div>
                                    </div>
                                </td>
                                <td>{{ $row->rate }}%</td>
                                <td>Rp {{ number_format($row->amount, 0, ',', '.') }}</td>
                                <td>
                                    Rp {{ number_format($row->balance, 0, ',', '.') }}
                                </td>
                                <td>{{ tanggal(Carbon\Carbon::parse($row->created_at)->format('Y-m-d')) }}
                                    {{ Carbon\Carbon::parse($row->created_at)->format('H:i:s') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
