<?php

namespace App\Imports;

use App\Models\Model\Categories;
use App\Models\Model\Times;
use Carbon\Carbon;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
class PlanilhaImport implements ToModel, WithHeadingRow
{
        protected $day;
        protected $modality_id;
        protected $type_time;
        protected $pool;
        protected $distance;
        protected $birth_year;
        protected $modality;
        protected $record;

        public function __construct($sheetConfigs)
        {
            $config = explode('_',$sheetConfigs);
            $this->type_time = $config[1];
            $this->birth_year = $config[3];
            $this->modality = $config[4];
            $this->pool = $config[5];
            $this->distance = $config[6];

            if($config[4] == 'medley'){
                $this->modality_id=array(1,2,3,4);
            }else{
                $this->modality_id=$this->modality;
            }
        }
    public function model(array $row)
    {
        $category = Categories::where('active',1)->where('birth_year',$this->birth_year)->first();
        // dd($row);
        if($row['id_atleta'] != "*" OR $row['id_atleta'] != ""){
            $this->day = $this->convertDay($row['dia_ddmmaaaa']);
            // dd($this->day);
            if (is_array($this->modality_id)) {
                for ($i=0; $i < 4; $i++) {

                    // dd($this->record);
                    if($this->record > 0){
                        switch ($this->modality_id[$i]) {
                            case 1:
                                $this->record = round($this->records($row['crawl_000000']), 2);
                            break;
                            case 2:
                                $this->record = round($this->records($row['borbo_000000']), 2);
                            break;
                            case 3:
                                $this->record = round($this->records($row['costa_000000']), 2);
                            break;
                            case 4:
                                $this->record = round($this->records($row['peito_000000']), 2);
                            break;
                        }
                        Times::create([
                            'athlete_id'    => $row['id_atleta'],
                            'modality_id'   => intval($this->modality_id[$i]),
                            'category_id'   => $category->id,
                            'distance'      => $this->distance,
                            'type_time'     => $this->type_time,
                            'pool'          => $this->pool,
                            'record'        => $this->record,
                            'day'           => $this->day,
                            'active'        => 1,
                            'code'          => Str::uuid(),
                            'created_by'    => Auth::user()->name,
                        ]);
                    }
                }
            }else{

                if($this->record > 0){
                    switch ($this->modality_id) {
                        case 1:
                            $this->record = round($this->records($row['crawl_000000']), 2);
                        break;
                        case 2:
                            $this->record = round($this->records($row['borbo_000000']), 2);
                        break;
                        case 3:
                            $this->record = round($this->records($row['costa_000000']), 2);
                        break;
                        case 4:
                            $this->record = round($this->records($row['peito_000000']), 2);
                        break;
                    }
                    Times::create([
                        'athlete_id'    => $row['id_atleta'],
                        'modality_id'   => intval($this->modality_id),
                        'category_id'   => $category->id,
                        'distance'      => $this->distance,
                        'type_time'     => $this->type_time,
                        'pool'          => $this->pool,
                        'record'        => $this->record,
                        'day'           => $this->day,
                        'active'        => 1,
                        'code'          => Str::uuid(),
                        'created_by'    => Auth::user()->name,
                    ]);
                }
            }
        }

        // dd($data);
    }
    //Converter o tempo vindo da planilha
    public function records($record)
    {
        if (is_numeric($record) && is_int((int) $record)) {
            // dd($record);
            return invertTime($record);
        } else {
            $valorFracionado = $record;
            $segundosEmUmDia = 24 * 60 * 60;

            $tempoEmSegundos = $valorFracionado * $segundosEmUmDia;

            $minutos = floor(($tempoEmSegundos % 3600) / 60);
            $segundos = $tempoEmSegundos % 60;

            $decimosSegundo = floor(($tempoEmSegundos - floor($tempoEmSegundos)) * 1000);

            return invertTime(sprintf('%02d:%02d,%02d',  $minutos, $segundos, $decimosSegundo));
        }

    }
    public function convertDay($day)
    {
        if (is_numeric($day) && is_int((int) $day)) {
            return date('Y-m-d', strtotime('1900-01-01 + ' . ($day - 2) . ' days'));
        } else {
            return implode("-",array_reverse(explode("/", $day)));
        }
    }
}
