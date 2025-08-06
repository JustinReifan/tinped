@php
    use Carbon\Carbon;
@endphp
<style>
    .rating-container {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .rating-info {
        /* margin-left: 10px; */
        /* Jarak antara elemen peringkat bintang dan informasi rating */
    }
</style>
@php
    $rating = App\Models\Rating::where('service_id', $smm->service)->avg('rating');
@endphp
<div class="text-center mb-3">
    <h5>{{ $smm->name }}</h5>
    <div class="rating-container">
        <div class="mention-stars"></div>
        <span class="rating-info">({{ $rating }} rating dari {{ $count }} penilaian.)</span>
    </div>
    @if ($cekRating)
        <div class="alert alert-success text-center m-0 mt-3">Anda sudah memberikan penilaian.</div>
    @else
        <p class="mb-2 mt-3">Berikan penilaian Anda:</p>
        <div>
            <a href="javascript:;" onclick="submitStar({{ $smm->service }}, 1)" class="star-rating">
                <i class="fa fa-fw fa-star text-secondary fa-2x"></i>
            </a>
            <a href="javascript:;" onclick= "submitStar({{ $smm->service }}, 2)" class="star-rating">
                <i class="fa fa-fw fa-star text-secondary fa-2x"></i>
            </a>
            <a href="javascript:;" onclick="submitStar({{ $smm->service }}, 3)" class="star-rating">
                <i class="fa fa-fw fa-star text-secondary fa-2x"></i>
            </a>
            <a href="javascript:;" onclick="submitStar({{ $smm->service }}, 4)" class="star-rating">
                <i class="fa fa-fw fa-star text-secondary fa-2x"></i>
            </a>
            <a href="javascript:;" onclick="submitStar({{ $smm->service }}, 5)" class="star-rating">
                <i class="fa fa-fw fa-star text-secondary fa-2x"></i>
            </a>
        </div>
    @endif
</div>
<p class="mb-2">10 Penilaian terakhir:</p>
@if ($ratings->first())
    @foreach ($ratings as $row)
        @php
            $user = App\Models\User::where('id', $row->user_id)->first();
        @endphp
        <div class="card mb-0 alert-secondary mt-2">
            <div class="card-body p-2 d-flex align-items-center">
                <img src="{{ url('assets/images/user.png') }}" alt="user-image" class="avatar-xs rounded-circle me-2">
                <p class="m-0">{{ $user->name }} memberikan
                    @for ($i = 0; $i < $row->rating; $i++)
                        @if ($i < $row->rating)
                            <i class="fa fa-fw fa-star text-warning"></i>
                        @else
                            <i class="fa fa-fw fa-star text-secondary"></i>
                        @endif
                    @endfor
                    @php
                        $hitung = 5 - $row->rating;
                    @endphp
                    @for ($i = 0; $i < $hitung; $i++)
                        <i class="fa fa-fw fa-star text-secondary"></i>
                    @endfor
                    ({{ $row->rating }})
                    bintang untuk layanan ini pada {{ tanggal(Carbon::parse($row->created_at)->format('Y-m-d')) }}
                    {{ Carbon::parse($row->created_at)->format('H:i:s') }}.
                </p>
            </div>
        </div>
    @endforeach
@else
    <div class="alert alert-secondary text-center m-0">Belum ada penilaian.
    </div>
@endif
<script>
    function submitStar(service, star) {
        Swal.fire({
            title: "Anda yakin?",
            text: "Anda memberikan " + star + " bintang untuk layanan ini.",
            icon: 'question',
            showCancelButton: true,
            customClass: {
                confirmButton: "btn btn-primary bg-gradient",
                cancelButton: "btn btn-secondary bg-gradient ms-2",
            },
            buttonsStyling: false,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "{{ url('submit-rating') }}",
                    method: "POST",
                    data: {
                        service: service,
                        star: star,
                        _token: "{{ csrf_token() }}",
                    },
                    "dataType": "JSON",
                    success: function(data) {
                        if (data.status == true) {
                            fireNotif("success", data.text);
                            $('#modals').modal('hide');
                            Livewire.emit('refreshParent');
                        } else {
                            fireNotif("error", data.text)
                        }
                    },
                    error: function(data) {
                        fireNotif("error", "Terjadi kesalahan!")
                    }
                });
            }
        })
    }
    var rate = $('.mention-stars');
    $(rate).rateYo({
        rating: {{ $rating ?? 0 }},
        starWidth: "20px",
        readOnly: true,
        normalFill: "#424242",
        ratedFill: "#FFD700",
    });
</script>
