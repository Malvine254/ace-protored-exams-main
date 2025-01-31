<?php

namespace App\Livewire\Shop;

use App\Models\School;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Universities extends Component
{
    use WithPagination;
    public $countries = [];

    #[Url(history: true)]
    public ?string $search_string = '';

    #[Url(history: true)]
    public ?string $state = '';

    #[Url(history: true)]
    public ?string $country = '';

    public function mount()
    {
        $this->countries = DB::table('schools')
            ->distinct()
            ->pluck('country')
            ->toArray();
    }

    public function render()
    {
        $states = [];

        $query = School::query()->orderBy('created_at', 'desc');

        if ($this->search_string) {
            $query = $query->where('name', 'like', "%{$this->search_string}%");
        }

        if ($this->country) {
            $query = $query->where('country', 'like', "%{$this->country}%");
        }

        if ($this->country) {
            $states =
                DB::table('schools')->where('country', 'like', "%{$this->country}%")
                ->distinct()
                ->pluck('state_province')
                ->toArray();
        }

        $schools = $query->paginate(20);

        return view('livewire.shop.universities', ['schools' => $schools, 'states' => $states])->extends('layouts.main');
    }
}
