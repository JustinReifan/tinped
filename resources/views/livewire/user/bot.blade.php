<div>
    <div id="title-page" data-value="Pengaturan Bot" data-value2="Layanan"></div>
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-header fw-bold p-3 text-xss">Whatsapp</div>
                <div class="card-body">
                    <div class="card pc-user-card"
                        style="background: rgba(var(--bs-primary-rgb), 0.2); border-color: var(--bs-primary) !important">
                        <div class="card-body py-3 pe-3">
                            Anda akan menerima notifikasi <b><em>WhatsApp</em></b> jika:
                            <ul class="m-0">
                                <li><b><em>WhatsApp</em></b> Anda telah diverifikasi.</li>
                                <li>Login akun menggunakan perangkat baru.</li>
                                <li>Melakukan permintaan reset password.</li>
                                <li>Saldo kurang dari atau sama dengan <b><em>Batas Saldo.</em></b></li>
                                <li>Melakukan pemesanan lebih dari <b><em>Harga Maksimal Pemesanan.</em></b></li>
                                <li>Melakukan deposit baru (termasuk pembaruan deposit).</li>
                                <li>Melakukan pembelian voucher baru (termasuk pembaruan voucher).</li>
                                <li>Membuat tiket baru (termasuk pembaruan tiket).</li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">WhatsApp
                            @if ($wa)
                                @if ($wa->status == '1')
                                    <i class="ti ti-check fw-bolder text-success" data-bs-toggle="tooltip"
                                        data-bs-placement="top" data-bs-original-title="verified"></i>
                                @else
                                    <i class="ti ti-x fw-bolder text-danger" data-bs-toggle="tooltip"
                                        data-bs-placement="top" data-bs-original-title="Unverified"></i>
                                @endif
                            @else
                                <i class="ti ti-x fw-bolder text-danger" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-original-title="Unverified"></i>
                            @endif
                        </label>
                        <div class="input-group">
                            <input type="string" class="form-control" disabled wire:model.lazy="number_whatsapp">
                            <button type="button" class="btn btn-warning" onclick="changeWa();"><i
                                    class="fas fa-edit fs-6 me-2"></i>Change</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Batas Saldo <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <select class="form-control" id="send_min_balance" name="send_min_balance"
                                style="max-width: 80px;" @if (!$wa or $wa->status == '0') disabled @endif>
                                <option value="1" @if ($switch_min_whatsapp == 1) selected @endif>On</option>
                                <option value="0" @if ($switch_min_whatsapp == 0) selected @endif>
                                    Off</option>
                            </select>
                            <div class="input-group-text">Rp</div>
                            <input type="number" class="form-control" wire:model.lazy="min_whatsapp" name="min_balance"
                                value="0" @if (!$wa or $wa->status == '0') disabled @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Harga Maksimal Pemesanan <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <select class="form-control" id="send_max_order" name="send_max_order"
                                style="max-width: 80px;" @if (!$wa or $wa->status == '0') disabled @endif>
                                <option value="1"@if ($switch_max_whatsapp == 1) selected @endif>On</option>
                                <option value="0"@if ($switch_max_whatsapp == 0) selected @endif>Off</option>
                            </select>
                            <div class="input-group-text">Rp</div>
                            <input type="number" class="form-control" wire:model.lazy="max_whatsapp" name="max_order"
                                value="100000" @if (!$wa or $wa->status == '0') disabled @endif>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Notifikasi Deposit <span class="text-danger">*</span></label>
                                <select class="form-control" id="notif_deposit" name="send_deposit"
                                    @if (!$wa or $wa->status == '0') disabled @endif>
                                    <option value="1" @if ($deposit_whatsapp == 1) selected @endif>On
                                    </option>
                                    <option value="0" @if ($deposit_whatsapp == 0) selected @endif>Off
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Notifikasi Tiket <span class="text-danger">*</span></label>
                                <select class="form-control" id="notif_tiket" name="send_ticket"
                                    @if (!$wa or $wa->status == '0') disabled @endif>
                                    <option value="1" @if ($tiket_whatsapp == 1) selected @endif>On
                                    </option>
                                    <option value="0" @if ($tiket_whatsapp == 0) selected @endif>Off
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-0">
                        <button type="submit" class="btn btn-primary w-100" id="submit"
                            @if (!$wa) disabled @endif><i
                                class="fas fa-save fs-6 me-2"></i>Save</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md"></div>
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
        function changeWa() {
            $('#change-whatsapp').modal('show');
        }
    </script>
</div>
@script
    <script>
        $('#submit').click(function() {
            let send_min_balance = $('#send_min_balance').val();
            let send_max_order = $('#send_max_order').val();
            let notif_deposit = $('#notif_deposit').val();
            let notif_tiket = $('#notif_tiket').val();
            $wire.saveChanges(send_min_balance, send_max_order, notif_deposit, notif_tiket);
        });
        window.addEventListener('swal:modal', event => {
            Swal.fire({
                title: event.detail[0].title,
                text: event.detail[0].text,
                icon: event.detail[0].type,
            });
        });
        $('#inputWhatsapp').keyup(function() {
            let data = $('#inputWhatsapp').data('whatsapp');
            let value = $(this).val();
            if (data != value) {
                $('#submitWhatsapp').removeClass('disabled');
            } else {
                $('#submitWhatsapp').addClass('disabled');
            }
        });
    </script>
@endscript
