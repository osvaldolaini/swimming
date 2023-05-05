<?php

namespace App\Http\Livewire;

use App\Models\Model\Athletes;
use App\Models\Model\Categories;
use App\Models\Model\Modalities;
use App\Models\Model\Times;
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


        $this->getTeam();
        dd($this->equipes);

        foreach ($atletas as $a) {
            foreach ($atletas as $b) {
                foreach ($atletas as $c) {
                    foreach ($atletas as $d) {
                        if ($a !== $b && $a !== $c && $a !== $d && $b !== $c && $b !== $d && $c !== $d) {
                            $this->equipes[] = [$a, $b, $c, $d];
                        }
                    }
                }
            }
        }
        // $combArrays = [];

        // foreach ($combinacoes as $cbb) {
        //     for ($i = 0; $i < 330; $i++) {
        //         $novaArray = $cbb;
        //         array_unshift($novaArray, array_pop($novaArray));
        //         $combArrays[] = $novaArray;
        //     }
        // }


        // foreach ($resultado as $key) {
        //     $this->equipes[] = array_unique($key);
        // }
        // $this->equipes = $resultado;

        // foreach ($resultado as $c) {
        //     $atletas = DB::table('athletes')->whereIn('id', $c)
        //         ->pluck('id');
        //     $tempo_total = '00:00:00';
        //     $tempo_modalidades = array();
        //     foreach ($this->modalidades as $m) {
        //         // $tempos = DB::table('times')->whereIn('athlete_id', $atletas)
        //         //     ->where('modality_id', $m->id)
        //         //     ->orderBy('athlete_id')->take(4)->get();

        //         $tempo_modalidades[] = Times::select('record', 'modality_id', 'athlete_id')->get();
        //         // $tempo_modalidade = '00:00:00';
        //         // foreach ($tempos as $t) {
        //         //     $tempo_modalidade = $this->somarTempo($tempo_modalidade, $t);
        //         // }
        //         // $tempo_total = $this->somarTempo($tempo_total, $tempo_modalidade);
        //     }
        //     $this->equipes[] = array(
        //         'atletas' => $atletas,
        //         'modalidades' => $this->modalidades,
        //         'tempos_modalidades' => $tempo_modalidades,
        //         // 'tempo_total' => $tempo_total
        //     );
        // }
        // dd($this->equipes);
    }


    function somarTempo($t1, $t2)
    {
        $timestamp1 = strtotime($t1);
        $timestamp2 = strtotime($t2);
        $segundos = $timestamp1 + $timestamp2 - strtotime('00:00:00');
        $resultado = date('H:i:s', $segundos);
        return $resultado;
    }
    // function combinations($qtd,$atletas){
    //     function combinations($arr, $k) {
    //         if ($k == 0) {
    //             return [[]];
    //         }
    //         if (count($arr) == 0) {
    //             return [];
    //         }
    //         $x = array_shift($arr);
    //         $combs = [];
    //         foreach (combinations($arr, $k - 1) as $comb) {
    //             array_unshift($comb, $x);
    //             $combs[] = $comb;
    //         }
    //         foreach (combinations($arr, $k) as $comb) {
    //             $combs[] = $comb;
    //         }
    //         return $combs;

    //     // if ($qtd === 0)
    //     //         return array(array());
    //     //     if (count($atletas) === 0)
    //     //         return array();
    //     //     $x = $atletas[0];
    //     //     $atletas1 = array_slice($atletas,1,count($atletas)-1);
    //     //     $res1 = combinations($qtd-1,$atletas1);
    //     //     for ($i = 0; $i < count($res1); $i++) {
    //     //         array_splice($res1[$i], 0, 0, $x);
    //     //     }
    //     //     $res2 = combinations($qtd,$atletas1);
    //     //     return array_merge($res1, $res2);

    //     // // $n = count($atletas);
    //     // // $combos = array();
    //     // // for ($i = 0; $i < $n - 3; $i++) {
    //     // //     for ($j = $i + 1; $j < $n - 2; $j++) {
    //     // //         for ($k = $j + 1; $k < $n - 1; $k++) {
    //     // //             for ($l = $k + 1; $l < $n; $l++) {
    //     // //                 $equipe = array($atletas[$i], $atletas[$j], $atletas[$k], $atletas[$l]);
    //     // //                 $combos[] = $equipe;
    //     // //             }
    //     // //         }
    //     // //     }
    //     // // }
    //     // // return $combos;
    // }


    // public function equipes($atletas)
    // {
    //     $array1 = $atletas;
    //     $array2 = [];

    //     foreach ($array1 as $index => $value) {
    //         if ($index === 0) {
    //             $array2[$index] = $value;
    //         } else {
    //             $array2[$index] = strval($value);
    //         }
    //     }

    //     function combinacoesDe($k, $xs)
    //     {
    //         if ($k === 0)
    //             return array(array());
    //         if (count($xs) === 0)
    //             return array();
    //         $x = $xs[0];
    //         $xs1 = array_slice($xs, 1, count($xs) - 1);
    //         $res1 = combinacoesDe($k - 1, $xs1);
    //         for ($i = 0; $i < count($res1); $i++) {
    //             array_splice($res1[$i], 0, 0, $x);
    //         }
    //         $res2 = combinacoesDe($k, $xs1);
    //         return array_merge($res1, $res2);
    //     }

    //     $comb = combinacoesDe(4, $array2);
    //     return $comb;
    // }
    // function combinacoesDeTodos($atletas)
    // {
    //     $array1 = $atletas;
    //     $atletas = [];

    //     foreach ($array1 as $index => $value) {
    //         if ($index === 0) {
    //             $atletas[$index] = $value;
    //         } else {
    //             $atletas[$index] = strval($value);
    //         }
    //     }
    //     $comb = array();
    //     $n = count($atletas);
    //     for ($i = 0; $i < $n; $i++) {
    //         $atleta = $atletas[$i];
    //         $resto = array_slice($atletas, 0, $i) + array_slice($atletas, $i + 1);
    //         $combs = combinacoesDe($n - 1, $resto);
    //         foreach ($combs as $c) {
    //             // array_unshift($c, $atleta);
    //             $comb[] = $c;
    //         }
    //     }
    //     // return $comb;
    // }

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
    public function render()
    {
        return view('livewire.generate-teams');
    }
}
