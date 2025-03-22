<div>
    <link href="//rawgit.com/gjunge/rateit.js/master/scripts/rateit.css" rel="stylesheet" type="text/css">
    <script src="//rawgit.com/gjunge/rateit.js/master/scripts/jquery.rateit.js" type="text/javascript"></script>
    <div class="row">
        <style>
            .rateyo-star {
                background-color: #ff0000;
            }
        </style>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header fw-bold p-3 text-xss"><i class="fas fa-tags me-2"></i> Daftar layanan</div>
                <div class="card-body">
                    <!-- Category Filter Buttons Section -->
                    <div class="tw-mb-6">
                        <h5 class="tw-text-gray-700 tw-font-medium tw-mb-3">Filter by Platform</h5>
                        <div class="tw-flex tw-flex-wrap tw-gap-2">
                            <button wire:click="Categorys(false)" class="tw-px-4 tw-py-2 tw-rounded-lg tw-bg-white tw-border tw-border-gray-200 tw-shadow-sm hover:tw-shadow-md tw-transition-all {{ !$category ? 'tw-border-primary-300 tw-bg-primary-50 tw-text-primary-600' : 'tw-text-gray-600' }}">
                                <i class="fas fa-globe tw-mr-2"></i> All
                            </button>
                            @forelse ($kategori as $row)
                                @php
                                    $iconClass = $row->icon ?? 'fas fa-tag';
                                    $isActive = ($category == $row->kategori);
                                @endphp
                                <button wire:click="Categorys('{{ $row->kategori }}')" 
                                    class="tw-px-4 tw-py-2 tw-rounded-lg tw-bg-white tw-border tw-border-gray-200 tw-shadow-sm hover:tw-shadow-md tw-transition-all tw-flex tw-items-center {{ $isActive ? 'tw-border-primary-300 tw-bg-primary-50 tw-text-primary-600' : 'tw-text-gray-600' }}">
                                    <i class="{{ $iconClass }} tw-mr-2"></i> {{ $row->kategori }}
                                </button>
                            @empty
                                <div class="tw-text-gray-500">No categories found</div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Search and Display Controls -->
                    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-3 tw-gap-4 tw-mb-4">
                        <div>
                            <label class="tw-text-sm tw-text-gray-600 tw-mb-1 tw-block">Show entries</label>
                            <select class="form-control tw-rounded-lg tw-border tw-border-gray-200 tw-shadow-sm" wire:model.change="perPage">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        
                        <div wire:ignore>
                            <label class="tw-text-sm tw-text-gray-600 tw-mb-1 tw-block">Select category</label>
                            <select class="select2 form-control tw-rounded-lg tw-border tw-border-gray-200 tw-shadow-sm" style="width:100%" name="category" id="category">
                                @if ($kate)
                                    <option value="{{ $kate }}">Kategori {{ $kate }}</option>
                                @else
                                    <option value="">Semua Kategori</option>
                                @endif
                                @forelse ($kategori as $row)
                                    @php
                                        $id = App\Models\Smm::where('category', $row->kategori)->first();
                                        $ct = $kategori->first()->id;
                                    @endphp
                                    <option value="{{ $row->kategori }}"
                                        data-icon="<i class='{!! $row->icon ?? null !!}'></i>">
                                        {!! $row->kategori !!}</option>
                                @empty
                                    <option value="">Tidak ada data</option>
                                @endforelse
                            </select>
                        </div>
                        
                        <div>
                            <label class="tw-text-sm tw-text-gray-600 tw-mb-1 tw-block">Search</label>
                            <input type="text" wire:model.live.debounce.300ms="search" 
                                class="form-control tw-rounded-lg tw-border tw-border-gray-200 tw-shadow-sm"
                                placeholder="Search for services...">
                        </div>
                    </div>
                    
                    <!-- Service Type Toggle -->
                    <div class="tw-flex tw-flex-wrap tw-gap-3 tw-mb-5">
                        <button wire:click="changeCustom('all')" 
                            class="tw-px-4 tw-py-2 tw-rounded-lg tw-bg-white tw-border tw-shadow-sm hover:tw-shadow-md tw-transition-all {{ !$custom ? 'tw-border-primary-300 tw-bg-primary-50 tw-text-primary-600' : 'tw-text-gray-600 tw-border-gray-200' }}">
                            All Services
                        </button>
                        <button wire:click="changeCustom('reguler')" 
                            class="tw-px-4 tw-py-2 tw-rounded-lg tw-bg-white tw-border tw-shadow-sm hover:tw-shadow-md tw-transition-all {{ $custom == 'reguler' ? 'tw-border-primary-300 tw-bg-primary-50 tw-text-primary-600' : 'tw-text-gray-600 tw-border-gray-200' }}">
                            Regular Services
                        </button>
                        <button wire:click="changeCustom('custom_comments')" 
                            class="tw-px-4 tw-py-2 tw-rounded-lg tw-bg-white tw-border tw-shadow-sm hover:tw-shadow-md tw-transition-all {{ $custom == 'custom_comments' ? 'tw-border-primary-300 tw-bg-primary-50 tw-text-primary-600' : 'tw-text-gray-600 tw-border-gray-200' }}">
                            Custom Comments
                        </button>
                        <button wire:click="changeCustom('custom_link')" 
                            class="tw-px-4 tw-py-2 tw-rounded-lg tw-bg-white tw-border tw-shadow-sm hover:tw-shadow-md tw-transition-all {{ $custom == 'custom_link' ? 'tw-border-primary-300 tw-bg-primary-50 tw-text-primary-600' : 'tw-text-gray-600 tw-border-gray-200' }}">
                            Custom Link
                        </button>
                    </div>

                    <!-- Results Table -->
                    <div class="tw-bg-white tw-rounded-lg tw-shadow tw-overflow-hidden tw-mb-4">
                        @if ($category)
                            <div class="tw-bg-primary-50 tw-text-primary-700 tw-py-2 tw-px-4 tw-text-center tw-font-medium">
                                {{ $category }}
                            </div>
                        @endif
                        
                        <div class="tw-overflow-x-auto">
                            <table class="tw-min-w-full tw-divide-y tw-divide-gray-200">
                                <thead class="tw-bg-gray-50">
                                    <tr class="tw-text-left tw-text-xs tw-font-medium tw-text-gray-500 tw-uppercase tw-tracking-wider">
                                        <th class="tw-px-4 tw-py-3">ID</th>
                                        <th class="tw-px-4 tw-py-3">Category</th>
                                        <th class="tw-px-4 tw-py-3">Service Name</th>
                                        <th class="tw-px-4 tw-py-3">Price / 1000</th>
                                        <th class="tw-px-4 tw-py-3">Min Order</th>
                                        <th class="tw-px-4 tw-py-3">Max Order</th>
                                        <th class="tw-px-4 tw-py-3 tw-text-center">Details</th>
                                    </tr>
                                </thead>
                                <tbody class="tw-bg-white tw-divide-y tw-divide-gray-200">
                                    @forelse ($layanan as $row)
                                        <tr class="hover:tw-bg-gray-50 tw-transition-colors">
                                            <td class="tw-px-4 tw-py-3 tw-whitespace-nowrap tw-text-sm tw-text-gray-900">{{ $row->service }}</td>
                                            <td class="tw-px-4 tw-py-3 tw-whitespace-nowrap tw-text-sm">
                                                <div class="tw-flex tw-items-center">
                                                    <i class="{{ $row->kategori->icon }} tw-mr-2 tw-text-primary-500"></i>
                                                    <span class="tw-text-gray-900">{!! $row->category !!}</span>
                                                </div>
                                            </td>
                                            <td class="tw-px-4 tw-py-3 tw-text-sm tw-text-gray-900">{{ $row->name }}</td>
                                            <td class="tw-px-4 tw-py-3 tw-whitespace-nowrap tw-text-sm tw-font-medium tw-text-primary-600">
                                                Rp {{ number_format($row->price, 0, ',', '.') }}
                                            </td>
                                            <td class="tw-px-4 tw-py-3 tw-whitespace-nowrap tw-text-sm tw-text-gray-900">
                                                {{ number_format($row->min, 0, ',', '.') }}
                                            </td>
                                            <td class="tw-px-4 tw-py-3 tw-whitespace-nowrap tw-text-sm tw-text-gray-900">
                                                {{ number_format($row->max, 0, ',', '.') }}
                                            </td>
                                            <td class="tw-px-4 tw-py-3 tw-whitespace-nowrap tw-text-center">
                                                <button type="button" 
                                                    class="tw-inline-flex tw-items-center tw-px-3 tw-py-2 tw-border tw-border-primary-300 tw-text-sm tw-font-medium tw-rounded-md tw-text-primary-700 tw-bg-white hover:tw-bg-primary-50 tw-transition-colors"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#details"
                                                    onclick="detail('{{ $row->service }}')">
                                                    <i class="fas fa-search tw-mr-2"></i>
                                                    View details
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="tw-px-6 tw-py-4 tw-text-center tw-text-gray-500">
                                                No services found
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="tw-px-4 tw-py-3 tw-bg-gray-50">
                            {!! $layanan->links() !!}
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Modal for Rating -->
            <div class="modal fade" id="rating" tabindex="-1" aria-labelledby="modalsLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="title-rating"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="content-rating">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for Service Details -->
            <div class="modal fade" id="details" tabindex="-1" aria-labelledby="modalsLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="title-detail"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="content-detail">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@script
    <script>
        $('#category').change(function() {
            var category = $(this).val();
            $wire.set('category', category);
        });
    </script>
@endscript

<script>
    function fav(id) {
        $.ajax({
            type: "POST",
            url: "{{ url('favorit/service') }}",
            data: "id=" + id + "&_token={{ csrf_token() }}",
            dataType: "json",
            success: function(data) {
                if (data.status == true) {
                    $('#fs-' + id).html('<i class="fas fa-star text-primary ms-1 font-size-20"></i>');
                    $('#fs-' + id).attr('onclick', 'unfav(\'' + id + '\');');
                    Swal.fire({
                        title: 'Berhasil',
                        icon: 'success',
                        html: data.message,
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'btn btn-primary',
                        },
                        buttonsStyling: false,
                    });
                } else {
                    Swal.fire({
                        title: 'Ups!',
                        icon: 'error',
                        html: data.message,
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'btn btn-primary',
                        },
                        buttonsStyling: false,
                    });
                }
            },
            error: function() {
                Swal.fire({
                    title: 'Ups!',
                    icon: 'error',
                    html: 'Terjadi kesalahan, silahkan coba lagi.',
                    confirmButtonText: 'OK',
                    customClass: {
                        confirmButton: 'btn btn-primary',
                    },
                    buttonsStyling: false,
                });
            },
            beforeSend: function() {}
        });
    }

    function unfav(id) {
        $.ajax({
            type: "POST",
            url: "{{ url('unfav/service') }}",
            data: "id=" + id + "&_token={{ csrf_token() }}",
            dataType: "json",
            success: function(data) {
                if (data.status == true) {
                    $('#fs-' + id).html(
                        '<i class="fa-regular fa-star text-primary ms-1 font-size-20"></i>');
                    $('#fs-' + id).attr('onclick', 'fav(\'' + id + '\');');
                    Swal.fire({
                        title: 'Berhasil!',
                        icon: 'success',
                        html: data.message,
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'btn btn-primary',
                        },
                        buttonsStyling: false,
                    });
                } else {
                    Swal.fire({
                        title: 'Ups!',
                        icon: 'error',
                        html: data.message,
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'btn btn-primary',
                        },
                        buttonsStyling: false,
                    });
                }
            },
            error: function() {
                Swal.fire({
                    title: 'Ups!',
                    icon: 'error',
                    html: 'Terjadi kesalahan, silahkan coba lagi.',
                    confirmButtonText: 'OK',
                    customClass: {
                        confirmButton: 'btn btn-primary',
                    },
                    buttonsStyling: false,
                });
            },
            beforeSend: function() {}
        });
    }

    function detail(id) {
        $.ajax({
            "type": "POST",
            "url": "{{ url('detail/service') }}",
            "data": "id=" + id + "&_token={{ csrf_token() }}",
            "dataType": "html",
            "success": function(data) {
                $('#content-detail').html(data);
                $('#title-detail').html('Detail Layanan #' + id);
            },
            error: function(data) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
                $('#details').modal('hide');
            },
        });
    }

    $(document).ready(function() {
        function iformat(icon) {
            var originalOption = icon.element;
            if ($(originalOption).index() == 0) {
                var ic = '';
            } else {
                var ic = $(originalOption).data('icon');
            }
            return $('<span>' + ic + ' ' + icon.text + '</span>');
        }
        $('#category').select2({
            width: "100%",
            templateSelection: iformat,
            templateResult: iformat,
            allowHtml: true
        });
    });
</script>
