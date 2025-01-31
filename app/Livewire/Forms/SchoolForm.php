<?php

namespace App\Livewire\Forms;

use App\Models\School;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SchoolForm extends Form
{
    public ?School $school;

    #[Validate('required|min:5')]
    public $name;
    #[Validate('required')]
    public $country = "United States of America";
    #[Validate('required')]
    public $state_province;
    #[Validate('required')]
    public $type = "University";
    public $courses = [];
    public $description;

    public function setSchool(School $school)
    {
        $this->school = $school;

        $this->fill($school->only([
            'name',
            'type',
            'description',
            'country',
            'state_province',
            'courses'
        ]));
    }

    public function store()
    {
        $this->validate();

        $saved = School::create($this->only([
            'name',
            'type',
            'description',
            'country',
            'state_province',
            'courses'
        ]));

        return $saved['id'];
    }


    public function update()
    {

        $this->school->update($this->only([
            'name',
            'type',
            'description',
            'country',
            'state_province',
            'courses'
        ]));
    }
}
