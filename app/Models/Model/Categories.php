<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','active','birth_year','updated_by','created_by','code','name'
    ];
    // protected $casts = [
    //     'birth_year' => 'datetime:Y',
    // ];
    public function athletes()
    {
        return $this->hasMany(Athletes::class);
    }
}
