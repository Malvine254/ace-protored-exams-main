<?php

namespace App\Livewire\Checkout;

use Livewire\Component;

class CartPrompt extends Component
{
    public $showCheckoutPrompt = false;

    protected $listeners = [
        'productAdded' => 'showCheckout',
    ];

    public function showCheckout(): void
    {
        $this->showCheckoutPrompt = true;
    }

    public function render()
    {
        return view('livewire.checkout.cart-prompt');
    }
}
