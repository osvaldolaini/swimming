<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Gate;
use Livewire\Component;


use App\Models\TeamsConfig;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public $times;
    public $teamConfig;
    public $athletes;
    public $head;
    public $coachs;

    public function mount()
    {
        if (Gate::allows('group-user')) {
            abort(403);
        }


        // $this->head = $this->teamConfig->head->where('type',2)->count();
        // $this->coachs = $this->teamConfig->coachs->where('type',3)->count();

    }
    public function render()
    {
        if(Auth::user()->team){
            $this->teamConfig = TeamsConfig::find(Auth::user()->team->id);

            $this->athletes = $this->teamConfig->athletes->count();
            $this->times = $this->teamConfig->times->count();
        }
        return view('livewire.dashboard');
    }
}
