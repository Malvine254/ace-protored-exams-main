<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class UserDetails extends Component
{
    public $user;

    public function mount($id)
    {
        $this->user = User::find($id);
    }

    public function deleteUser()
    {
        if ($this->user) {
            $this->user->delete();

            // Emit an event or redirect after deletion
            session()->flash('message', 'User deleted successfully.');
            return redirect()->route('admin.users'); // Adjust route as needed
        }

        session()->flash('error', 'User not found or already deleted.');
    }

    public function render()
    {
        return view('livewire.admin.user-details')->extends('layouts.main');
    }
}
