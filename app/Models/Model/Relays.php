<?php

namespace App\Models\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relays extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','category_id','type','active','min_age',
        'max_age','type','old_min','old_max',
        'updated_by','created_by','code','name'
    ];

    public function athletes($birth)
    {
        return Athletes::where('active', 1)
        ->where('birth', 'LIKE', '%' . $birth. '%')
        ->orderBy('sex','asc')->orderBy('name','asc')
        ->get();
    }
    public function getTypeAttribute($value)
    {
        switch ($value) {
            case '1':
                $type = 'Base';
                break;
            case '2':
                $type = 'Absoluto';
                break;
            case '3':
                $type = 'Master';
                break;
            default:
                $type = 'Base';
                break;
        }
        return $type;
    }
    public function getConvertTypeAttribute()
    {
        if ($this->type == 'Base') {
            $type = 1;
        }elseif ($this->type == 'Absoluto') {
            $type = 2;
        }elseif ($this->type == 'Master') {
            $type = 3;
        }else {
            $type = 1;
        }
        return $type;
    }
    public function scopeFilterFields($query, $filters)
    {
        foreach ($filters as $key => $value) {
            if ($key == 'type') {
                switch ($value) {
                    case '1':
                        $type = 'Base';
                        break;
                    case '2':
                        $type = 'Absoluto';
                        break;
                    case '3':
                        $type = 'Master';
                        break;
                    default:
                        $type = 'Base';
                        break;
                }
                return $type;
            }

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
    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
}
