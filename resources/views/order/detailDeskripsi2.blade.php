@php
    if ($rating == 0) {
        $rating = 0;
    } else {
        $rating = $rating;
    }
    $count = App\Models\Rating::where('service_id', $smm->service)->count();
@endphp
<div class="card">
    <div class="card-body">
        <p class="mb-0 fw-medium">ID {{ $smm->service }}</p>
        <p class="mb-0 fw-medium">{{ $smm->name }}</p>
        <p class="mb-3 fw-bold">
            Harga: Rp {{ number_format($smm->price, 0, ',', '.') }}/K</p>
        <p class="pt-1 mt-2 mb-1 border-top small fw-bold">Deskripsi:</p> {!! $replace == null ? 'Tidak ada deskripsi' : $replace !!}
        <p class="pt-1 mt-2 mb-1 border-top small fw-bold">Waktu Rata-Rata:</p>
        <p class="mb-1">{{ $smm->average_time == null ? 'Belum ada data' : $smm->average_time }}</p>
        <p class="pt-1 mt-2 mb-1 border-top small fw-bold">Rating:</p>
        <div class="mention-stars" data-rate="{{ $rating }}"></div>
        <p class="mt-1 mb-0 small fw-medium">({{ $rating }} rating dari {{ $count }} penilaian.)</p>
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
