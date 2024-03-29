<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','type','name','min_age','max_age','code',
        'updated_by','created_by'
    ];
    // protected $casts = [
    //     'birth_year' => 'datetime:Y',
    // ];
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
}
