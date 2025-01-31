<?php

namespace App\Livewire\Shop;

use App\Facades\Cart;
use Livewire\Component;

class CartButton extends Component
{
    public $cartTotal = 0;
    public $cart = [];

    protected $listeners = [
        'productAdded' => 'updateCartTotal',
        'productRemoved' => 'updateCartTotal',
        'clearCart' => 'updateCartTotal'
    ];

    public function mount(): void
    {
        $this->cart = Cart::get()['products'];
        $this->cartTotal = count(Cart::get()['products']);
    }

    public function updateCartTotal(): void
    {
        $this->cartTotal = count(Cart::get()['products']);
        $this->cart = Cart::get()['products'];
    }

    public function render()
    {
        return view('livewire.shop.cart-button');
    }
}
