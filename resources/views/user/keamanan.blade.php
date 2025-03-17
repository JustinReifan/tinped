@extends('templates.main')
@section('content')
    <div id="title-page" data-value="Keamanan" data-value2="Account"></div>
    @php
        use App\Helpers\Encryption;
    @endphp

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
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ $error }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endforeach
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header fw-bold p-3 text-xss"><i class="fas fa-fire me-1"></i>API</div>
                <div class="card-body">
                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#api_key" role="tab">
                                <i class="fa-solid fa-lock me-1 align-middle"></i> <span class="d-md-inline-block">API
                                    Key</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#whitelist_ip" role="tab">
                                <i class="fas fa-list-ul me-1 align-middle"></i> <span class="d-md-inline-block">Whitelist
                                    IP</span>
                            </a>
                        </li>
                    </ul>
                    @php
                        $count = strlen(Auth::user()->api_key) - 15;
                    @endphp
                    <div class="tab-content pt-2">
                        <div class="tab-pane active" id="api_key" role="tabpanel">
                            <div class="mb-0">
                                <label class="form-label">API Key</label>

                                <div class="input-group mb-3">
                                    <input type="text" name="api_key" id="api_key" class="form-control mt-2"
                                        value="{{ substr_replace(Auth::user()->api_key, '*****', -$count) }}" readonly>
                                    <button type="button"
                                        data-clipboard-text="{{ Encryption::decrypt(Auth::user()->api_key) }}"
                                        class="btn copy btn-primary btn-sm mt-2">Copy</button>
                                </div>
                                <button onclick="resets()" class="btn btn-primary "><i
                                        class="mdi mdi-key-link me-1"></i>Buat Ulang API Key</button>
                            </div>
                        </div>
                        <div class="tab-pane" id="whitelist_ip" role="tabpanel">
                            <form method="POST" action="{{ url('account/update/whitelist-ip') }}">
                                @csrf
                                <div class="mb-2">
                                    <label class="form-label">Whitelist IP <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="whitelist_ip"
                                        value="{{ Auth::user()->whitelist_ip }}">
                                    <div class="alert alert-info mt-2">
                                        <i class="fas fa-info-circle"></i> Lebih dari 1 IP Statis? <br>
                                        Pisahkan setiap IP dengan koma (,) Contoh: 192.232.11.1,192.455.12.1
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password Saat Ini <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <div class="mb-0">
                                    <button type="submit" class="btn btn-primary "><i
                                            class="mdi mdi-shield-lock-outline me-1"></i>Ubah Whitelist IP</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function resets() {
            $.ajax({
                url: "{{ url('account/resetapi') }}",
                type: "POST",
                dataType: "json",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    if (data.status == true) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        })
                    } else {
                        Swal.fire({
                            title: 'Gagal!',
                            text: data.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        })
                    }
                },
                error: function(data) {
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan, silahkan coba lagi.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    })
                }
            })
        }
    </script>
@endsection
