<?php

namespace App\Livewire\Shop;

use App\Models\Product;
use App\Models\School;
use Livewire\Attributes\Url;
use Livewire\Component;

class UniversityBooks extends Component
{
    public $university;

    #[Url(history: true)]
    public ?string $search_string = '';

    public function mount($university)
    {
        $id = $this->getIDFromSlug($university);

        $this->university = School::find($id);
    }

    private function getIDFromSlug($string)
    {
        $parts = explode('-', $string);

        $lastPart = end($parts);

        return $lastPart;
    }

    public function render()
    {
        $query = Product::query()->inRandomOrder();

        if ($this->search_string) {
            $query = $query->where('name', 'like', "%{$this->search_string}%");
        }

        $products = $query->paginate(20);

        return view('livewire.shop.university-books', ['books' => $products])->extends('layouts.main');
    }
}
