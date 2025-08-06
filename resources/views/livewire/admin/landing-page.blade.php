<div>
    @php
        $landing = App\Models\Landing::first();
    @endphp
    <style>
        .col-form-label {
            font-weight: 600
        }
    </style>
    <div class="card">
        <div class="card-body py-0">
            <ul class="nav nav-tabs profile-tabs " id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link {{ $tab == 'page-1' ? 'active' : '' }}" id="page-1-tab"
                        wire:click="$set('tab','page-1')" data-bs-toggle="tab" href="#page-1" role="tab"
                        aria-selected="true"><i class="ti ti-page-break me-2"></i>Page one</a>
                </li>
                <li class="nav-item"><a class="nav-link {{ $tab == 'page-2' ? 'active' : '' }}" id="page-2-tab"
                        wire:click="$set('tab','page-2')" data-bs-toggle="tab" href="#page-2" role="tab"
                        aria-selected="true"><i class="ti ti-page-break me-2"></i>Page two</a>
                </li>
                <li class="nav-item"><a class="nav-link {{ $tab == 'page-3' ? 'active' : '' }}" id="page-3-tab"
                        wire:click="$set('tab','page-3')" data-bs-toggle="tab" href="#page-3" role="tab"
                        aria-selected="true"><i class="ti ti-page-break me-2"></i>Page three</a>
                </li>
                <li class="nav-item"><a class="nav-link {{ $tab == 'page-4' ? 'active' : '' }}" id="page-4-tab"
                        wire:click="$set('tab','page-4')" data-bs-toggle="tab" href="#page-4" role="tab"
                        aria-selected="true"><i class="ti ti-page-break me-2"></i>Page four</a>
                </li>
                <li class="nav-item"><a class="nav-link {{ $tab == 'footer' ? 'active' : '' }}" id="footer-tab"
                        wire:click="$set('tab','footer')" data-bs-toggle="tab" href="#footer" role="tab"
                        aria-selected="true"><i class="ti ti-page-break me-2"></i>Footer</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="tab-content">
        @if (session()->has('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if (session()->has('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="tab-pane show {{ $tab == 'page-1' ? 'active' : '' }}" id="page-1" role="tabpanel"
            aria-labelledby="page-1-tab">
            <div class="card">
                @php
                    $page1 = json_decode($landing->page_one, true);
                @endphp
                <div class="card-header fw-bold p-3 text-xss">Page 1</div>
                <div class="card-body">
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-form-label">Header one</label>
                        <div class="col-lg-10">
                            <textarea type="text" class="form-control" name="header" id="header">{!! $page1['header'] !!}</textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-form-label">Header two</label>
                        <div class="col-lg-10">
                            <textarea type="text" class="form-control" name="header2" id="header2">{!! $page1['header2'] !!}</textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-form-label">Rating</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="rating" value="{!! $page1['rating'] !!}"
                                id="rating">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-form-label">Text count member</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="count" value="{!! $page1['count_member'] !!}"
                                id="count">
                        </div>
                    </div>
                    @php
                        $order = $page1['order'] ?? null;
                    @endphp
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-form-label">Order no login</label>
                        <div class="col-lg-10">
                            <select name="order" id="order" class="form-control">
                                <option value="1" {{ $order == '1' ? 'selected' : '' }}>Yes
                                </option>
                                <option value="0" {{ $order == '0' ? 'selected' : '' }}>No
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-form-label"></label>
                        <div class="col-lg-10">
                            <div class="d-grid">
                                <button type="submit" id="savePage1" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane show {{ $tab == 'page-2' ? 'active' : '' }}" id="page-2" role="tabpanel"
            aria-labelledby="page-2-tab">
            <div class="card">
                @php
                    $page2 = json_decode($landing->page_two, true);
                @endphp
                <div class="card-header fw-bold p-3 text-xss">Page 2</div>
                <div class="card-body">
                    <form action="{{ url('admin/page-2') }}" enctype='multipart/form-data' method="POST">
                        @csrf
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-form-label">Title Page</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" name="title_page"
                                    value="{!! $page2['title_page'] !!}" id="title_page">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-form-label">Small text</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" name="small_text"
                                    value="{!! $page2['small_text'] !!}" id="small_text">
                            </div>
                        </div>

                        <ul class="nav nav-tabs profile-tabs " id="myTab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="card-1-tab" data-bs-toggle="tab"
                                    href="#card-1" role="tab" aria-selected="true"><i
                                        class="ti ti-brand-pagekit me-2"></i>Card one</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" id="card-2-tab" data-bs-toggle="tab"
                                    href="#card-2" role="tab" aria-selected="true"><i
                                        class="ti ti-brand-pagekit me-2"></i>Card
                                    two</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" id="card-3-tab" data-bs-toggle="tab"
                                    href="#card-3" role="tab" aria-selected="true"><i
                                        class="ti ti-brand-pagekit me-2"></i>Card
                                    three</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-2">
                            <div class="tab-pane show active" id="card-1" role="tabpanel"
                                aria-labelledby="card-1-tab">
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-form-label">Title
                                        card</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" name="card_one[title]"
                                            value="{!! $page2['card_one']['title'] !!}" id="card_one[title]">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-form-label">Content
                                        card</label>
                                    <div class="col-lg-10">
                                        <textarea type="text" class="form-control" name="card_one[content]" id="card_one[content]">{!! $page2['card_one']['content'] !!}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-form-label">Image
                                        card</label>
                                    <div class="col-lg-10">
                                        <input type="file" class="form-control" name="card_one_image"
                                            id="card_one_image">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-form-label">Button</label>
                                    <div class="col-lg-10">
                                        <div class="row">
                                            <div class="col-md">
                                                <label for="" class="form-label">URL Button</label>
                                                <input type="text" class="form-control" name="card_one[url]"
                                                    value="{!! $page2['card_one']['url_button'] !!}" id="card_one[url_button]">
                                            </div>
                                            <div class="col-md">
                                                <label for="" class="form-label">Text Button</label>
                                                <input type="text" class="form-control"
                                                    name="card_one[text_button]" value="{!! $page2['card_one']['text_button'] !!}"
                                                    id="card_one[text_button]">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane show" id="card-2" role="tabpanel" aria-labelledby="card-2-tab">
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-form-label">Title
                                        card</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" name="card_two[title]"
                                            value="{!! $page2['card_two']['title'] !!}" id="card_two[title]">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-form-label">Content
                                        card</label>
                                    <div class="col-lg-10">
                                        <textarea type="text" class="form-control" name="card_two[content]" id="card_two[content]">{!! $page2['card_two']['content'] !!}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-form-label">Image
                                        card</label>
                                    <div class="col-lg-10">
                                        <input type="file" class="form-control" name="card_two_image"
                                            id="card_two_image">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-form-label">Button</label>
                                    <div class="col-lg-10">
                                        <div class="row">
                                            <div class="col-md">
                                                <label for="" class="form-label">URL Button</label>
                                                <input type="text" class="form-control" name="card_two[url]"
                                                    value="{!! $page2['card_two']['url_button'] !!}" id="card_two[url_button]">
                                            </div>
                                            <div class="col-md">
                                                <label for="" class="form-label">Text Button</label>
                                                <input type="text" class="form-control"
                                                    name="card_two[text_button]" value="{!! $page2['card_two']['text_button'] !!}"
                                                    id="card_two[text_button]">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane show" id="card-3" role="tabpanel" aria-labelledby="card-3-tab">
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-form-label">Title
                                        card</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" name="card_three[title]"
                                            value="{!! $page2['card_three']['title'] !!}" id="card_three[title]">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-form-label">Content
                                        card</label>
                                    <div class="col-lg-10">
                                        <textarea type="text" class="form-control" name="card_three[content]" id="card_three[content]">{!! $page2['card_three']['content'] !!}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-form-label">Image
                                        card</label>
                                    <div class="col-lg-10">
                                        <input type="file" class="form-control" name="card_three_image"
                                            id="card_three_image">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-form-label">Button</label>
                                    <div class="col-lg-10">
                                        <div class="row">
                                            <div class="col-md">
                                                <label for="" class="form-label">URL Button</label>
                                                <input type="text" class="form-control" name="card_three[url]"
                                                    value="{!! $page2['card_three']['url_button'] !!}" id="card_three[url_button]">
                                            </div>
                                            <div class="col-md">
                                                <label for="" class="form-label">Text Button</label>
                                                <input type="text" class="form-control"
                                                    name="card_three[text_button]" value="{!! $page2['card_three']['text_button'] !!}"
                                                    id="card_three[text_button]">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-form-label"></label>
                            <div class="col-lg-10">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="tab-pane show {{ $tab == 'page-3' ? 'active' : '' }}" id="page-3" role="tabpanel"
            aria-labelledby="page-3-tab">
            <div class="card">
                @php
                    $page3 = json_decode($landing->page_three, true);
                @endphp
                <div class="card-header fw-bold p-3 text-xss">Page 3</div>
                <div class="card-body">
                    <form action="{{ url('admin/page-3') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-form-label">Title Page</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" name="title_page"
                                    value="{!! $page3['title_page'] !!}" id="title_page">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-form-label">Small text</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" name="small_text"
                                    value="{!! $page3['small_text'] !!}" id="small_text">
                            </div>
                        </div>

                        <ul class="nav nav-tabs profile-tabs " id="myTab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="tab-1-tab" data-bs-toggle="tab"
                                    href="#tab-1" role="tab" aria-selected="true"><i
                                        class="ti ti-brand-pagekit me-2"></i>Tab one</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" id="tab-2-tab" data-bs-toggle="tab"
                                    href="#tab-2" role="tab" aria-selected="true"><i
                                        class="ti ti-brand-pagekit me-2"></i>Tab
                                    two</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" id="tab-3-tab" data-bs-toggle="tab"
                                    href="#tab-3" role="tab" aria-selected="true"><i
                                        class="ti ti-brand-pagekit me-2"></i>Tab
                                    three</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" id="tab-4-tab" data-bs-toggle="tab"
                                    href="#tab-4" role="tab" aria-selected="true"><i
                                        class="ti ti-brand-pagekit me-2"></i>Tab
                                    three</a>
                            </li>
                        </ul>

                        <div class="tab-content mt-2">
                            <div class="tab-pane show active" id="tab-1" role="tabpanel"
                                aria-labelledby="tab-1-tab">
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-form-label">Title tab</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" name="tab_one[title]"
                                            value="{!! $page3['tab_one']['title'] !!}" id="tab_one[title]">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-form-label">Content
                                        card</label>
                                    <div class="col-lg-10">
                                        <textarea type="text" class="form-control" name="tab_one[content]" id="tab_one[content]">{!! $page3['tab_one']['content'] !!}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-form-label">Image card</label>
                                    <div class="col-lg-10">
                                        <input type="file" class="form-control" name="tab_one_image"
                                            id="tab_one_image">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane show" id="tab-2" role="tabpanel" aria-labelledby="tab-2-tab">
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-form-label">Title tab</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" name="tab_two[title]"
                                            value="{!! $page3['tab_two']['title'] !!}" id="tab_two[title]">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-form-label">Content
                                        card</label>
                                    <div class="col-lg-10">
                                        <textarea type="text" class="form-control" name="tab_two[content]" id="tab_two[content]">{!! $page3['tab_two']['content'] !!}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-form-label">Image card</label>
                                    <div class="col-lg-10">
                                        <input type="file" class="form-control" name="tab_two_image"
                                            id="tab_two_image">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane show" id="tab-3" role="tabpanel" aria-labelledby="tab-3-tab">
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-form-label">Title tab</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" name="tab_three[title]"
                                            value="{!! $page3['tab_three']['title'] !!}" id="tab_three[title]">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-form-label">Content
                                        card</label>
                                    <div class="col-lg-10">
                                        <textarea type="text" class="form-control" name="tab_three[content]" id="tab_three[content]">{!! $page3['tab_three']['content'] !!}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-form-label">Image card</label>
                                    <div class="col-lg-10">
                                        <input type="file" class="form-control" name="tab_three_image"
                                            id="tab_three_image">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane show" id="tab-4" role="tabpanel" aria-labelledby="tab-4-tab">
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-form-label">Title
                                        tab</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" name="tab_four[title]"
                                            value="{!! $page3['tab_four']['title'] !!}" id="tab_four[title]">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-form-label">Content
                                        card</label>
                                    <div class="col-lg-10">
                                        <textarea type="text" class="form-control" name="tab_four[content]" id="tab_four[content]">{!! $page3['tab_four']['content'] !!}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-form-label">Image
                                        card</label>
                                    <div class="col-lg-10">
                                        <input type="file" class="form-control" name="tab_four_image"
                                            id="tab_four_image">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="tab-pane show {{ $tab == 'page-4' ? 'active' : '' }}" id="page-4" role="tabpanel"
            aria-labelledby="page-4-tab">
            @php
                $page4 = json_decode($landing->page_four, true);
                // dd($page4);
            @endphp
            <div class="card">
                <div class="card-header fw-bold text-xss p-3">Page 4</div>
                <div class="card-body">
                    <label for="" class="form-label">Title</label>
                    <input type="text" name="title" value="{{ $page4['title'] }}" id="title_page4"
                        class="form-control">
                    <label for="" class="form-label mt-2">Small Text</label>
                    <textarea name="small_text" id="small_text_page4" class="form-control">{!! $page4['small_text'] !!}</textarea>
                    <div class="d-grid">
                        <button class="btn btn-primary mt-2" id="savePage4">Save</button>
                    </div>
                    <div class="table-responsive mt-2 mb-2">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Image</th>
                                    <th>Content</th>
                                    <th>Profesi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($page4['data'] as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value['nama'] }}</td>
                                        <td><img src="{{ url($value['image']) }}" alt=""
                                                style="width: 50px">
                                        </td>
                                        <td>{{ $value['content'] }}</td>
                                        <td>{{ $value['profesi'] }}</td>
                                        <td>
                                            <button class="btn btn-danger btn-sm"
                                                onclick="deletePeople('{{ $key }}')"><i
                                                    class="fas fa-trash me-1"></i>Hapus</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <label for="" class="form-label">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control"
                                placeholder="Nama">
                        </div>
                        <div class="col-md">
                            <label for="" class="form-label">Image</label>
                            <input type="file" name="image" wire:model="image_pagefour" id="image"
                                accept="image/*" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md">
                            <label for="" class="form-label">Content</label>
                            <input name="content" id="content" class="form-control" placeholder="Content">
                        </div>
                        <div class="col-md">
                            <label for="" class="form-label">Profesi</label>
                            <input type="text" name="profesi" id="profesi" class="form-control"
                                placeholder="Profesi">
                        </div>
                    </div>
                    <div class="float-end mt-2">
                        <button class="btn btn-primary" id="savePeople">Tambah</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane show {{ $tab == 'footer' ? 'active' : '' }}" id="footer" role="tabpanel"
            aria-labelledby="footer-tab">
            <div class="card">
                <div class="card-header fw-bold p-3 text-xss">Footer</div>
                <div class="card-body" wire:ignore>

                    <textarea id="classic-editor">{!! $landing->footer !!}</textarea>
                    <div class="d-grid">
                        <button class="btn btn-primary mt-2" id="saveFooter">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="triggerDelete"></div>
    <script>
        function deletePeople(key) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#triggerDelete').data('key', key);
                    $('#triggerDelete').click();
                }
            })
        }
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
    </script>
</div>
@script
    <script>
        $('#triggerDelete').click(function() {
            let key = $(this).data('key');
            $wire.deletePeople(key);
        })
        $('#savePage1').click(function() {
            let header = $('#header').val();
            let header2 = $('#header2').val();
            let rating = $('#rating').val();
            let count = $('#count').val();
            let order = $('#order').val();
            $wire.savePage1(header, header2, rating, count, order);
        });
        $('#savePeople').click(function() {
            let nama = $('#nama').val();
            let content = $('#content').val();
            let profesi = $('#profesi').val();
            $wire.savePeople(nama, content, profesi);
        });
        $('#savePage4').click(function() {
            let title = $('#title_page4').val();
            let small_text = $('#small_text_page4').val();
            $wire.savePage4(title, small_text);
        });
        $('#saveFooter').click(function() {
            let footer = window.editor.getData();
            $wire.saveFooter(footer);
        })
    </script>
@endscript
