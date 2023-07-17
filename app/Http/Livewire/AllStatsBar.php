<?php

namespace App\Http\Livewire;

use App\Models\Model\Modalities;
use App\Models\Model\Times;
use Livewire\Component;

class AllStatsBar extends Component
{
    public $time;
    public $labels;
    public $titles;
    public $data = array();
    public $times = array();

    public function mount($times,$prove)
    {
        for ($i=0; $i < count($times); $i++) {
            $time = Times::query()
            ->where('id',$times[$i])
            ->get();
            // $this->labels = $questions->pluck('created_at')->toArray();
            $this->labels[] = $time->map(
                fn($question)=>[
                    'day' => $question->day
                ]
            )->pluck('day')->toArray();

            $this->data[] = InvertTime(Times::where('id',$times[$i])->first()->record);
            $this->times[] = Times::where('id',$times[$i])->first()->record;
        }


        $p = explode('|',$prove);
        $this->titles = $p[2]. ' '.Modalities::find($p[0])->title. ' em piscina de '.$p[1];
        // dd($this->data);
    }
    public function render()
    {
        return view('livewire.all-stats-bar');
    }
}
