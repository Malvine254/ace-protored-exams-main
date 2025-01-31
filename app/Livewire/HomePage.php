<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class HomePage extends Component
{
    public function render()
    {
        $products = Product::inRandomOrder()->take(8)->get();

        return view('livewire.home-page', ['products' => $products])->extends('layouts.main');
    }
}
