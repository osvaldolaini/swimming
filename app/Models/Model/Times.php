<?php

namespace App\Models\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Times extends Model
{
    use HasFactory;

    protected $fillable = [
        'athlete_id', 'category_id', 'record','recordConverte',
        'modality_id', 'day', 'id','teams_configs_id',
        'pool', 'distance', 'type_time',
        'updated_by', 'created_by', 'code'
    ];

    protected $casts = [
        'day' => 'datetime:Y-m-d',
    ];

    public function athletes()
    {
        return $this->belongsTo(Athletes::class, 'athlete_id', 'id');
    }

    public function modality()
    {
        return $this->belongsTo(Modalities::class);
    }
    public function dayMonth()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->day)
            ->format('d/m/Y');
    }

    public function getTypeTimeAttribute($value)
    {
        switch ($value) {
            case 'tomada':
                $convert = 'Tomada de tempo';
                break;
            case 'prova':
                $convert = 'Prova';
                break;

            default:
                $convert = '';
                break;
        }
        return $convert;
    }
    public function getConvertTypeAttribute($value)
    {
        switch ($value) {
            case 'Tomada de tempo':
                $convert = 'tomada';
                break;
            case 'Prova':
                $convert = 'prova';
                break;

            default:
                $convert = '';
                break;
        }
        return $convert;
    }
    public function getRecordConvertAttribute($value)
    {
        $time = explode('.', $this->record);
        if ($time[0] > 0) {
            $seconds = intval($time[0]); //Converte para inteiro

            $mins = floor($seconds / 60);
            $secs = floor($seconds % 60);

            if (isset($time[1])) {
                $sign = sprintf('%02d:%02d', $mins, $secs) . ',' . $time[1];
            } else {
                $sign = sprintf('%02d:%02d', $mins, $secs) . ',00';
            }
        } else {
            $sign = '00:00,' . $time[1];
        }

        return $sign;
    }

    public function getDayAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)
            ->format('d/m/Y');
    }
    public function scopeFilterFields($query, $filters)
    {
        foreach ($filters as $key => $value) {
            if ($key == 'record') {
                $tempo = preg_replace('/[^0-9:,.]/', '', $value);
                $tempo = str_replace(',', '.', $tempo);
                $partesTempo = explode(':', $tempo);
                $partesTempo = array_map('floatval', $partesTempo);
                $totalPartes = count($partesTempo);
                if ($totalPartes === 1) {
                    $partesTempo = [0, $partesTempo[0]];
                    $totalPartes = 2;
                }
                if ($totalPartes === 2 && $partesTempo[0] === 0) {
                    $converted = $partesTempo[1];
                    return array('f'=>'LIKE','converted'=>'%' . $converted . '%');
                } elseif ($totalPartes === 2) {
                    $converted = ($partesTempo[0] * 60) + $partesTempo[1];
                    return array('f'=>'LIKE','converted'=>'%' . $converted . '%');
                } elseif ($totalPartes >= 3) {
                    $converted = ($partesTempo[0] * 60) + $partesTempo[1] + ($partesTempo[2] / 100);
                    return array('f'=>'REGEXP','converted'=>'^' . $converted . '$');
                }
            }
            if($key == 'day'){
                if (substr_count($value, " ") === 1) {
                    $partesSpace = explode(" ", $value);
                    if (substr_count($partesSpace[0], "/") === 1) {
                        $partes = explode("/", $partesSpace[0]);
                        $converted = $partes[1] . "%-" . $partes[0] . "% " . $partesSpace[1];
                    } elseif (substr_count($partesSpace[0], "/") === 2) {
                        $partes = explode("/", $partesSpace[0]);
                        $converted = $partes[2] . "%-" . $partes[1] . "-" . $partes[0] . "% " . $partesSpace[1];
                    } else {
                        $converted = $value;
                    }
                } else {
                    if (substr_count($value, "/") === 1) {
                        $partes = explode("/", $value);
                        $converted = $partes[1] . "%-" . $partes[0];
                    } elseif (substr_count($value, "/") === 2) {
                        $partes = explode("/", $value);
                        $converted = $partes[2] . "%-" . $partes[1] . "-" . $partes[0];
                    } else {
                        $converted = $value;
                    }
                }
                return array('f'=>'LIKE','converted'=>'%' . $converted . '%');
            }
        }
    }
}
