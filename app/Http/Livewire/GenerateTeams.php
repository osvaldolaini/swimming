<?php

namespace App\Http\Livewire;

use App\Models\Model\Athletes;
use App\Models\Model\Categories;
use App\Models\Model\Modalities;
use App\Models\Model\Times;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GenerateTeams extends Component
{
    public $modality = 'livre';
    public $category;
    public $birth_year;
    public $type_team = 'masculino';
    public $distance = '50';
    public $pool = '25';
    public $type_time = 'ambos';
    public $order = 'day';
    public $select_team = 'best';
    public $equipes;
    public $num_teams = 4;
    public $modalidades;
    public $message = null;

    public $times;

    public function mount()
    {
        $this->modalidades = Modalities::where('active', 1)->get();
        $this->category = Categories::where('active', 1)->get();
        $this->birth_year = Categories::where('active', 1)->first()->birth_year;
        $this->times = Times::all();

    }
    public function render()
    {
        return view('livewire.generate-teams');
    }
    //zerar equipes
    public function cleanSearch()
    {
        $this->equipes = [];
    }
    //Função que monta as equipes
    public function generateTeams()
    {

        $this->equipes = array();
        $atletas = $this->getAthletes();
        // dd($atletas );
        if($atletas->count() < 4){
            $this->message = 'Quantidade de atletas é insuficiente para montar uma equipe!';
            return;
        }else{
            $this->message = null;
        }
        // dd($atletas);
        //Função que pega a equipe medley
        if ($this->modality == 'medley') {
            $this->equipes= $this->medleyTeams($atletas);
        }else{
            //Função que pega a equipe por modalidade
            $this->equipes = $this->modalityTeams($atletas);
        }
        // dd($this->equipes);
        $this->equipes = $this->getTeams($this->equipes);

        if($this->select_team == 'best'){
            $this->equipes = $this->bestTeams($this->equipes);
        }
        // dd($this->equipes);

    }
    public function getAthletes()
    {
         //Ambos os sexos
         if ($this->type_team == 'mista') {
            $atletas = DB::table('athletes')->select('id')
            ->where('birth', 'LIKE', '%' . $this->birth_year . '%')
            ->pluck('id');
        }else{
        //Pega os atletas por sexo
            $atletas = DB::table('athletes')->select('id')
            ->where('birth', 'LIKE', '%' . $this->birth_year . '%')
            ->where('sex', $this->type_team)
            ->pluck('id');
        }
        $athletes = collect();
        foreach ($atletas as $key) {
            //seleciona se o atleta ja nadou algo
            if ($this->type_time == 'ambos') {
                $time = Times::select('id')
                ->where('pool',$this->pool)
                ->where('distance',$this->distance)
                ->where('athlete_id', $key)
                ->get();
            }else{
                //filtra por tipo de tempo
                $time = Times::select('id')
                ->where('pool',$this->pool)
                ->where('distance',$this->distance)
                ->where('type_time',$this->type_time)
                ->where('athlete_id', $key)
                ->get();
            }
            if ($time->count() > 0) {
                $athletes->push($key);
            }
        }

        return $athletes ;
    }

    //Pega a equipe medley
    public function medleyTeams($atletas){
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
                foreach ($teams as $team ){
                    $title += 1;
                    $athletes       = [];
                    $time_athlete   = [];
                    $ids            = [];
                    $mod=0;
                    $sex=0;
                    foreach ($team as $key => $athlete) {
                        // $mod +=1;
                        if ($this->modality == 'medley') {
                            $mod +=1;
                        }elseif($this->modality == 'livre') {
                            $mod = 1;
                        }else{
                            $mod = $this->modality;
                        }
                        if ($this->type_time != 'ambos') {
                            $time = Times::select('record','athlete_id','modality_id')
                            ->with(['athletes','modality'])
                            ->where('pool',$this->pool)
                            ->where('distance',$this->distance)
                            ->where('type_time',$this->type_time)
                            ->where('modality_id', $mod)
                            ->where('athlete_id', $athlete)
                            ->orderBy($this->order,'asc')
                            ->first();
                        }else{
                            $time = Times::select('record','athlete_id','modality_id')
                            ->with(['athletes','modality'])
                            ->where('pool',$this->pool)
                            ->where('distance',$this->distance)
                            ->where('modality_id', $mod)
                            ->where('athlete_id', $athlete)
                            ->orderBy($this->order,'asc')
                            ->first();
                        }
                        if($time)
                        {
                            if ($time->athletes->sex == 'masculino') {
                                $sex+=1;
                            }
                            $time_total    += $time->record;
                            $athletes[]     = ($time->athlete_id ? $time->athletes->nick : 'Excluido');
                            $ids[]          = $athlete;
                            $time_athlete[] = $time;
                            // $time_athlete[] = date('i', strtotime($time->record)).':'.number_format(date('s.u', strtotime($time->record)), 2, '.', '');
                        }
                    }
                    if (count($athletes) == 4) {
                        if ($this->type_team == 'mista') {
                            //Remove se existir mais de 2 meninos na equipe
                            if ($sex == 2) {
                                $arrayTeam = [
                                    'time_total'    => $time_total,
                                    'team'          => $time_athlete,
                                    'ids'           => $ids,
                                ];
                            }
                        }else{
                            $arrayTeam = [
                                'time_total'    => $time_total,
                                'team'          => $time_athlete,
                                'ids'           => $ids,
                            ];
                        }

                        $allTeams[]=$arrayTeam;
                    }
                    $time_total = 0;
                    // if($title == 8){
                    //     break;
                    // }
                }
                return $this->array_msort($allTeams, array('time_total'=>SORT_ASC));
        // return $allTeams;
    }
    //Função que ordena pelo melhor tempo
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

    function bestTeams($teams)
    {

        // $teams = array(
        //     array(
        //         'ids' => array(2, 8, 4, 10),
        //         'time_total' => 582.01,
        //         'team' => array(),
        //     ),
        //     array(
        //         'ids' => array(15, 16, 11, 22),
        //         'time_total' => 581.03,
        //         'team' => array(),
        //     ),
        //     array(
        //         'ids' => array(9, 4, 6, 7),
        //         'time_total' => 582.20,
        //         'team' => array(),
        //     ),
        //     array(
        //         'ids' => array(5, 7, 20, 11),
        //         'time_total' => 582.34,
        //         'team' => array(),
        //     ),
        //     array(
        //         'ids' => array(101, 60, 233, 100),
        //         'time_total' => 581.33,
        //         'team' => array(),
        //     )
        // );

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
                            if (!$diff_j){

                                $diff_k = in_array($teams[$j], $arrays_i); //Verifica se já está nos não pesquisáveis
                                if (!$diff_k){
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
            // break;
        }

        // dd($result);
        return $result;
    }
}
