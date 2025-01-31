<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AllUsers extends Component
{

    public function render()
    {
        return view('livewire.admin.all-users')->extends('layouts.main');
    }
}
