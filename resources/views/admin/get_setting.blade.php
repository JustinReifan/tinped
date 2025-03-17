<div class="row mb-2 ">
    <div class="col-lg-3 mb-2 mb-sm-0 ">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active show" id="v-pills-home-tab" data-bs-toggle="pill" href="#v-pills-home" role="tab"
                aria-controls="v-pills-home" aria-selected="true">
                <i class="mdi mdi-home-variant"></i>
                <span class="">Utama</span>
            </a>
            <a class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" href="#v-pills-profile" role="tab"
                aria-controls="v-pills-profile" aria-selected="false">
                <i class="mdi mdi-account-circle"></i>
                <span class="">Profil</span>
            </a>
            <a class="nav-link" id="v-pills-order-tab" data-bs-toggle="pill" href="#v-pills-order" role="tab"
                aria-controls="v-pills-order" aria-selected="false">
                <i class="mdi mdi-cart"></i>
                <span class="">Pesanan</span>
            </a>
            <a class="nav-link" id="v-pills-order-status-tab" data-bs-toggle="pill" href="#v-pills-order-status"
                role="tab" aria-controls="v-pills-order-status" aria-selected="false">
                <i class="mdi mdi-card-search"></i>
                <span class="">Status Pesanan</span>
            </a>
            <a class="nav-link" id="v-pills-service-tab" data-bs-toggle="pill" href="#v-pills-service" role="tab"
                aria-controls="v-pills-service" aria-selected="false">
                <i class="mdi mdi-tag-multiple"></i>
                <span class="">Layanan</span>
            </a>
            <a class="nav-link" id="v-pills-refill-tab" data-bs-toggle="pill" href="#v-pills-refill" role="tab"
                aria-controls="v-pills-refill" aria-selected="false">
                <i class="mdi mdi-recycle"></i>
                <span class="">Refill Pesanan</span>
            </a>
            <a class="nav-link" id="v-pills-refill-status-tab" data-bs-toggle="pill" href="#v-pills-refill-status"
                role="tab" aria-controls="v-pills-refill-status" aria-selected="false">
                <i class="mdi mdi-card-search"></i>
                <span class="">Status Refill</span>
            </a>
            <a class="nav-link" id="v-pills-cancel-tab" data-bs-toggle="pill" href="#v-pills-cancel"
                role="tab" aria-controls="v-pills-refill-status" aria-selected="false">
                <i class="mdi mdi-card-search"></i>
                <span class="">Cancel Pesanan</span>
            </a>
        </div>
    </div>
    <div class="col-lg-9 ">
        @php
            $decode = json_decode($provider->json, true);
            $permintaan = $decode['permintaan'] ?? null;
        @endphp
        <form method="post" action="{{ url('admin/konfigurasi/add-database') }}" id="input_form">
            <input type="hidden" name="id_provider" value="{{ $provider->id }}">
            @csrf
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade active show" id="v-pills-home" role="tabpanel"
                    aria-labelledby="v-pills-home-tab">
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label class="form-label">ID <text class="text-danger">*</text></label>
                            <input type="text" class="form-control" name="provider_id"
                                value="{{ $decode['provider_id'] ?? null }}">

                        </div>
                        <div class="form-group col-lg-4">
                            <label class="form-label">Kunci <text class="text-danger">*</text></label>
                            <input type="text" class="form-control" name="provider_key"
                                value="{{ $decode['provider_key'] ?? null }}">

                        </div>
                        <div class="form-group col-lg-4">
                            <label class="form-label">Rahasia</label>
                            <input type="text" class="form-control" name="provider_secret"
                                placeholder="Kosongkan jika tidak dibutuhkan"
                                value="{{ $decode['provider_secret'] ?? null }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Default type</label>
                        <input type="text" class="form-control" name="default_type"
                            placeholder="Kosongkan jika tidak dibutuhkan"
                            value="{{ $decode['default_type'] ?? null }}">
                        <small class="text-danger">Masukkan default type pesanan * contoh 'primary' atau
                            'default'. Sesuaikan dengan API dari provider</small>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input id="is_refill_support" name="is_refill_support" type="checkbox"
                                class="custom-control-input">
                            <label class="custom-control-label" for="is_refill_support">Refill
                                Support</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input id="is_default_settings" name="is_default_settings" type="checkbox"
                                class="custom-control-input">
                            <label class="custom-control-label" for="is_default_settings">Default
                                Settings (SMM Luar)</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input id="is_indo_settings" name="is_indo_settings" type="checkbox"
                                class="custom-control-input">
                            <label class="custom-control-label" for="is_indo_settings">Default
                                Settings (SMM Indo)</label>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                    aria-labelledby="v-pills-profile-tab">
                    <div class="form-group">
                        <label class="form-label">1. Endpoint</label>
                        <input type="url" class="form-control" name="endpoint[profile]"
                            value="{{ $decode['endpoint']['profile'] ?? null }}"
                            placeholder="Kosongkan jika tidak dibutuhkan">
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <h6>2. Request</h6>
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="permintaan[profile][action]"
                                placeholder="Kosongkan jika tidak dibutuhkan"
                                value="{{ $permintaan['profile']['action'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Aksi" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="permintaan[profile][provider_id]"
                                placeholder="" value="{{ $permintaan['profile']['provider_id'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="ID" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="permintaan[profile][provider_key]"
                                placeholder="" value="{{ $permintaan['profile']['provider_key'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Kunci" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="permintaan[profile][provider_secret]"
                                placeholder="Kosongkan jika tidak dibutuhkan"
                                value="{{ $permintaan['profile']['provider_secret'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Rahasia" disabled="">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <h6>3. Response</h6>
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="response[profile][balance]"
                                placeholder="" value="{{ $decode['response']['profile']['balance'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Expected Key" disabled="">
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="v-pills-order" role="tabpanel" aria-labelledby="v-pills-order-tab">
                    <div class="form-group">
                        <label class="form-label">1. Endpoint</label>
                        <input type="url" class="form-control" name="endpoint[order]"
                            value="{{ $decode['endpoint']['order'] ?? null }}"
                            placeholder="Kosongkan jika tidak dibutuhkan">
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <h6>2. Request</h6>
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="permintaan[order][action]"
                                placeholder="Kosongkan jika tidak dibutuhkan"
                                value="{{ $permintaan['order']['action'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Aksi" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="permintaan[order][provider_id]"
                                placeholder="" value="{{ $permintaan['order']['provider_id'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="ID" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="permintaan[order][provider_key]"
                                placeholder="" value="{{ $permintaan['order']['provider_key'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Kunci" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="permintaan[order][provider_secret]"
                                placeholder="Kosongkan jika tidak dibutuhkan"
                                value="{{ $permintaan['order']['provider_secret'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Rahasia" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="permintaan[order][service]"
                                placeholder="" value="{{ $permintaan['order']['service'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="ID Layanan" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="permintaan[order][target]"
                                placeholder="" value="{{ $permintaan['order']['target'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Target" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="permintaan[order][quantity]"
                                placeholder="" value="{{ $permintaan['order']['quantity'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Jumlah" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="permintaan[order][custom_comments]"
                                placeholder="Kosongkan jika tidak dibutuhkan"
                                value="{{ $permintaan['order']['custom_comments'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Custom Comments" disabled="">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <h6>3. Response</h6>
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="response[order][order_id]"
                                placeholder="" value="{{ $decode['response']['order']['order_id'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Expected Key" disabled="">
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="v-pills-order-status" role="tabpanel"
                    aria-labelledby="v-pills-order-status-tab">
                    <div class="form-group">
                        <label class="form-label">1. Endpoint</label>
                        <input type="url" class="form-control" name="endpoint[status]"
                            value="{{ $decode['endpoint']['status'] ?? null }}"
                            placeholder="Kosongkan jika tidak dibutuhkan">
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h6>2. Request</h6>
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="permintaan[status][action]"
                                placeholder="Kosongkan jika tidak dibutuhkan"
                                value="{{ $permintaan['status']['action'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Aksi" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="permintaan[status][provider_id]"
                                placeholder="" value="{{ $permintaan['status']['provider_id'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="ID" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="permintaan[status][provider_key]"
                                placeholder="" value="{{ $permintaan['status']['provider_key'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Kunci" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="permintaan[status][provider_secret]"
                                placeholder="Kosongkan jika tidak dibutuhkan"
                                value="{{ $permintaan['status']['provider_secret'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Rahasia" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="permintaan[status][order_id]"
                                placeholder="" value="{{ $permintaan['status']['order_id'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="ID Pesanan" disabled="">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <h6>3. Response</h6>
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="response[status][status]"
                                placeholder="" value="{{ $decode['response']['status']['status'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Status" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="response[status][start_count]"
                                placeholder="" value="{{ $decode['response']['status']['start_count'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Jumlah Awal" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="response[status][remains]"
                                placeholder="" value="{{ $decode['response']['status']['remains'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Jumlah Sisa" disabled="">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <h6>3. Status Value</h6>
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="status_value[status][pending]"
                                placeholder="" value="{{ $decode['status_value']['status']['pending'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Pending" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="status_value[status][processing]"
                                placeholder="" value="{{ $decode['status_value']['status']['processing'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Processing" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="status_value[status][success]"
                                placeholder="" value="{{ $decode['status_value']['status']['success'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Success" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="status_value[status][error]"
                                placeholder="" value="{{ $decode['status_value']['status']['error'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Error" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="status_value[status][partial]"
                                placeholder="" value="{{ $decode['status_value']['status']['partial'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Partial" disabled="">
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-service" role="tabpanel"
                    aria-labelledby="v-pills-service-tab">
                    <div class="form-group">
                        <label class="form-label">1. Endpoint</label>
                        <input type="url" class="form-control" name="endpoint[service]"
                            value="{{ $decode['endpoint']['service'] ?? null }}"
                            placeholder="Kosongkan jika tidak dibutuhkan">
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h6>2. Request</h6>
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="permintaan[service][action]"
                                placeholder="Kosongkan jika tidak dibutuhkan"
                                value="{{ $permintaan['service']['action'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Aksi" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="permintaan[service][provider_id]"
                                placeholder="" value="{{ $permintaan['service']['provider_id'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="ID" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="permintaan[service][provider_key]"
                                placeholder="" value="{{ $permintaan['service']['provider_key'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Kunci" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="permintaan[service][provider_secret]"
                                placeholder="Kosongkan jika tidak dibutuhkan"
                                value="{{ $permintaan['service']['provider_secret'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Rahasia" disabled="">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <h6>3. Response</h6>
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="response[service][looping]"
                                placeholder="Kosongkan jika tidak dibutuhkan"
                                value="{{ $decode['response']['service']['looping'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Perulangan" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="response[service][id]" placeholder=""
                                value="{{ $decode['response']['service']['id'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="ID Layanan" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="response[service][name]" placeholder=""
                                value="{{ $decode['response']['service']['name'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Nama Layanan" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="response[service][description]"
                                placeholder="Kosongkan jika tidak dibutuhkan"
                                value="{{ $decode['response']['service']['description'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Deskripsi Layanan" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="response[service][category]"
                                placeholder="Kosongkan jika tidak dibutuhkan"
                                value="{{ $decode['response']['service']['category'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Kategori Layanan" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="response[service][price]"
                                placeholder="" value="{{ $decode['response']['service']['price'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Harga Layanan" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="response[service][min]" placeholder=""
                                value="{{ $decode['response']['service']['min'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Min. Layanan" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="response[service][max]" placeholder=""
                                value="{{ $decode['response']['service']['max'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Maks. Layanan" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="response[service][type]"
                                placeholder="Kosongkan jika tidak dibutuhkan"
                                value="{{ $decode['response']['service']['type'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Tipe Layanan" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="response[service][refill]"
                                placeholder="Kosongkan jika tidak dibutuhkan"
                                value="{{ $decode['response']['service']['refill'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Refill Layanan" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="response[service][cancel]"
                            placeholder="Kosongkan jika tidak dibutuhkan"
                            value="{{ $decode['response']['service']['cancel'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Cancel Layanan" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="response[service][average_time]"
                                placeholder="Kosongkan jika tidak dibutuhkan"
                                value="{{ $decode['response']['service']['average_time'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Average Time" disabled="">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <h6>4. Other Value</h6>
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="other_value[service][custom_comments]"
                                placeholder="Kosongkan jika tidak dibutuhkan"
                                value="{{ $decode['other_value']['service']['custom_comments'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Custom Comments" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="other_value[service][comment_likes]"
                                placeholder="Kosongkan jika tidak dibutuhkan"
                                value="{{ $decode['other_value']['service']['comment_likes'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Comment Likes" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="other_value[service][is_refill_support]"
                                placeholder="Kosongkan jika tidak dibutuhkan"
                                value="{{ $decode['other_value']['service']['is_refill_support'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Refill Support" disabled="">
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-refill" role="tabpanel" aria-labelledby="v-pills-refill-tab">
                    <div class="form-group">
                        <label class="form-label">1. Endpoint</label>
                        <input type="url" class="form-control" name="endpoint[refill]"
                            value="{{ $decode['endpoint']['refill'] ?? null }}"
                            placeholder="Kosongkan jika tidak dibutuhkan">
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <h6>2. Request</h6>
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="permintaan[refill][action]"
                                placeholder="Kosongkan jika tidak dibutuhkan"
                                value="{{ $permintaan['refill']['action'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Aksi" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="permintaan[refill][provider_id]"
                                placeholder="" value="{{ $permintaan['refill']['provider_id'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="ID" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="permintaan[refill][provider_key]"
                                placeholder="" value="{{ $permintaan['refill']['provider_key'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Kunci" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="permintaan[refill][provider_secret]"
                                placeholder="Kosongkan jika tidak dibutuhkan"
                                value="{{ $permintaan['refill']['provider_secret'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Rahasia" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="permintaan[refill][order_id]"
                                placeholder="" value="{{ $permintaan['refill']['order_id'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="ID Pesanan" disabled="">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <h6>3. Response</h6>
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="response[refill][refill_id]"
                                placeholder="" value="{{ $decode['response']['refill']['refill_id'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Expected Key" disabled="">
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-refill-status" role="tabpanel"
                    aria-labelledby="v-pills-refill-status-tab">
                    <div class="form-group">
                        <label class="form-label">1. Endpoint</label>
                        <input type="url" class="form-control" name="endpoint[refill_status]"
                            value="{{ $decode['endpoint']['refill_status'] ?? null }}"
                            placeholder="Kosongkan jika tidak dibutuhkan">
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h6>2. Request</h6>
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="permintaan[refill_status][action]"
                                placeholder="Kosongkan jika tidak dibutuhkan"
                                value="{{ $permintaan['refill_status']['action'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Aksi" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="permintaan[refill_status][provider_id]"
                                placeholder="" value="{{ $permintaan['refill_status']['provider_id'] ?? null }}"">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="ID" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="permintaan[refill_status][provider_key]"
                                value="{{ $permintaan['refill_status']['provider_key'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Kunci" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control"
                                name="permintaan[refill_status][provider_secret]"
                                placeholder="Kosongkan jika tidak dibutuhkan"
                                value="{{ $permintaan['refill_status']['provider_secret'] ?? null }}"">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Rahasia" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="permintaan[refill_status][refill_id]"
                                placeholder="" value="{{ $permintaan['refill_status']['refill_id'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="ID Refill" disabled="">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <h6>3. Response</h6>
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="response[refill_status][status]"
                                placeholder="" value="{{ $decode['response']['refill_status']['status'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Expected Key" disabled="">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <h6>3. Status Value</h6>
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="status_value[refill_status][pending]"
                                placeholder=""
                                value="{{ $decode['status_value']['refill_status']['pending'] ?? null }}"">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Pending" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="status_value[refill_status][processing]"
                                placeholder=""
                                value="{{ $decode['status_value']['refill_status']['processing'] ?? null }}"">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Processing" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="status_value[refill_status][success]"
                                placeholder=""
                                value="{{ $decode['status_value']['refill_status']['success'] ?? null }}"">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Success" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="status_value[refill_status][error]"
                                placeholder=""
                                value="{{ $decode['status_value']['refill_status']['error'] ?? null }}"">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Error" disabled="">
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-cancel" role="tabpanel"
                    aria-labelledby="v-pills-cancel-tab">
                    <div class="form-group">
                        <label class="form-label">1. Endpoint</label>
                        <input type="url" class="form-control" name="endpoint[cancel]"
                            value="{{ $decode['endpoint']['cancel'] ?? null }}"
                            placeholder="Kosongkan jika tidak dibutuhkan">
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h6>2. Request</h6>
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="permintaan[cancel][action]"
                                placeholder="Kosongkan jika tidak dibutuhkan"
                                value="{{ $permintaan['cancel']['action'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Aksi" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="permintaan[cancel][provider_id]"
                                placeholder="Kosongkan jika tidak dibutuhkan" value="{{ $permintaan['cancel']['provider_id'] ?? null }}"">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="ID" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="permintaan[cancel][provider_key]"
                                placeholder="Default: api_key" value="{{ $permintaan['cancel']['provider_key'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Kunci" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control"
                                name="permintaan[cancel][provider_secret]"
                                placeholder="Kosongkan jika tidak dibutuhkan"
                                value="{{ $permintaan['cancel']['provider_secret'] ?? null }}"">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Rahasia" disabled="">
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="permintaan[cancel][order_id]"
                                placeholder="Order ID Key" value="{{ $permintaan['cancel']['order_id'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="ID Pesanan" disabled="">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <h6>3. Response</h6>
                        </div>
                        <div class="form-group col-6 col-lg-8">
                            <input type="text" class="form-control" name="response[cancel][status]"
                                placeholder="" value="{{ $decode['response']['cancel']['status'] ?? null }}">
                        </div>
                        <div class="form-group col-6 col-lg-4">
                            <input type="text" class="form-control" value="Expected Key" disabled="">
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-outline-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    $('input[name="is_default_settings"]').on('change', (event) => {
        if ($(event.currentTarget).is(':checked')) {
            $('input[name="is_refill_support"]').prop('checked', true);
            $('input[name="provider_id').val('-');
            $('input[name="permintaan[profile][action]"]').val('balance');
            $('input[name="permintaan[profile][provider_id]"]').val('-');
            $('input[name="permintaan[profile][provider_key]"]').val('key');
            $('input[name="response[profile][balance]"]').val('[\'balance\']');
            $('input[name="permintaan[order][action]"]').val('add');
            $('input[name="permintaan[order][provider_id]"]').val('-');
            $('input[name="permintaan[order][provider_key]"]').val('key');
            $('input[name="permintaan[order][service]"]').val('service');
            $('input[name="permintaan[order][target]"]').val('link');
            $('input[name="permintaan[order][quantity]"]').val('quantity');
            $('input[name="permintaan[order][custom_comments]"]').val('comments');
            $('input[name="response[order][order_id]"]').val('[\'order\']');
            $('input[name="permintaan[status][action]"]').val('status');
            $('input[name="permintaan[status][provider_id]"]').val('-');
            $('input[name="permintaan[status][provider_key]"]').val('key');
            $('input[name="permintaan[status][order_id]"]').val('order');
            $('input[name="response[status][status]"]').val('[\'status\']');
            $('input[name="response[status][start_count]"]').val('[\'start_count\']');
            $('input[name="response[status][remains]"]').val('[\'remains\']');
            $('input[name="status_value[status][pending]"]').val('Pending');
            $('input[name="status_value[status][success]"]').val('Completed');
            $('input[name="status_value[status][processing]"]').val('Processing');
            $('input[name="status_value[status][error]"]').val('Canceled');
            $('input[name="status_value[status][partial]"]').val('Cancelled');
            $('input[name="permintaan[service][action]"]').val('services');
            $('input[name="permintaan[service][provider_id]"]').val('-');
            $('input[name="permintaan[service][provider_key]"]').val('key');
            $('input[name="response[service][id]"]').val('[\'service\']');
            $('input[name="response[service][name]"]').val('[\'name\']');
            $('input[name="response[service][category]"]').val('[\'category\']');
            $('input[name="response[service][price]"]').val('[\'rate\']');
            $('input[name="response[service][min]"]').val('[\'min\']');
            $('input[name="response[service][max]"]').val('[\'max\']');
            $('input[name="response[service][type]"]').val('[\'type\']');
            $('input[name="response[service][refill]"]').val('[\'refill\']');
            $('input[name="other_value[service][custom_comments]"]').val('Custom Comments');
            $('input[name="other_value[service][comment_likes]"]').val('Comment Likes');
            $('input[name="other_value[service][is_refill_support]"]').val('true');
            $('select[name="currency"]').val('USD');
            $('select[name="price_setting[service][operator]"]').val('*');
            $('input[name="price_setting[service][value]"]').val('1');
            $('select[name="profit_setting[service][operator]"]').val('*');
            $('input[name="profit_setting[service][value]"]').val('1');
            $('select[name="reseller_price_setting[service][operator]"]').val('*');
            $('input[name="reseller_price_setting[service][value]"]').val('1');
            $('select[name="reseller_profit_setting[service][operator]"]').val('*');
            $('input[name="reseller_profit_setting[service][value]"]').val('1');
            $('input[name="permintaan[refill][action]"]').val('refill');
            $('input[name="permintaan[refill][provider_id]"]').val('-');
            $('input[name="permintaan[refill][provider_key]"]').val('key');
            $('input[name="permintaan[refill][order_id]"]').val('order');
            $('input[name="response[refill][refill_id]"]').val('[\'refill\']');
            $('input[name="permintaan[refill_status][action]"]').val('refill_status');
            $('input[name="permintaan[refill_status][provider_id]"]').val('-');
            $('input[name="permintaan[refill_status][provider_key]"]').val('key');
            $('input[name="permintaan[refill_status][refill_id]"]').val('refill_id');
            $('input[name="response[refill_status][status]"]').val('[\'status\']');
            $('input[name="status_value[refill_status][pending]"]').val('Pending');
            $('input[name="status_value[refill_status][success]"]').val('Completed');
            $('input[name="status_value[refill_status][processing]"]').val('Processing');
            $('input[name="status_value[refill_status][error]"]').val('Error');
        }
    });
    $('input[name="is_indo_settings"]').on('change', (event) => {
        if ($(event.currentTarget).is(':checked')) {
            $('input[name="is_refill_support"]').prop('checked', true);
            $('input[name="provider_id').val('-');
            $('input[name="permintaan[profile][action]"]').val('');
            $('input[name="permintaan[profile][provider_id]"]').val('api_id');
            $('input[name="permintaan[profile][provider_key]"]').val('api_key');
            $('input[name="response[profile][balance]"]').val('[\'data\'][\'balance\']');
            $('input[name="permintaan[order][action]"]').val('');
            $('input[name="permintaan[order][provider_id]"]').val('api_id');
            $('input[name="permintaan[order][provider_key]"]').val('api_key');
            $('input[name="permintaan[order][service]"]').val('service');
            $('input[name="permintaan[order][target]"]').val('target');
            $('input[name="permintaan[order][quantity]"]').val('quantity');
            $('input[name="permintaan[order][custom_comments]"]').val('custom_comments');
            $('input[name="response[order][order_id]"]').val('[\'data\'][\'id\']');
            $('input[name="permintaan[status][action]"]').val('');
            $('input[name="permintaan[status][provider_id]"]').val('api_id');
            $('input[name="permintaan[status][provider_key]"]').val('api_key');
            $('input[name="permintaan[status][order_id]"]').val('id');
            $('input[name="response[status][status]"]').val('[\'data\'][\'status\']');
            $('input[name="response[status][start_count]"]').val('[\'data\'][\'start_count\']');
            $('input[name="response[status][remains]"]').val('[\'data\'][\'remains\']');
            $('input[name="status_value[status][pending]"]').val('Pending');
            $('input[name="status_value[status][success]"]').val('Success');
            $('input[name="status_value[status][processing]"]').val('Processing');
            $('input[name="status_value[status][error]"]').val('Error');
            $('input[name="status_value[status][partial]"]').val('Partial');
            $('input[name="permintaan[service][action]"]').val('');
            $('input[name="permintaan[service][provider_id]"]').val('api_id');
            $('input[name="permintaan[service][provider_key]"]').val('api_key');
            $('input[name="response[service][id]"]').val('[\'id\']');
            $('input[name="response[service][looping]"]').val('[\'data\']');
            $('input[name="response[service][name]"]').val('[\'name\']');
            $('input[name="response[service][category]"]').val('[\'category\']');
            $('input[name="response[service][price]"]').val('[\'price\']');
            $('input[name="response[service][min]"]').val('[\'min\']');
            $('input[name="response[service][max]"]').val('[\'max\']');
            $('input[name="response[service][type]"]').val('[\'type\']');
            $('input[name="response[service][refill]"]').val('[\'refill\']');
            $('input[name="other_value[service][custom_comments]"]').val('custom_comments');
            $('input[name="other_value[service][comment_likes]"]').val('custom_link');
            $('input[name="other_value[service][is_refill_support]"]').val('true');
            $('select[name="currency"]').val('IDR');
            $('select[name="price_setting[service][operator]"]').val('*');
            $('input[name="price_setting[service][value]"]').val('1');
            $('select[name="profit_setting[service][operator]"]').val('*');
            $('input[name="profit_setting[service][value]"]').val('1');
            $('select[name="reseller_price_setting[service][operator]"]').val('*');
            $('input[name="reseller_price_setting[service][value]"]').val('1');
            $('select[name="reseller_profit_setting[service][operator]"]').val('*');
            $('input[name="reseller_profit_setting[service][value]"]').val('1');
            $('input[name="permintaan[refill][action]"]').val('');
            $('input[name="permintaan[refill][provider_id]"]').val('api_id');
            $('input[name="permintaan[refill][provider_key]"]').val('api_key');
            $('input[name="permintaan[refill][order_id]"]').val('id_order');
            $('input[name="response[refill][refill_id]"]').val('[\'data\'][\'id_refill\']');
            $('input[name="permintaan[refill_status][action]"]').val('');
            $('input[name="permintaan[refill_status][provider_id]"]').val('api_id');
            $('input[name="permintaan[refill_status][provider_key]"]').val('api_key');
            $('input[name="permintaan[refill_status][refill_id]"]').val('id_refill');
            $('input[name="response[refill_status][status]"]').val('[\'data\'][\'status\']');
            $('input[name="status_value[refill_status][pending]"]').val('Pending');
            $('input[name="status_value[refill_status][success]"]').val('Success');
            $('input[name="status_value[refill_status][processing]"]').val('Proses');
            $('input[name="status_value[refill_status][error]"]').val('Gagal');
        }
    });
</script>
