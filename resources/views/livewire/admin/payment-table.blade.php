@php

@endphp
<div>


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
        <div class="col-md-!2">
            <div class="card">
                <div class="card-header fw-bold p-3 text-xss"><i class="mdi mdi-message-draw"></i>Tambah metode
                    pembayaran
                    <div class="float-end" style="cursor: pointer;">
                        <i class="mdi mdi-arrow-down"></i>
                    </div>
                    </h5>
                    <div class="card-body" id="card-toggle">
                        <form wire:submit.prevent="savednews">
                            <div class="row">
                                <div class="col-md">
                                    <label class="form-label">Provider <span class="text-danger">*</span></label>
                                    <input type="text" name="code" placeholder="Masukkan provider"
                                        wire:model.lazy="provider" id="code" class="form-control">
                                    @error('code')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md">
                                    <label class="form-label">Type Process <span class="text-danger">*</span></label>
                                    <select name="type" id="type" class="form-control" wire:model.lazy="type">
                                        <option value="">Pilih Type Process</option>
                                        <option value="auto">Otomatis</option>
                                        <option value="manual">Manual</option>
                                    </select>
                                    @error('type')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md">
                                    <label class="form-label">Code Payment <span class="text-danger">*</span></label>
                                    <input type="text" name="code" placeholder="Masukkan code payment"
                                        wire:model.lazy="code" id="code" class="form-control">
                                    @error('code')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md">
                                    <label for="" class="form-label">Name Payment <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name" wire:model.lazy="name"
                                        placeholder="Masukkan nama payment" id="name" class="form-control">
                                    @error('code')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md">
                                    <label for="" class="form-label">Rate Type<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" wire:model="rate_type">
                                        <option value="">Pilih Rate Type</option>
                                        <option value="percent">Percentage</option>
                                        <option value="fixed">Nominal</option>
                                    </select>
                                    @error('rate_type')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md">
                                    <label for="" class="form-label">Rate<span
                                            class="text-danger">*</span></label>
                                    <input type="number" name="rate" id="rate" wire:model.lazy="rate"
                                        placeholder="Masukkan rate" class="form-control">
                                    @error('rate')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md">
                                    <label for="" class="form-label">Name Account<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="account_name" id="account_name"
                                        wire:model.lazy="account_name" placeholder="Masukkan Name Account"
                                        class="form-control">
                                    @error('account_name')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md">
                                    <label for="" class="form-label">Number Account<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="account_number" id="account_number"
                                        wire:model.lazy="account_number" placeholder="Masukkan Number Account"
                                        class="form-control">
                                    @error('account_number')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <label for="" class="form-label mt-2">Description<span
                                    class="text-danger">*</span></label>
                            <textarea name="description" placeholder="Masukkan deskripsi" id="description" wire:model.lazy="description"
                                class="form-control" cols="30" rows="2"></textarea>
                            @error('description')
                                <span class="error">{{ $message }}</span>
                            @enderror
                            <div class="float-end mt-2">
                                <button class="btn btn-danger" type="reset">Reset</button>
                                <button class="btn btn-info" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="btn-group flex-wrap">
                            <button wire:click="all" class="btn btn-primary">Semua</button>
                            <button wire:click="active" class="btn btn-primary">Active</button>
                            <button wire:click="nonaktif" class="btn btn-primary">Nonaktif</button>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header fw-bold p-3 text-xss"><i class="mdi mdi-ticket me-1"></i>Metode Pembayaran
                        </h5>
                        <div class="card-body">
                            <form method="get" class="row">
                                <div class="col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Tampilkan</span>
                                        </div>
                                        <select wire:model.change="perPage" class="form-control" name="row"
                                            id="table-row">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                        <div class="input-group-append">
                                            <span class="input-group-text">baris.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group mb-3">
                                        <input type="text" wire:model.live.debounce.300ms="search"
                                            class="form-control" name="search" id="table-search" value=""
                                            placeholder="Cari...">
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr class="text-uppercase">
                                            <th>ID</th>
                                            <th>Provider</th>
                                            <th>Process</th>
                                            <th>Code</th>
                                            <th>Name Payment</th>
                                            <th>Rate Type</th>
                                            <th>Rate</th>
                                            <th>Name Account</th>
                                            <th>Number Account</th>
                                            <th>Deskripsi</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($list->count() > 0)
                                            @foreach ($list as $row)
                                                @php
                                                    if ($row->status == 'inactive') {
                                                        $status = 'danger';
                                                        $text = 'Nonaktif';
                                                    } elseif ($row->status == 'active') {
                                                        $status = 'success';
                                                        $text = 'Aktif';
                                                    }
                                                @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ Str::ucfirst($row->provider) }}</td>
                                                    <td>{{ $row->process }}</td>
                                                    <td>{{ $row->code }}</td>
                                                    <td>{{ $row->name }}</td>
                                                    <td>{{ $row->rate_type }}</td>
                                                    @if ($row->rate_type == 'percent')
                                                        <td>{{ $row->rate }}%</td>
                                                    @else
                                                        <td>{{ $row->rate }}</td>
                                                    @endif
                                                    <td>{{ $row->account_name }}</td>
                                                    <td>{{ $row->account_number }}</td>
                                                    <td>{{ $row->description }}</td>
                                                    <td><span
                                                            class="btn btn-soft-{{ $status }} btn-sm ">{{ $text }}</span>
                                                    </td>
                                                    <td class="text-nowrap">
                                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#modal"
                                                            wire:click="editPayment('{{ $row->id }}')">Edit</button></button>
                                                        @if ($row->status == 'active')
                                                            <button class="btn btn-danger btn-sm"
                                                                wire:click.prevent='nonaktifkan({{ $row->id }})'>
                                                                Nonaktifkan
                                                            </button>
                                                        @else
                                                            <button class="btn btn-success btn-sm"
                                                                wire:click.prevent='aktifkan({{ $row->id }})'>
                                                                Aktifkan
                                                            </button>
                                                        @endif
                                                        <button class="btn btn-danger btn-sm"
                                                            wire:click.prevent="deleteMetode({{ $row->id }})"><i
                                                                class="mdi mdi-delete"></i></button>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="8" class="text-center">Data Not Found</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                {{ $list->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal" wire:ignore.self tabindex="-1" aria-labelledby="modalsLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Pembayaran</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form wire:submit.prevent="SaveEdit">
                            <div class="modal-body" id="content">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-box">
                                        <tr>
                                            <th>Provider</th>
                                            <td>
                                                <input type="text" name="" wire:model.lazy="provider"
                                                    id="provider" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Process</th>
                                            <td>
                                                <input type="text" name="" wire:model.lazy="type"
                                                    id="process" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Code</th>
                                            <td>
                                                <input type="text" name="" wire:model.lazy="code"
                                                    id="code" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <td>
                                                <input type="text" name="" wire:model.lazy="name"
                                                    id="name" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Rate Type</th>
                                            <td>
                                                <select class="form-control" wire:model="rate_type">
                                                    <option value="">Pilih Rate Type</option>
                                                    <option value="percent">Percentage</option>
                                                    <option value="fixed">Nominal</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Rate</th>
                                            <td>
                                                <input type="text" name="" wire:model.lazy="rate"
                                                    id="rate" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Name Account</th>
                                            <td>
                                                <input type="text" name="" wire:model.lazy="account_name"
                                                    id="account_name" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Number Account</th>
                                            <td>
                                                <input type="text" name="" wire:model.lazy="account_number"
                                                    id="account_number" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <td>
                                                <textarea name="description" placeholder="Masukkan deskripsi" id="description" wire:model.lazy="description"
                                                    class="form-control" cols="30" rows="2"></textarea>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer" wire:ignore>
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">Save
                                    changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg">
                <div class="card">
                    <div class="card-header fw-bold p-3 text-xss"><i class="mdi mdi-ticket me-1"></i>Gopay</h5>

                        @php
                            $search = App\Models\Gopay::where([['status', 'active']])->first();
                        @endphp
                        @if (!$search)
                            <form action="{{ url('koneksi/encrypt/gopay') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <label class="col-form-label fw-semibold fs-6 pt-0">Nomor Handphone</label>

                                    <div class="input-group input-group-solid">
                                        <input type="hidden" name="otptoken" id="gopay_otptoken" />
                                        <input type="number" name="phonenumber" id="gopay_phonenumber"
                                            class="form-control mb-3 mb-lg-0" placeholder="Masukkan Nomor Handphone"
                                            value="" required />
                                        <button type="button" class="btn btn-primary btn-sm" onclick="otpgopay()">
                                            Kirim Kode OTP
                                        </button>
                                    </div>
                                    <div class="mb-7 mt-2">
                                        <label class="col-form-label fw-semibold fs-6 pt-0">Kode OTP</label>

                                        <div class="input-group input-group-solid">
                                            <input type="number" name="otpcode" id="gopay_otpcode"
                                                class="form-control mb-3 mb-lg-0" placeholder="Masukkan Kode OTP"
                                                required />

                                            <button type="button" class="btn btn-primary" id="gopay_login"
                                                onclick="loginGopay()" disabled>
                                                Login
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @else
                            <div class="d-flex justify-content-center mb-3 py-6 px-9">
                                <button type="submit" class="btn btn-info" onclick="changeaccount('gopay')">
                                    Change Account
                                </button>
                                <button type="submit" style="margin-left: 8px;" onclick="mutasigopay()"
                                    class="btn btn-success">
                                    Cek Mutasi
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg">


                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <div class="card-title">E Wallet OVO</div>
                            </div>
                        </div>

                        @php
                            $search = App\Models\Ovo::where([['status', 'active']])->first();
                        @endphp
                        @if (!$search)
                            <form action="{{ url('koneksi/encrypt/ovo') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <label for="">No. Handphone</label>

                                    <div class="input-group input-group-solid">
                                        <input type="hidden" name="otptoken" id="ovo_otptoken" />
                                        <input type="number" name="phonenumber" id="ovo_phonenumber"
                                            class="form-control form-control-solid mb-3 mb-lg-0"
                                            placeholder="Masukkan Nomor Handphone" required />
                                        <button type="button" class="btn btn-primary btn-sm" onclick="otpOvo()">
                                            Kirim Kode OTP
                                        </button>
                                    </div>

                                    <div class="mb-7 mt-2">
                                        <label class="col-form-label fw-semibold fs-6 pt-0">Kode OTP</label>

                                        <div class="input-group input-group-solid">
                                            <input type="text" name="pin" id="ovo_pins"
                                                class="form-control form-control-solid mb-3 mb-lg-0"
                                                placeholder="Masukkan Pin Account" required />
                                            <button type="button" class="btn btn-primary btn-sm" id="ovo_logins"
                                                onclick="loginOvo()">
                                                Login
                                            </button>
                                        </div>
                                    </div>
                                    <div class="mb-7 mt-2">
                                        <label class="col-form-label fw-semibold fs-6 pt-0">Pin Account</label>
                                        <div class="input-group input-group-solid">
                                            <input type="password" name="pin" id="ovo_pin"
                                                class="form-control form-control-solid mb-3 mb-lg-0"
                                                placeholder="Masukkan Pin Account" required />
                                            <button type="button" class="btn btn-primary btn-sm" id="ovo_logins"
                                                onclick="pinOVO()">
                                                Submit Pin
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @else
                            <div class="d-flex justify-content-center mb-3 py-6 px-9">
                                <button type="submit" class="btn btn-info" onclick="changeaccount('ovo')">
                                    Change Account
                                </button>
                                <button type="submit" style="margin-left: 8px;" onclick="mutasiovo()"
                                    class="btn btn-success">
                                    Cek Mutasi
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md">
                    <div class="card" id="blockui">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <div class="card-title">All Mutasi</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="mutasi"></div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function mutasigopay() {
                    $('#blockui').block({
                        message: '<div class="spinner-grow text-primary" role="status">Loading...</span><div>',
                        timeout: 10000,
                    });
                    $.ajax({
                        url: "{{ route('koneksi.encrypt.gopay.mutasi') }}",
                        type: "POST",
                        dataType: "html",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            $('#blockui').unblock();
                            $('#mutasi').html(data);
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            });
                            $('#mutasi').html('');
                        }
                    });
                }

                function mutasiovo() {
                    $('#blockui').block({
                        message: '<div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span><div>',
                        timeout: 10000,
                    });
                    $.ajax({
                        url: "{{ route('koneksi.encrypt.ovo.mutasi') }}",
                        type: "POST",
                        dataType: "html",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            $('#blockui').unblock();
                            $('#mutasi').html(data);
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            });
                            $('#mutasi').html('');
                        }
                    });
                }
            </script>
            <script>
                function changeaccount(data) {
                    Swal.fire({
                        title: 'Apakah anda yakin?',
                        text: "Anda akan mengganti akun bank BCA anda!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, ganti!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ url('admin/koneksi/encrypt/changeaccount') }}",
                                type: "POST",
                                data: {
                                    data: data,
                                    _token: "{{ csrf_token() }}"
                                },
                                success: function(data) {
                                    Swal.fire(
                                        'Berhasil!',
                                        data.message,
                                        'success'
                                    ).then((result) => {
                                        location.reload();
                                    })
                                },
                                error: function(data) {
                                    Swal.fire(
                                        'Gagal!',
                                        'Gagal mengganti akun',
                                        'error'
                                    )
                                }
                            })
                        }
                    })
                }
                window.addEventListener('success', event => {
                    $('#type').val('');
                    $('#code').val('');
                    $('#name').val('');
                    $('#rate').val('');
                    $('#account_number').val('');
                    $('#account_name').val('');
                    $('#description').val('');
                    Swal.fire(
                        'Terhapus!',
                        event.detail[0].message,
                        'success'
                    )
                });
                window.addEventListener('failed', event => {
                    Swal.fire(
                        'Gagal!',
                        event.detail[0].message,
                        'error'
                    )
                });
                window.addEventListener('HideModal', event => {
                    $('#modal').modal('hide');
                });
                $('button[type=reset]').click(function() {
                    $('#code').val('');
                    $('#name').val('');
                    $('#rate').val('');
                    $('#account_number').val('');
                    $('#account_name').val('');
                    $('#description').val('');
                });
                window.addEventListener('delete-confirmation', event => {
                    Swal.fire({
                        title: 'Apakah Anda Yakin?',
                        text: "Data yang dihapus tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Hapus!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Livewire.emit('deleteMetode')
                        }
                    })
                });

                function otpgopay() {
                    $.ajax({
                        url: "{{ route('gopay.otp') }}",
                        type: "POST",
                        data: {
                            phonenumber: $("#gopay_phonenumber").val(),
                            _token: "{{ csrf_token() }}",
                        },
                        dataType: "JSON",
                        success: function(data) {
                            if (data.status == true) {
                                $("#gopay_login").removeAttr("disabled");
                                Swal.fire({
                                    icon: "success",
                                    title: "Berhasil",
                                    text: "Kode OTP berhasil dikirim",
                                });
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Gagal",
                                    text: "Kode OTP gagal dikirim",
                                });
                            }
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: "error",
                                title: "Gagal",
                                text: "Terjadi kesalahan",
                            });
                        },
                    });
                }

                function otpOvo() {
                    $.ajax({
                        url: "{{ route('ovo.otp') }}",
                        type: "POST",
                        data: {
                            phonenumber: $("#ovo_phonenumber").val(),
                            _token: "{{ csrf_token() }}",
                        },
                        dataType: "JSON",
                        success: function(data) {
                            if (data.status == true) {
                                $("#ovo_login").removeAttr("disabled");
                                Swal.fire({
                                    icon: "success",
                                    title: "Berhasil",
                                    text: "Kode OTP berhasil dikirim",
                                });
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Gagal",
                                    text: "Kode OTP gagal dikirim",
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: "error",
                                title: "Gagal",
                                text: "Terjadi kesalahan",
                            });
                        },
                    });
                }

                function pinOVO() {
                    $.ajax({
                        url: "{{ route('ovo.pin') }}",
                        type: "POST",
                        data: {
                            phonenumber: $("#ovo_phonenumber").val(),
                            ovo_pin: $("#ovo_pin").val(),
                            _token: "{{ csrf_token() }}",
                        },
                        dataType: "JSON",
                        success: function(data) {
                            if (data.status == true) {
                                $("#ovo_login").removeAttr("disabled");
                                Swal.fire({
                                    icon: "success",
                                    title: "Berhasil",
                                    text: "Konfigurasi Akun ovo berhasil",
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.reload();
                                    }
                                });
                            } else if (data.status == false) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Gagal",
                                    text: data.message,
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: "error",
                                title: "Gagal",
                                text: "Terjadi kesalahan",
                            });
                        },
                    });
                }

                function loginGopay() {
                    $.ajax({
                        url: "{{ route('gopay.login') }}",
                        type: "POST",
                        data: {
                            phonenumber: $("#gopay_phonenumber").val(),
                            gopay_otpcode: $("#gopay_otpcode").val(),
                            _token: "{{ csrf_token() }}",
                        },
                        dataType: "json",
                        success: function(data) {
                            console.log(data);
                            if (data.status == true) {
                                $("#gopay_login").removeAttr("disabled");
                                Swal.fire({
                                    icon: "success",
                                    title: "Berhasil",
                                    text: "Login berhasil",
                                }).then((result) => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Gagal",
                                    text: "Login gagal",
                                });
                            }
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: "error",
                                title: "Gagal",
                                text: "Terjadi kesalahan",
                            });
                        },
                    });
                }

                function loginOvo() {
                    var otp = $("#ovo_pins").val();
                    if (otp == "" || otp == undefined) {
                        Swal.fire({
                            icon: "error",
                            title: "Gagal",
                            text: "Kode OTP tidak boleh kosong",
                        });
                        return false;
                    }
                    $.ajax({
                        url: "{{ route('ovo.login') }}",
                        type: "POST",
                        data: {
                            phonenumber: $("#ovo_phonenumber").val(),
                            ovo_otpcode: otp,
                            _token: "{{ csrf_token() }}",
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data.status == true) {
                                $("#ovo_logins").removeAttr("disabled");
                                Swal.fire({
                                    icon: "success",
                                    title: "Berhasil",
                                    text: "Login berhasil",
                                });
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Gagal",
                                    text: "Login gagal",
                                });
                            }
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: "error",
                                title: "Gagal",
                                text: "Terjadi kesalahan",
                            });
                        },
                    });

                }
            </script>
