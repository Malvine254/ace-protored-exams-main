<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;


class AllProducts extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public ?string $search_string = '';

    #[Url(history: true)]
    public ?string $filter = '';

    public function render()
    {
        $p_query = Product::query()->orderBy('created_at', 'desc');

        if ($this->search_string) {
            $p_query = $p_query->where('name', 'like', "%{$this->search_string}%");
        }

        $products = $p_query->paginate(20);

        return view('livewire.admin.all-products', ['products' => $products])->extends('layouts.main');
    }
}
