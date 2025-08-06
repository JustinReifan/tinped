<div>
    <div class="card">
        <div class="card-header fw-bold p-3 text-xss"><i class="fas fa-pencil-ruler me-2"></i>Edit deposit
            #{{ $history->trxid }}
        </div>
        <div class="card-body">
            <form wire:submit="updateDeposit">
                <div class="row mb-3">
                    <div class="col-md">
                        <label for="" class="form-label">Trxid</label>
                        <input type="text" class="form-control" wire:model.lazy="trxid" id="trxid" ">
                    </div>
                    <div class="col-md" wire:ignore>
                        <label for="" class="form-label">Type Proses</label>
                        <select name="type_proses" id="type_proses" style="width:100%" wire:model.change="type_proses"
                            class="form-control select2" style="width:100%">
                        <option value="auto" @if ($history->type == 'auto') selected @endif>Otomatis</option>
                        <option value="manual" @if ($history->type == 'manual') selected @endif>Manual</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md">
                        <label for="" class="form-label">Code</label>
                        <input type="text" class="form-control" wire:model.lazy="code" id="code" ">
                    </div>
                    <div class="col-md">
                        <label for="" class="form-label">Name Payment</label>
                        <input type="text" class="form-control" wire:model.lazy="name_payment"
                            id="name_payment" ">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md">
                        <label for="" class="form-label">Account Number</label>
                        <input type="text" class="form-control" id="account_number" wire:model.lazy="account_number" ">
                    </div>
                    <div class="col-md">
                        <label for="" class="form-label">Account Name</label>
                        <input type="text" class="form-control" id="account_name" wire:model.lazy="account_name" ">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md">
                        <label for="" class="form-label">Total Pembayaran</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input type="text" class="form-control" wire:model.lazy="amount" id="amount" ">
                    </div>
                </div>
                <div class="col-md">
                    <label for="" class="form-label">Saldo yang diterima</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp.</span>
                        <input type="text" class="form-control" wire:model.lazy="diterima" id="diterima" ">
                        </div>
                    </div>
                </div>
                <div class="float-end">
                    <button class="btn btn-danger" type="button" wire:click="$set('toggleEdit', false)">Cancel</button>
                    <button class="btn btn-primary" type="submit" wire:click="updateDeposit">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
