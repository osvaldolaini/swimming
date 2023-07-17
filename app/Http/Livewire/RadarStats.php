<?php

namespace App\Http\Livewire;

use App\Models\Model\Athletes;
use App\Models\Model\Times;
use Livewire\Component;
use Carbon\Carbon;

class RadarStats extends Component
{
    public $name;
    public $athletes;
    public $category;
    public $labels;
    public $data;

    public function mount($athlete)
    {
        $this->athletes = $athlete;
        $this->name = $athlete->name;

        $this->category = getCategory($athlete->birth);
        // dd($this->category);
        $this->labels = [
            'Medley',
            'Crawl',
            'Borbo',
            'costa',
            'Peito',
        ];


        $this->data = [
            $this->getAll(),
            $this->getMedia(1),
            $this->getMedia(2),
            $this->getMedia(3),
            $this->getMedia(4),
        ];
    }
    public function render()
    {
        // dd($this->getMedia(1));
        return view('livewire.radar-stats');
    }
    public function getMedia($mod)
    {
        $allAthletes = Athletes::where('active',1)
        ->where('birth', 'LIKE', '%' . $this->category->birth_year. '%')
         ->where('sex',$this->athletes->sex)
        ->get();

        $most = 1000.00;
        $at = 0;

        foreach ($allAthletes as $key) {
            $time = Times::select('record')
            // ->where('pool',25)
            ->where('distance',50)
            ->where('athlete_id',$key->id)
            ->where('modality_id',$mod)
            ->where('category_id',$this->category->id)
            ->orderBy('record','asc')
            ->first();

            if ($time) {
                if($time->record < $most){
                    $most = invertTime($time->record);
                }
                $at +=1;
            }
        }

        $timeAthlete = Times::select('record')
            // ->where('pool',25)
            ->where('distance',50)
            ->where('modality_id',$mod)
            ->where('athlete_id',$this->athletes->id)
            ->where('category_id',$this->category->id)
            ->orderBy('record','asc')
            ->first();

        if($timeAthlete){
            $r = invertTime($timeAthlete->record);
        }else{
            $r = 0;
        }

        $m = $most;

        $ex = (($r*100)/$m);
        $ex = number_format((float)$ex, 2, '.', '');
        if($ex > 100){
            $ex = 100 - ($ex - 100);
        }

        return $ex;
    }

    public function getAll()
    {
        $e = 0;
        $x = 0;
            for ($i=1; $i < 5; $i++) {
                if($this->getMedia(1) > 0 ){
                    $x = $this->getMedia($i) / 4;
                }
                $e+=$x;
            }

        return $e;
    }
}
