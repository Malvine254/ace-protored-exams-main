<?php

namespace App\Livewire\Shop;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ShopPage extends Component
{
    use WithPagination;

    public function render()
    {
        $products = Product::orderBy('name', 'asc')->paginate(20);

        return view('livewire.shop.shop-page', ['products' => $products])->extends('layouts.main');
    }
}
