<form action="{{ url('admin/konfigurasi/set_profit') }}" method="POST">
    <input type="hidden" name="id" value="{{ $provider->id }}">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <h6>Setting profit Provider {{ $provider->nama }}</h6>
        </div>
        @php
            $decode = json_decode($provider->profit, true);
        @endphp
        @foreach ($decode as $key => $value)
            <input type="hidden" name="{{ $key }}[min]" value="{{ $value['min'] }}">
            <input type="hidden" name="{{ $key }}[max]" value="{{ $value['max'] }}">
            <div class="form-group col-3 col-lg-3">
                <select class="form-control " name="{{ $key }}[type]" aria-hidden="true">
                    <option value="">Pilih...</option>
                    <option value="percent"{{ $value['type'] == 'percent' ? 'selected' : '' }}>% (Persen)</option>
                    <option value="fixed" {{ $value['type'] == 'fixed' ? 'selected' : '' }}>+ (Tambah)</option>
                    <option value="minus" {{ $value['type'] == 'minus' ? 'selected' : '' }}>- (Minus)</option>
                </select>
            </div>
            <div class="form-group col-5 col-lg-6">
                <input type="text" class="form-control" name="{{ $key }}[profit]" placeholder=""
                    value="{{ $value['profit'] }}">
            </div>
            <div class="form-group col-4 col-lg-3">
                <input type="text" class="form-control"
                    @if ($key == '4') value=">- {{ number_format($value['min'], 0, ',', '.') }}"
                    @else
                    value="{{ number_format($value['min'], 0, ',', '.') . ' - ' . number_format($value['max'], 0, ',', '.') }}" @endif
                    disabled="">
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-6">
            <div class="button-items d-grid gap-2">
                <button type="reset" class="btn btn-secondary btn-block waves-effect waves-light mt-0"><i
                        class="ti ti-repeat-once"></i> Reset</button>
            </div>
        </div>
        <div class="col-6">
            <div class="button-items d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-block waves-effect waves-light mt-0"><i
                        class="ti ti-send"></i> Submit</button>
            </div>
        </div>
    </div>
</form>
