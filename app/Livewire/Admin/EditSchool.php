<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\SchoolForm;
use App\Models\School;
use Livewire\Component;

class EditSchool extends Component
{
    public $school;
    public SchoolForm $form;

    public function mount($id)
    {
        if ($id !== 'new') {
            $this->school = School::find($id);
            $this->form->setSchool($this->school);
        }
    }

    public function save()
    {
        if ($this->school) {
            $this->form->update();

            return redirect(request()->header('Referer'));
        } else {
            $this->form->store();

            return redirect(route('admin.schools'));
        }
    }

    public function render()
    {
        return view('livewire.admin.edit-school')->extends('layouts.main');
    }
}
