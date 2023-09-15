<?php

namespace App\Http\Livewire;

use App\Models\TeamsConfig;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Livewire\Component;

class TeamConfig extends Component
{

    public $rules;

    public $config;
    public $name;
    public $birth;
    public $nick;
    public $model_id;

    public $alertSession = false;

    public function mount()
    {
        if (Gate::allows('group-user')) {
            abort(403);
        }
        $this->config  = Auth::user()->team;
        if ($this->config) {
            $this->model_id = $this->config->id;
            $this->name     = $this->config->name;
            $this->nick     = $this->config->nick;
            if ($this->config->birth != '') {
                $this->birth = convertOnlyDatee($this->config->birth);
            }
            // dd($this->birth);
        }
    }

    public function render()
    {
        return view('livewire.team-config');
    }

    public function store()
    {
        $this->rules = [
            'name' => 'required|min:4|max:255',
            'nick' => 'required|max:255',
        ];
        $this->validate();
        if ($this->birth != '') {
            $this->birth = implode(
                "-",
                array_reverse(explode("/", $this->birth))
            );
        }

        TeamsConfig::updateOrCreate([
            'id'        => $this->model_id,
        ], [
            'user_id'   => Auth::user()->id,
            'name'      => mb_strtoupper($this->name),
            'nick'      => mb_strtoupper($this->nick),
            'birth'     => $this->birth,
            'code'      => Str::uuid(),
            'created_by' => Auth::user()->name,
        ]);

        if ($this->config) {
            session()->flash('success', 'Clube atualizado com sucesso');
        } else {
            session()->flash('success', 'Clube criado com sucesso');
        }

        $this->alertSession = true;

        return redirect()->route('configTeam');
    }
    //Fecha a caixa da mensagem
    public function closeAlert()
    {
        $this->alertSession = false;
    }
}
