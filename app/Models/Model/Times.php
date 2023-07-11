<?php

namespace App\Models\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Times extends Model
{
    use HasFactory;

    protected $fillable = [
        'athlete_id','category_id','record','modality_id','day','id',
        'pool','distance','type_time',
        'updated_by','created_by','code'
    ];

    protected $casts = [
        'day' => 'datetime:Y-m-d',
    ];

    public function athletes()
    {
        return $this->belongsTo(Athletes::class,'athlete_id','id');
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
}
