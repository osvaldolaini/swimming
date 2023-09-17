<?php

namespace App\Http\Livewire;

use App\Models\UserGroup;
use Livewire\Component;

class CoachTeam extends Component
{
    public function render()
    {
        return view('profile.coach-team');
    }
    public function deleteTeam($id)
    {
        UserGroup::updateOrCreate([
            'id'=>$id,
        ],[
            'head_ok'=>0,
            'coach_ok'=>0,
        ]);
        session()->flash('success','Desvinculado com sucesso.');
        return redirect()->route('profile.show');
    }
}
