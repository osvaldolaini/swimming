<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;
class Athletes extends Model
{
    use HasFactory;

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */

    protected $fillable = [
        'id','active','sex','name','birth','nick','updated_by',
        'created_by','code','slug','register','register_date'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name']=mb_strtoupper($value);
        $this->attributes['slug']=Str::slug($value);
    }

    protected $casts = [
        'birth' => 'datetime:Y-m-d',
        'register_date'=>'datetime:Y-m-d',
    ];

    protected $visible = ['id','active','sex','name'];

    public function times()
    {
        return $this->hasMany(Times::class);
    }
    public function timess()
    {
        return $this->hasMany(Times::class,'athlete_id','id');
    }

}
