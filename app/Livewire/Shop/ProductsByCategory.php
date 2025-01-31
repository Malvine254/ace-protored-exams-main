<?php

namespace App\Livewire\Shop;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsByCategory extends Component
{
    use WithPagination;
    public $tag;

    public function mount($id)
    {
        $this->tag = str_replace('-', ' ', $id);
    }

    public function render()
    {
        $products = Product::where('name', 'like', "%{$this->tag}%")
            ->orWhere('categories', 'like', "%{$this->tag}%")
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('livewire.shop.products-by-category', ['products' => $products])->extends('layouts.main');
    }
}
