
<div>
    <link href="//rawgit.com/gjunge/rateit.js/master/scripts/rateit.css" rel="stylesheet" type="text/css">
    <script src="//rawgit.com/gjunge/rateit.js/master/scripts/jquery.rateit.js" type="text/javascript"></script>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- Services Header Card -->
                    <div class="tw-bg-gradient-to-br tw-from-primary-50 tw-to-primary-100 dark:tw-from-gray-800 dark:tw-to-gray-900 tw-rounded-xl tw-shadow-sm hover:tw-shadow-md tw-transition-all tw-duration-300 tw-overflow-hidden tw-mb-8 tw-border tw-border-primary-200 dark:tw-border-gray-700">
                        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2">
                            <!-- Left Column: Services Text -->
                            <div class="tw-p-6 md:tw-p-8 tw-flex tw-flex-col tw-justify-center">
                                <h2 class="tw-text-2xl md:tw-text-3xl tw-font-bold tw-text-gray-800 dark:tw-text-white tw-mb-3">Jelajahi Layanan SMM</h2>
                                <p class="tw-text-gray-600 dark:tw-text-gray-300 tw-mb-4">Temukan layanan SMM yang sempurna untuk kebutuhan media sosial Anda. Filter berdasarkan platform untuk melihat layanan tertentu.</p>
                                
                                <!-- Search Input - Improved alignment -->
                                <div class="tw-mt-2">
                                    <div class="tw-relative">
                                        <input type="text" wire:model.live.debounce.300ms="search" 
                                            class="tw-w-full tw-pl-12 tw-pr-4 tw-py-3 tw-rounded-lg tw-border tw-border-gray-200 dark:tw-border-gray-700 dark:tw-bg-gray-800/80 dark:tw-text-white focus:tw-ring-primary-500 focus:tw-border-primary-500 tw-transition-all tw-duration-300"
                                            placeholder="Search for services...">
                                        <div class="tw-absolute tw-left-4 tw-top-3.5 tw-text-gray-400 dark:tw-text-gray-500">
                                            <i class="fas fa-search"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Right Column: Category Filter Buttons -->
                            <div class="tw-bg-white/50 dark:tw-bg-gray-800/50 tw-backdrop-blur-sm tw-p-6 md:tw-p-8">
                                <h3 class="tw-text-lg tw-font-medium tw-text-gray-700 dark:tw-text-gray-200 tw-mb-4">Filter by Platform</h3>
                                
                                <div class="tw-flex tw-flex-wrap tw-gap-3">
                                    <!-- All Categories Button -->
                                    <button wire:click="resetFilters" 
                                        class="tw-flex tw-items-center tw-px-4 tw-py-2 tw-rounded-lg tw-transition-all tw-duration-300 {{ !$category ? 'tw-bg-gradient-to-r tw-from-primary-500 tw-to-primary-600 tw-text-white tw-shadow-md hover:tw-shadow-lg hover:tw-from-primary-600 hover:tw-to-primary-700' : 'tw-bg-white dark:tw-bg-gray-700 tw-border tw-border-gray-200 dark:tw-border-gray-600 tw-text-gray-700 dark:tw-text-gray-200 hover:tw-bg-gray-50 dark:hover:tw-bg-gray-600 tw-shadow-sm' }}">
                                        <i class="fas fa-globe tw-mr-2"></i>
                                        <span>All</span>
                                    </button>
                                    
                                    @php
                                        $uniquePlatforms = [];
                                        foreach ($kategori as $row) {
                                            // Extract platform name (first word before space)
                                            $platform = strtok($row->kategori, ' ');
                                            
                                            if (!array_key_exists($platform, $uniquePlatforms)) {
                                                $uniquePlatforms[$platform] = [
                                                    'name' => $platform,
                                                    'icon' => 'fas fa-hashtag'
                                                ];
                                            }
                                        }
                                    @endphp
                                    
                                    @foreach ($uniquePlatforms as $platform => $data)
                                        @php
                                            $isActive = ($category && stripos($category, $platform) !== false);
                                            
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
                                                $iconClass = 'fab fa-tiktok tw-text-black dark:tw-text-white';
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
                                        
                                        <button wire:click="Categorys('{{ $platform }}')" 
                                            class="tw-flex tw-items-center tw-px-4 tw-py-2 tw-rounded-lg tw-transition-all tw-duration-300 {{ $isActive ? 'tw-bg-gradient-to-r tw-from-primary-500 tw-to-primary-600 tw-text-white tw-shadow-md hover:tw-shadow-lg hover:tw-from-primary-600 hover:tw-to-primary-700' : 'tw-bg-white dark:tw-bg-gray-700 tw-border tw-border-gray-200 dark:tw-border-gray-600 tw-text-gray-700 dark:tw-text-gray-200 hover:tw-bg-gray-50 dark:hover:tw-bg-gray-600 tw-shadow-sm' }}">
                                            <i class="{{ $iconClass }} tw-mr-2"></i>
                                            <span>{{ ucfirst($platform) }}</span>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Additional Filters Section - Improved styling -->
                    <div class="tw-mb-6">
                        <div class="tw-flex tw-flex-wrap tw-gap-4 tw-justify-between tw-items-start">
                            <!-- Service Type Filters -->
                            <div class="tw-flex tw-flex-col">
                                <h5 class="tw-text-gray-700 dark:tw-text-gray-300 tw-font-medium tw-mb-3">Service Type</h5>
                                <div class="tw-flex tw-flex-wrap tw-gap-2">
                                    @php
                                    $type = App\Models\Smm::distinct()->where('status', 'aktif')->get('type');
                                    @endphp
                                    <button wire:click="changeCustom('all')" 
                                        class="tw-px-4 tw-py-2 tw-rounded-lg tw-transition-all tw-duration-300 {{ !$custom && !$refill ? 'tw-bg-gradient-to-r tw-from-primary-100 tw-to-primary-200 dark:tw-from-primary-900/40 dark:tw-to-primary-800/60 tw-text-primary-700 dark:tw-text-primary-300 tw-border tw-border-primary-200 dark:tw-border-primary-800 tw-shadow-sm' : 'tw-bg-white dark:tw-bg-gray-800 tw-border tw-border-gray-200 dark:tw-border-gray-700 tw-text-gray-600 dark:tw-text-gray-300 hover:tw-bg-gray-50 dark:hover:tw-bg-gray-700' }}">
                                        All Services
                                    </button>
                                    <button wire:click="$set('refill', true)" 
                                        class="tw-px-4 tw-py-2 tw-rounded-lg tw-transition-all tw-duration-300 {{ $refill ? 'tw-bg-gradient-to-r tw-from-primary-100 tw-to-primary-200 dark:tw-from-primary-900/40 dark:tw-to-primary-800/60 tw-text-primary-700 dark:tw-text-primary-300 tw-border tw-border-primary-200 dark:tw-border-primary-800 tw-shadow-sm' : 'tw-bg-white dark:tw-bg-gray-800 tw-border tw-border-gray-200 dark:tw-border-gray-700 tw-text-gray-600 dark:tw-text-gray-300 hover:tw-bg-gray-50 dark:hover:tw-bg-gray-700' }}">
                                        Refill
                                    </button>
                                    
                                    @foreach ($type as $type)
                                    <button wire:click="changeCustom('{{ $type->type }}')"
                                        class="tw-px-4 tw-py-2 tw-rounded-lg tw-transition-all tw-duration-300 {{ $custom == $type->type && !$refill ? 'tw-bg-gradient-to-r tw-from-primary-100 tw-to-primary-200 dark:tw-from-primary-900/40 dark:tw-to-primary-800/60 tw-text-primary-700 dark:tw-text-primary-300 tw-border tw-border-primary-200 dark:tw-border-primary-800 tw-shadow-sm' : 'tw-bg-white dark:tw-bg-gray-800 tw-border tw-border-gray-200 dark:tw-border-gray-700 tw-text-gray-600 dark:tw-text-gray-300 hover:tw-bg-gray-50 dark:hover:tw-bg-gray-700' }}">{{ $type->type }}</button>
                                    @endforeach
                                </div>
                            </div>
                            
                            <!-- Specific Category Dropdown - Enhanced styling and dynamic filtering -->
                            <div class="tw-flex tw-flex-col tw-min-w-[200px] sm:tw-min-w-[250px]">
                                <h5 class="tw-text-gray-700 dark:tw-text-gray-300 tw-font-medium tw-mb-3">Category Filter</h5>
                                <select wire:model.live="specificCategory" 
                                    class="tw-rounded-lg tw-border tw-border-gray-200 dark:tw-border-gray-700 dark:tw-bg-gray-800 dark:tw-text-white tw-shadow-sm tw-py-2 tw-px-3 tw-w-full focus:tw-ring-primary-500 focus:tw-border-primary-500 tw-transition-all tw-duration-300">
                                    <option value="">All Categories</option>
                                    @if($category && count($filteredCategories) > 0)
                                        @foreach($filteredCategories as $cat)
                                        <option value="{{ $cat }}">{{ $cat }}</option>
                                        @endforeach
                                    @else
                                        @foreach($allCategories as $cat)
                                        <option value="{{ $cat }}">{{ $cat }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        
                        <!-- Service Group Filter - Improved styling -->
                        @if(count($serviceGroups) > 0)
                        <div class="tw-mt-4">
                            <h5 class="tw-text-gray-700 dark:tw-text-gray-300 tw-font-medium tw-mb-3">Services Group</h5>
                            <div class="tw-flex tw-flex-wrap tw-gap-2">
                                <button wire:click="applyServiceGroupFilter(null)" 
                                    class="tw-px-4 tw-py-2 tw-rounded-lg tw-transition-all tw-duration-300 {{ !$serviceGroup ? 'tw-bg-gradient-to-r tw-from-primary-100 tw-to-primary-200 dark:tw-from-primary-900/40 dark:tw-to-primary-800/60 tw-text-primary-700 dark:tw-text-primary-300 tw-border tw-border-primary-200 dark:tw-border-primary-800 tw-shadow-sm' : 'tw-bg-white dark:tw-bg-gray-800 tw-border tw-border-gray-200 dark:tw-border-gray-700 tw-text-gray-600 dark:tw-text-gray-300 hover:tw-bg-gray-50 dark:hover:tw-bg-gray-700' }}">
                                    All Groups
                                </button>
                                
                                @foreach($serviceGroups as $group)
                                <button wire:click="applyServiceGroupFilter('{{ $group }}')" 
                                    class="tw-px-4 tw-py-2 tw-rounded-lg tw-transition-all tw-duration-300 {{ $serviceGroup == $group ? 'tw-bg-gradient-to-r tw-from-primary-100 tw-to-primary-200 dark:tw-from-primary-900/40 dark:tw-to-primary-800/60 tw-text-primary-700 dark:tw-text-primary-300 tw-border tw-border-primary-200 dark:tw-border-primary-800 tw-shadow-sm' : 'tw-bg-white dark:tw-bg-gray-800 tw-border tw-border-gray-200 dark:tw-border-gray-700 tw-text-gray-600 dark:tw-text-gray-300 hover:tw-bg-gray-50 dark:hover:tw-bg-gray-700' }}">
                                    {{ $group }}
                                </button>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                    
                    <!-- Display Controls - Improved spacing -->
                    <div class="tw-mb-6 tw-bg-gray-50 dark:tw-bg-gray-800/50 tw-p-4 tw-rounded-lg tw-border tw-border-gray-100 dark:tw-border-gray-800">
                        <div class="tw-flex tw-flex-wrap tw-items-center tw-justify-between">
                            <div class="tw-mb-4 sm:tw-mb-0">
                                <label class="tw-text-sm tw-text-gray-600 dark:tw-text-gray-400 tw-mb-1 tw-block">Show entries</label>
                                <select wire:model.change="perPage" class="tw-rounded-lg tw-border tw-border-gray-200 dark:tw-border-gray-700 dark:tw-bg-gray-800 dark:tw-text-white tw-shadow-sm tw-py-2 tw-px-3 focus:tw-ring-primary-500 focus:tw-border-primary-500 tw-transition-all tw-duration-300">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            
                            <!-- Active Filters Display - Enhanced styling -->
                            <div class="tw-flex tw-flex-wrap tw-gap-2">
                                @if ($category)
                                <div class="tw-bg-gradient-to-r tw-from-primary-50 tw-to-primary-100 dark:tw-from-primary-900/20 dark:tw-to-primary-800/30 tw-text-primary-700 dark:tw-text-primary-300 tw-py-2 tw-px-4 tw-rounded-lg tw-font-medium tw-flex tw-items-center tw-shadow-sm">
                                    <span>Platform: {{ ucfirst($category) }}</span>
                                </div>
                                @endif
                                
                                @if ($specificCategory)
                                <div class="tw-bg-gradient-to-r tw-from-primary-50 tw-to-primary-100 dark:tw-from-primary-900/20 dark:tw-to-primary-800/30 tw-text-primary-700 dark:tw-text-primary-300 tw-py-2 tw-px-4 tw-rounded-lg tw-font-medium tw-flex tw-items-center tw-shadow-sm">
                                    <span>Category: {{ $specificCategory }}</span>
                                </div>
                                @endif
                                
                                @if ($serviceGroup)
                                <div class="tw-bg-gradient-to-r tw-from-primary-50 tw-to-primary-100 dark:tw-from-primary-900/20 dark:tw-to-primary-800/30 tw-text-primary-700 dark:tw-text-primary-300 tw-py-2 tw-px-4 tw-rounded-lg tw-font-medium tw-flex tw-items-center tw-shadow-sm">
                                    <span>Group: {{ $serviceGroup }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Services Grid - Enhanced cards with improved UI -->
                    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 lg:tw-grid-cols-3 tw-gap-5 tw-mb-6">
                        @forelse ($layanan as $row)
                                    @php
                                        $favorit = App\Models\Favorit::where('user_id', Auth::user()->id)
                                            ->where([
                                                ['service_id', $row->service],
                                                ['category', $row->category],
                                                ['layanan', $row->name],
                                            ])
                                            ->first();
                                    @endphp
                            <div class="tw-bg-gradient-to-br tw-from-white tw-to-gray-50 dark:tw-from-gray-800 dark:tw-to-gray-900 tw-rounded-xl tw-shadow-sm hover:tw-shadow-lg hover:tw-shadow-primary-100/50 dark:hover:tw-shadow-primary-900/30 tw-transition-all tw-duration-300 tw-border tw-border-gray-100 dark:tw-border-gray-700 tw-overflow-hidden tw-transform hover:tw-scale-[1.02] tw-relative">
                                <!-- Favorite Star Icon - Top Right Corner -->
                                @if ($favorit)
                                <button 
                                    type="button" 
                                    class="tw-absolute tw-top-4 tw-right-4 tw-text-gray-400 hover:tw-text-yellow-400 tw-transition-colors tw-z-10"
                                    onclick="unfav('{{ $row->service }}');"
                                    id="fs-{{ $row->service }}"
                                    title="Unfavoritkan Layanan"
                                >
                                <i class="fas fa-star tw-text-lg tw-text-yellow-400" ></i> <!-- Filled star for favorited -->
                                </button>
                                @else
                                <button 
                                    type="button" 
                                    class="tw-absolute tw-top-4 tw-right-4 tw-text-gray-400 hover:tw-text-yellow-400 tw-transition-colors tw-z-10"
                                    onclick="fav('{{ $row->service }}');"
                                    id="fs-{{ $row->service }}"
                                    title="Favoritkan Layanan"
                                >
                                    <i class="far fa-star tw-text-lg" ></i> <!-- Outline star for unfavorited -->
                                </button>
                                @endif
                            
                                <!-- Category Label - Enhanced with gradient and centered text -->
                                <div class="tw-bg-gradient-to-r tw-from-primary-400 tw-to-primary-600 tw-text-center tw-py-2">
                                    <p class="tw-text-xs tw-text-white tw-font-medium">{{ $row->category }}</p>
                                </div>
                                
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
                                                $iconClass = 'fab fa-tiktok tw-text-black dark:tw-text-white';
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
                                        
                                        <div class="tw-w-11 tw-h-11 tw-flex tw-items-center tw-justify-center tw-rounded-full tw-bg-gradient-to-br tw-from-primary-50 tw-to-primary-100 dark:tw-from-gray-800 dark:tw-to-gray-700 tw-mr-3 tw-shadow-sm">
                                            <i class="{{ $iconClass }} tw-text-lg"></i>
                                        </div>
                                        <div>
                                            <h4 class="tw-font-medium tw-text-gray-900 dark:tw-text-gray-100 tw-text-base">{{ $row->name }}</h4>
                                            <p class="tw-text-xs tw-text-gray-500 dark:tw-text-gray-400">ID: {{ $row->service }}</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Service Details -->
                                    <div class="tw-grid tw-grid-cols-2 tw-gap-4 tw-mb-4">
                                        <div>
                                            <p class="tw-text-xs tw-text-gray-500 dark:tw-text-gray-400">Price per 1000</p>
                                            <p class="tw-font-semibold tw-text-primary-600 dark:tw-text-primary-400 tw-bg-gradient-to-r tw-from-primary-500 tw-to-primary-700 tw-bg-clip-text tw-text-transparent">Rp {{ number_format($row->price, 0, ',', '.') }}</p>
                                        </div>
                                        <div>
                                            <p class="tw-text-xs tw-text-gray-500 dark:tw-text-gray-400">Min Order</p>
                                            <p class="tw-font-medium tw-text-gray-800 dark:tw-text-gray-200">{{ number_format($row->min, 0, ',', '.') }}</p>
                                        </div>
                                        <div>
                                            <p class="tw-text-xs tw-text-gray-500 dark:tw-text-gray-400">Max Order</p>
                                            <p class="tw-font-medium tw-text-gray-800 dark:tw-text-gray-200">{{ number_format($row->max, 0, ',', '.') }}</p>
                                        </div>
                                        <div>
                                            <p class="tw-text-xs tw-text-gray-500 dark:tw-text-gray-400">Type</p>
                                            <p class="tw-font-medium tw-text-gray-800 dark:tw-text-gray-200">{{ $row->type ?: 'Regular' }}</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Action Buttons - Enhanced styling with futuristic design -->
                                    <div class="tw-flex tw-justify-end tw-space-x-2">
                                        <button type="button" 
                                        class="tw-inline-flex tw-items-center tw-px-3 tw-py-2 tw-border tw-border-gray-300 dark:tw-border-gray-600 tw-rounded-md tw-bg-white dark:tw-bg-gray-700 tw-text-sm tw-font-medium tw-text-gray-700 dark:tw-text-gray-200 hover:tw-bg-gray-50 dark:hover:tw-bg-gray-600 tw-shadow-sm hover:tw-shadow tw-transition-all tw-duration-300"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#details"
                                        onclick="detail('{{ $row->service }}')">
                                        <i class="fas fa-info-circle tw-mr-2 tw-text-primary-500"></i> Details
                                    </button>
                                    <button type="button" class="tw-inline-flex tw-items-center tw-px-3 tw-py-2 tw-border tw-border-gray-300 dark:tw-border-gray-600 tw-rounded-md dark:tw-bg-gray-700 tw-text-sm tw-font-medium tw-text-gray-700 dark:tw-text-gray-200 hover:tw-bg-gray-50 dark:hover:tw-bg-gray-600 tw-shadow-sm hover:tw-shadow tw-transition-all tw-duration-300"
                                            data-bs-toggle="modal" data-bs-target="#rating"
                                            onclick="rating('{{ $row->service }}')"><i
                                                class="fa-fw fas fa-star me-1 tw-text-yellow-400"></i>
                                            Rating
                                        </button>
                                        
                                        @php
                                            $text = $row->service . '||' . $row->provider;
                                            $encrypt = App\Helpers\Encryption::encrypt($text);
                                        @endphp
                                        
                                        <a href="{{ url('order/single') }}?id={!! $encrypt !!}" 
                                            class="tw-inline-flex tw-items-center tw-px-4 tw-py-2 tw-border tw-border-transparent tw-rounded-md tw-shadow-sm hover:tw-shadow-md hover:tw-shadow-primary-300/50 dark:hover:tw-shadow-primary-900/30 tw-text-sm tw-font-medium tw-text-white tw-bg-gradient-to-r tw-from-primary-500 tw-to-primary-600 hover:tw-from-primary-600 hover:tw-to-primary-700 tw-transition-all tw-duration-300">
                                            <i class="fas fa-shopping-cart tw-mr-2"></i> Order Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="tw-col-span-1 md:tw-col-span-2 lg:tw-col-span-3 tw-p-8 tw-text-center tw-bg-white dark:tw-bg-gray-800 tw-rounded-lg tw-shadow-sm tw-border tw-border-gray-100 dark:tw-border-gray-700">
                                <div class="tw-text-gray-500 dark:tw-text-gray-400">
                                    <i class="fas fa-search tw-text-3xl tw-mb-3 tw-opacity-40"></i>
                                    <p class="tw-text-lg">No services found</p>
                                    <p class="tw-text-sm tw-mt-1">Try adjusting your search or filter criteria</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    
                    <!-- Pagination - Improved styling -->
                    <div class="tw-mt-6">
                        <div class="tw-flex tw-justify-center">
                            {!! $layanan->links() !!}
                        </div>
                    </div>
                </div>
            </div>

            {{-- modal for rating --}}
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
    function rating(id) {
        $.ajax({
            "type": "POST",
            "url": "{{ url('rating/service') }}",
            "data": "id=" + id + "&_token={{ csrf_token() }}",
            "dataType": "html",
            "success": function(data) {
                $('#content-rating').html(data);
                $('#title-rating').html('Berapa nilai untuk layanan ini?');
            },
            error: function(data) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
                $('#rating').modal('hide');
            },
        });
    }

    function fav(id) {
        $.ajax({
            type: "POST",
            url: "{{ url('favorit/service') }}",
            data: "id=" + id + "&_token={{ csrf_token() }}",
            dataType: "json",
            success: function(data) {
                if (data.status == true) {
                    $('#fs-' + id).html('<i class="fas fa-star tw-text-lg tw-text-yellow-400"></i>');
                    $('#fs-' + id).has('i').attr('onclick', 'unfav(\'' + id + '\');');
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
                        '<i class="far fa-star tw-text-lg"></i>');
                    $('#fs-' + id).has('i').attr('onclick', 'fav(\'' + id + '\');');
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
