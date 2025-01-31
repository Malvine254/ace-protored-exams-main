<?php

namespace App\Livewire;

use Livewire\Component;

class SearchBar extends Component
{
    public $query = '';

    protected $queryString = ['query'];

    public function search()
    {
        return $this->redirect(route('shop.search') . '?query=' . $this->query);
    }

    public function render()
    {
        return view('livewire.search-bar');
    }
}
