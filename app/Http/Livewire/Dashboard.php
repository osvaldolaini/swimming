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
    public $alertSession = false;

    public function mount()
    {
        if (Auth::user()->group == null) {
            redirect()->route('groupUser');
        }
        if(Auth::user()->team){
            $this->teamConfig = TeamsConfig::find(Auth::user()->team->id);

            $this->athletes = $this->teamConfig->athletes->count();
            $this->times = $this->teamConfig->times->count();
            // $this->head = $this->teamConfig->head->where('type',2)->count();
            $this->coachs = $this->teamConfig->coachs->where('type',3)
            ->where('coach_ok',1)
            ->where('head_ok',1)->count();
        }
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
      //Fecha a caixa da mensagem
    public function closeAlert()
    {
        $this->alertSession = false;
    }
}
