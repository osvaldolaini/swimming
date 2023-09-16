<?php

namespace App\Http\Livewire;

use App\Models\TeamsConfig;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SearchTeam extends Component
{
    public $openModalSearch = false;
    public $teams;
    public $alertSession;
    public $model_id;
    public $inputSearch = '';
    protected $listeners =
    [
        'closeReceived',
        'openModalSearch',
        'openAlert'
    ];

    public function render()
    {
        if ($this->inputSearch != '') {
            $this->teams = TeamsConfig::where('name', 'LIKE', '%' . $this->inputSearch . '%')
            ->orWhere('nick', 'LIKE', '%' . $this->inputSearch . '%')
            ->limit(10)->get();
        }

        return view('livewire.search-team');
    }
    public function openModalSearch()
    {
        $this->openModalSearch = true;
    }
    public function closeModalSearch()
    {
        $this->openModalSearch = false;
    }
    public function send($teams_configs_id)
    {
        UserGroup::updateOrCreate([
            'id'=>Auth::user()->group->id,
        ],[
            'teams_configs_id'  =>$teams_configs_id,
            'coach_ok'          =>1,
        ]);
        $this->openAlert('success','Solicitação enviada com sucesso.');

        return redirect()->route('dashboard');
    }
    //OPEN MESSAGE
    public function openAlert($status, $msg)
    {
        session()->flash($status, $msg);
        $this->alertSession = true;
    }
}
