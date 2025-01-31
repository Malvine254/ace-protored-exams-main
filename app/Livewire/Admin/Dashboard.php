<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public $products_count;
    public $users_count;
    public $orders_count;
    public $paid_orders_count;
    public $revenue;

    public function mount()
    {
        $this->products_count = Product::count();
        $this->users_count = User::where('email', '!=', config('constants.super_admin_email'))->count();
        $this->orders_count = Order::count();
        $this->revenue = Order::where('status', 'paid')->sum('total_amount');
        $this->paid_orders_count = Order::where('status', 'paid')->count();
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
