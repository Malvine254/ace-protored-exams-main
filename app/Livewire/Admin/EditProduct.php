<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\ProductForm;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;

class EditProduct extends Component
{
    public $product;
    public ProductForm $form;

    public function mount($id)
    {
        if ($id !== 'new') {
            $this->product = Product::find($id);
            $this->form->setProduct($this->product);
        }
    }

    public function updatedFormName($value)
    {
        $this->form->slug = Str::slug($value);
    }

    public function updatedFormSlug($value)
    {
        $sanitizedSlug = Str::slug($value);

        if ($this->form->slug !== $sanitizedSlug) {
            $this->form->slug = $sanitizedSlug;
        }
    }


    public function update()
    {
        if ($this->product) {
            $this->form->update();

            return redirect(request()->header('Referer'));
        } else {
            $this->form->store();

            return redirect(route('admin.products'));
        }
    }

    public function delete()
    {
        $this->product->delete();

        return redirect(route('admin.products'));
    }

    public function render()
    {
        return view('livewire.admin.edit-product')->extends('layouts.main');
    }
}
