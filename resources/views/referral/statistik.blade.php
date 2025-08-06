@extends('templates.main')
@section('content')
    @php
        $configReferral = App\Models\ConfigReferral::where('level', Auth::user()->level)->first();
    @endphp
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-1">Rp {{ number_format($referral->komisi, 0, ',', '.') }}</h3>
                            <p class="text-muted mb-0">Komisi Referral</p>
                        </div>
                        <div class="col-4 text-end"><i class="ti ti-credit-card text-primary f-36"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-1">
                                @if ($configReferral->type_komisi == 'percent')
                                    {{ $configReferral->value }}%
                                @else
                                    Rp {{ number_format($referral->value, 0, ',', '.') }}
                                @endif
                            </h3>
                            <p class="text-muted mb-0">Referral Rate</p>
                        </div>
                        <div class="col-4 text-end"><i class="ti ti-percentage text-primary f-36"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="title-page" data-value="Statistik" data-value2="Referral"></div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header fw-bold p-3 text-xss"><i class="ti ti-chart-bar me-1"></i>Statistik Referral</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <span class="float-start"><b>Referral</b> Link</span>
                        </div>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm float-end"
                                    value="{{ url('reff/' . $referral->code) }}" disabled="">
                                <a href="javascript:;" class="btn btn-primary btn-sm copy"
                                    data-clipboard-text="{{ url('reff/' . $referral->code) }}"
                                    style="width: 100px; padding-top: 0.3rem;"><i class="fas fa-copy me-2"></i>Salin</a>
                            </div>
                        </div>
                    </div>
                    <a data-bs-toggle="modal" data-bs-target="#withdraw" href="javascript:;"
                        class="btn btn-success  mt-3 d-grid">Withdraw Komisi</a>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Level</th>
                                    <th>Komisi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $configs = App\Models\ConfigReferral::get();
                                @endphp
                                @forelse ($configs as $row)
                                    <tr>
                                        <td class="fw-bold">{{ strtoupper($row->level) }}</td>
                                        <td>
                                            @if ($row->type_komisi == 'percent')
                                                {{ $row->value }}% / Transaksi
                                            @else
                                                Rp {{ number_format($row->value, 0, ',', '.') }} / Transaksi
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card">
                <div class="card-body position-relative">
                    <div class="position-absolute end-0 top-0 p-3"><span
                            class="badge bg-primary">{{ ucfirst(Auth::user()->level) }}</span></div>
                    <div class="text-center mt-3">
                        <div class="chat-avtar d-inline-flex mx-auto"><img class="rounded-circle img-fluid wid-70"
                                src="{{ asset($config->default_image) }}" alt="User image"></div>
                        <h5 class="mb-0">{{ Auth::user()->name }}</h5>
                        <p class="text-muted text-sm">{{ strtoupper(Auth::user()->role) }}</p>
                        <hr class="my-3 border border-secondary-subtle">
                        <div class="row g-3">
                            <div class="col-6">
                                <h5 class="mb-0">{{ number_format($referral->visitors, 0, ',', '.') }}</h5><small
                                    class="text-muted">Visitors</small>
                            </div>
                            <div class="col-6 border border-top-0 border-bottom-0">
                                <h5 class="mb-0">
                                    {{ number_format($referral->registered, 0, ',', '.') }}
                                </h5><small class="text-muted">Registered</small>
                            </div>
                        </div>
                        <hr class="my-3 border border-secondary-subtle">
                    </div>
                    @livewireStyles
                    @livewire('referral.table-user', ['referral' => $referral])
                    @livewireScripts
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header fw-bold p-3 text-xss"><i class="ti ti-currency-dollar me-1"></i>Riwayat Withdraw</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Rate</th>
                            <th>Jumlah</th>
                            <th>Saldo yang didapatkan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $withdraw = App\Models\ReferralWithdraw::where('user_id', Auth::id())->get();
                        @endphp

                        @forelse ($withdraw as $row)
                            <tr>
                                <td>{{ tanggal(Carbon\Carbon::parse($row->created_at)->format('Y-m-d')) }}
                                    {{ Carbon\Carbon::parse($row->created_at)->format('H:i:s') }}</td>
                                <td>{{ $row->rate }}%</td>
                                <td>Rp {{ number_format($row->amount, 0, ',', '.') }}</td>
                                <td>
                                    Rp {{ number_format($row->balance, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse


                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="withdraw" tabindex="-1" aria-labelledby="modalsLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Withdraw Komisi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('referral/withdraw') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Saldo Komisi Anda</label>
                                    <input type="text" class="form-control"
                                        value="Rp {{ number_format($referral->komisi, 0, ',', '.') }}" disabled="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Jumlah Saldo <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="amount" id="amount">
                                        <button type="button" class="btn btn-primary"
                                            onclick="convert_all();">Semua</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Minimum Convert</label>
                                    <div class="input-group">
                                        <div class="input-group-text">Rp</div>
                                        <input type="text" class="form-control"
                                            value="{{ number_format($config->min_withdraw, 0, ',', '.') }}"
                                            disabled="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Saldo Diterima</label>
                                    <div class="input-group">
                                        <div class="input-group-text">Rp</div>
                                        <input type="text" class="form-control" id="total" value="0"
                                            disabled="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-0">
                            <button type="submit" class="btn btn-primary float-end"><i
                                    class="fas fa-random fs-6 me-2"></i>Convert</button>
                            <button type="reset" class="btn btn-danger float-end me-2"><i
                                    class="fas fa-sync fs-6 me-2"></i>Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @php
        $rate = $config->rate_withdraw;
    @endphp
    <script>
        function convert_all() {
            $('#amount').val('{{ $referral->komisi }}');
            $('#amount').change();
        }
        $('#amount').change(function() {
            let rate = '{{ $config->rate_withdraw }}';
            let amount = $('#amount').val();
            let total = amount - $('#amount').val() * rate / 100;
            $('#total').val(number_format(total, 0, ',', '.'));
        });
        @if (session()->has('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
            });
        @endif
        @if (session()->has('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
            });
        @endif
        @foreach ($errors->all() as $error)
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ $error }}',
            });
        @endforeach
    </script>
@endsection
