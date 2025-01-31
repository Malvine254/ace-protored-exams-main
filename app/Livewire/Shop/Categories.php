<?php

namespace App\Livewire\Shop;

use Livewire\Component;

class Categories extends Component
{
    public function render()
    {
        return view('livewire.shop.categories')->extends('layouts.main');
    }
}
