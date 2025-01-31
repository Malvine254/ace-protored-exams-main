<?php

namespace App\Livewire;

use App\Mail\AdminNotifications;
use App\Mail\OrderSuccessEmail;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class OrderSuccessfulPage extends Component
{
    public $order;

    public function mount(string $id, Request $request)
    {
        $session_id = $request->query('session_id');

        $this->order = Order::find($id);

        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

        $session = $stripe->checkout->sessions->retrieve($session_id);

        // update order
        if ($session['payment_status'] == 'paid') {
            $this->order->update(['status' => 'paid', 'paid_at' => now()]);
        }

        // send email
        if ($session['payment_status'] == 'paid' && !$this->order->email_sent) {
            try {
                Mail::to(config('constants.admin_notifications_email'))->send(new AdminNotifications($this->order));
                Mail::to($this->order->customer_email)->send(new OrderSuccessEmail($this->order));

                $this->order->update(['email_sent' => true]);
            } catch (\Exception $e) {
                // Payment failed; store an error message in the session
                Log::error('Error: Failed to send email ' . $e->getMessage());
            }
        }
    }

    public function render()
    {
        return view('livewire.order-successful-page')->extends('layouts.main');
    }
}
