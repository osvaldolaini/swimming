<?php

namespace App\Http\Livewire;

use App\Models\Model\Teams;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TeamsList extends Component
{
    public $teams;
    public function mount()
    {
        if (Gate::allows('group-user')) {
            abort(403);
        }
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
