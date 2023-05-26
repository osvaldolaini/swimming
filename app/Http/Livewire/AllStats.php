<?php

namespace App\Http\Livewire;

use App\Models\Model\Athletes;
use App\Models\Model\Times;
use Livewire\Component;

class AllStats extends Component
{
    public $times;
    public $charts;
    public $athlete_id;
    public $athlete;
    public $stats = array();

    public function render()
    {
        if (isset($_GET['atleta'])) {
            $this->athlete_id = $_GET['atleta'];
            $this->times = Times::where('athlete_id',$this->athlete_id)->get();

            foreach ($this->times as $key) {
                $this->stats[]=[
                    'id'=>$key->id,
                    'prove'=>$key->modality_id.'|'.$key->pool.'|'.$key->distance,
                ];
            }
            $this->athlete = Athletes::where('id',$_GET['atleta'])->first();
        }
        $checkedIds = [];
        $repeatedIds = [];
        foreach ($this->stats as $item) {
            $prove = $item['prove'];
            if (in_array($prove, $checkedIds)) {
                $repeatedIds[] = $item['id'];
            } else {
                $checkedIds[] = $prove;
            }
        }
        $this->charts = $this->invertArray($this->stats);
        // dd($this->charts);
        return view('livewire.all-stats');
    }

    public function invertArray($stats)
    {
        $proveIds = [];

        foreach ($stats as $item) {
            $prove = $item['prove'];
            $id = $item['id'];

            if (!isset($proveIds[$prove])) {
                $proveIds[$prove] = [];
            }
            $proveIds[$prove][] = $id;
        }

        $repeatedProveIds = [];

        foreach ($proveIds as $prove => $ids) {
            if (count($ids) > 1) {
                $repeatedProveIds[$prove] = $ids;
            }
        }
        return $repeatedProveIds;
    }
}
