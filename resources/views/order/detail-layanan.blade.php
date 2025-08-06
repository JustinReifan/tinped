<div class="table-responsive">
    <table class="table table-striped table-bordered table-box">
        <tbody>
            @php
                $rating = App\Models\Rating::where('service_id', $smm->service)->avg('rating');
                if ($rating == 0) {
                    $rating = 0;
                } else {
                    $rating = $rating;
                }
            @endphp
            <tr>
                <th>Rating</th>
                <td>
                    <div class="mention-stars" data-rate="{{ $rating }}"></div>
                </td>
            </tr>
            <tr>
                <th>Category</th>
                <td>{{ $smm->category }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $smm->name }}</td>
            </tr>
            <tr>
                <th>Quantity</th>
                <td>
                    Min: {{ number_format($smm->min, 0, ',', '.') }} <br>
                    Max: {{ number_format($smm->max, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Price</th>
                <td>Rp {{ number_format($smm->price, 0, ',', '.') }}/K</td>
            </tr>
            <tr>
                <th>Refill</th>
                <td>
                    @if ($smm->refill == 0)
                        <span class="badge bg-danger">OFF</span>
                    @else
                        <span class="badge bg-success">ON</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Cancel</th>
                <td>
                    @if ($smm->cancel == 0)
                        <span class="badge bg-danger">Not allowed</span>
                    @else
                        <span class="badge bg-success">Allowed</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Description</th>
                @php

                    $replace = str_replace("\r\n", '<br>', $smm->description);
                    $replace = str_replace("\n", '<br>', $replace);
                @endphp
                <td>{!! $replace !!}</td>
            </tr>
            <tr>
                <th>Average Time</th>
                <td>{{ $smm->average_time }}</td>
            </tr>
        </tbody>
    </table>
</div>
<script>
    var rate = $('.mention-stars');
    $(rate).rateYo({
        rating: {{ $rating }},
        starWidth: "20px",
        readOnly: true,
        normalFill: "#000000",
        ratedFill: "#FFD700",
    });
</script>
