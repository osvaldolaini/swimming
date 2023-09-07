<?php

namespace App\Http\Livewire;

use Livewire\Component;

class GenerateTeams extends Component
{
    public $titles = 'Gerar equipes rev';

    public function render()
    {
        return view('livewire.generate-teams');
    }
}
