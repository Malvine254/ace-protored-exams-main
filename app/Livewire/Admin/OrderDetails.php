<?php

namespace App\Livewire\Admin;

use App\Models\DownloadLogs;
use App\Models\Order;
use Livewire\Component;

class OrderDetails extends Component
{
    public $order;
    public $download_logs;

    public function mount($id)
    {
        $this->order = Order::find($id);
        $this->download_logs = DownloadLogs::where('order_id', $id)->get();
    }

    public function render()
    {
        return view('livewire.admin.order-details')->extends('layouts.main');
    }
}
