<?php

namespace App\Models\Model;

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
}
