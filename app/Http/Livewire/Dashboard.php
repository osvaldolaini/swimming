<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Dashboard extends Component
{
    public function mount()
    {
        if (Gate::allows('group-user')) {
            abort(403);
        }
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
}
