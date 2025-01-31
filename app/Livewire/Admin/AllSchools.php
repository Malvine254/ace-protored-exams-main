<?php

namespace App\Livewire\Admin;

use App\Models\School;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class AllSchools extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public ?string $search_string = '';

    public function render()
    {
        $query = School::query()->orderBy('created_at', 'desc');

        if ($this->search_string) {
            $query = $query->where('name', 'like', "%{$this->search_string}%");
        }

        $schools = $query->paginate(20);

        return view('livewire.admin.all-schools', ['schools' => $schools])->extends('layouts.main');
    }
}
