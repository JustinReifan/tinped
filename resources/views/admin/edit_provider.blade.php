<form action="{{ url('admin/konfigurasi/update-provider') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $provider->id }}">
    <div class="row mb-3">
        <div class="col-md">
            <label for="" class="form-label">Nama Provider</label>
            <input type="text" class="form-control" placeholder="Masukkan nama provider" value="{{ $provider->nama }}"
                id="nama_provider" name="nama_provider">
        </div>
        <div class="col-md">
            <label for="" class="form-label">Mata Uang</label>
            <select class="form-select select2" id="mata_uang" name="currency">
                <option value="">Pilih mata uang</option>
                <option value="idr" {{ $provider->currency == 'idr' ? 'selected' : '' }}>IDR</option>
                <option value="usd" {{ $provider->currency == 'usd' ? 'selected' : '' }}>USD</option>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md">
            <label for="" class="form-label">Rate</label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1">Rp</span>
                <input type="text" class="form-control" name="rate" value="{{ $provider->rate }}"
                    placeholder="Masukkan rate" value="1" id="rate">
            </div>
        </div>
        <div class="col-md">
            <label for="" class="form-label">Auto no login?</label>
            <select class="form-select select2" id="auto_nologin" name="auto_nologin">
                <option value="">Pilih status</option>
                <option value="1" {{ $provider->auto_nologin == '1' ? 'selected' : '' }}>Ya</option>
                <option value="0" {{ $provider->auto_nologin == '0' ? 'selected' : '' }}>Tidak</option>
            </select>
        </div>
        <div class="col-md">
            <label for="" class="form-label">Proses Manual</label>
            <select class="form-select select2" id="proses_manual" name="proses_manual">
                <option value="">Pilih status</option>
                <option value="1" {{ $provider->proses_manual == '1' ? 'selected' : '' }}>Ya</option>
                <option value="0" {{ $provider->proses_manual == '0' ? 'selected' : '' }}>Tidak</option>
            </select>
        </div>
    </div>
    <div class="float-end mb-3 mt-3">
        <button class="btn btn-primary" type="submit" id="btnsave">Simpan</button>
    </div>
</form>
