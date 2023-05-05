<?php

namespace App\Http\Livewire;

use App\Models\Model\Athletes;
use App\Models\Model\Categories;
use App\Models\Model\Modalities;
use App\Models\Model\Times;
use DateTime;
use Exception;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Collection;
use Math_Combinatorics;

class GenerateTeam extends Component
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
        $atletas = DB::table('athletes')
            ->where('birth', 'LIKE', '%' . $this->birth_year . '%')
            ->where('sex', $this->type_team)
            ->pluck('id');


        $this->equipes= $this->teams($atletas);
        $this->equipes = $this->getTeam($this->equipes);

        dd($this->equipes);
    }


    function somarTempo($t1, $t2)
    {
        $timestamp1 = strtotime($t1);
        $timestamp2 = strtotime($t2);
        $segundos = $timestamp1 + $timestamp2 - strtotime('00:00:00');
        $resultado = date('H:i:s', $segundos);
        return $resultado;
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
                foreach ($teams as $team ){
                    $title += 1;
                    $athletes       = [];
                    $modality       = [];
                    $time_athlete   = [];
                    $mod=0;
                    foreach ($team as $key => $athlete) {
                        $mod +=1;
                        $time = Times::where('modality_id', $mod)
                            ->where('athlete_id', $athlete)
                            ->with(['athletes','modality'])
                            ->first();
                        $t = number_format(date('H:i:s.u', strtotime($time->record)), 2, '.', '');
                        $athletes[]     = $time->athletes->nick;
                        $modality[]     = $time->modality->title;
                        $time_athlete[] = $this->t;
                    }

                    $arrayTeam = [
                        'title'         => 'Equipe '.$title,
                        'team'          => $athletes,
                        'modality'      => $modality,
                        'time_athlete'  => $time_athlete
                    ];
                    $allTeams[]=$arrayTeam;
                    break;
                }


        return $allTeams;
            // @endphp
            // <p>Equipe {{ $team }}</p>
            //     @foreach ($equipe as $key => $atleta)
            //     @php
            //     $tempo_total = 0;
            //     $mod = $key + 1;
            // @endphp

                // <p>
                //     @php
                //             $time = $times
                //             ->where('modality_id', $mod)
                //             ->where('athlete_id', $atleta)
                //             ->first();
                //             // $tempo_total += date('H:i:s', strtotime($time->record));
                //     @endphp

                //     @if ($time)
                //         {{ $time->athletes->nick }}
                //         - {{ $time->modality->title }}
                //         @php
                //             $tb = explode(':', date('H:i:s', strtotime($time->record)));
                //         @endphp
                //         {{ $tb[0] }}:{{ $tb[1] }},{{ $tb[2] }}
                //     @endif

                // </p>
                // @endforeach

                //     <br/><br/>
                // @endforeach


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
}
