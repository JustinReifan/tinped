@extends('templates.main')
@section('content')
    <style>
        .col-print-1 {
            width: 8%;
            float: left;
        }

        .col-print-2 {
            width: 16%;
            float: left;
        }

        .col-print-3 {
            width: 25%;
            float: left;
        }

        .col-print-4 {
            width: 33%;
            float: left;
        }

        .col-print-5 {
            width: 42%;
            float: left;
        }

        .col-print-6 {
            padding-left: 20px;
            width: 50%;
            float: left;
        }

        .col-print-7 {
            width: 58%;
            float: left;
        }

        .col-print-8 {
            width: 66%;
            float: left;
        }

        .col-print-9 {
            width: 75%;
            float: left;
        }

        .col-print-10 {
            width: 83%;
            float: left;
        }

        .col-print-11 {
            width: 92%;
            float: left;
        }

        .col-print-12 {
            padding-left: 20px;
            width: 100%;
            float: left;
        }

        .padding-y {
            padding-top: 18px;
            padding-bottom: 18px;
        }

        .bold {
            font-weight: 700;
        }
    </style>
    @php
        use Carbon\Carbon;

    @endphp
    <div id="title-page" data-value="Invoice" data-value2="Invoice Deposit"></div>
    <div class="row">
        <div class="col-lg-7 mx-auto">
            @if (session()->get('success'))
                <div class="alert alert-success" role="alert">
                    <b>Response</b> : Berhasil<br>
                    <b>Message</b> : {!! session()->get('success') !!}
                </div>
            @elseif (session()->get('error'))
                <div class="alert alert-danger" role="alert">
                    <b>Response</b> : Gagal! <br>
                    <b>Message</b> : {!! session()->get('error') !!}
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="topup-form el-col el-col-24" style="padding-left: 10px; padding-right: 10px;">
                        <div class="margin-y margin-x text-center mb-2">
                            <div class="bold extra-large margin-y-b">Isi Saldo via {{ Str::upper($deposit->name_payment) }}
                            </div>
                            <span class="text-medium">Transaksi Sukses, Silahkan Selesaikan pembayaran sesuai data di bawah
                                ini</span>
                        </div>
                        <div class="text-bold text-center padding-y"
                            style="background-color: rgb(249, 249, 249); color: red;">
                            <div class="red-text" style="font-size: 20px; font-weight: 800;">
                                <b>#</b>{{ $deposit->trxid }}
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-print-6">
                                Jumlah Transfer
                            </div>
                            <div class="col-print-6">
                                <div class="bold">
                                    <b>Rp. {{ number_format($deposit->amount, 0, ',', '.') }}</b>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-print-6">
                                Jumlah Diterima
                            </div>
                            <div class="col-print-6">
                                <div class="bold">
                                    <b>Rp. {{ number_format($deposit->diterima, 0, ',', '.') }}</b>
                                </div>
                            </div>
                        </div>
                        @if (strpos($channel->account_number, 'PAYDISINI') == false)
                            <div class="row mt-3">
                                <div class="col-print-6 ">
                                    Nomor Rekening Transfer
                                </div>
                                <div class="col-print-6 bold">
                                    {{ $channel->account_number }}
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-print-6">
                                    Nama Rekening
                                </div>
                                <div class="col-print-6 bold">
                                    {{ $channel->account_name }}
                                </div>
                            </div>
                        @endif
                        <div class="row mt-3">
                            <div class="col-print-6">
                                Status Deposit
                            </div>
                            <div class="col-print-6 bold">
                                @php
                                    if ($deposit->status == 'done') {
                                        $tk = 'fas fa-check-circle text-success mr-1';
                                        $class = 'success';
                                        $teks = 'Berhasil';
                                    } elseif ($deposit->status == 'pending') {
                                        $tk = 'fas fa-circle-notch fa-spin text-warning mr-1';
                                        $class = 'warning';
                                        $teks = 'Menunggu Pembayaran';
                                    } else {
                                        $tk = 'far fa-times-circle text-danger';
                                        $class = 'danger';
                                        $teks = 'Dibatalkan';
                                    }
                                @endphp
                                <i class="{{ $tk }}"></i>&nbsp;
                                <span class="text-{{ $class }}">{{ $teks }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-print-12">
                                @if ($deposit->status == 'pending')
                                    <div class="alert alert-warning mt-2">
                                        Mohon untuk transfer sesuai dengan jumlah yang tertera <b>(Tanpa Pembulatan)</b>,
                                        untuk memudahkan verifikasi transfer deposit.
                                        <br><br> <b>Catatan: </b> Jumlah transfer (<b>Rp.
                                            {{ number_format($deposit->amount, 0, ',', '.') }}</b>)
                                        hanya berlaku sampai (<b>
                                            {{ tanggal($deposit->created_at->addHours(3)->format('Y-m-d')) }}
                                            {{ date('H:i:s', strtotime($deposit->created_at->addHours(3))) }}</b>)
                                    </div>
                                @elseif ($deposit->status == 'done')
                                    <div class="alert alert-success mt-2">
                                        Pembayaran anda telah berhasil. Saldo anda sudah bertambah. Terima kasih telah
                                        menggunakan
                                        layanan
                                        kami.
                                    </div>
                                @else
                                    <div class="alert alert-danger mt-2">
                                        Pembayaran anda gagal. Silahkan coba lagi.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="text-center mb-3">
                        <button class="btn btn-primary" onclick="window.print()"><i class="fas fa-print"></i> Print</button>
                        @if ($deposit->status == 'pending')
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modals"
                                onclick="cancel('{{ $deposit->trxid }}')">Batalkan Pembayaran</button>
                        @endif
                        @if ($deposit->payment_url && $deposit->status == 'pending')
                            <a href="{{ $deposit->payment_url }}" class="btn btn-success">Lanjutkan Pembayaran</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function cancel(trxid) {
            delay = 900;
            $.ajax({
                url: "{{ route('deposit.cancel') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    trxid: trxid
                },
                beforeSend: function() {
                    $('#title').html('Cancel Deposit');
                    $('#isi').html(
                        '<div class="progress mb-4"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>'
                    );
                },
                success: function(data) {
                    setTimeout(function() {
                        $('#title').html('Cancel');
                        $('#content').html(data);
                    }, delay);
                },
                error: function() {
                    $('#title').html(name);
                    $('#isi').html('There is an error...');
                }
            });
        }
    </script>
@endsection
