@extends('templates.main')
@section('content')
    <div id="title-page" data-value="Deposit" data-value2="Baru"></div>
    <style>
        .form-check {
            display: block;
            min-height: 1.3125rem;
            padding-left: 10px;
            margin-bottom: 0.125rem;
        }
    </style>

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session('error') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($errors->all())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="p-3 card-header fw-bold text-xss"><i class="mdi mdi-wallet-plus-outline me-1"></i>Deposit Baru
                </div>
                <div class="card-body">
                    <form action="{{ url('deposit/proses') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Jenis Pembayaran <span class="text-danger">*</span></label>
                            <select class="form-control select2" style="width:100%" id="type_payment" name="type_payment">
                                <option selected disabled>Pilih jenis pembayaran</option>
                                @php
                                    $distinct = App\Models\MetodePembayaran::distinct()
                                        ->orderBy('type_payment', 'asc')
                                        ->get(['type_payment']);
                                @endphp
                                @forelse ($distinct as $dis)
                                    <option value="{{ $dis->type_payment }}">{{ $dis->type_payment }}</option>
                                @empty
                                    <option value="0">Data tidak tersedia</option>
                                @endforelse
                            </select>
                        </div>
                        <div id="metod"></div>
                        <div class="mb-3">
                            <label class="form-label">Nominal <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="nominal" placeholder="Masukkan nominal deposit"
                                name="nominal">
                        </div>
                        <div class="mt-2 row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Jumlah Transfer <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp.</span>
                                    <input type="text" class="form-control" id="jmlh" name="jmlh" readonly>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Saldo Diterima <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp.</span>
                                    <input type="text" class="form-control" id="get" name="get" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2 form-group float-end">
                            <button type="reset" class="mt-2 mr-1 btn btn-danger" id="reset">Reset</button>
                            <button type="submit" class="mt-2 btn btn-primary ">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="p-3 card-header fw-bold text-xss"><i class="mdi mdi-information-outline me-1"></i>Informasi
                </div>
                <div class="card-body">
                    <strong>Cara Melakukan Deposit Baru :</strong>
                    <ul>
                        <li>Pilih <em>Jenis Pembayaran</em>.</li>
                        <li>Pilih <em>Payment</em>.</li>
                        <li>Input <em>Nominal Deposit</em> yang Anda inginkan.</li>
                        <li>Transfer Pembayaran sesuai dengan nominal yang tertera.</li>
                        <li>
                            Saldo akan otomatis bertambah dalam beberapa menit apabila Anda menggunakan <em>Jenis
                                Permintaan</em> <b><em>OTOMATIS</em></b>.
                        </li>
                    </ul>
                    <strong>Penting !</strong>
                    <ul>
                        <li>Kami berhak menghapus atau memblokir akun Anda apabila terbukti melakukan kecurangan
                            pada
                            Deposit.</li>
                        <li>
                            Jika menggunakan <em>Jenis Permintaan</em> <b><em>MANUAL</em></b>, harap konfirmasi ke
                            Admin
                            agar Permintaan Deposit segera diterima.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script>
        let metodeId;
        $('.btn-primary').click(function() {
            var payment = $('input[name=payment]:checked').val();

            if (layanan == 0 || quantity == 0 || target == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Silahkan lengkapi data terlebih dahulu!',
                });
                return false;
            } else if (quantity < min || quantity > max) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Jumlah pesanan tidak sesuai dengan ketentuan layanan!'
                });
                return false;
            } else {
                $(this).html('<i class="mdi mdi-cart-arrow-up me-1"></i>Memproses...').attr('disabled', true);
                $('form').submit();
            }
        });
        $('#type_payment').change(function() {
            let value = $(this).val();
            if (value) {
                $.ajax({
                    type: "POST",
                    url: "{{ url('deposit/get-methode') }}",
                    dataType: 'json',
                    data: {
                        id: value,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        if (data.status) {
                            $('#metod').html(data.html);
                            $('#nominal').prop('disabled', false);
                            $('#nominal').attr('placeholder', 'Masukkan nominal deposit');
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.message
                            });
                            $('#nominal').prop('disabled', true);
                            $('#nominal').attr('placeholder', 'Pembayaran tidak tersedia...');
                        }


                    },
                    error: function() {
                        Swal.fire("Failed!", "Terjadi kesalahan, mohon refresh halaman ini", "error");
                    }
                });
            }
        });

        function inputmetode(id) {
            metodeId = id;
            $.ajax({
                type: "POST",
                url: "{{ url('deposit/bonus') }}",
                dataType: "html",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    $('#bonus').html(data);
                },
                error: function() {
                    Swal.fire("Failed!", "Terjadi kesalahan, mohon refresh halaman ini", "error");
                }
            })
        }
        $('#reset').click(function() {
            $('input[name="payment"]').prop('checked', false);
            $('#metod')
                .find('option')
                .remove()
                .end()
                .append('<option value="0">-- Pilih metode deposit --</option>')
                .val('0');
        });

    
        function debounce(fn, delay) {
            let timeout;
            return function(...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => fn.apply(this, args), delay);
            };
        }


        const handleInput = debounce(function() {
            var nominal = $('#nominal').val();
            var metod = $('#metod').val();
            if (nominal) {
                $.ajax({
                    url: "{{ url('deposit/get-fees') }}",
                    data: {
                        metod: metodeId,
                        nominal: nominal,
                        _token: "{{ csrf_token() }}"
                    },
                    type: 'POST',
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == true) {
                            document.getElementById("get").value = data.get;
                            document.getElementById("jmlh").value = data.jmlh;
                        } else {
                            Swal.fire("Failed!", data.message, "error");
                            $('input[name="payment"]').prop('checked', false);
                            // reset form
                            document.getElementById("get").value = '';
                            document.getElementById("jmlh").value = '';

                        }
                    },
                    error: function() {
                        Swal.fire("Failed!", "Terjadi kesalahan, mohon refresh halaman ini", "error");
                    }
                })
            }
        }, 300); // 👈 debounce 300 ms

        $('#nominal').on('input', handleInput);
        $('#metod').on('change', handleInput);
        


        $('.select2').select2();
    </script>
@endsection
