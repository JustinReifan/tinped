@extends('templates.main')
@section('content')
    <div id="title-page" data-value="Tiket Baru" data-value2="Layanan"></div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {!! session()->get('success') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ session()->get('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @foreach ($errors->all() as $message)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endforeach
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header fw-bold p-3 text-xss"><i class="mdi mdi-email-plus-outline me-1"></i>Tiket Baru
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ url('ticket/proses') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Subjek <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="subject">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tipe <span class="text-danger">*</span></label>
                            <select class="select2 form-control" name="type">
                                <option value="" selected disabled>Pilih...</option>
                                <option value="order">Pesanan</option>
                                <option value="deposit">Deposit</option>
                                <option value="other">Lainnya</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pesan <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="content" rows="4"></textarea>
                        </div>
                        <div class="mb-0">
                            <button type="submit" class="btn btn-primary waves-effect waves-light float-end"><i
                                    class="fab fa-telegram-plane me-1"></i>Kirim</button>
                            <button type="reset" class="btn btn-danger waves-effect waves-light float-end me-2"><i
                                    class="fa-solid fa-repeat me-1"></i>Ulangi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header fw-bold p-3 text-xss"><i class="mdi mdi-information-outline me-1"></i>Informasi
                </div>
                <div class="card-body">
                    <strong>Cara Membuat Tiket Baru :</strong>
                    <ul>
                        <li>Input <em>Subjek</em> yang Anda inginkan.</li>
                        <li>Pilih <em>Tipe Tiket</em> (Pesanan, Deposit, Lainnya).</li>
                        <li>Kami akan segera merespon tiket Anda.</li>
                    </ul>
                    <strong>Penting !</strong>
                    <ul>
                        <li>Kami berhak menghapus atau memblokir akun Anda apabila terbukti melakukan tindakan
                            pelanggaran
                            pada Tiket.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.btn-primary').click(function() {
            var subject = $('input[name=subject]').val();
            var type = $('select[name=type]').val();
            var content = $('textarea[name=content]').val();
            if (subject == '' || type == 0 || content == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Mohon isi semua kolom yang tersedia !',
                });
                return false;
            } else {
                $(this).html('<i class="mdi mdi-loading mdi-spin me-1"></i>Proses...');
                $('form').submit();
            }
        });
        $('.select2').select2();
    </script>
@endsection
