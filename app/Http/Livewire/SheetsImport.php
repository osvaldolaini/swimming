<?php

namespace App\Http\Livewire;
use App\Imports\PlanilhaImport;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\Component;

use Livewire\WithFileUploads;
class SheetsImport extends Component
{
    use WithFileUploads;

    public $sheet;
    public $alertSession = false;
    //Fecha a caixa da mensagem
    public function closeAlert()
    {
        $this->alertSession = false;
    }
    public function render()
    {
        return view('livewire.sheets-import');
    }

    public function importExcel()
    {
        $this->validate([
            'sheet' => 'required|file|mimes:xlsx|max:2048',
        ]);

        $xlsx = $this->sheet->getClientOriginalName();
        $this->sheet->storeAs('imports/'.$xlsx);
        // dd(storage_path('imports/'.$xlsx));
        Excel::import(new PlanilhaImport($xlsx),storage_path('app/imports/'.$xlsx) );

        session()->flash('success', 'Planilha inserida com sucesso');
        $this->reset(
            'sheet'
        );


    }
}
