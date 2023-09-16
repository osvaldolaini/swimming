<?php

namespace App\Http\Livewire;

use App\Models\TeamsConfig;
use App\Models\UserGroup;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


use Illuminate\Support\Facades\Gate;

class Coachs extends Component
{

    public $teamConfig;
    public $coachs;
    public $alertSession = false;


    public function mount()
    {
        if (Gate::allows('group-user')) {
            abort(403);
        }
        $this->teamConfig = TeamsConfig::find(Auth::user()->team->id);
        $this->coachs = $this->teamConfig->coachs->where('type', 3)
            ->where('coach_ok', 1);
    }
    public function render()
    {
        $this->coachs = $this->teamConfig->coachs->where('type', 3)
            ->where('coach_ok', 1);
        return view('livewire.coachs');
    }
    public function active($id)
    {
        UserGroup::updateOrCreate([
            'id'=>$id,
        ],[
            'head_ok'=>1,
        ]);
        session()->flash('success','Vinculado com sucesso.');
        $this->alertSession = true;
        $this->mount();

    }
    public function delete($id)
    {
        UserGroup::updateOrCreate([
            'id'=>$id,
        ],[
            'head_ok'=>0,
        ]);
        session()->flash('success','Desvinculado com sucesso.');
        $this->alertSession = true;
        $this->mount();

    }
    //Fecha a caixa da mensagem
    public function closeAlert()
    {
        $this->alertSession = false;
    }
}
