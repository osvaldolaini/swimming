<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','active','birth_year','birth_year_end','updated_by','created_by','code','name'
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
}
