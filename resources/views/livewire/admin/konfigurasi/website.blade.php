<div>
    <style>
    </style>
    <div class="card">
        <div class="card-body py-0">
            <ul class="nav nav-tabs profile-tabs " id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link {{ $tab == 'umum' ? 'active' : '' }}" id="umum-tab"
                        wire:click="$set('tab','umum')" data-bs-toggle="tab" href="#umum" role="tab"
                        aria-selected="true"><i class="fab fa-affiliatetheme me-2"></i>Umum</a>
                </li>
                <li class="nav-item"><a class="nav-link {{ $tab == 'update' ? 'active' : '' }}" id="update-tab"
                        wire:click="$set('tab','update')" data-bs-toggle="tab" href="#update" role="tab"
                        aria-selected="true"><i class="ti ti-repeat me-2"></i>Update</a>
                </li>
                <li class="nav-item"><a class="nav-link {{ $tab == 'smtp' ? 'active' : '' }}" id="smtp-tab"
                        wire:click="$set('tab','smtp')" data-bs-toggle="tab" href="#smtp" role="tab"
                        aria-selected="true"><i class="ti ti-mail-forward me-2"></i>SMTP</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane show {{ $tab == 'umum' ? 'active' : '' }}" id="umum" role="tabpanel"
            aria-labelledby="umum-tab">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header fw-bold p-3 text-xss"><i class="ti ti-manual-gearbox me-2"></i>Theme
                            Customizer
                        </div>
                        <div class="card-body">
                            <div class="offcanvas-body py-0">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div class="pc-dark">
                                            <h6 class="mb-1">Theme Mode</h6>
                                            <p class="text-muted text-sm">Choose light or dark mode or Auto</p>
                                            <div class="row theme-color theme-layout">
                                                <div class="col-4">
                                                    <div class="d-grid"><button
                                                            class="preset-btn btn {{ $theme == 'light' ? 'active' : '' }}"
                                                            data-value="true" onclick="layout_changes('light');"
                                                            data-bs-toggle="tooltip" title="Light"><svg
                                                                class="pc-icon text-warning">
                                                                <use xlink:href="#custom-sun-1"></use>
                                                            </svg></button></div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="d-grid"><button
                                                            class="preset-btn btn {{ $theme == 'dark' ? 'active' : '' }}"
                                                            data-value="false" onclick="layout_changes('dark');"
                                                            data-bs-toggle="tooltip" title="Dark"><svg
                                                                class="pc-icon">
                                                                <use xlink:href="#custom-moon"></use>
                                                            </svg></button></div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="d-grid"><button
                                                            class="preset-btn btn {{ $theme == 'dark' ? 'active' : '' }}"
                                                            data-value="default" onclick="layout_changes_default();"
                                                            data-bs-toggle="tooltip"
                                                            title="Automatically sets the theme based on user's operating system's color scheme."><span
                                                                class="pc-lay-icon d-flex align-items-center justify-content-center"><i
                                                                    class="ph-duotone ph-cpu"></i></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <h6 class="mb-1">Custom Theme</h6>
                                        <p class="text-muted text-sm">Choose your primary theme color</p>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"
                                                id="value-color">{{ $config->color_default }}</span>
                                            <input type="color" class="form-control form-control-color"
                                                value="{{ $config->color_default }}" title="Choose your color">
                                            <button class="btn btn-danger" id="reset_default"
                                                type="button">Reset</button>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-12 d-grid">
                                                <button type="button"id="saveTheme"
                                                    class="btn btn-outline-primary">Simpan</button>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header fw-bold p-3 text-xss"><i class="fas fa-calendar-alt me-2"></i>Cronjob
                        </div>
                        <div class="card-body">
                            @php
                                $decode = json_decode($config->cronjob, true);
                            @endphp
                            @forelse ($decode as $key => $value)
                                <div class="mb-3">
                                    <label for="" class="form-label">Cronjob
                                        {{ ucfirst(str_replace('_', ' ', $key)) }}</label>
                                    <div class="form-check form-check-inline form-switch custom-switch-v1">
                                        <input type="checkbox"
                                            class="form-check-input cronjobs input-{{ $value == true ? 'primary' : 'danger' }}"
                                            id="{{ $key }}" {{ $value == true ? 'checked="checked"' : '' }}>
                                        <label
                                            class="form-check-label text-{{ $value == true ? 'primary' : 'danger' }} fw-bold"
                                            for="switch">{{ $value == true ? 'On' : 'Off' }}</label>
                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-danger">
                                    <div class="alert-body text-center">
                                        <i class="fas fa-exclamation-triangle me-2"></i> Data tidak ditemukan
                                    </div>
                                </div>
                            @endforelse
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-12 d-grid">
                                        <button type="button"id="saveCronjob"
                                            class="btn btn-outline-primary">Simpan</button>
                                    </div>
                                </div>
                            </li>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="card">
                        <div class="card-header fw-bold p-3 text-xss"><i class="fas fa-newspaper me-2"></i>Konfigurasi
                            Website dan
                            SEO</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="">Favicon icon</label>
                                <div class="input-group mb-3"><input type="file" class="form-control"
                                        id="favicon" wire:model="favicon" name="favicon" accept="image/*">
                                    <button class="btn btn-danger" onclick="resetInput('favicon')">Reset</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="mb-3">
                                        <label class="form-label" for="">Logo website</label>
                                        <div class="input-group mb-3"><input type="file" class="form-control"
                                                id="logo_website" wire:model="logo_website" name="logo_website"
                                                accept="image/*">
                                            <button class="btn btn-danger"
                                                onclick="resetInput('logo_website')">Reset</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="mb-3">
                                        <label class="form-label" for="">Default image user</label>
                                        <div class="input-group mb-3"><input type="file" class="form-control"
                                                id="image_user" name="image_user" wire:model="default_image"
                                                accept="image/*"> <button class="btn btn-danger"
                                                onclick="resetInput('image_user')">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="">Name Panel</label>
                                <input type="text" class="form-control" id="name_panel"
                                    value="{{ $config->name_panel }}" placeholder="Masukkan nama panel">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="">Path public</label>
                                <input type="text" class="form-control" id="path"
                                    value="{{ $config->path ?? null }}" placeholder="Masukkan directory index.php">
                                <small class="text-danger">* Masukkan path public jika directory folder public
                                    tidak
                                    sama dengan directory .env ( Khusus domain utama cpanel yang tidak bisa ubah
                                    folder root domain) </small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Title website</label>
                                <input type="text" class="form-control" id="title_website"
                                    value="{!! $config->title_website !!}" placeholder="Masukkan title website">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi website</label>
                                <textarea type="text" class="form-control" id="description_website" placeholder="Masukkan Deskripsi">{{ $config->description_website }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Keyword website</label>
                                <textarea type="text" class="form-control" id="keyword_website" placeholder="Masukkan Keyword">{{ $config->keyword_website }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Meta tag website</label>
                                <textarea type="text" class="form-control" id="meta_website" placeholder="<meta">{{ $config->meta_website }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Footer Website</label>
                                <textarea type="text" class="form-control" id="footer_website" placeholder="<meta">{!! $config->footer_website !!}</textarea>
                            </div>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-12 d-grid">
                                        <button type="button"id="saveSEO"
                                            class="btn btn-outline-primary">Simpan</button>
                                    </div>
                                </div>
                            </li>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane show {{ $tab == 'update' ? 'active' : '' }}" id="update" role="tabpanel"
            aria-labelledby="update-tab">
            <div class="card">
                <div class="card-header fw-bold p-3 text-xss"><i class="ti ti-adjustments me-2"></i> Update Online
                </div>
                <div class="card-body">
                    @php
                        $version = json_decode($config->version_source, true);
                        $time = \Carbon\Carbon::parse($version['last_update'])->format('d F Y H:i:s');
                    @endphp
                    <div class="kotak">
                        <div class="label">CLIENT ID</div>
                        <div class="value text-info">
                            {{ $version['client_id'] }} <span> <i wire:click="generate"
                                    class="fas fa-random fw-bold text-black" style="font-size:11px; cursor:pointer;"
                                    title="random"></i></span>
                        </div>
                        <div class="label">VERSION</div>
                        <div class="value text-danger">v{{ $version['version'] }}</div>
                        <div class="label">LAST UPDATE</div>
                        <div class="value text-success">{{ $time }}</div>
                        <div class="label">LOG UPDATE</div>
                        <div class="value text-primary">
                            {!! $version['message'] !!}
                        </div>
                    </div>
                    <div class="d-grid mt-3">
                        <button class="btn btn-outline-primary" id="check-update">Check
                            Update</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane show {{ $tab == 'smtp' ? 'active' : '' }}" id="smtp" role="tabpanel"
            aria-labelledby="smtp-tab">
            <div class="card">
                <div class="card-header fw-bold p-3 text-xss "><i class="ti ti-mail-opened me-2"></i>Konfigurasi SMTP
                </div>
                <div class="card-body">
                    @php
                        $decode = json_decode($config->konfigurasi_mail, true);
                    @endphp

                    <div class="mb-3">
                        <label for="" class="form-label">Verify user register</label>
                        <div class="form-check form-check-inline form-switch custom-switch-v1">
                            <input type="checkbox"
                                class="form-check-input input-{{ $decode['send_mail'] == true ? 'primary' : 'danger' }}"
                                id="verifycheck" {{ $decode['send_mail'] == true ? 'checked="checked"' : '' }}>
                            <label
                                class="form-check-label text-{{ $decode['send_mail'] == true ? 'primary' : 'danger' }} fw-bold"
                                for="switch">{{ $decode['send_mail'] == true ? 'On' : 'Off' }}</label>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md">
                            <label for="" class="form-label">Mail mailer</label>
                            <input type="text" name="mail_mailer" id="mail_mailer"
                                value="{{ $decode['mail_mailer'] }}" class="form-control">
                        </div>
                        <div class="col-md">
                            <label for="" class="form-label">Mail host</label>
                            <input type="text" name="mail_host" id="mail_host" class="form-control"
                                value="{{ $decode['mail_host'] }}">

                        </div>
                        <div class="col-md">
                            <label for="" class="form-label">Mail Port</label>
                            <input type="text" name="mail_port" id="mail_port" class="form-control"
                                value="{{ $decode['mail_port'] }}">

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md">
                            <label for="" class="form-label">Mail username</label>
                            <input type="text" name="mail_username" id="mail_username" class="form-control"
                                value="{{ $decode['mail_username'] }}">

                        </div>
                        <div class="col-md">
                            <label for="" class="form-label">Mail password</label>
                            <input type="passwordd" name="mail_password" id="mail_password" class="form-control"
                                value="{{ $decode['mail_password'] }}">
                        </div>
                        <div class="col-md">
                            <label for="" class="form-label">Mail encryption</label>
                            <input type="text" name="mail_encryption" id="mail_encryption" class="form-control"
                                value="{{ $decode['mail_encryption'] }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md">
                            <label for="" class="form-label">Mail from address</label>
                            <input type="text" name="mail_from_address" id="mail_from_address"
                                class="form-control" value="{{ $decode['mail_from_address'] }}">
                        </div>
                        <div class="col-md">
                            <label for="" class="form-label">Mail from name</label>
                            <input type="text" name="mail_from_name" id="mail_from_name" class="form-control"
                                value="{{ $decode['mail_from_name'] }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="button" id="savesmtp" class="btn btn-primary float-end"><i
                                class="fas fa-save fs-6 me-2"></i>Save</button>
                        <button type="reset" class="btn btn-danger float-end me-2"><i
                                class="fas fa-sync fs-6 me-2"></i>Reset</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="changeTheme"></div>
    <div id="defaultTheme"></div>
</div>
<script>
    (function() {
        ClassicEditor
            .create(document.querySelector('#classic-editor'))
            .then(editor => {
                window.editor = editor; // Simpan instance editor
            })
            .catch(error => {
                console.error(error);
            });
    })();

    function layout_changes(layout) {
        $('#changeTheme').data('theme', layout);
        $('#changeTheme').click();
    }

    function layout_changes_default() {
        $('#defaultTheme').click();
    }

    function resetInput(id) {
        $('#' + id).val('');
    }
</script>
</div>
@script
    <script>
        let layout = "{{ $config->color_default }}";
        let theme;
        document.querySelector('.form-control-color').addEventListener('input', function(e) {
            layout = e.target.value;
            $('#value-color').text(layout);
        });
        $('#saveTheme').on('click', function() {
            $wire.saveTheme(layout, theme);
        });
        $('#changeTheme').click(function() {
            theme = $(this).data('theme');
            layout_change(theme);
        });
        $('#reset_default').click(function() {
            layout = '#4680ff';
            $('.form-control-color').val(layout);
            $('#value-color').text(layout);
        });
        $('#defaultTheme').click(function() {
            layout_change_default();
            theme = 'default';
        });
        $('#saveTOS').click(function() {
            let tos = editor.getData();
            $wire.saveTOS(tos);
        });
        $('#savesmtp').click(function() {
            let verifycheck = $('#verifycheck').is(':checked');
            let mail_mailer = $('#mail_mailer').val();
            let mail_host = $('#mail_host').val();
            let mail_port = $('#mail_port').val();
            let mail_username = $('#mail_username').val();
            let mail_password = $('#mail_password').val();
            let mail_encryption = $('#mail_encryption').val();
            let mail_from_address = $('#mail_from_address').val();
            let mail_from_name = $('#mail_from_name').val();
            let send_mail = $('#send_mail').is(':checked');
            $wire.saveSMTP(verifycheck, mail_mailer, mail_host, mail_port, mail_username, mail_password,
                mail_encryption,
                mail_from_address, mail_from_name, send_mail);
        });
        $('#check-update').click(function() {
            $(this).attr('disabled', 'disabled');
            $(this).html('Loading...');
            Swal.fire({
                title: 'Loading',
                html: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                },
            });
            $wire.checkupdate();
        });
        $('#saveCronjob').click(function() {
            let cronjob = {};

            $('.cronjobs').each(function() {
                let id = $(this).attr('id');
                let value = $(this).is(':checked');
                cronjob[id] = value;
            });
            $wire.saveCronjob(cronjob);
        });
        $('#saveSEO').click(function() {
            let name_panel = $('#name_panel').val();
            let title_website = $('#title_website').val();
            let description_website = $('#description_website').val();
            let path = $('#path').val();
            let keyword_website = $('#keyword_website').val();
            let meta_website = $('#meta_website').val();
            let footer_website = $('#footer_website').val();
            $wire.saveSEO(name_panel, title_website, description_website, keyword_website, meta_website,
                footer_website, path);
        });
        window.addEventListener('swal:modal', event => {
            let detail = event.detail[0];
            if (detail.refresh) {
                Swal.fire({
                    title: detail.title,
                    text: detail.text,
                    icon: detail.type,
                }).then(() => {
                    if (detail.refresh) {
                        location.reload();
                    }
                });
                setInterval(() => {
                    location.reload();
                }, 1500);
            } else {

            }
        });

        // cek semua input checkbox apabila ada yang di centang maka tambahkan class text-primary pada element label dibawah nya
        $('.form-check-input').on('change', function() {
            if ($(this).is(':checked')) {
                $(this).removeClass('input-danger');
                $(this).parent().find('label').addClass('text-primary');
                $(this).parent().find('label').removeClass('text-danger');
                $(this).parent().find('label').addClass('fw-bold');
                $(this).parent().find('label').text('On');
            } else {
                $(this).removeClass('input-primary');
                $(this).parent().find('label').removeClass('text-primary');
                $(this).parent().find('label').addClass('text-danger');
                $(this).parent().find('label').text('Off');
            }
        });
    </script>
@endscript
