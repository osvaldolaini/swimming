<?php

namespace App\Exports;


// use App\Models\Model\Athletes;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithProperties;

// use App\Models\Model\Times;

class PlanilhaExportView implements FromView, WithProperties
{
    protected $athletes;
    protected $modality;
    protected $title;
    public function __construct($athletes,$modality,$title)
    {
        $this->athletes = $athletes;
        $this->modality = $modality;
        $this->title = $title;
    }
    public function view(): View
    {
        return view('planilha-modelo-tempo', [
            'athletes' => $this->athletes,
            'modality' => $this->modality,
            'title' => $this->title
        ]);
    }
    public function properties(): array
    {
        return [
            'creator'        => Auth::user()->name,
        ];
    }
}
