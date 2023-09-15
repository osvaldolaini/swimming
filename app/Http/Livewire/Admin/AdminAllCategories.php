<?php

namespace App\Http\Livewire\Admin;

use App\Models\Model\Teams;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;

class AdminAllCategories extends Component
{
    public $teams;
    public function mount()
    {
        if (Gate::allows('group-admin')) {
            abort(403);
        }
        $this->teams = Teams::where('active',1)->orderBy('max_age','asc')->get();
    }
    public function render()
    {
        return view('livewire.admin.admin-all-categories');
    }
    public function goAthletes($code)
    {
        return redirect()->to('/administrador/atletas?category='.$code);
    }
}
