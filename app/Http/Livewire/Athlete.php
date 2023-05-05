<?php

namespace App\Http\Livewire;

use App\Models\Model\Athletes;
use App\Models\Model\Times;
use Livewire\Component;

class Athlete extends Component
{
    public $athletes;
    public $category;
    public $times;

    public function mount()
    {
        $this->athletes = Athletes::where('active',1)->orderBy('sex','asc')->orderBy('name','asc')->get();
        $this->times = Times::orderBy('record','desc')->get();
    }
    public function render()
    {
        return view('livewire.athlete');
    }
}
