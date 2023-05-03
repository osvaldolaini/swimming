<?php

namespace App\Http\Livewire;

use App\Models\Model\Categories;
use App\Models\Model\Modalities;
use App\Models\Model\Times;
use Livewire\Component;

class GenerateTeam extends Component
{
    public $modality = 'livre';
    public $category;
    public $type_team = 'm';
    public $distance = '25';

    public function mount()
    {
        ;//$this->modality = Modalities::where('active',1)->get();
        $this->category = Categories::where('active',1)->get();
    }
    public function render()
    {
        return view('livewire.generate-team');
    }
    public function gerar()
    {
        if ($this->type_team == 'mista') {
            $this->misto();
        }else{
            $this->sex();
        }
    }
    public function sex()
    {
        if ($this->modality == 'livre') {
            $bestTimes = Times::where('modality_id', 1)
            ->orderBy('record')
            ->limit(4)
            ->get();
        }
        dd($bestTimes->toArray());
    }
    public function misto()
    {
        dd('misto');
    }
}
