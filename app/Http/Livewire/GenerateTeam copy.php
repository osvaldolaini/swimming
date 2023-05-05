<?php

namespace App\Http\Livewire;

use App\Models\Model\Categories;
use App\Models\Model\Modalities;
use App\Models\Model\Times;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

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

    public function mount()
    {
        //$this->modality = Modalities::where('active',1)->get();
        $this->category = Categories::where('active',1)->get();
        $this->birth_year = Categories::where('active',1)->first()->birth_year;
    }
    public function render()
    {
        return view('livewire.generate-team');
    }

public function generateMedleyTeams()
{

}
    function generateTeams($category_id, $modality_id, $num_teams) {
        $athletes = DB::table('athletes')
                      ->where('category_id', $category_id)
                      ->pluck('id')
                      ->toArray();

        $num_athletes = count($athletes);
        $team_size = 4;

        if ($num_athletes < $team_size) {
            throw new Exception('Não há atletas suficientes na categoria para formar uma equipe completa');
        }

        $num_iterations = $num_teams * 100;
        $results = [];
        $teams = [];

        for ($i = 0; $i < $num_iterations; $i++) {
            shuffle($athletes);
            $team = array_slice($athletes, 0, $team_size);

            if (in_array($team, $teams)) {
                continue;
            }

            $teams[] = $team;

            $times = DB::table('times')
                       ->whereIn('athlete_id', $team)
                       ->where('modality_id', $modality_id)
                       ->orderBy('record', 'asc')
                       ->limit($team_size)
                       ->pluck('record')
                       ->toArray();

            if (count($times) < $team_size) {
                continue;
            }

            $total_time = array_sum($times);
            $time_formatted = gmdate('H:i:s', $total_time);

            $modalidades = [];
            foreach($team as $atleta_id) {
                $modalidade = DB::table('times')
                                ->where('athlete_id', $atleta_id)
                                ->where('modality_id', $modality_id)
                                ->pluck('record')
                                ->first();

                $modalidades[] = DB::table('modalities')
                                    ->where('id', $modality_id)
                                    ->pluck('name')
                                    ->first();
            }

            $results[] = [
                'atleta' => $team,
                'modalidade' => $modalidades,
                'tempo' => $times,
                'tempo_total' => $time_formatted,
            ];

            if (count($results) >= $num_teams) {
                break;
            }
        }

        if (empty($results)) {
            throw new Exception('Não foi possível gerar equipes com os dados informados');
        }

        return $results;
    }


    public function gerarNew()
    {

            $categorias = DB::table('categories')->get();
            $modalidades = DB::table('modalities')->where('active', 1)->get();
            $atletas = DB::table('athletes')->where('sex', 'feminino')->get();

            $this->bestTimes = [];

            foreach ($categorias as $categoria) {
                foreach ($modalidades as $modalidade) {
                    $atletasCategoria = $atletas->pluck('id')->toArray();
                    $atletasModalidade = DB::table('times')
                        ->where('category_id', $categoria->id)
                        ->where('modality_id', $modalidade->id)
                        ->whereIn('athlete_id', $atletasCategoria)
                        ->orderBy('record')
                        ->take(4)
                        ->pluck('athlete_id')
                        ->toArray();

                        // dd($atletasModalidade );
                    if (count($atletasModalidade) == 4) {
                        $this->bestTimes[] = [
                            'categoria' => $categoria->name,
                            'modalidade' => $modalidade->title,
                            'atletas' => $atletasModalidade,
                            'tempo_total' => DB::table('times')
                                ->where('category_id', $categoria->id)
                                ->where('modality_id', $modalidade->id)
                                ->whereIn('athlete_id', $atletasModalidade)
                                ->sum('record')
                        ];
                    }
                }
            }

            usort($this->bestTimes, function($a, $b) {
                return $a['tempo_total'] - $b['tempo_total'];
            });

            dd($this->bestTimes );
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
            $this->bestTimes = Times::whereHas('athletes', function (Builder $query) {
                $query->where('sex', $this->type_team);
                if ($this->birth_year) {
                    $query->where('birth', 'LIKE', '%'.$this->birth_year.'%');
                }
            })
            ->where('modality_id',1)
            ->orderBy('record')
            ->get();
        }else{
            $this->bestTimes = Times::whereHas('athletes', function (Builder $query) {
                $query->where('sex', $this->type_team);
                if ($this->birth_year) {
                    $query->where('birth', 'LIKE', '%'.$this->birth_year.'%');
                }
            })
            ->orderBy('record')
            ->get();
        }

    }
    public function misto()
    {
        if ($this->modality == 'livre') {
            $this->bestTimes = Times::whereHas('athletes', function (Builder $query) {
                if ($this->birth_year) {
                    $query->where('birth', 'LIKE', '%'.$this->birth_year.'%');
                }
            })
            ->where('modality_id',1)
            ->orderBy('record')
            ->get();
        }else{
            $this->bestTimes = Times::whereHas('athletes', function (Builder $query) {
                if ($this->birth_year) {
                    $query->where('birth', 'LIKE', '%'.$this->birth_year.'%');
                }
            })
            ->orderBy('record')
            ->get();
        }
    }
}


