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
        $this->times = Times::orderBy('record','asc')->get();
    }
    public function render()
    {
        // dd($this->times);
        return view('livewire.athlete');
    }
}
