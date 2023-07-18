<?php

namespace App\Http\Livewire;

use App\Models\Model\Categories;
use Livewire\Component;

class Teams extends Component
{
    public $teams;
    public function mount()
    {
        $this->teams = Categories::where('active',1)->orderBy('birth_year','desc')->get();
    }
    public function render()
    {
        return view('livewire.teams');
    }
    public function goAthletes($categoty,$limit)
    {
        return redirect()->to('/atletas?category='.$categoty.'&limit='.$limit);
    }
}
