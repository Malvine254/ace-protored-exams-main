<?php

namespace App\Livewire\Shop;

use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Facades\Cart;

class ProductPage extends Component
{
    public $product;
    public $description = '';
    public $category;
    public $related_products;

    public function mount($slug)
    {
        $id = $this->getIDFromSlug($slug);

        $this->product = Product::find($id);

        $this->description = $this->product->name . "is a must-have resource for students aiming to excel. With our guarantee of authenticity and up-to-date content, you'll gain access to high-quality material that simplifies complex concepts and reinforces your understanding. Don't settle for less; trust RN Study Resources for reliable resources that give you the edge you need to succeed academically.
        ";

        $this->category = $this->findMatchingCategory($this->product->name);

        if ($this->category) {
            $this->related_products = Product::inRandomOrder()->where('name', 'like', '%' . $this->category . '%')->take(5)->get();
        } else {
            $this->related_products = Product::inRandomOrder()->take(5)->get();
        }
    }

    private function getIDFromSlug($string)
    {
        $parts = explode('-', $string);

        $lastPart = end($parts);

        return $lastPart;
    }

    /**
     * Replace all occurrences of a specific text in a string, regardless of case, with an empty string.
     *
     * @param string $input The input string.
     * @param string $textToReplace The text to be replaced.
     * @return string The modified string.
     */
    private function replaceText($input, $textToReplace)
    {
        return preg_replace('/' . preg_quote($textToReplace, '/') . '/i', '', $input);
    }

    /**
     * Checks if any category name appears in the given title.
     *
     * @param string $title The title to check.
     * @param array $categoriesData The array of categories.
     * @return string|null The first matched category name, or null if no match is found.
     */
    private function findMatchingCategory($title)
    {
        $categoriesData = config('book-categories.categories');

        foreach ($categoriesData as $categoryGroup) {
            foreach ($categoryGroup['categories'] as $category) {
                if (stripos($title, $category) !== false) {
                    return $category;
                }
            }
        }
        return null; // No match found
    }

    #[On('add-to-cart')]
    public function addToCart()
    {
        Cart::add($this->product);
        $this->dispatch('productAdded');
    }

    #[On('direct-purchase')]
    public function directPurchase()
    {
        Cart::add($this->product);
        $this->redirect(route('cart'));
    }

    public function render()
    {
        return view('livewire.shop.product-page')->extends('layouts.main');
    }
}
