<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyOrders extends Component
{
    public $orders;

    public function mount()
    {
        $user = Auth::user();

        $this->orders = Order::where('customer_email', $user->email)
            ->orWhere('user_id', $user->id)
            ->get();
    }

    public function render()
    {
        return view('livewire.my-orders')->extends('layouts.main');
    }
}
