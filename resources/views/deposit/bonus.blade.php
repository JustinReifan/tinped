<div class="table-responsive" style="padding: 10px;">
    <table class="table table-bordered mb-0" style="margin-top: 10px; margin-bottom: 10px;">
        <thead>
            <tr>
                <th>Minimal Deposit</th>
                <th>Bonus Deposit</th>
            </tr>
        </thead>
        <tbody>
            @php
                $bonus = json_decode($metode->bonus, true); // Decode data JSON
            @endphp

            @if (is_array($bonus))
                @forelse ($bonus as $bon)
                    <tr>
                        <td>Rp {{ number_format($bon['min_nominal'], 0, ',', '.') }}</td>
                        <td>{{ $bon['nominal'] }}%</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">No data</td>
                    </tr>
                @endforelse
            @else
                <tr>
                    <td colspan="2" class="text-center">No data</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
