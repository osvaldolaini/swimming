<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PlanilhaExport;
use App\Exports\PlanilhaExportView;

use App\Models\Model\Athletes;
use App\Models\Model\Categories;
use App\Models\Model\Teams;
use Illuminate\Support\Facades\Auth;

class SheetsExport extends Component
{
    public $type_team = 'todos';
    public $distance = '50';
    public $pool = '25';
    public $type_time = 'tomada';
    public $modality = '1';
    public $teams;
    public $team_id;
    public $allAthletes;

    public function mount()
    {
        $this->teams = Teams::where('active', 1)->orderBy('min_age','asc')->get();
        $this->team_id = Teams::where('active', 1)->orderBy('min_age','asc')->first()->id;
    }

    public function render()
    {
        return view('livewire.sheets-export');
    }
    public function downloadExcel()
    {
        // return Excel::download(new PlanilhaExport(), 'planilha_modelo_tempos.xlsx');
        $name = 'planilha_'.$this->type_time.'_'.$this->type_team.'_'.$this->team_id.
        '_'.$this->modality.'_'.$this->pool.'_'.$this->distance.'_'.
        Auth::user()->team->id.'_excel';

        // if($this->birth_year != 'todas'){
            $team = Teams::find($this->team_id);
            $this->allAthletes = Athletes::where('active', 1)
            ->where('teams_configs_id',Auth::user()->team->id)
            ->whereBetween('birth', [$team->birth_year . '-01-01', $team->birth_year_end . '-12-31'])
            ->orderBy('name','desc')
            ->orderBy('sex','desc')
            ->get();
        // }else{
        //     $this->allAthletes = Athletes::where('active', 1)
        //     ->orderBy('name','desc')
        //     ->orderBy('sex','desc')
        //     // ->where('birth', 'LIKE', '%' . $this->birth_year . '%')
        //     ->get();
        // }

        if ($this->type_team != 'todos') {
            $this->allAthletes = $this->allAthletes->where('sex', $this->type_team);
        }

        if ($this->modality == 'medley')
        {
            $title = 'medley';
        }else{
            switch ($this->modality) {
                case 1:  $title ='Crawl'; break;
                case 2:  $title ='Borbo'; break;
                case 3:  $title ='Costa'; break;
                case 4:  $title ='Peito'; break;
            }
        }

        // dd($this->allAthletes);
        return Excel::download(
            new PlanilhaExportView(
                $this->allAthletes,
                $this->modality,
                $title
            ),
            $name.'.xlsx'
            );
    }
}
