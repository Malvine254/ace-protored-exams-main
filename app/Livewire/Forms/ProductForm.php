<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProductForm extends Form
{
    public ?Product $product;

    #[Validate('required')]
    public $name;
    public $type;
    public $categories = [];
    public $images = [];
    public $description;

    public $download_link;
    public $slug;
    public $price;
    public $discounted_from;
    public $tags = [];
    public $in_stock = true;

    public function setProduct(Product $product)
    {
        $this->product = $product;

        $this->fill($product->only([
            'name',
            'description',
            'price',
            'download_link',
            'images',
            'type',
            'slug',
            'categories',
            'tags',
            'in_stock',
            'discounted_from'
        ]));
    }

    public function store()
    {
        $this->validate();

        // $this->slug = $this->kebabCase($this->name);

        $saved = Product::create($this->only([
            'name',
            'description',
            'price',
            'download_link',
            'images',
            'type',
            'slug',
            'categories',
            'tags',
            'in_stock',
            'discounted_from'
        ]));

        return $saved['id'];
    }

    private function kebabCase($string)
    {
        $string = strtolower($string);
        $string = preg_replace('/[^a-zA-Z0-9]+/', ' ', $string);

        $string = preg_replace_callback(
            '/([a-z])([A-Z])/',
            function ($matches) {
                return strtolower($matches[1]) . '-' . strtolower($matches[2]);
            },
            $string,
        );

        $string = str_replace(' ', '-', $string);

        $string = trim($string, '-');

        return $string;
    }

    public function update()
    {

        $this->product->update($this->only([
            'name',
            'description',
            'price',
            'download_link',
            'images',
            'type',
            'slug',
            'categories',
            'tags',
            'in_stock',
            'discounted_from'
        ]));
    }
}
