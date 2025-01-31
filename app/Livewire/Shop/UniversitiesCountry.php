<?php

namespace App\Livewire\Shop;

use App\Models\School;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class UniversitiesCountry extends Component
{
    use WithPagination;
    public $states = [];

    #[Url(history: true)]
    public ?string $search_string = '';

    public function mount($country)
    {
        $$this->states = DB::table('schools')->where('country', '==', $country)
            ->distinct()
            ->pluck('state_province')
            ->toArray();
    }

    public function render()
    {
        $query = School::query()->orderBy('created_at', 'desc');

        if ($this->search_string) {
            $query = $query->where('name', 'like', "%{$this->search_string}%");
        }

        $schools = $query->paginate(20);

        return view('livewire.shop.universities-country')->extends('layouts.main');
    }
}
