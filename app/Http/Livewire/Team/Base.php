<?php

namespace App\Http\Livewire\Team;

use App\Models\Model\Athletes;
use App\Models\Model\Categories;
use App\Models\Model\Modalities;
use App\Models\Model\Relays;
use App\Models\Model\Teams;
use App\Models\Model\Times;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Base extends Component
{
    public $modalAthletes = false;
    public $modality = '1';
    public $category;
    public $allAthletes;
    public $filterA = array();
    public $filterName = array();
    public $birth;
    public $type_team = 'masculino';
    public $distance = '50';
    public $pool = '25';
    public $type_time = 'ambos';
    public $order = 'record';
    public $select_team = 'best';
    public $equipes;
    public $exceptions = array();
    public $num_teams = 4;
    public $modalidades;
    public $message = null;
    public $qtd_athletes = 12;
    public $combinations = 0;

    public $athleteAll;
    public $athleteM;
    public $athleteF;

    public $times;
    public $titles = 'Mirim à Junior';

    public $allTimesAthlete;

    public function mount()
    {
        $cat = Teams::where('active', 1)->where('type', 1)
            ->orderBy('min_age', 'asc')->first();
        $this->modalidades = Modalities::where('active', 1)->get();
        $this->category = Relays::where('active', 1)->where('type', 1)->orderBy('min_age', 'asc')->get();
        $this->birth = $cat->birth_year . '|' . $cat->birth_year_end;
        $this->times = Times::all();
    }
    public function render()
    {
        return view('livewire.team.base');
    }
    //Remover atletas
    public function filterAthletes($a_id)
    {
        if (in_array($a_id, $this->filterA)) {
            $a = Athletes::find($a_id)->name;
            $index = array_search($a_id, $this->filterA);
            $index2 = array_search($a, $this->filterName);
            if ($index !== false) {
                unset($this->filterA[$index]);
                unset($this->filterName[$index2]);
            }
        } else {
            $this->filterName[] = Athletes::find($a_id)->name;
            $this->filterA[] = $a_id;
        }

        $this->updated($this->filterA);
        $this->updated($this->filterName);
    }
    public function getfilterAthletes()
    {
        $birth_date = explode('|', $this->birth);
        //Ambos os sexos
        $this->allAthletes = Athletes::where('active', 1)
            ->where('teams_configs_id', Auth::user()->team->id)
            ->whereBetween('birth', [$birth_date[0] . '-01-01', $birth_date[1] . '-12-31'])
            ->get();
        if ($this->type_team != 'mista') {
            // $this->allAthletes = Athletes::where('active', 1)
            // ->get();
            $this->allAthletes = $this->allAthletes->where('sex', $this->type_team);
        }

        $this->equipes = [];
    }
    //zerar equipes
    public function cleanSearch()
    {
        $this->equipes = [];
        $this->combinations = 0;
    }
    //Função que monta as equipes
    public function generateTeams()
    {
        //Ambos os sexos
        if ($this->type_team == 'mista') {
            $this->qtd_athletes = 6;
        } else {
            $this->qtd_athletes = 12;
        }

        $this->equipes = array();

        //Pega os atletas e filtra os excluidos
        $this->getAthletes();

        // dd($this->athleteAll);
        //verifica se esses atletas tem tempo
        $this->testTime();

        //verifica se tem atletas suficientes
        if ($this->type_team != 'mista') {
            $calc = $this->athleteAll->count();
        } else {
            $calc = $this->athleteF->count() + $this->athleteM->count();
        }

        if ($calc < 4) {
            $this->message = 'Quantidade de atletas é insuficiente para montar uma equipe ou não existem atletas com tempos cadastrados!';
            return;
        } else {
            $this->message = null;
        }

        //Função que pega a equipe medley
        if ($this->modality == 'medley') {
            $atletas = $this->qtdMedley();
            $this->equipes = $this->medleyTeams($atletas);
        } else {
            $atletas = $this->qtdModality();
            //Função que pega a equipe por modalidade
            $this->equipes = $this->modalityTeams($atletas);
        }

        // dd($this->equipes);
        $this->combinations = count($this->equipes);
        // dd($this->combinations)
        //pega os tempos
        $this->getTimes();

        if(empty($this->allTimesAthlete))
        {
            $this->equipes = array();
            $this->message = 'Quantidade de atletas é insuficiente para montar uma equipe ou
            não existem atletas com parâmetros tempos cadastrados!';
            return;
        }

        $this->equipes = $this->getTeams($this->equipes);
        // dd($this->equipes);
        if ($this->select_team == 'best') {
            $this->equipes = $this->bestTeams($this->equipes);
        }
        // dd($this->equipes);

    }
    //Pega os atletas e filtra os excluidos
    public function getAthletes()
    {
        $birth_date = explode('|', $this->birth);
        //Pega os atletas por sexo
        if ($this->type_team == 'mista') {
            $this->athleteM = DB::table('athletes')->select('id')
                ->where('teams_configs_id', Auth::user()->team->id)
                ->where('sex', 'masculino')
                ->whereBetween('birth', [$birth_date[0] . '-01-01', $birth_date[1] . '-12-31'])
                ->pluck('id');
            $this->athleteF = DB::table('athletes')->select('id')
                ->where('teams_configs_id', Auth::user()->team->id)
                ->where('sex', 'feminino')
                ->whereBetween('birth', [$birth_date[0] . '-01-01', $birth_date[1] . '-12-31'])
                ->pluck('id');

            // Atletas removidos
            if ($this->filterA) {
                $this->athleteM = $this->athleteM->diff($this->filterA);
                $this->athleteM = $this->athleteM->values();

                $this->athleteF = $this->athleteF->diff($this->filterA);
                $this->athleteF = $this->athleteF->values();
            }
        } else {
            $this->athleteAll = DB::table('athletes')->select('id')
                ->where('teams_configs_id', Auth::user()->team->id)
                ->whereBetween('birth', [$birth_date[0] . '-01-01', $birth_date[1] . '-12-31'])
                ->where('sex', $this->type_team)
                ->pluck('id');
            // Atletas removidos
            if ($this->filterA) {
                $this->athleteAll = $this->athleteAll->diff($this->filterA);
                $this->athleteAll = $this->athleteAll->values();
            }
        }
    }
    //Verifica se esses atletas tem tempo
    public function testTime()
    {
        $reject = array();
        if ($this->type_team == 'mista') {
            foreach ($this->athleteF as $key) {
                //seleciona se o atleta ja nadou algo
                if ($this->type_time == 'ambos') {
                    $time = Times::select('id')
                        ->where('pool', $this->pool)
                        ->where('distance', $this->distance)
                        ->where('athlete_id', $key)
                        ->get();
                } else {
                    //filtra por tipo de tempo
                    $time = Times::select('id')
                        ->where('pool', $this->pool)
                        ->where('distance', $this->distance)
                        ->where('type_time', $this->type_time)
                        ->where('athlete_id', $key)
                        ->get();
                }

                if ($time->count() <= 0) {
                    // Se não tiver tempo registrado retira da equipe
                    $reject[] = $key;
                }
            }
            foreach ($this->athleteM as $key) {
                //seleciona se o atleta ja nadou algo
                if ($this->type_time == 'ambos') {
                    $time = Times::select('id')
                        ->where('pool', $this->pool)
                        ->where('distance', $this->distance)
                        ->where('athlete_id', $key)
                        ->get();
                } else {
                    //filtra por tipo de tempo
                    $time = Times::select('id')
                        ->where('pool', $this->pool)
                        ->where('distance', $this->distance)
                        ->where('type_time', $this->type_time)
                        ->where('athlete_id', $key)
                        ->get();
                }

                if ($time->count() <= 0) {
                    // Se não tiver tempo registrado retira da equipe
                    $reject[] = $key;
                }
            }
            if ($reject) {
                $this->athleteM = $this->athleteM->diff($reject);
                $this->athleteM = $this->athleteM->values();

                $this->athleteF = $this->athleteF->diff($reject);
                $this->athleteF = $this->athleteF->values();
            }
        } else {
            foreach ($this->athleteAll as $key) {
                //seleciona se o atleta ja nadou algo
                if ($this->type_time == 'ambos') {
                    $time = Times::select('id')
                        ->where('pool', $this->pool)
                        ->where('distance', $this->distance)
                        ->where('athlete_id', $key)
                        ->get();
                } else {
                    //filtra por tipo de tempo
                    $time = Times::select('id')
                        ->where('pool', $this->pool)
                        ->where('distance', $this->distance)
                        ->where('type_time', $this->type_time)
                        ->where('athlete_id', $key)
                        ->get();
                }
                // dd($time->count());
                if ($time->count() <= 0) {
                    // Se não tiver tempo registrado retira da equipe
                    $reject[] = $key;
                }
            }
            if ($reject) {
                $this->athleteAll = $this->athleteAll->diff($reject);
                $this->athleteAll = $this->athleteAll->values();
            }
        }
    }

    //Pega a equipe medley
    public function medleyTeams($atletas)
    {
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

    //Pega a equipe por modalidade
    public function modalityTeams($atletas)
    {
        $array1 = $atletas;
        $array2 = [];

        foreach ($array1 as $index => $value) {
            if ($index === 0) {
                $array2[$index] = $value;
            } else {
                $array2[$index] = strval($value);
            }
        }
        function combinacoesDe($n, $xs)
        {
            // dd($xs);
            if ($n === 0) {
                return array(array());
            }
            if (count($xs) === 0) {
                return array();
            }
            $x = $xs[0];
            $xs1 = array_slice($xs, 1);
            $res1 = combinacoesDe($n - 1, $xs1);
            for ($i = 0; $i < count($res1); $i++) {
                array_splice($res1[$i], 0, 0, $x);
            }
            $res2 = combinacoesDe($n, $xs1);
            return array_merge($res1, $res2);
        }
        return combinacoesDe(4, $array2);
    }

    //pega todas as combinações possíveis
    function getTeams($teams)
    {
        $allTeams = [];
        $arrayTeam = [];
        $title = 0;
        $time_total = 0;

        foreach ($teams as $team) {
            $title += 1;
            $athletes       = [];
            $time_athlete   = [];
            $ids            = [];
            $mod = 0;
            $sex = 0;

            foreach ($team as $key => $athlete) {

                // $mod +=1;
                if ($this->modality == 'medley') {
                    $mod += 1;
                } else {
                    $mod = $this->modality;
                }

                $time = $this->allTimesAthlete[$athlete][$mod];
                if (!$time) {
                    continue;
                }
                if ($time) {
                    if ($this->allTimesAthlete[$athlete]['sex'] == 'masculino') {
                        $sex += 1;
                    }

                    $time_total    += $time['record'];
                    $athletes[]     = ($this->allTimesAthlete[$athlete] ? $this->allTimesAthlete[$athlete]['nick'] : 'Excluido');
                    $ids[]          = $athlete;
                    $t = $this->allTimesAthlete[$athlete][$mod];
                    $time_athlete[] = [
                        'record'        => $t['record'],
                        'modality_id'   => $t['modality_id'],
                        'title'         => $t['title'],
                        'nick'         => $this->allTimesAthlete[$athlete]['nick'],
                    ];
                    // $time_athlete[] = date('i', strtotime($time->record)).':'.number_format(date('s.u', strtotime($time->record)), 2, '.', '');
                }
            }

            if (count($ids) == 4) {
                if ($this->type_team == 'mista') {
                    //Remove se existir mais de 2 meninos na equipe
                    if ($sex == 2) {
                        $arrayTeam = [
                            'time_total'    => $time_total,
                            'team'          => $time_athlete,
                            'ids'           => $ids,
                        ];
                    }
                } else {
                    $arrayTeam = [
                        'time_total'    => $time_total,
                        'team'          => $time_athlete,
                        'ids'           => $ids,
                    ];
                }

                // dd($allTeams);
                if (!empty($arrayTeam)) {
                $allTeams[] = $arrayTeam;
                }
            }
            $time_total = 0;
            // if($title == 8){
            //     break;
            // }
        }
        // dd($allTeams);
        return $this->array_msort(array_filter($allTeams), array('time_total' => SORT_ASC));
        // return $allTeams;
    }
    //Função que ordena pelo melhor tempo
    function array_msort($array, $cols)
    {
        $n = 0;
        $colarr = array();
        foreach ($cols as $col => $order) {
            $colarr[$col] = array();
            foreach ($array as $k => $row) {
                $colarr[$col]['_' . $k] = strtolower($row[$col]);
            }
        }
        $eval = 'array_multisort(';
        foreach ($cols as $col => $order) {
            $eval .= '$colarr[\'' . $col . '\'],' . $order . ',';
        }
        $eval = substr($eval, 0, -1) . ');';
        eval($eval);
        $ret = array();
        foreach ($colarr as $col => $arr) {
            foreach ($arr as $k => $v) {
                $k = substr($k, 1);
                if (!isset($ret[$n])) $ret[$n] = $array[$k];
                $ret[$n][$col] = $array[$k][$col];
                $n += 1;
            }
        }
        return $ret;
    }

    //Pega os melhores times
    function bestTeams($teams)
    {
        $result = array();
        $arrays_i = array();
        for ($i = 0; $i < count($teams); $i++) {
            $diff_i = in_array($teams[$i], $arrays_i); // Compara lista de excluidos
            if (!$diff_i) { // se não foi exluido
                $result[] = $teams[$i]; // Inseri os não excluidos ao resultado
                $arrays_i[] = $teams[$i]; // Inseri os não excluidos na lista de não pesquisar
                foreach ($teams[$i]['ids'] as $ids) {
                    for ($j = 0; $j < count($teams); $j++) {
                        $diff_j = in_array($teams[$j], $result); //Verifica se já está nos resultados
                        if (!$diff_j) {

                            $diff_k = in_array($teams[$j], $arrays_i); //Verifica se já está nos não pesquisáveis
                            if (!$diff_k) {
                                $diff = in_array(intval($ids), $teams[$j]['ids']);
                                if ($diff) {
                                    // echo '<p>';
                                    // print_r($teams[$j]['ids']);
                                    $arrays_i[] = $teams[$j];
                                }
                            }
                        }
                    }
                }
            }
        }
        // dd($result);
        return $result;
    }
    //Pega quantidade para montar as 3 melhores equipes
    public function qtdModality()
    {
        //Ambos os sexos
        if ($this->type_team == 'mista') {
            $bestsF = $this->qtdTeam($this->athleteF, $this->modality);
            $bestsM = $this->qtdTeam($this->athleteM, $this->modality);
            $bests = $bestsF->merge($bestsM);
        } else {
            $bests = $this->qtdTeam($this->athleteAll, $this->modality);
        }
        return $bests;
        // dd($bests);
    }

    //Pega quantidade para montar as 3 melhores equipes
    public function qtdMedley()
    {
        //Ambos os sexos
        if ($this->type_team == 'mista') {
            $this->qtd_athletes = 4;
            $bestsLF = $this->qtdTeam($this->athleteF, 1);
            $bestsBF = $this->qtdTeam($this->athleteF, 2);
            $bestsCF = $this->qtdTeam($this->athleteF, 3);
            $bestsPF = $this->qtdTeam($this->athleteF, 4);

            $bestsLM = $this->qtdTeam($this->athleteM, 1);
            $bestsBM = $this->qtdTeam($this->athleteM, 2);
            $bestsCM = $this->qtdTeam($this->athleteM, 3);
            $bestsPM = $this->qtdTeam($this->athleteM, 4);

            $bestsF = $bestsLF->merge($bestsBF)->merge($bestsCF)->merge($bestsPF);
            $bestsM = $bestsLM->merge($bestsBM)->merge($bestsCM)->merge($bestsPM);

            $bests = $bestsF->merge($bestsM);
        } else {
            // $this->qtd_athletes = 11;
            $bestsL = $this->qtdTeam($this->athleteAll, 1);
            $bestsB = $this->qtdTeam($this->athleteAll, 2);
            $bestsC = $this->qtdTeam($this->athleteAll, 3);
            $bestsP = $this->qtdTeam($this->athleteAll, 4);
            $bests = $bestsL->merge($bestsB, $bestsC, $bestsP);
        }
        //    dd($bests->unique());
        return $bests->unique();
    }
    public function qtdTeam($atletas, $modality)
    {
        $bests = collect();
        $aTimes = array();
        foreach ($atletas as $key) {
            $time = Times::select('record', 'athlete_id')
                ->where('pool', $this->pool)
                ->where('distance', $this->distance)
                ->where('athlete_id', $key)
                ->where('modality_id', $modality)
                ->orderBy('record', 'asc')
                ->first();
            if ($time) {
                $aTimes[$time->athlete_id] = $time->record;
            }
        }
        array_filter($aTimes);
        // return array_slice($aTimes, 0, 8, true);
        asort($aTimes);
        if (count($atletas) < $this->qtd_athletes) {
            $this->qtd_athletes = count($atletas);
        }
        // dd(array_slice($aTimes, 0, 8, true));
        foreach (array_slice($aTimes, 0, $this->qtd_athletes, true) as $key => $value) {
            $bests->push($key);
        }
        // dd( $this->qtd_athletes);
        return $bests;
    }

    public function getTimes()
    {
        $allTimesAthlete=array();
        // Mesclar todas as arrays internas em uma única array
        $mergedArray = call_user_func_array('array_merge', $this->equipes);
        // Remover duplicatas mantendo as chaves
        $uniqueIds = array_unique($mergedArray);
        // Reindexar as chaves da array resultante
        $uniqueIds = array_values($uniqueIds);
        foreach ($uniqueIds as $key => $value) {
            if ($this->modality == 'medley') {
                for ($mod=1; $mod < 5; $mod++) {
                    $time = $this->getTime($mod,$value);
                    if($time){
                        $allTimesAthlete[$value][$mod] = [
                            'record' => $time->record,
                            'modality_id' => $time->modality_id,
                            'title' => $time->modality->title,
                        ];
                        $allTimesAthlete[$value]['record']=$time->record;
                        $allTimesAthlete[$value]['sex']=$time->athletes->sex;
                        $allTimesAthlete[$value]['nick']=$time->athletes->nick;
                    }else{
                        $allTimesAthlete[$value][$mod] = null;
                    }
                }
            } else {
                $mod = $this->modality;
                $time = $this->getTime($mod,$value);
                if($time){
                    $allTimesAthlete[$value][$mod] = [
                        'record'        => $time->record,
                        'modality_id'   => $time->modality_id,
                        'title'         => $time->modality->title,
                    ];
                    $allTimesAthlete[$value]['sex']=$time->athletes->sex;
                    $allTimesAthlete[$value]['nick']=$time->athletes->nick;
                }
            }
        }
        $this->allTimesAthlete = $allTimesAthlete;
        // dd($this->allTimesAthlete);
    }
    public function getTime($mod,$value)
    {
        if ($this->order == 'record') {
            $o = 'asc';
            $order = 'record';
            $operador = '<=';
            $day = date('Y').'-12-31';
        }
        if ($this->order == 'day') {
            $o = 'desc';
            $order = 'day';
            $operador = '<=';
            $day = date('Y').'-12-31';
        }
        if ($this->order == 'year') {
            $o = 'desc';
            $order = 'day';
            $operador = 'LIKE';
            $day = '%'.date('Y').'%';
        }
        if ($this->type_time != 'ambos') {
            $time = Times::select('record', 'athlete_id', 'modality_id')
                ->with(['athletes', 'modality'])
                ->where('pool', $this->pool)
                ->where('distance', $this->distance)
                ->where('type_time', $this->type_time)
                ->where('modality_id', $mod)
                ->where('athlete_id', $value)
                ->where('day',$operador, $day)
                ->orderBy($order, $o)
                ->first();
        } else {
            $time = Times::select('record', 'athlete_id', 'modality_id')
                ->with(['athletes', 'modality'])
                ->where('pool', $this->pool)
                ->where('distance', $this->distance)
                ->where('modality_id', $mod)
                ->where('athlete_id', $value)
                ->where('day',$operador, $day)
                ->orderBy($order, $o)
                ->first();
        }
        return $time;
    }
}
