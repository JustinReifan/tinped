<div class="row gy-2 gx-2 mt-3">
    @forelse ($channel as $row)
        <div class="col-12 col-md-6 col-lg-4">
            <div class="payment-menu h-100">
                <input type="radio" onclick="inputmetode('{{ $row->id }}')" name="method"
                    id="payment_{{ $row->id }}" value="{{ $row->id }}" data-payment-group="te">
                <label for="payment_{{ $row->id }}" class="payment-item h-100">
                    <div class="info-top">
                        <div>
                            <img src="{{ url($row->image) }}" alt="" height="25px">
                        </div>
                    </div>
                    <div class="info-bottom text-sm-left">
                        <span class="fw-bolder">{{ $row->name }}
                            @php
                                $decode = json_decode($row->bonus, true);
                                if (isset($decode[0]['nominal'])) {
                                    $bonus = $decode[0]['nominal'];
                                } else {
                                    $bonus = 0;
                                }
                            @endphp
                            @if ($row->type_proses == 'otomatis')
                                @if ($row->rate_type == 'percent')
                                    (Fee {{ $row->rate }}%)
                                @else
                                    (Fee Rp {{ number_format($row->rate, 0, ',', '.') }})
                                @endif
                            @endif
                            @if ($bonus > 0)
                                (Bonus {{ $bonus }}%)
                            @endif
                        </span>
                        <div class="">
                            @if ($row->type_proses == 'otomatis')
                                Dicek otomatis
                            @else
                                Konfirmasi Via Tiket
                            @endif
                        </div>
                    </div>
                </label>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-danger text-center">Tidak ada metode pembayaran yang tersedia</div>
        </div>
    @endforelse
    <div id="bonus"></div>
</div>
