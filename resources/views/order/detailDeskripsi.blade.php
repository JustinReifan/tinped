@php
    if ($rating == 0) {
        $rating = 0;
    } else {
        $rating = $rating;
    }
    $count = App\Models\Rating::where('service_id', $smm->first()->service)->count();
@endphp
<div class="card">
    <div class="card-body">
        <p class="fw-medium mb-0">{{ $smm->first()->name }}</p>
        <p class="mb-3 fw-bold">
            Harga: Rp {{ number_format($smm->first()->price, 0, ',', '.') }}/K</p>
        <p class="border-top mt-2 small fw-bold mb-1 pt-1">Deskripsi:</p> {!! $replace !!}
        <p class="border-top mt-2 small fw-bold mb-1 pt-1">Waktu Rata-Rata:</p>
        <p class="mb-1">{{ $smm->first()->average_time == null ? 'Belum ada data' : $smm->first()->average_time }}</p>
        <p class="border-top mt-2 small fw-bold mb-1 pt-1">Rating:</p>
        <div class="mention-stars" data-rate="{{ $rating }}"></div>
        <p class="small fw-medium mb-0 mt-1">({{ $rating }} rating dari {{ $count }} penilaian.)</p>
    </div>
</div>
<script>
    var rate = $('.mention-stars');
    $(rate).rateYo({
        rating: {{ $rating }},
        starWidth: "15px",
        readOnly: true,
        normalFill: "#000000",
        ratedFill: "#FFD700",
    });
</script>
