<?php

namespace App\Livewire\Checkout;

use App\Facades\Cart as CartFacade;
use Livewire\Component;

class CartPage extends Component
{
    public $cart;
    public $total_amount;

    public function mount(): void
    {
        $this->cart = CartFacade::get();
        $this->total_amount = $this->calculateTotal($this->cart['products'], 'price');
    }

    public function removeFromCart($productId): void
    {
        CartFacade::remove($productId);
        $this->cart = CartFacade::get();
        $this->dispatch('productRemoved');
    }

    private function calculateTotal($array, $field)
    {
        $sum = 0;
        foreach ($array as $item) {
            if (isset($item[$field])) {
                $sum += $item[$field];
            }
        }
        return $sum;
    }

    public function checkout(): void
    {
        // CartFacade::clear();
        // $this->dispatch('clearCart');
        // $this->cart = CartFacade::get();

        $this->redirect('/checkout');
    }

    public function render()
    {
        return view('livewire.checkout.cart-page')->extends('layouts.main');
    }
}
