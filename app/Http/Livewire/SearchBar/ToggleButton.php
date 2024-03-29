<?php

namespace App\Http\Livewire\SearchBar;

use App\Models\Model\TeamsRestriction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ToggleButton extends Component
{
    public Model $model;
    public string $field;
    public bool $hasStatus;
    public $width;

    public function mount()
    {
        $this->hasStatus = (bool) $this->model->getAttribute($this->field);
    }
    public function render()
    {
        return view('livewire.search-bar.toggle-button');
    }
    public function updating($field, $value)
    {
        $this->model->setAttribute($this->field, $value)->save();

        // if ($value == false) {
        //     TeamsRestriction::create([
        //         'teams_configs_id'  =>Auth::user()->team->id,
        //         'team_id'           =>$this->model->id,
        //         'user_id'           =>Auth::user()->id,
        //     ]);
        // }else{
        //     if ($this->model->status) {
        //         $this->model->status->delete();
        //     }
        // }
        $this->openAlert('success', 'Registro atualizado com sucesso.');
    }
    //pega o status do registro
    public function openAlert($status, $msg)
    {
        $this->emit('openAlert', $status, $msg);
    }
}
