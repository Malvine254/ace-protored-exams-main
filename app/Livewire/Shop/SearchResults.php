<?php

namespace App\Livewire\Shop;

use App\Models\Product;
use Livewire\Component;

class SearchResults extends Component
{
    public $query = '';

    protected $queryString = ['query'];

    public function render()
    {
        $products = Product::where('name', 'like', "%{$this->query}%")
            ->orWhere('categories', 'like', "%{$this->query}%")
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('livewire.shop.search-results', ['products' => $products])->extends('layouts.main');
    }
}
