<?php

namespace App\Http\Livewire;

use App\Models\Model\Athletes;
use App\Models\Model\Categories;
use App\Models\Model\Modalities;
use App\Models\Model\Times;
use DateTime;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GenerateTeams extends Component
{
    public $modality = 'livre';
    public $category;
    public $birth_year;
    public $type_team = 'masculino';
    public $distance = '25';
    public $bestTimes;
    public $equipes;
    public $num_teams = 4;
    public $modalidades;

    public $times;
    public $totalComb;


    public function mount()
    {
        $this->modalidades = Modalities::where('active', 1)->get();
        $this->category = Categories::where('active', 1)->get();
        $this->birth_year = Categories::where('active', 1)->first()->birth_year;
        $this->times = Times::all();

    }

    function generateTeams()
    {
        $this->equipes = array();
        $atletas = DB::table('athletes')->select('id')
            ->where('birth', 'LIKE', '%' . $this->birth_year . '%')
            ->where('sex', $this->type_team)
            ->pluck('id');


        $this->equipes= $this->teams($atletas);
        $this->equipes = $this->getTeam($this->equipes);
        // dd($this->equipes);

    }

    public function teams($atletas){
        $combArrays = [];
        foreach ($atletas as $a) {
            foreach ($atletas as $b) {
                foreach ($atletas as $c) {
                    foreach ($atletas as $d) {
                        if ($a !== $b && $a !== $c && $a !== $d && $b !== $c && $b !== $d && $c !== $d) {
                            $combArrays[] = [$a, $b, $c, $d];
                        }
                    }
                }
            }
        }
        return $combArrays;
    }
    function getTeam($teams)
    {
        $allTeams = [];
        $arrayTeam = [];
        $title = 0;
        $time_total = 0;
                foreach ($teams as $team ){
                    $title += 1;
                    $athletes       = [];
                    $modality       = [];
                    $time_athlete   = [];
                    $mod=0;
                    foreach ($team as $key => $athlete) {
                        $mod +=1;
                        $time = Times::select('record','athlete_id','modality_id')
                            ->where('modality_id', $mod)
                            ->where('athlete_id', $athlete)
                            ->with(['athletes','modality'])
                            ->first();

                        if($time)
                        {
                            $time_total    += $this->timeToMilliseconds($time->record);
                            $athletes[]     = ($time->athlete_id ? $time->athletes->nick : 'Excluido');
                            $modality[]     = $time->modality->title;
                            $time_athlete[] = $time;
                            // $time_athlete[] = date('i', strtotime($time->record)).':'.number_format(date('s.u', strtotime($time->record)), 2, '.', '');
                        }
                    }
                    if (count($athletes) == 4) {
                        $arrayTeam = [
                            'time_total'    => $time_total,
                            // 'title'         => 'Equipe '.$title,
                            'team'          => $time_athlete,
                            // 'modality'      => $modality,
                            // 'time_athlete'  => $time_athlete
                        ];
                        $allTeams[]=$arrayTeam;
                    }
                    $time_total = 0;


                    if($title == 4){
                        break;
                    }

                }

        // return sort($allTeams,'title');
        return $this->array_msort($allTeams, array('time_total'=>SORT_ASC));
        // return $allTeams;

    }
    public function render()
    {
        return view('livewire.generate-teams');
    }
    function timeToMilliseconds($time) {
        $dateTime = new DateTime($time);
        $seconds = 0;
        $seconds += $dateTime->format('H') * 3600;
        $seconds += $dateTime->format('i') * 60;
        $seconds += $dateTime->format('s');

        $seconds = floatval($seconds . '.' . $dateTime->format('u'));

        return $seconds * 1000;
    }
    function array_msort($array, $cols)
    {
        $n=0;
        $colarr = array();
        foreach ($cols as $col => $order) {
            $colarr[$col] = array();
            foreach ($array as $k => $row) { $colarr[$col]['_'.$k] = strtolower($row[$col]); }
        }
        $eval = 'array_multisort(';
        foreach ($cols as $col => $order) {
            $eval .= '$colarr[\''.$col.'\'],'.$order.',';
        }
        $eval = substr($eval,0,-1).');';
        eval($eval);
        $ret = array();
        foreach ($colarr as $col => $arr) {
            foreach ($arr as $k => $v) {
                $k = substr($k,1);
                if (!isset($ret[$n])) $ret[$n] = $array[$k];
                $ret[$n][$col] = $array[$k][$col];
                $n+=1;
            }
        }
        return $ret;

    }
}
