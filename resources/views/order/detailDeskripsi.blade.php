@php
    // Pastikan variabel ada dan beri nilai default
    $smmFirst = $smm->first() ?? null;
    $rating = $rating ?? 0;
    $count = $count ?? 0; // Pindahkan query count ke controller!
@endphp

<div class="card">
    <div class="card-body">
        <p class="mb-0 fw-medium">ID {{ $smmFirst->service ?? 'ID Layanan Tidak Tersedia' }}</p>
        <p class="mb-0 fw-medium">{{ $smmFirst->name ?? 'Nama Layanan Tidak Tersedia' }}</p>
        <p class="mb-3 fw-bold">
            Harga: Rp {{ number_format($smmFirst->price ?? 0, 0, ',', '.') }} / 1000
        </p>
        <p class="pt-1 mt-2 mb-1 border-top small fw-bold">Deskripsi:</p> 
        {!! $replace ?? '-' !!}
        
        <p class="pt-1 mt-2 mb-1 border-top small fw-bold">Waktu Rata-Rata:</p>
        <p class="mb-1">{{ $smmFirst->average_time ?? 'Belum ada data' }}</p>
        
        <p class="pt-1 mt-2 mb-1 border-top small fw-bold">Rating:</p>
        <div class="mention-stars" data-rate="{{ $rating }}"></div>
        <p class="mt-1 mb-0 small fw-medium">
            ({{ $rating }} rating dari {{ $count }} penilaian.)
        </p>
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