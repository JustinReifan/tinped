@extends('templates.main')
@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar bg-light-primary"><i class="fas fa-wallet f-18"></i></div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="mb-1">Saldo Anda</p>
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">Rp
                                    {{ number_format(Auth::user()->balance, 0, ',', '.') }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar bg-light-primary">
                                <i class="fas fa-cart-arrow-down f-18"></i>
                            </div>
                        </div>
                        @php
                            $sum = App\Models\History::where('user_id', Auth::user()->id)
                                ->where('status', 'done')
                                ->sum('price');
                        @endphp
                        <div class="flex-grow-1 ms-3">
                            <p class="mb-1">Pesanan Selesai</p>
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">Rp {{ number_format($sum, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar bg-light-primary">
                                <i class="fas fa-money-bill-transfer f-18"></i>
                            </div>
                        </div>
                        @php

                            $sum = App\Models\Deposit::where('user_id', Auth::user()->id)
                                ->where('status', 'done')
                                ->sum('diterima');
                        @endphp
                        <div class="flex-grow-1 ms-3">
                            <p class="mb-1">Deposit Selesai</p>
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">Rp {{ number_format($sum, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="font-light alert alert-info fs-6">
                ⚠️ Ingin punya website seperti ini? Konsultasi gratis disini <a class="text-decoration-underline"
                    href="https://wa.me/6285931018333">Klik</a> 👈
            </div>
        </div>
        <div class="col-md-5">

            <div class="card accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse"
                            data-bs-target="#Service1" aria-expanded="true" aria-controls="1">
                            <i class="fas fa-star me-2"></i> Layanan Rekomendasi
                        </button>
                    </h2>
                    <div id="Service1" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <table class="table m-0 align-middle table-sm">

                                @php
                                    $hasValidService = false;
                                @endphp
                                
                                @foreach ($layananRekomendasi as $service)
                                    @if ($service->smm()->first())
                                        @php
                                            $hasValidService = true;
                                            $text = $service->service . '||' . $service->provider;
                                            $encrypt = App\Helpers\Encryption::encrypt($text);
                                        @endphp
                                        <tr>
                                            <td class="text-muted">{{ $loop->iteration }}</td>
                                            <td>{{ $service->smm()->first()->name }}</td>
                                            <td class="text-center">
                                                <a href="{{ url('order/single?id=' . $encrypt) }}" class="btn btn-sm btn-primary bg-gradient ms-2">
                                                    <i class="ti ti-shopping-cart"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                
                                @if (! $hasValidService)
                                    <tr>
                                        <td colspan="3" class="text-center">Layanan rekomendasi kosong</td>
                                    </tr>
                                @endif

                            </table>
                           
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <i class="fas fa-chart-line me-2"></i> Layanan Terlaris Bulan Ini
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <table class="table m-0 align-middle table-sm">
                                @php
                                    $m = date('m');
                                    $month = date('m');
                                    $year = date('Y');
                                    $days = Carbon::now()->daysInMonth;
                                    $tanggal = "$year-$month-01 00:00:00";
                                    $tgl = "$year-$month-$days 00:00:00";
                                    $layananTerlaris = App\Models\History::select(
                                        'service_id',
                                        'layanan',
                                        DB::raw('COUNT(*) as total_orders'),
                                    )
                                        ->groupBy('service_id', 'layanan')
                                        ->orderByDesc('total_orders')
                                        ->whereBetween('created_at', [$tanggal, $tgl])
                                        ->take(5)
                                        ->get();
                                    $i = 1;
                                @endphp
                                @forelse ($layananTerlaris as $row)
                                    <tr>
                                        <td class="text-muted">
                                            {{ $i++ }}</td>
                                        <td class>
                                            {{ $row->layanan }}</td>
                                        <td class="text-center">
                                            <a href="{{ url('order/single?id=' . $row->service_id) }}"
                                                class="btn btn-sm btn-primary bg-gradient ms-2"><i
                                                    class="ti ti-shopping-cart"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <i class="fas fa-history me-2"></i> Layanan Yang Sering Anda Pesan
                            Bulan Ini
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <table class="table m-0 align-middle table-sm">
                                @php
                                    $layananCount = App\Models\History::select(
                                        'service_id',
                                        'layanan',
                                        DB::raw('COUNT(*) as total_orders'),
                                    )
                                        ->where('user_id', Auth::user()->id)
                                        ->groupBy('service_id', 'layanan')
                                        ->orderByDesc('total_orders')
                                        ->whereBetween('created_at', [$tanggal, $tgl])
                                        ->take(5)
                                        ->get();
                                    $i = 1;
                                @endphp
                                @forelse ($layananCount as $row)
                                    <tr>
                                        <td class="text-muted">
                                            {{ $i++ }}</td>
                                        <td class>
                                            {{ $row->layanan }}</td>
                                        <td class="text-center">
                                            <a href="{{ url('order/single?id=' . $row->service_id) }}"
                                                class="btn btn-sm btn-primary bg-gradient ms-2"><i
                                                    class="ti ti-shopping-cart"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            <i class="fas fa-calendar-check me-2"></i> Layanan Terakhir Yang Anda Pesan Bulan
                            Ini
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                        data-bs-parent="#accordionExample">
                        @php
                            // Ambil data history 1 bulan terakhir
                        @endphp
                        <div class="accordion-body">
                            <table class="table m-0 align-middle table-sm">
                                @php
                                    $terakhir = App\Models\History::distinct()
                                        ->where('user_id', Auth::user()->id)
                                        ->whereBetween('created_at', [$tanggal, $tgl])
                                        ->get(['service_id', 'layanan', 'id']) // Include 'id'
                                        ->sortByDesc('id') // Replace orderBy with sortByDesc since you're using Collections
                                        ->take(5);
                                    $i = 1;
                                @endphp
                                @forelse ($terakhir as $row)
                                    <tr>
                                        <td class="text-muted">
                                            {{ $i++ }}</td>
                                        <td class>
                                            {{ $row->layanan }}</td>
                                        <td class="text-center">
                                            <a href="{{ url('order/single?id=' . $row->service_id) }}"
                                                class="btn btn-sm btn-primary bg-gradient ms-2"><i
                                                    class="ti ti-shopping-cart"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="p-3 card-header fw-bold text-xss"><i class="fas fa-bullhorn me-2"></i>Informasi Terbaru</div>
                <div class="pb-3 card-body" style="max-height: 401px; overflow: auto;">
                    <ul class="list-group list-group-flush border-top-0">
                        @php
                            $berita = App\Models\Announcement::orderBy('id', 'DESC')->limit(3)->get();
                            $berita2 = App\Models\Announcement::orderBy('id', 'asc')->limit(3)->get();
                            $first = $berita2->first();
                        @endphp
                        @foreach ($berita as $row)
                            @php
                                if ($row->type == 'info') {
                                    $type = 'primary';
                                    $icon = 'fas fa-info-circle';
                                    $text = 'Informasi';
                                } else {
                                    $type = 'success';
                                    $icon = 'ti ti-message-report';
                                    $text = 'Layanan';
                                }
                            @endphp
                            <li class="px-0 pt-0 list-group-item">
                                <div class="d-flex align-items-start">
                                    <div class="mt-3 flex-grow-1 me-2">
                                        <span class="mb-0"><span
                                                class="text-white fs-5 badge fw-bold bg-primary rounded-pill"><i
                                                    class="fas fa-info-circle me-2"></i>{{ strtoupper($row->type) }}
                                            </span><small
                                                class="fw-normal float-end">{{ tanggal(Carbon::parse($row->created_at)->format('Y-m-d')) }}
                                                -
                                                {{ Carbon::parse($row->created_at)->format('H:i') }}</small></span>
                                        <p class="text-muted" style="margin-bottom: 8px;">
                                        <p>
                                            @php
                                                $row->message = nl2br($row->message);
                                                $row->message = preg_replace(
                                                    '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/',
                                                    '<a href="$0" target="_blank">$0</a>',
                                                    $row->message,
                                                );

                                            @endphp
                                            {!! $row->message !!}
                                        </p>
                                        @if ($row->id == $first->id)
                                            <b><small class="text-muted">Pembaruan terakhir:
                                                    {{ tanggal(Carbon::parse($row->created_at)->format('Y-m-d')) }} -
                                                    {{ Carbon::parse($row->created_at)->format('H:i') }}</small></b>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <hr class="mt-0">
                    <div class="d-grid">
                        <a href="{{ url('news/berita') }}" class="mb-0 btn btn-primary">Lihat Semua</a>
                    </div>
                </div>
            </div>
            <div class="max-w-xl mt-4 overflow-hidden border rounded shadow-sm w-100 border-primary"
                style="max-width: 36rem;">
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.youtube.com/embed/L0RSC-aVCVA?si=tiQuC-_8fabL_CVp"
                        title="TINPED SMM Tutorial" frameborder="0"
                        allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
