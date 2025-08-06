<div>
    <style>
        .sensor {
            filter: blur(3px);
        }

        .sensor:hover {
            filter: none;
        }

        .text-right {
            text-align: right;
        }
    </style>
    <div class="row">
        <div class="col-md-8 mx-auto">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {!! session()->get('success') !!}
                    <button type="button" class="btn-close" wire:click="RemoveSession" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ session()->get('error') }}
                    <button type="button" wire:click="RemoveSession" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            @endif
            @if ($errors->all())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }} </li>
                    @endforeach
                    <button type="button" class="btn-close" wire:click="RemoveSession" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            @endif
            <div class="card">
                <div class="card-header fw-bold p-3 text-xss"><i class="mdi mdi-webpack me-1"></i>Konfigurasi Website
                    </h5>
                    <div class="card-body">
                        <ul class="nav nav-pills" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link @if ($tab == 'ui') active @endif mt-2"
                                    wire:click="activatedTab('ui')" data-bs-toggle="tab" href="#color" role="tab">
                                    <i class="mdi mdi-format-color-fill me-1 align-middle"></i> <span
                                        class="d-md-inline-block">Ui
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if ($tab == 'api_key') active @endif mt-2"
                                    wire:click="activatedTab('api_key')" data-bs-toggle="tab" href="#api_key"
                                    role="tab">
                                    <i class="mdi mdi-fire me-1 align-middle"></i> <span class="d-md-inline-block">API
                                        KEY</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if ($tab == 'seo') active @endif mt-2"
                                    wire:click="activatedTab('seo')"data-bs-toggle="tab" href="#seo" role="tab">
                                    <i class="mdi mdi-sitemap me-1 align-middle"></i> <span
                                        class="d-md-inline-block">SEO</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if ($tab == 'contact') active @endif mt-2"
                                    wire:click="activatedTab('contact')"data-bs-toggle="tab" href="#contact"
                                    role="tab">
                                    <i class="mdi mdi-contacts me-1 align-middle"></i> <span
                                        class="d-md-inline-block">Contact</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">
                            <div class="tab-pane @if ($tab == 'ui') active @endif mt-2" id="color"
                                role="tabpanel">
                                <form wire:submit.prevent="setUi">
                                    <div class="mb-2 row">
                                        <label class="col-md-3 col-form-label">Type Sidebbar</label>
                                        <div class="col-md-9">
                                            <select name="type_sidebar" id="type_sidebar" class="form-control"
                                                wire:model.change="type_sidebar">
                                                <option value="">Select menu</option>
                                                <option value="vertical">Vertical</option>
                                                <option value="horizontal">Horizontal</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label class="col-md-3 col-form-label">Color Default</label>
                                        <div class="col-md-9">
                                            <div class="input-group" wire:ignore>
                                                <input type="text" wire:model="color_default" name="color"
                                                    id="color" class="form-control form-control-sm">
                                                <div class="input-group-addon">
                                                    <input type='text' id="custom" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label class="col-md-3 col-form-label">Linear Gradient Navbar</label>
                                        <div class="col-md-9">
                                            <div class="input-group" wire:ignore>
                                                <input type="text" wire:model="second_default" name="color"
                                                    id="color" class="form-control form-control-sm">
                                                <div class="input-group-addon">
                                                    <input type='text' id="customs" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-0 mt-3 float-end">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light"><i
                                                class="mdi mdi-content-save me-1"></i>Save Changes</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane @if ($tab == 'api_key') active @endif mt-2" id="api_key"
                                role="tabpanel">
                                <form wire:submit.prevent="setApi">
                                    <div class="row">
                                        <div class="col-md text-right" wire:ignore>
                                            <button class="btn btn-success btn-sm mb-2" type="button" id="eyes"
                                                style="margin-left:5px; border-radius:5px">
                                                <i class="fas fa-eye-slash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label class="col-md-3 col-form-label">API ID MedanPedia</label>
                                        <div class="col-md-9">
                                            <input type="text" wire:model.lazy="api_id"
                                                placeholder="Masukkan api id giatpedia" name="color" id="color"
                                                class="form-control blur sensor">
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label class="col-md-3 col-form-label">API KEY MedanPedia</label>
                                        <div class="col-md-9">
                                            <input type="text" wire:model.lazy="api_key"
                                                placeholder="Masukkan api key giatpedia" name="color"
                                                id="color" class="form-control blur sensor">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="mb-2 row">
                                        <label class="col-md-3 col-form-label">MERCHANT CODE TRIPAY</label>
                                        <div class="col-md-9">
                                            <input type="text" wire:model.lazy="merchant_code"
                                                placeholder="Masukkan api key medan" name="color" id="color"
                                                class="form-control blur sensor">
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label class="col-md-3 col-form-label">API KEY TRIPAY</label>
                                        <div class="col-md-9">
                                            <input type="text" wire:model.lazy="api_tripay"
                                                placeholder="Masukkan api key medan" name="color" id="color"
                                                class="form-control blur sensor">
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label class="col-md-3 col-form-label">PRIVATE KEY TRIPAY</label>
                                        <div class="col-md-9">
                                            <input type="text" wire:model.lazy="private_tripay"
                                                placeholder="Masukkan api key medan" name="color" id="color"
                                                class="form-control blur sensor">
                                        </div>
                                    </div>
                                    <div class="mb-0 mt-3 float-end">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light"><i
                                                class="mdi mdi-content-save me-1"></i>Save Changes</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane @if ($tab == 'seo') active @endif mt-2" id="seo"
                                role="tabpanel">
                                <form wire:submit.prevent="setSeo">
                                    <div class="mb-2 row">
                                        <label class="col-md-3 col-form-label">Logo</label>
                                        <div class="col-md-9">
                                            <input type="file" accept="image/*" wire:model.lazy="logo"
                                                name="color"class="form-control">
                                            {{-- Show image from $url_logo --}}
                                            @if ($url_logo)
                                                <img src="{{ asset('assets/images/logo/' . $url_logo) }}"
                                                    alt="" width="100px" class="mt-2" height="100px">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label class="col-md-3 col-form-label">Name Panel</label>
                                        <div class="col-md-9">
                                            <input type="text" wire:model.lazy="name_panel" name="color"
                                                placeholder="Masukkan Nama Panel" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label class="col-md-3 col-form-label">Title Website</label>
                                        <div class="col-md-9">
                                            <input type="text" wire:model.lazy="title_website" name="color"
                                                placeholder="Masukkan Nama Panel" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label class="col-md-3 col-form-label">Description website</label>
                                        <div class="col-md-9">
                                            <textarea type="text" wire:model.lazy="description_website" cols="5" rows="4" name="color"
                                                placeholder="Masukkan Deskripsi website" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label class="col-md-3 col-form-label">Keyword website</label>
                                        <div class="col-md-9">
                                            <textarea type="text" wire:model.lazy="keyword_website" cols="12" rows="10" name="color"
                                                placeholder="Masukkan Keyword Panel" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="mb-0 mt-3 float-end">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light"><i
                                                class="mdi mdi-content-save me-1"></i>Save Changes</button>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane @if ($tab == 'contact') active @endif mt-2" id="contact"
                                role="tabpanel">
                                <form wire:submit.prevent="setContact">
                                    <div class="mb-2 row">
                                        <label class="col-md-3 col-form-label">Name Contact</label>
                                        <div class="col-md-9">
                                            <input type="text" wire:model.lazy="name_contact" name="color"
                                                placeholder="Masukkan Nama Panel" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label class="col-md-3 col-form-label">Facebook Url</label>
                                        <div class="col-md-9">
                                            <input type="text" wire:model.lazy="facebook" name="color"
                                                placeholder="Masukkan Url Facebook" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label class="col-md-3 col-form-label">Number Whatsapp</label>
                                        <div class="col-md-9">
                                            <input type="text" wire:model.lazy="whatsapp" name="color"
                                                placeholder="Masukkan Nomor whatsapp | format +628XXXX"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label class="col-md-3 col-form-label">Instagram</label>
                                        <div class="col-md-9">
                                            <input type="text" wire:model.lazy="instagram" name="color"
                                                placeholder="Masukkan akun instagram | @smm_panel_indonesia"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-0 mt-3 float-end">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light"><i
                                                class="mdi mdi-content-save me-1"></i>Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const text = document.querySelector('h1');

        function getColor(event) {
            const color = event.target.value;
            @this.set('color_default', color);
        }
        $("#custom").spectrum({
            showInput: true,
            showSelectionPalette: false,
        });
        var defaults = "{{ $color_default }}";
        $("#custom").spectrum("set", defaults);
        $("#custom").on('change', function() {
            var color = $("#custom").spectrum("get").toHexString();
            @this.set('color_default', color);
        });
        $("#customs").spectrum({
            showInput: true,
            showSelectionPalette: false,
        });
        var defaults = "{{ $second_default }}";
        $("#customs").spectrum("set", defaults);
        $("#customs").on('change', function() {
            var color = $("#customs").spectrum("get").toHexString();
            @this.set('color_default', color);
        });
        $('#eyes').click(function() {
            if ($(".blur").hasClass("sensor")) {
                $(".blur").removeClass("sensor");
                $("#eyes").html(`<i class="fas fa-eye"></i>`);
            } else {
                $(".blur").addClass("sensor");
                $("#eyes").html(`<i class="fas fa-eye-slash"></i>`);
            }
        });
    </script>
