<?php

namespace App\Models\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','active','category_id','name','min_age','max_age',
        'updated_by','created_by','code','type'
    ];
    // protected $casts = [
    //     'birth_year' => 'datetime:Y',
    // ];
    public function athletes($min,$max)
    {
        // Obter a data atual
        $nowYear = Carbon::now()->year;
        $min_year = Carbon::parse($nowYear . '-01-01');
        $max_year = Carbon::parse($nowYear . '-01-01');
        $min_year = $min_year->subYears($min)->year;
        $max_year = $max_year->subYears($max)->year;

        return Athletes::select('sex')->where('active', 1)
        ->whereBetween('birth', [$min_year . '-01-01', $max_year . '-12-31'])
        ->get();
    }
    public function getYearAttribute()
    {
        // Obter a data atual
        $nowYear = Carbon::now()->year;
        $dataAtual = Carbon::parse($nowYear . '-01-01');
        $dataAtual2 = Carbon::parse($nowYear . '-01-01');
        if ($this->min_age != $this->max_age) {
            return 'Nascidos entre: '. $dataAtual->subYears($this->min_age)->year .
            ' e '.$dataAtual2->subYears($this->max_age)->year;
        }else{
            return 'Nascidos em: '. $dataAtual->subYears($this->min_age)->year;
        }
    }
    public function getBirthYearAttribute()
    {
        // Obter a data atual
        $nowYear = Carbon::now()->year;
        $BirthYear = Carbon::parse($nowYear . '-01-01');
        return $BirthYear->subYears($this->min_age)->year;
    }
    public function getBirthYearEndAttribute()
    {
        // Obter a data atual
        $nowYear = Carbon::now()->year;
        $BirthYearEnd = Carbon::parse($nowYear . '-01-01');
        return $BirthYearEnd->subYears($this->max_age)->year;
    }

}
