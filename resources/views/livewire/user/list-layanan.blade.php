
<div>
    <link href="//rawgit.com/gjunge/rateit.js/master/scripts/rateit.css" rel="stylesheet" type="text/css">
    <script src="//rawgit.com/gjunge/rateit.js/master/scripts/jquery.rateit.js" type="text/javascript"></script>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- Services Header Card -->
                    <div class="tw-bg-white tw-rounded-xl tw-shadow-sm tw-overflow-hidden tw-mb-8 tw-border tw-border-gray-100">
                        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2">
                            <!-- Left Column: Services Text -->
                            <div class="tw-p-6 md:tw-p-8 tw-flex tw-flex-col tw-justify-center">
                                <h2 class="tw-text-2xl md:tw-text-3xl tw-font-bold tw-text-gray-800 tw-mb-3">Explore Our Services</h2>
                                <p class="tw-text-gray-600 tw-mb-4">Find the perfect social media marketing services for your business needs. Filter by platform to see specific services.</p>
                                
                                <!-- Search Input -->
                                <div class="tw-mt-2">
                                    <div class="tw-relative">
                                        <input type="text" wire:model.live.debounce.300ms="search" 
                                            class="tw-w-full tw-pl-10 tw-pr-4 tw-py-2 tw-rounded-lg tw-border tw-border-gray-200 focus:tw-ring-primary-300 focus:tw-border-primary-300"
                                            placeholder="Search for services...">
                                        <div class="tw-absolute tw-left-3 tw-top-2.5 tw-text-gray-400">
                                            <i class="fas fa-search"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Right Column: Category Filter Buttons -->
                            <div class="tw-bg-gray-50 tw-p-6 md:tw-p-8">
                                <h3 class="tw-text-lg tw-font-medium tw-text-gray-700 tw-mb-4">Filter by Platform</h3>
                                
                                <div class="tw-flex tw-flex-wrap tw-gap-3">
                                    <!-- All Categories Button -->
                                    <button wire:click="Categorys(false)" 
                                        class="tw-flex tw-items-center tw-px-4 tw-py-2 tw-rounded-lg tw-transition-all {{ !$category ? 'tw-bg-primary-100 tw-text-primary-700 tw-border tw-border-primary-200' : 'tw-bg-white tw-border tw-border-gray-200 tw-text-gray-700 hover:tw-bg-gray-50' }}">
                                        <i class="fas fa-globe tw-mr-2"></i>
                                        <span>All</span>
                                    </button>
                                    
                                    @php
                                        $uniqueCategories = [];
                                        foreach ($kategori as $row) {
                                            // Extract platform name (first word before space)
                                            $platform = strtok($row->kategori, ' ');
                                            if (!in_array($platform, $uniqueCategories)) {
                                                $uniqueCategories[$platform] = [
                                                    'name' => $platform,
                                                    'full' => $row->kategori,
                                                    'icon' => $row->icon ?? 'fas fa-hashtag'
                                                ];
                                            }
                                        }
                                    @endphp
                                    
                                    @foreach ($uniqueCategories as $platform => $data)
                                        @php
                                            $isActive = (strpos($category, $platform) !== false);
                                            // Map platform names to appropriate icons
                                            $iconClass = $data['icon'];
                                            if (stripos($platform, 'youtube') !== false) {
                                                $iconClass = 'fab fa-youtube tw-text-red-500';
                                            } elseif (stripos($platform, 'instagram') !== false) {
                                                $iconClass = 'fab fa-instagram tw-text-pink-500';
                                            } elseif (stripos($platform, 'facebook') !== false) {
                                                $iconClass = 'fab fa-facebook tw-text-blue-600';
                                            } elseif (stripos($platform, 'twitter') !== false || stripos($platform, 'x') !== false) {
                                                $iconClass = 'fab fa-twitter tw-text-blue-400';
                                            } elseif (stripos($platform, 'tiktok') !== false) {
                                                $iconClass = 'fab fa-tiktok tw-text-black';
                                            } elseif (stripos($platform, 'telegram') !== false) {
                                                $iconClass = 'fab fa-telegram tw-text-blue-500';
                                            } elseif (stripos($platform, 'whatsapp') !== false) {
                                                $iconClass = 'fab fa-whatsapp tw-text-green-500';
                                            } elseif (stripos($platform, 'spotify') !== false) {
                                                $iconClass = 'fab fa-spotify tw-text-green-600';
                                            } elseif (stripos($platform, 'pinterest') !== false) {
                                                $iconClass = 'fab fa-pinterest tw-text-red-600';
                                            } elseif (stripos($platform, 'linkedin') !== false) {
                                                $iconClass = 'fab fa-linkedin tw-text-blue-700';
                                            }
                                        @endphp
                                        
                                        <button wire:click="Categorys('{{ $data['full'] }}')" 
                                            class="tw-flex tw-items-center tw-px-4 tw-py-2 tw-rounded-lg tw-transition-all {{ $isActive ? 'tw-bg-primary-100 tw-text-primary-700 tw-border tw-border-primary-200' : 'tw-bg-white tw-border tw-border-gray-200 tw-text-gray-700 hover:tw-bg-gray-50' }}">
                                            <i class="{{ $iconClass }} tw-mr-2"></i>
                                            <span>{{ ucfirst($platform) }}</span>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Service Type Filters -->
                    <div class="tw-mb-6">
                        <h5 class="tw-text-gray-700 tw-font-medium tw-mb-3">Service Type</h5>
                        <div class="tw-flex tw-flex-wrap tw-gap-2">
                            <button wire:click="changeCustom('all')" 
                                class="tw-px-4 tw-py-2 tw-rounded-lg tw-transition-all {{ !$custom ? 'tw-bg-primary-50 tw-text-primary-600 tw-border tw-border-primary-200' : 'tw-bg-white tw-border tw-border-gray-200 tw-text-gray-600 hover:tw-bg-gray-50' }}">
                                All Services
                            </button>
                            <button wire:click="changeCustom('reguler')" 
                                class="tw-px-4 tw-py-2 tw-rounded-lg tw-transition-all {{ $custom == 'reguler' ? 'tw-bg-primary-50 tw-text-primary-600 tw-border tw-border-primary-200' : 'tw-bg-white tw-border tw-border-gray-200 tw-text-gray-600 hover:tw-bg-gray-50' }}">
                                Regular Services
                            </button>
                            <button wire:click="changeCustom('custom_comments')" 
                                class="tw-px-4 tw-py-2 tw-rounded-lg tw-transition-all {{ $custom == 'custom_comments' ? 'tw-bg-primary-50 tw-text-primary-600 tw-border tw-border-primary-200' : 'tw-bg-white tw-border tw-border-gray-200 tw-text-gray-600 hover:tw-bg-gray-50' }}">
                                Custom Comments
                            </button>
                            <button wire:click="changeCustom('custom_link')" 
                                class="tw-px-4 tw-py-2 tw-rounded-lg tw-transition-all {{ $custom == 'custom_link' ? 'tw-bg-primary-50 tw-text-primary-600 tw-border tw-border-primary-200' : 'tw-bg-white tw-border tw-border-gray-200 tw-text-gray-600 hover:tw-bg-gray-50' }}">
                                Custom Link
                            </button>
                        </div>
                    </div>
                    
                    <!-- Display Controls -->
                    <div class="tw-mb-6">
                        <div class="tw-flex tw-flex-wrap tw-items-center tw-justify-between">
                            <div class="tw-mb-4 sm:tw-mb-0">
                                <label class="tw-text-sm tw-text-gray-600 tw-mb-1 tw-block">Show entries</label>
                                <select wire:model.change="perPage" class="tw-rounded-lg tw-border tw-border-gray-200 tw-shadow-sm">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            
                            @if ($category)
                                <div class="tw-bg-primary-50 tw-text-primary-700 tw-py-2 tw-px-4 tw-rounded-lg tw-font-medium">
                                    {{ $category }}
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Services Grid -->
                    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 lg:tw-grid-cols-3 tw-gap-4 tw-mb-6">
                        @forelse ($layanan as $row)
                            <div class="tw-bg-white tw-rounded-lg tw-shadow-sm tw-overflow-hidden tw-border tw-border-gray-100 hover:tw-shadow-md tw-transition-all">
                                <div class="tw-p-4">
                                    <!-- Service Header -->
                                    <div class="tw-flex tw-items-center tw-mb-4">
                                        @php
                                            // Determine icon based on category
                                            $platform = strtok($row->category, ' ');
                                            $iconClass = 'fas fa-hashtag tw-text-gray-400';
                                            
                                            if (stripos($platform, 'youtube') !== false) {
                                                $iconClass = 'fab fa-youtube tw-text-red-500';
                                            } elseif (stripos($platform, 'instagram') !== false) {
                                                $iconClass = 'fab fa-instagram tw-text-pink-500';
                                            } elseif (stripos($platform, 'facebook') !== false) {
                                                $iconClass = 'fab fa-facebook tw-text-blue-600';
                                            } elseif (stripos($platform, 'twitter') !== false || stripos($platform, 'x') !== false) {
                                                $iconClass = 'fab fa-twitter tw-text-blue-400';
                                            } elseif (stripos($platform, 'tiktok') !== false) {
                                                $iconClass = 'fab fa-tiktok tw-text-black';
                                            } elseif (stripos($platform, 'telegram') !== false) {
                                                $iconClass = 'fab fa-telegram tw-text-blue-500';
                                            } elseif (stripos($platform, 'whatsapp') !== false) {
                                                $iconClass = 'fab fa-whatsapp tw-text-green-500';
                                            } elseif (stripos($platform, 'spotify') !== false) {
                                                $iconClass = 'fab fa-spotify tw-text-green-600';
                                            } elseif (stripos($platform, 'pinterest') !== false) {
                                                $iconClass = 'fab fa-pinterest tw-text-red-600';
                                            } elseif (stripos($platform, 'linkedin') !== false) {
                                                $iconClass = 'fab fa-linkedin tw-text-blue-700';
                                            }
                                        @endphp
                                        
                                        <div class="tw-w-10 tw-h-10 tw-flex tw-items-center tw-justify-center tw-rounded-full tw-bg-gray-100 tw-mr-3">
                                            <i class="{{ $iconClass }} tw-text-lg"></i>
                                        </div>
                                        <div>
                                            <h4 class="tw-font-medium tw-text-gray-900 tw-text-base">{{ $row->name }}</h4>
                                            <p class="tw-text-xs tw-text-gray-500">ID: {{ $row->service }}</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Service Details -->
                                    <div class="tw-grid tw-grid-cols-2 tw-gap-4 tw-mb-4">
                                        <div>
                                            <p class="tw-text-xs tw-text-gray-500">Price per 1000</p>
                                            <p class="tw-font-semibold tw-text-primary-600">Rp {{ number_format($row->price, 0, ',', '.') }}</p>
                                        </div>
                                        <div>
                                            <p class="tw-text-xs tw-text-gray-500">Min Order</p>
                                            <p class="tw-font-medium tw-text-gray-800">{{ number_format($row->min, 0, ',', '.') }}</p>
                                        </div>
                                        <div>
                                            <p class="tw-text-xs tw-text-gray-500">Max Order</p>
                                            <p class="tw-font-medium tw-text-gray-800">{{ number_format($row->max, 0, ',', '.') }}</p>
                                        </div>
                                        <div>
                                            <p class="tw-text-xs tw-text-gray-500">Type</p>
                                            <p class="tw-font-medium tw-text-gray-800">{{ $row->type ?: 'Regular' }}</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Action Buttons -->
                                    <div class="tw-flex tw-justify-end tw-space-x-2">
                                        <button type="button" 
                                            class="tw-inline-flex tw-items-center tw-px-3 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-bg-white tw-text-sm tw-font-medium tw-text-gray-700 hover:tw-bg-gray-50"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#details"
                                            onclick="detail('{{ $row->service }}')">
                                            <i class="fas fa-info-circle tw-mr-2"></i> Details
                                        </button>
                                        
                                        @php
                                            $text = $row->service . '||' . $row->provider;
                                            $encrypt = App\Helpers\Encryption::encrypt($text);
                                        @endphp
                                        
                                        <a href="{{ url('order/single') }}?id={!! $encrypt !!}" 
                                            class="tw-inline-flex tw-items-center tw-px-3 tw-py-2 tw-border tw-border-transparent tw-rounded-md tw-shadow-sm tw-text-sm tw-font-medium tw-text-white tw-bg-primary hover:tw-bg-primary-600">
                                            <i class="fas fa-shopping-cart tw-mr-2"></i> Order Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="tw-col-span-1 md:tw-col-span-2 lg:tw-col-span-3 tw-p-8 tw-text-center tw-bg-white tw-rounded-lg tw-shadow-sm tw-border tw-border-gray-100">
                                <div class="tw-text-gray-500">
                                    <i class="fas fa-search tw-text-3xl tw-mb-3 tw-opacity-40"></i>
                                    <p class="tw-text-lg">No services found</p>
                                    <p class="tw-text-sm tw-mt-1">Try adjusting your search or filter criteria</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    
                    <!-- Pagination -->
                    <div class="tw-mt-6">
                        {!! $layanan->links() !!}
                    </div>
                </div>
            </div>
            
            <!-- Modal for Detail -->
            <div class="modal fade" id="details" tabindex="-1" aria-labelledby="modalsLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="title-detail"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="content-detail">
                            <!-- Content will be loaded via AJAX -->
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
        
        // Initialize any select2 elements if needed
        if ($('#category').length) {
            $('#category').select2({
                width: "100%",
                templateSelection: iformat,
                templateResult: iformat,
                allowHtml: true
            });
        }
    });
</script>