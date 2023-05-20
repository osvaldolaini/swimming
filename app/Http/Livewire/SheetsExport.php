<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PlanilhaExport;
use App\Exports\PlanilhaExportView;

use App\Models\Model\Athletes;
use App\Models\Model\Categories;

class SheetsExport extends Component
{
    public $type_team = 'todos';
    public $distance = '50';
    public $pool = '25';
    public $type_time = 'tomada';
    public $modality = '1';
    public $category;
    public $birth_year = 'todas';
    public $allAthletes;

    public function mount()
    {
        $this->category = Categories::where('active', 1)->orderBy('birth_year','desc')->get();
    }

    public function render()
    {
        return view('livewire.sheets-export');
    }
    public function downloadExcel()
    {
        // return Excel::download(new PlanilhaExport(), 'planilha_modelo_tempos.xlsx');
        $name = 'planilha_'.$this->type_time.'_'.$this->type_team.'_'.$this->birth_year.'_'.$this->modality.'_'.$this->pool.'_'.$this->distance;

        if($this->birth_year != 'todas'){
            $this->allAthletes = Athletes::where('active', 1)
            ->where('birth', 'LIKE', '%' . $this->birth_year . '%')
            ->get();
        }else{
            $this->allAthletes = Athletes::where('active', 1)
            // ->where('birth', 'LIKE', '%' . $this->birth_year . '%')
            ->get();
        }

        if ($this->type_team != 'todos') {
            $this->allAthletes = $this->allAthletes->where('sex', $this->type_team);
        }

        if ($this->modality == 'medley')
        {
            $title = 'medley';
        }else{
            switch ($this->modality) {
                case 1:  $title ='Craw'; break;
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
