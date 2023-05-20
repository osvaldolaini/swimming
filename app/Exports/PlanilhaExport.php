<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;

class PlanilhaExport implements FromView, WithHeadings, ShouldAutoSize
{
    protected $opcoes;

    public function __construct($opcoes)
    {
        $this->opcoes = $opcoes;
    }

    public function view(): View
    {
        // Retorne a view que será utilizada para gerar a planilha
        return view('planilha-modelo-tempo', [
            'opcoes' => $this->opcoes,
        ]);
    }

    public function headings(): array
    {
        // Defina os títulos das colunas da planilha, incluindo a coluna das opções
        return [
            'Coluna 1',
            'Coluna 2',
            'Opções',
        ];
    }
}
