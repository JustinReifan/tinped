<div class="mb-2">
    <label class="form-label">Kategori <span class="text-danger">*</span></label>
    <select name="category" id="category" class="form-control select22">
        @php
            $category = $smm->unique('category');
        @endphp
        @foreach ($category as $data)
            <option value="{{ $data->category }}">{{ $data->category }}</option>
        @endforeach
    </select>
    <div class="mt-2">
        <label class="form-label">Layanan<span class="text-danger">*</span></label>
        <select name="layanan" id="layanan" class="form-control select22">
            @foreach ($smm->unique('name') as $data)
                @php
                    $enc = App\Helpers\Encryption::encrypt($data->service . '|' . $data->provider);
                @endphp
                <option value="{{ $enc }}"@if ($loop->iteration == '1' ? 'selected' : '')  @endif>{{ $data->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>
