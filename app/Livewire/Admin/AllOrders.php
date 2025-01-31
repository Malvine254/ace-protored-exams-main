<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class AllOrders extends Component
{

    public function render()
    {

        return view('livewire.admin.all-orders')->extends('layouts.main');
    }
}
