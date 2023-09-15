<?php

namespace App\Http\Livewire\SearchBar;

use App\Models\Model\TeamsRestriction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ToggleButtonTeam extends Component
{
    public Model $model;
    public string $field;
    public bool $hasStatus;
    public $width;

    public function mount()
    {
        if ($this->model->status) {
            $this->hasStatus = true;
        }else{
            $this->hasStatus = false;
        }
    }
    public function render()
    {
        return view('livewire.search-bar.toggle-button');
    }
    public function updating($field, $value)
    {
        // $this->model->setAttribute($this->field, $value)->save();
        // dd($this->model->status);
        if ($value == true) {
            TeamsRestriction::create([
                'teams_configs_id'  =>Auth::user()->team->id,
                'team_id'           =>$this->model->id,
                'user_id'           =>Auth::user()->id,
            ]);
        }else{
            if ($this->model->status) {
                $this->model->status->delete();
            }
        }
        $this->openAlert('success', 'Registro atualizado com sucesso.');
    }
    //pega o status do registro
    public function openAlert($status, $msg)
    {
        $this->emit('openAlert', $status, $msg);
    }
}
