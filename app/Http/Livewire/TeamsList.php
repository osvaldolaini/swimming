<?php

namespace App\Http\Livewire;

use App\Models\Model\Teams;
use Livewire\Component;

class TeamsList extends Component
{
    public $teams;
    public function mount()
    {
        $this->teams = Teams::where('active',1)->orderBy('max_age','asc')->get();
    }
    public function render()
    {
        return view('livewire.teams');
    }
    public function goAthletes($code)
    {

        return redirect()->to('/atletas?category='.$code);
    }
}
