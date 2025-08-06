<div>
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
    @if ($errors->first())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header fw-bold p-3 text-xss"><i class="fas fa-gears me-2"></i>Pengaturan
                </div>
                <div class="card-body pb-3">
                    <form wire:submit="changeSetting">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Profile Picture</label>
                                    <div class="input-group">
                                        <input class="form-control" type="file" name="profile"
                                            wire:model="profile_picture" id="input-profile"
                                            accept="image/jpg,image/jpeg,image/png">
                                        <button type="button" class="btn btn-danger"><i
                                                class="fas fa-sync fs-6 me-2"></i>Reset</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" wire:ignore>
                                    <label class="form-label">Gender <span class="text-danger">*</span></label>
                                    <select class="select2 form-control" id="gender" name="gender"
                                        wire:model.change="gender">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Email
                                        @if (Auth::user()->is_mail == '1')
                                            <i class="ti ti-check fw-bolder text-success" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-original-title="Verified"></i>
                                        @else
                                            <i class="ti ti-x fw-bolder text-danger" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-original-title="Unverified"></i>
                                        @endif
                                    </label>
                                    <div class="input-group">
                                        <input type="email" class="form-control" wire:model.lazy="email"
                                            disabled="">
                                        <button type="button" class="btn btn-warning"
                                            wire:click="$set('email2', '{{ Auth::user()->email }}')"
                                            onclick="changeEmail();"><i
                                                class="fas fa-edit fs-6 me-2"></i>Change</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">WhatsApp <i class="ti ti-check fw-bolder text-success"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-original-title="verified"></i></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" wire:model="whatsapp" disabled="">
                                        <button type="button" class="btn btn-primary"
                                            onclick="window.location.href='{{ url('account/bot') }}';"><i
                                                class="fas fa-edit fs-6 me-2"></i>Change</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Username <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="username"
                                        wire:model.lazy="username">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Fullname <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="full_name"
                                        wire:model.lazy="full_name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Timezone <span class="text-danger">*</span></label>
                                    <select name="timezone" id="timezone" class="select2 form-control"
                                        wire:model.change="timezone">

                                        <option value="Asia/Jakarta">Asia/Jakarta - GMT+07:00 (WIB)</option>
                                        <option value="Asia/Makassar">Asia/Makassar - GMT+08:00 (WITA)</option>
                                        <option value="Asia/Jayapura">Asia/Jayapura - GMT+09:00 (WIT)</option>
                                        <option value="UTC">UTC</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">New Password</label>
                                    <input type="password" class="form-control" wire:model.lazy="new_password"
                                        name="new_password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control" wire:model.lazy="cpassword"
                                        name="confirm_password">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Password <span class="text-danger">*</span> (<span
                                            class="small text-muted">Enter your password to make
                                            changes.</span>)</label>
                                    <input type="password" class="form-control" wire:model.lazy="password"
                                        name="password">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary float-end"><i
                                        class="fas fa-save fs-6 me-2"></i>Save</button>
                                <button type="reset" class="btn btn-danger float-end me-2"><i
                                        class="fas fa-sync fs-6 me-2"></i>Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="change-email" wire:ignore data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Change Email</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-3">
                    <form wire:submit="change_email">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="email" id="inputEmail"
                                wire:model.lazy="email2" data-email="{{ Auth::user()->email }}" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary float-end disabled" id="submitEmail"><i
                                    class="fas fa-save fs-6 me-2"></i>Save</button>
                            <button type="button" class="btn btn-danger float-end me-2" data-bs-dismiss="modal"><i
                                    class="fas fa-times fs-6 me-2"></i>Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="change-whatsapp" wire:ignore data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Change Whatsapp</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-3">
                    <form wire:submit="change_whatsapp">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Whatsapp <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="whatsapp" id="inputWhatsapp"
                                wire:model.lazy="number_whatsapp" data-whatsapp="{{ $number_whatsapp }}"
                                autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary float-end disabled" data-bs-dismiss="modal"
                                id="submitWhatsapp"><i class="fas fa-save fs-6 me-2"></i>Save</button>
                            <button type="button" class="btn btn-danger float-end me-2" data-bs-dismiss="modal"><i
                                    class="fas fa-times fs-6 me-2"></i>Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function changeEmail() {
            $('#change-email').modal('show');
        }

        function changeWa() {
            $('#change-whatsapp').modal('show');
        }
    </script>
</div>
@script
    <script>
        $('#gender').change(function() {
            $wire.set('gender', this.value);
        });
        $('#timezone').change(function() {
            $wire.set('timezone', this.value);
        });
        window.addEventListener('removeblock', event => {
            HoldOn.close();
            if (event.detail[0].refresh) {
                setInterval(() => {
                    window.location.reload();
                }, 1000);
            }
        });
        $('#inputEmail').keyup(function() {
            let data = $('#inputEmail').data('email');
            let value = $(this).val();
            if (data != value) {
                $('#submitEmail').removeClass('disabled');
            } else {
                $('#submitEmail').addClass('disabled');
            }
        });
    </script>
@endscript
