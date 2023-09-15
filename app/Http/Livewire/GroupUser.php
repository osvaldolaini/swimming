<?php

namespace App\Http\Livewire;

use App\Models\UserGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class GroupUser extends Component
{
    public $type = null;
    public $showGroupModal = false;
    public $alertSession = false;
    //pega o status do registro
    public function openAlert($status,$msg)
    {
        $this->emit('openAlert', $status, $msg);
    }
    public function mount()
    {
        if (Gate::allows('group-user-ok')) {
            abort(403);
        }
    }
    public function render()
    {
        return view('livewire.group-user');
    }
    //CREATE
    public function showGroupModal($type)
    {
        $this->showGroupModal = true;
        $this->type = $type;
    }
    public function store()
    {
        UserGroup::create([
            'user_id'       => Auth::user()->id,
            'type'    => $this->type,
        ]);

        $this->openAlert('success', 'Atividade selecionada com sucesso.');

        $this->alertSession = true;
        $this->showGroupModal = false;
        redirect()->route('dashboard');
    }
}
