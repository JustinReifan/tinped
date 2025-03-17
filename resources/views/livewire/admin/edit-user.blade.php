<div>
    <div class="card">
        <div class="card-header fw-bold p-3 text-xss">Edit user </div>
        <div class="card-body">
            <form wire:submit="editUsers">
                <div class="row">
                    <div class="col-md">
                        <label for="" class="form-label">Nama</label>
                        <input type="text" class="form-control" wire:model.lazy="name">
                    </div>
                    <div class="col-md">
                        <label for="" class="form-label">Username</label>
                        <input type="text" class="form-control" wire:model.lazy="username">
                    </div>
                    <div class="col-md">
                        <label for="" class="form-label">Email</label>
                        <input type="text" class="form-control" wire:model.lazy="email">
                    </div>
                    <div class="col-md">
                        <label for="" class="form-label">Whatsapp</label>
                        <input type="text" class="form-control" wire:model.lazy="whatsapp">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md">
                        <label for="" class="form-label">Google2fa</label>
                        <select name="google" id="google" class="form-control">
                            <option value="0">Tidak</option>
                            <option value="1">Ya</option>
                        </select>
                    </div>
                    <div class="col-md">
                        <label for="" class="form-label">Balance</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="text" class="form-control" wire:model.lazy="balance">
                        </div>
                    </div>
                    <div class="col-md">
                        <label for="" class="form-label">Omzet</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="text" class="form-control" wire:model.lazy="omzet">
                        </div>
                    </div>
                    <div class="col-md">
                        <label for="" class="form-label">Level</label>
                        <select name="level" id="level" wire:model.lazy="level" class="form-control">
                            @php
                                $level = App\Models\LevelUser::all();
                            @endphp
                            @forelse ($level as $row)
                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @empty
                                <option value="">Tidak ada level</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md">
                        <label for="" class="form-label">Role</label>
                        <select name="role" id="role" wire:model.change="role" class="form-control">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="col-md">
                        <label for="" class="form-label">Is Verify</label>
                        <select name="is_verify" id="is_verify" wire:model.change="is_verify" class="form-control">
                            <option value="0">Tidak</option>
                            <option value="1">Ya</option>
                        </select>
                    </div>
                    <div class="col-md">
                        <label for="" class="form-label">Gender</label>
                        <select name="gender" id="gender" class="form-control" wire:model.change="gender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="col-md">
                        <label for="" class="form-label">Zona</label>
                        <select name="zona" id="zona" class="form-control" wire:model.change="zona">
                            <option value="Asia/Jakarta">Asia/Jakarta - GMT+07:00 (WIB)</option>
                            <option value="Asia/Makassar">Asia/Makassar - GMT+08:00 (WITA)</option>
                            <option value="Asia/Jayapura">Asia/Jayapura - GMT+09:00 (WIT)</option>
                        </select>
                    </div>
                </div>
                <div class="mt-3">
                    <label for="" class="form-label">Status</label>
                    <select name="stat" id="stat" class="form-control" wire:model.change="status">
                        <option value="active">Active</option>
                        <option value="banned">Banned</option>
                        <option value="nonverif">Nonverif</option>
                    </select>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <div class="button-items d-grid gap-2">
                            <button type="reset" wire:click="$set('edit_id', null)"
                                class="btn btn-danger btn-block waves-effect waves-light mt-0"><i
                                    class="ti ti-arrow-back-up"></i> Back</button>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="button-items d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-block waves-effect waves-light mt-0"><i
                                    class="ti ti-send"></i> Change</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
