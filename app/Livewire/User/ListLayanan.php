<?php

namespace App\Livewire\User;

use App\Models\Category;
use App\Models\Smm;
use Livewire\Component;
use Livewire\WithPagination;

class ListLayanan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $kate;
    public $perPage = 10;
    public $search = '';
    public $custom = false;
    public $category = false;
    public $serviceGroup = null;
    public $specificCategory = null;
    public $sortDirection = 'asc';
    public $sortField = 'price';

    // Listen for events
    protected $queryString = ['search', 'category', 'serviceGroup', 'specificCategory'];

    public function changeCustom($custom)
    {
        if ($custom == 'all') {
            $this->custom = false;
        } else {
            $this->custom = $custom;
        }
        $this->resetPage();
    }

    public function Categorys($category)
    {
        $this->category = $category;
        $this->specificCategory = null; // Reset specific category when changing platform
        $this->resetPage();
    }

    public function applyServiceGroupFilter($group)
    {
        $this->serviceGroup = $group;
        $this->resetPage();
    }

    public function applySpecificCategory($category)
    {
        $this->specificCategory = $category;
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->specificCategory = null;
        $this->serviceGroup = null;
        $this->category = false;
        $this->custom = false;
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Smm::with('kategori')
            ->where('status', 'aktif')
            ->where('type', 'like', '%' . $this->custom . '%');

        // Apply search filter
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('service', 'like', '%' . $this->search . '%')
                    ->orWhere('name', 'like', '%' . $this->search . '%')
                    ->orWhere('category', 'like', '%' . $this->search . '%');
            });
        }

        // Apply platform filter (category base)
        if ($this->category) {
            $query->where('category', 'like', $this->category . '%');
        } elseif ($this->kate) {
            $query->where('category', 'like', '%' . $this->kate . '%');
        }

        // Apply specific category filter (exact match)
        if ($this->specificCategory) {
            $query->where('category', $this->specificCategory);
        }

        // Apply service group filter
        if ($this->serviceGroup) {
            $query->where('name', 'like', '%' . $this->serviceGroup . '%');
        }

        // Sort by price (default ascending)
        $query->orderBy($this->sortField, $this->sortDirection);

        // Get paginated results
        $layanan = $query->paginate($this->perPage);

        // Get all categories for filters
        $kategori = Category::where('status', 'aktif')
            ->orderBy('kategori', 'asc')
            ->get();

        // Get unique service groups for the current platform
        $serviceGroups = collect();
        $allCategories = collect();

        if ($this->category) {
            // Find service groups within the currently selected platform
            $serviceNamesForCategory = Smm::where('category', 'like', $this->category . '%')
                ->where('status', 'aktif')
                ->pluck('name')
                ->map(function ($name) {
                    // Extract service type keywords (likes, views, followers, etc.)
                    $keywords = ['Likes', 'Views', 'Followers', 'Comments', 'Subscribers', 'Plays', 'Saves', 'Shares'];
                    foreach ($keywords as $keyword) {
                        if (stripos($name, $keyword) !== false) {
                            return $keyword;
                        }
                    }
                    return null;
                })
                ->filter()
                ->unique()
                ->values();

            $serviceGroups = $serviceNamesForCategory;
        }

        // Get all unique categories for the dropdown (regardless of platform selection)
        $allCategories = Smm::where('status', 'aktif')
            ->pluck('category')
            ->unique()
            ->values();

        return view('livewire.user.list-layanan', [
            'layanan' => $layanan,
            'kategori' => $kategori,
            'serviceGroups' => $serviceGroups,
            'allCategories' => $allCategories
        ]);
    }
}