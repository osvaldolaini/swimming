<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Times extends Model
{
    use HasFactory;

    protected $fillable = [
        'athlete_id','category_id','record','modality_id','day','id'
    ];

    // protected $casts = [
    //     'record' => 'datetime:i:s.u',
    // ];

    public function athletes()
    {
        return $this->belongsTo(Athletes::class,'athlete_id','id');
    }

    public function modality()
    {
        return $this->belongsTo(Modalities::class);
    }
}
