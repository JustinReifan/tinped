@extends('templates.main')
@section('content')
    <div id="title-page" data-value="Ketentuan" style="padding-top:24px;" data-value2="Referral"></div>
    <div class="card">
        <div class="card-header fw-bold p-3 text-xss">Ketentuan Referral</div>
        <div class="card-body">
            <div class="alert alert-primary">
                <div class="alert-body">
                    <i class="fas fa-exclamation-circle me-1"></i>Undang pengguna baru dan dapatkan komisi!
                    <br>Jika pengguna baru menggunaan kode referral kamu dan melakukan transaksi, kamu akan mendapatkan
                    saldo
                    komisi disetiap transaksi mereka.
                </div>
            </div>
            <a href="javascript:;" data-bs-toggle="modal" data-bs-target=".confirm-referral"
                class="btn btn-primary d-grid">AKTIFKAN SEKARANG</a>
        </div>
    </div>
    <div class="modal fade confirm-referral" tabindex="-1" aria-labelledby="modalsLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">Ketentuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="max-height: 500px; overflow: auto;">
                    {!! $config->tos_referral !!}
                </div>
                <div class="modal-footer">
                    <a href="{{ url('referral?action=agree') }}" class="btn btn-primary d-grid">AKTIFKAN SEKARANG</a>
                </div>
            </div>
        </div>
    </div>
@endsection
