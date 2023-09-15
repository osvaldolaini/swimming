<?php

namespace App\Http\Livewire\Admin;

use App\Models\Model\Athletes;
use App\Models\Model\Times;
use App\Models\TeamsConfig;
use App\Models\UserGroup;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class AdminDashboard extends Component
{
    public $times;
    public $teams;
    public $athletes;
    public $head;
    public $coachs;

    public function mount()
    {
        if (Gate::allows('group-admin')) {
            abort(403);
        }
        $this->times    = Times::count();
        $this->teams    = TeamsConfig::count();
        $this->athletes = Athletes::count();
        $this->head     = UserGroup::where('type',2)->count();
        $this->coachs   = UserGroup::where('type',3)->count();
    }
    public function render()
    {
        return view('livewire.admin.admin-dashboard');
    }
}
