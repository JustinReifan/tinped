<div>
    <style>
        label {
            margin-top: 3px;
        }
    </style>
    <div class="card">
        <div class="card-body py-0">
            <ul class="nav nav-tabs profile-tabs " id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link {{ $tab == 'api_key' ? 'active' : '' }}" id="api_key-tab"
                        wire:click="$set('tab','api_key')" data-bs-toggle="tab" href="#api_key" role="tab"
                        aria-selected="true"><i class="fas fa-fire me-2"></i>Api key</a>
                </li>
                <li class="nav-item"><a class="nav-link {{ $tab == 'batas-saldo' ? 'active' : '' }}"
                        id="batas-saldo-tab" wire:click="$set('tab','batas-saldo')" data-bs-toggle="tab"
                        href="#batas-saldo" role="tab" aria-selected="true"><i
                            class="ti ti-currency-dollar me-2"></i>Batas
                        Saldo</a>
                </li>
                <li class="nav-item"><a class="nav-link {{ $tab == 'max-pesanan' ? 'active' : '' }}"
                        id="max-pesanan-tab" wire:click="$set('tab','max-pesanan')" data-bs-toggle="tab"
                        href="#max-pesanan" role="tab" aria-selected="true"><i
                            class="ti ti-shopping-cart me-2"></i>Max Pesanan</a>
                </li>
                <li class="nav-item"><a class="nav-link {{ $tab == 'deposit' ? 'active' : '' }}" id="deposit-tab"
                        wire:click="$set('tab','deposit')" data-bs-toggle="tab" href="#deposit" role="tab"
                        aria-selected="true"><i class="ti ti-credit-card me-2"></i>Notif deposit</a>
                </li>
                <li class="nav-item"><a class="nav-link {{ $tab == 'tiket' ? 'active' : '' }}" id="tiket-tab"
                        wire:click="$set('tab','tiket')" data-bs-toggle="tab" href="#tiket" role="tab"
                        aria-selected="true"><i class="ti ti-ticket me-2"></i>Notif tiket</a>
                </li>
                <li class="nav-item"><a class="nav-link {{ $tab == 'reply_admin' ? 'active' : '' }}"
                        id="reply_admin-tab" wire:click="$set('tab','reply_admin')" data-bs-toggle="tab"
                        href="#reply_admin" role="tab" aria-selected="true"><i class="ti ti-user me-2"></i>Reply
                        tiket admin</a>
                </li>
                <li class="nav-item"><a class="nav-link {{ $tab == 'forgot_password' ? 'active' : '' }}"
                        id="forgot_password-tab" wire:click="$set('tab','forgot_password')" data-bs-toggle="tab"
                        href="#forgot_password" role="tab" aria-selected="true"><i
                            class="ti ti-keyboard me-2"></i>Forgot Password</a>
                </li>
            </ul>
            <div class="tab-content mt-3 mb-3">
                <div class="tab-pane show {{ $tab == 'api_key' ? 'active' : '' }}" id="api_key" role="tabpanel"
                    aria-labelledby="api_key-tab">
                    <div class="col-lg-12">
                        <h6>1. Data</h6>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-form-label form-label" for="example-fileinput">Url Send
                            Message</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="url" id="url"
                                value="{{ $bot->url }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-form-label form-label" for="example-fileinput">Api Key</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="api_keys" id="api_keys"
                                value="{{ $bot->api_key }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-form-label form-label" for="example-fileinput">Device key / Number
                        </label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="device_key" id="device_key"
                                value="{{ $bot->device_key }}">
                        </div>
                    </div>
                    <hr>
                    @php
                        $decode = json_decode($bot->konfigurasi, true);
                    @endphp
                    <div class="row">
                        <div class="col-lg-12">
                            <h6>2. Request</h6>
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="api_key"
                                placeholder="Kosongkan jika tidak dibutuhkan"
                                value="{{ $decode['api_key'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Api key" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="device_keys" placeholder=""
                                value="{{ $decode['device_key'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Device key atau nomor whatsapp"
                                disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="target" placeholder=""
                                value="{{ $decode['target'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Target / tujuan" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="message"
                                placeholder="Kosongkan jika tidak dibutuhkan"
                                value="{{ $decode['message'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Rahasia" disabled="">
                        </div>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-primary" id="saveApiKey">Simpan</button>
                    </div>
                </div>
                <div class="tab-pane show {{ $tab == 'batas-saldo' ? 'active' : '' }}" id="batas-saldo"
                    role="tabpanel" aria-labelledby="batas-saldo-tab">
                    <div class="row">
                        <div class="col-md">
                            <div class="card border border-primary">
                                <div class="card-header bg-transparent border-primary">
                                    <h5 class="my-0 text-primary"><i class="fa-solid fa-bullseye me-2"></i>Daftar
                                        Variabel</h5>
                                </div>
                                <div class="card-body">
                                    <label class="form-label">Nama user</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm"
                                            value="((name_user))" disabled="">
                                        <a href="javascript:;"
                                            class="btn btn-primary btn-sm copy waves-effect waves-light"
                                            data-clipboard-text="((name_user))"
                                            style="width: 100px; padding-top: 0.3rem;"><i
                                                class="fas fa-copy me-2"></i>Salin</a>
                                    </div>
                                    <label class="form-label">Email user</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm"
                                            value="((email_user))" disabled="">
                                        <a href="javascript:;"
                                            class="btn btn-primary btn-sm copy waves-effect waves-light"
                                            data-clipboard-text="((email_user))"
                                            style="width: 100px; padding-top: 0.3rem;"><i
                                                class="fas fa-copy me-2"></i>Salin</a>
                                    </div>
                                    <label class="form-label">Balance user</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm"
                                            value="((balance_user))" disabled="">
                                        <a href="javascript:;"
                                            class="btn btn-primary btn-sm copy waves-effect waves-light"
                                            data-clipboard-text="((balance_user))"
                                            style="width: 100px; padding-top: 0.3rem;"><i
                                                class="fas fa-copy me-2"></i>Salin</a>
                                    </div>
                                    <label class="form-label">Date time</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm"
                                            value="((date_time))" disabled="">
                                        <a href="javascript:;"
                                            class="btn btn-primary btn-sm copy waves-effect waves-light"
                                            data-clipboard-text="((date_time))"
                                            style="width: 100px; padding-top: 0.3rem;"><i
                                                class="fas fa-copy me-2"></i>Salin</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md">

                            <div class="card border border-primary">
                                <div class="card-header bg-transparent border-primary">
                                    <h5 class="my-0 text-primary"><i class="ti ti-file-text me-2"></i>Text
                                        Message</h5>
                                </div>
                                <div class="card-body">
                                    <label for="" class="form-label">Message</label>
                                    <textarea name="batas_saldo" id="batas_saldo" class="form-control" rows="5">{{ $bot->batas_saldo }}</textarea>
                                    <div class="d-grid mt-3">
                                        <button class="btn btn-primary" id="saveBatasSaldo">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane show {{ $tab == 'max-pesanan' ? 'active' : '' }}" id="max-pesanan"
                    role="tabpanel" aria-labelledby="max-pesanan-tab">
                    <div class="row">
                        <div class="col-md">
                            <div class="card border border-primary">
                                <div class="card-header bg-transparent border-primary">
                                    <h5 class="my-0 text-primary"><i class="fa-solid fa-bullseye me-2"></i>Daftar
                                        Variabel</h5>
                                </div>
                                <div class="card-body">
                                    <label class="form-label">Nama user</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm"
                                            value="((name_user))" disabled="">
                                        <a href="javascript:;"
                                            class="btn btn-primary btn-sm copy waves-effect waves-light"
                                            data-clipboard-text="((name_user))"
                                            style="width: 100px; padding-top: 0.3rem;"><i
                                                class="fas fa-copy me-2"></i>Salin</a>
                                    </div>
                                    <label class="form-label">Email user</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm"
                                            value="((email_user))" disabled="">
                                        <a href="javascript:;"
                                            class="btn btn-primary btn-sm copy waves-effect waves-light"
                                            data-clipboard-text="((email_user))"
                                            style="width: 100px; padding-top: 0.3rem;"><i
                                                class="fas fa-copy me-2"></i>Salin</a>
                                    </div>
                                    <label class="form-label">Harga pesanan</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm"
                                            value="((price_pesanan))" disabled="">
                                        <a href="javascript:;"
                                            class="btn btn-primary btn-sm copy waves-effect waves-light"
                                            data-clipboard-text="((price_pesanan))"
                                            style="width: 100px; padding-top: 0.3rem;"><i
                                                class="fas fa-copy me-2"></i>Salin</a>
                                    </div>
                                    <label class="form-label">Pesanan</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm"
                                            value="((pesanan))" disabled="">
                                        <a href="javascript:;"
                                            class="btn btn-primary btn-sm copy waves-effect waves-light"
                                            data-clipboard-text="((pesanan))"
                                            style="width: 100px; padding-top: 0.3rem;"><i
                                                class="fas fa-copy me-2"></i>Salin</a>
                                    </div>
                                    <label class="form-label">Date time</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm"
                                            value="((date_time))" disabled="">
                                        <a href="javascript:;"
                                            class="btn btn-primary btn-sm copy waves-effect waves-light"
                                            data-clipboard-text="((date_time))"
                                            style="width: 100px; padding-top: 0.3rem;"><i
                                                class="fas fa-copy me-2"></i>Salin</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md">

                            <div class="card border border-primary">
                                <div class="card-header bg-transparent border-primary">
                                    <h5 class="my-0 text-primary"><i class="ti ti-file-text me-2"></i>Text
                                        Message</h5>
                                </div>
                                <div class="card-body">
                                    <label for="" class="form-label">Message</label>
                                    <textarea name="max-pesanans" id="max-pesanans" class="form-control" rows="5">{{ $bot->max_pesanan }}</textarea>
                                    <div class="d-grid mt-3">
                                        <button class="btn btn-primary" id="saveMaxPesanan">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane show {{ $tab == 'deposit' ? 'active' : '' }}" id="deposit" role="tabpanel"
                    aria-labelledby="deposit-tab">
                    <div class="row">
                        <div class="col-md">
                            <div class="card border border-primary">
                                <div class="card-header bg-transparent border-primary">
                                    <h5 class="my-0 text-primary"><i class="fa-solid fa-bullseye me-2"></i>Daftar
                                        Variabel</h5>
                                </div>
                                <div class="card-body">
                                    <label class="form-label">Nama user</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm"
                                            value="((name_user))" disabled="">
                                        <a href="javascript:;"
                                            class="btn btn-primary btn-sm copy waves-effect waves-light"
                                            data-clipboard-text="((name_user))"
                                            style="width: 100px; padding-top: 0.3rem;"><i
                                                class="fas fa-copy me-2"></i>Salin</a>
                                    </div>
                                    <label class="form-label">Email user</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm"
                                            value="((email_user))" disabled="">
                                        <a href="javascript:;"
                                            class="btn btn-primary btn-sm copy waves-effect waves-light"
                                            data-clipboard-text="((email_user))"
                                            style="width: 100px; padding-top: 0.3rem;"><i
                                                class="fas fa-copy me-2"></i>Salin</a>
                                    </div>
                                    <label class="form-label">Order ID Deposit</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm"
                                            value="((order_id))" disabled="">
                                        <a href="javascript:;"
                                            class="btn btn-primary btn-sm copy waves-effect waves-light"
                                            data-clipboard-text="((order_id))"
                                            style="width: 100px; padding-top: 0.3rem;"><i
                                                class="fas fa-copy me-2"></i>Salin</a>
                                    </div>
                                    <label class="form-label">Channel Pembayaran</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm"
                                            value="((channel_pembayaran))" disabled="">
                                        <a href="javascript:;"
                                            class="btn btn-primary btn-sm copy waves-effect waves-light"
                                            data-clipboard-text="((channel_pembayaran))"
                                            style="width: 100px; padding-top: 0.3rem;"><i
                                                class="fas fa-copy me-2"></i>Salin</a>
                                    </div>
                                    <label class="form-label">Nominal</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm"
                                            value="((nominal))" disabled="">
                                        <a href="javascript:;"
                                            class="btn btn-primary btn-sm copy waves-effect waves-light"
                                            data-clipboard-text="((nominal))"
                                            style="width: 100px; padding-top: 0.3rem;"><i
                                                class="fas fa-copy me-2"></i>Salin</a>
                                    </div>
                                    <label class="form-label">Expired date</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm"
                                            value="((expired))" disabled="">
                                        <a href="javascript:;"
                                            class="btn btn-primary btn-sm copy waves-effect waves-light"
                                            data-clipboard-text="((expired))"
                                            style="width: 100px; padding-top: 0.3rem;"><i
                                                class="fas fa-copy me-2"></i>Salin</a>
                                    </div>
                                    <label class="form-label">Date time</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm"
                                            value="((date_time))" disabled="">
                                        <a href="javascript:;"
                                            class="btn btn-primary btn-sm copy waves-effect waves-light"
                                            data-clipboard-text="((date_time))"
                                            style="width: 100px; padding-top: 0.3rem;"><i
                                                class="fas fa-copy me-2"></i>Salin</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md">

                            <div class="card border border-primary">
                                <div class="card-header bg-transparent border-primary">
                                    <h5 class="my-0 text-primary"><i class="ti ti-file-text me-2"></i>Text
                                        Message</h5>
                                </div>
                                <div class="card-body">
                                    <label for="" class="form-label">Message</label>
                                    <textarea name="notif_deposit" id="notif_deposit" class="form-control" rows="5">{{ $bot->notif_deposit }}</textarea>
                                    <div class="d-grid mt-3">
                                        <button class="btn btn-primary" id="saveNotifDeposit">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane show {{ $tab == 'tiket' ? 'active' : '' }}" id="tiket" role="tabpanel"
                    aria-labelledby="tiket-tab">
                    <div class="row">
                        <div class="col-md">
                            <div class="card border border-primary">
                                <div class="card-header bg-transparent border-primary">
                                    <h5 class="my-0 text-primary"><i class="fa-solid fa-bullseye me-2"></i>Daftar
                                        Variabel</h5>
                                </div>
                                <div class="card-body">
                                    <label class="form-label">Nama user</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm"
                                            value="((name_user))" disabled="">
                                        <a href="javascript:;"
                                            class="btn btn-primary btn-sm copy waves-effect waves-light"
                                            data-clipboard-text="((name_user))"
                                            style="width: 100px; padding-top: 0.3rem;"><i
                                                class="fas fa-copy me-2"></i>Salin</a>
                                    </div>
                                    <label class="form-label">Email user</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm"
                                            value="((email_user))" disabled="">
                                        <a href="javascript:;"
                                            class="btn btn-primary btn-sm copy waves-effect waves-light"
                                            data-clipboard-text="((email_user))"
                                            style="width: 100px; padding-top: 0.3rem;"><i
                                                class="fas fa-copy me-2"></i>Salin</a>
                                    </div>
                                    <label class="form-label">Tiket ID</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm"
                                            value="((tiket_id))" disabled="">
                                        <a href="javascript:;"
                                            class="btn btn-primary btn-sm copy waves-effect waves-light"
                                            data-clipboard-text="((tiket_id))"
                                            style="width: 100px; padding-top: 0.3rem;"><i
                                                class="fas fa-copy me-2"></i>Salin</a>
                                    </div>
                                    <label class="form-label">Subjek Tiket</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm" value="((subjek))"
                                            disabled="">
                                        <a href="javascript:;"
                                            class="btn btn-primary btn-sm copy waves-effect waves-light"
                                            data-clipboard-text="((subjek))"
                                            style="width: 100px; padding-top: 0.3rem;"><i
                                                class="fas fa-copy me-2"></i>Salin</a>
                                    </div>
                                    <label class="form-label">Tipe ID</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm"
                                            value="((tipe_id))" disabled="">
                                        <a href="javascript:;"
                                            class="btn btn-primary btn-sm copy waves-effect waves-light"
                                            data-clipboard-text="((tipe_id))"
                                            style="width: 100px; padding-top: 0.3rem;"><i
                                                class="fas fa-copy me-2"></i>Salin</a>
                                    </div>
                                    <label class="form-label">Pesan</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm"
                                            value="((message))" disabled="">
                                        <a href="javascript:;"
                                            class="btn btn-primary btn-sm copy waves-effect waves-light"
                                            data-clipboard-text="((message))"
                                            style="width: 100px; padding-top: 0.3rem;"><i
                                                class="fas fa-copy me-2"></i>Salin</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md">

                            <div class="card border border-primary">
                                <div class="card-header bg-transparent border-primary">
                                    <h5 class="my-0 text-primary"><i class="ti ti-file-text me-2"></i>Text
                                        Message</h5>
                                </div>
                                <div class="card-body">
                                    <label for="" class="form-label">Message</label>
                                    <textarea name="notif_tiket" id="notif_tiket" class="form-control" rows="5">{{ $bot->notif_tiket }}</textarea>
                                    <div class="d-grid mt-3">
                                        <button class="btn btn-primary" id="saveNotifTiket">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane show {{ $tab == 'reply_admin' ? 'active' : '' }}" id="reply_admin"
                    role="tabpanel" aria-labelledby="reply-admin-tab">
                    <div class="row">
                        <div class="col-md">
                            <div class="card border border-primary">
                                <div class="card-header bg-transparent border-primary">
                                    <h5 class="my-0 text-primary"><i class="fa-solid fa-bullseye me-2"></i>Daftar
                                        Variabel</h5>
                                </div>
                                <div class="card-body">
                                    <label class="form-label">Nama user</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm"
                                            value="((name_user))" disabled="">
                                        <a href="javascript:;"
                                            class="btn btn-primary btn-sm copy waves-effect waves-light"
                                            data-clipboard-text="((name_user))"
                                            style="width: 100px; padding-top: 0.3rem;"><i
                                                class="fas fa-copy me-2"></i>Salin</a>
                                    </div>
                                    <label class="form-label">Email user</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm"
                                            value="((email_user))" disabled="">
                                        <a href="javascript:;"
                                            class="btn btn-primary btn-sm copy waves-effect waves-light"
                                            data-clipboard-text="((email_user))"
                                            style="width: 100px; padding-top: 0.3rem;"><i
                                                class="fas fa-copy me-2"></i>Salin</a>
                                    </div>
                                    <label class="form-label">Tiket ID</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm"
                                            value="((tiket_id))" disabled="">
                                        <a href="javascript:;"
                                            class="btn btn-primary btn-sm copy waves-effect waves-light"
                                            data-clipboard-text="((tiket_id))"
                                            style="width: 100px; padding-top: 0.3rem;"><i
                                                class="fas fa-copy me-2"></i>Salin</a>
                                    </div>
                                    <label class="form-label">Message</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm"
                                            value="((message))" disabled="">
                                        <a href="javascript:;"
                                            class="btn btn-primary btn-sm copy waves-effect waves-light"
                                            data-clipboard-text="((message))"
                                            style="width: 100px; padding-top: 0.3rem;"><i
                                                class="fas fa-copy me-2"></i>Salin</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md">

                            <div class="card border border-primary">
                                <div class="card-header bg-transparent border-primary">
                                    <h5 class="my-0 text-primary"><i class="ti ti-file-text me-2"></i>Text
                                        Message</h5>
                                </div>
                                <div class="card-body">
                                    <label for="" class="form-label">Message</label>
                                    <textarea name="reply_tiket" id="reply_tiket" class="form-control" rows="5">{{ $bot->reply_tiket }}</textarea>
                                    <div class="d-grid mt-3">
                                        <button class="btn btn-primary" id="saveReplyTiket">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane show {{ $tab == 'forgot_password' ? 'active' : '' }}" id="forgot_password"
                    role="tabpanel" aria-labelledby="reply-admin-tab">
                    <div class="row">
                        <div class="col-md">
                            <div class="card border border-primary">
                                <div class="card-header bg-transparent border-primary">
                                    <h5 class="my-0 text-primary"><i class="fa-solid fa-bullseye me-2"></i>Daftar
                                        Variabel</h5>
                                </div>
                                <div class="card-body">
                                    <label class="form-label">Nama user</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm"
                                            value="((name_user))" disabled="">
                                        <a href="javascript:;"
                                            class="btn btn-primary btn-sm copy waves-effect waves-light"
                                            data-clipboard-text="((name_user))"
                                            style="width: 100px; padding-top: 0.3rem;"><i
                                                class="fas fa-copy me-2"></i>Salin</a>
                                    </div>
                                    <label class="form-label">Email user</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm"
                                            value="((email_user))" disabled="">
                                        <a href="javascript:;"
                                            class="btn btn-primary btn-sm copy waves-effect waves-light"
                                            data-clipboard-text="((email_user))"
                                            style="width: 100px; padding-top: 0.3rem;"><i
                                                class="fas fa-copy me-2"></i>Salin</a>
                                    </div>
                                    <label class="form-label">Link</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm" value="((link))"
                                            disabled="">
                                        <a href="javascript:;"
                                            class="btn btn-primary btn-sm copy waves-effect waves-light"
                                            data-clipboard-text="((link))"
                                            style="width: 100px; padding-top: 0.3rem;"><i
                                                class="fas fa-copy me-2"></i>Salin</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md">

                            <div class="card border border-primary">
                                <div class="card-header bg-transparent border-primary">
                                    <h5 class="my-0 text-primary"><i class="ti ti-file-text me-2"></i>Text
                                        Message</h5>
                                </div>
                                <div class="card-body">
                                    <label for="" class="form-label">Message</label>
                                    <textarea name="forgot_passwords" id="forgot_passwords" class="form-control" rows="5">{{ $bot->forgot_password }}</textarea>
                                    <div class="d-grid mt-3">
                                        <button class="btn btn-primary" id="saveForgotPassword">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@script
    <script>
        $('#saveApiKey').click(function() {
            let url = $('#url').val();
            let api_key = $('#api_keys').val();
            let device_key = $('#device_key').val();
            let api_keys = $('input[name=api_key]').val();
            let device_keys = $('input[name=device_keys]').val();
            let target = $('input[name=target]').val();
            let message = $('input[name=message]').val();
            $wire.saveApiKey(url, api_key, device_key, api_keys, device_keys, target, message);
        });
        $('#saveBatasSaldo').click(function() {
            let batas_saldo = $('#batas_saldo').val();
            $wire.saveBatasSaldo(batas_saldo);
        });
        $('#saveMaxPesanan').click(function() {
            let max_pesanan = $('#max-pesanans').val();
            $wire.saveMaxPesanan(max_pesanan);
        });
        $('#saveNotifDeposit').click(function() {
            let notif_deposit = $('#notif_deposit').val();
            $wire.saveNotifDeposit(notif_deposit);
        });

        $('#saveNotifTiket').click(function() {
            let notif_tiket = $('#notif_tiket').val();
            $wire.saveNotifTiket(notif_tiket);
        });
        $('#saveReplyTiket').click(function() {
            let reply_tiket = $('#reply_tiket').val();
            $wire.saveReplyTiket(reply_tiket);
        });
        $('#saveForgotPassword').click(function() {
            let forgot_password = $('#forgot_passwords').val();
            $wire.saveForgotPassword(forgot_password);
        });
    </script>
@endscript
