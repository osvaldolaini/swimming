<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class GenerateTeams extends Component
{
    public $titles = 'Gerar equipes rev';

    public function render()
    {
        if (Gate::allows('group-user')) {
            abort(403);
        }
        return view('livewire.generate-teams');
    }
}
