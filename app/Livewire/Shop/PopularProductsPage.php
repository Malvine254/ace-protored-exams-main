<?php

namespace App\Livewire\Shop;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class PopularProductsPage extends Component
{
    use WithPagination;

    public function render()
    {
        $products = Product::inRandomOrder()->paginate(20);

        return view('livewire.shop.popular-products-page', ['products' => $products])->extends('layouts.main');
    }
}
