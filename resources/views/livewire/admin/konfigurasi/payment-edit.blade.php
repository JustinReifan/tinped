<div>
    <form wire:submit="SaveEdit" enctype="multipart/form-data">
        <div class="card">
            <div class="card-header fw-bold p-3 text-xss">Edit Pembayaran</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-box">
                        <tr>
                            <th>Provider</th>
                            <td>
                                <input type="text" name="" wire:model.lazy="provider2" id="provider2"
                                    class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <th>Type Proses</th>
                            <td>
                                <select name="type_proses" wire:model.change="type_proses" id="type_proses"
                                    class="form-control">
                                    <option value="">Select type</option>
                                    <option value="otomatis">Otomatis</option>
                                    <option value="manual">Manual</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Code</th>
                            <td>
                                <input type="text" name="" wire:model.lazy="code" id="code"
                                    class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>
                                <input type="text" name="" wire:model.lazy="name" id="name"
                                    class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <th>Rate Type</th>
                            <td>
                                <select class="form-control" wire:model.change="rate_type">
                                    <option value="">Pilih Rate Type</option>
                                    <option value="percent">Percentage</option>
                                    <option value="fixed">Fixed</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Rate</th>
                            <td>
                                <input type="text" name="" wire:model.lazy="rate" id="rate"
                                    class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <th>Min & Max</th>
                            <td>
                                <div class="row">

                                    <div class="col-md">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Min Deposit</label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="number" name="min_deposit" id="min_deposit"
                                                    wire:model.lazy="min_deposit" placeholder="Masukkan Min Deposit"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Max Deposit</label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="number" name="max_deposit" id="max_deposit"
                                                    wire:model.lazy="max_deposit" placeholder="Masukkan Max Deposit"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Name Account</th>
                            <td>
                                <input type="text" name="" wire:model.lazy="account_name" id="account_name"
                                    class="form-control">
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
                            <th>Image Metode</th>
                            <td>
                                <div class="input-group mb-3"><input type="file" class="form-control"
                                        id="image_metode" wire:model="image_metode" name="image_metode"
                                        accept="image/*">
                                    <button class="btn btn-danger" id="resetimage">Reset</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>No login</th>
                            <td>
                                <select name="nologin" id="nologin" wire:model="nologin" class="form-control">
                                    <option value="1">Ya</option>
                                    <option value="0">Tidak</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <select name="stat" id="stat" wire:model="status" class="form-control">
                                    <option value="active">Aktif</option>
                                    <option value="inactive">Tidak</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-danger me-2" type="button"
                        wire:click="$set('edit_id', null)">Cancel</button>
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </div>
        </div>
    </form>
</div>
